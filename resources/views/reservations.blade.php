@include('layouts.header')

<!-- Harici Kütüphaneler -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/css/kanban.css') }}">

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-24">Rezervasyon Yönetimi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ana Sayfa</a></li>
                                <li class="breadcrumb-item active">Rezervasyon Yönetimi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-center">Boş Masalar</h5>
                    <div class="kanban-list" id="empty-tables">
                        <!-- Boş masalar buraya yüklenecek -->
                    </div>
                </div>

                <div class="col-md-6">
                    <h5 class="text-center">Rezerve Edilen Masalar</h5>
                    <div class="kanban-list" id="reserved-tables">
                        <!-- Rezerve edilen masalar buraya yüklenecek -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Masaları yükle
        function loadTables() {
            loadEmptyTables();
            loadReservedTables();
        }

        // Boş masaları yükle
        function loadEmptyTables() {
            $.ajax({
                url: '{{ route('empty-table') }}',
                method: 'GET',
                success: function(data) {
                    renderTables(data, '#empty-tables', createEmptyTableForm);
                },
                error: function() {
                    alert("Boş masalar yüklenemedi. Lütfen tekrar deneyin.");
                }
            });
        }

        // Rezerve edilen masaları yükle
        function loadReservedTables() {
            $.ajax({
                url: '{{ route('reserved-table') }}',
                method: 'GET',
                success: function(data) {
                    renderTables(data, '#reserved-tables', createReservedTableInfo);
                },
                error: function() {
                    alert("Rezerve masalar yüklenemedi. Lütfen tekrar deneyin.");
                }
            });
        }

        // Masaları render et
        function renderTables(tables, containerSelector, createCardFunc) {
            const targetContainer = $(containerSelector);
            targetContainer.empty();

            if (tables.length === 0) {
                targetContainer.append('<p class="text-muted">Henüz masa yok.</p>');
            } else {
                tables.forEach(table => {
                    targetContainer.append(createCardFunc(table));
                });
            }
        }

        // Boş masa için form
        function createEmptyTableForm(table) {
            return `
                <div class="kanban-card" id="table-${table.id}">
                    <h6>${table.name}</h6>
                    <p class="text-muted">Kapasite: ${table.capacity || 'N/A'}</p>
                    <div class="form-group">
                        <label for="customerName${table.id}">Müşteri İsmi:</label>
                        <input type="text" class="form-control mb-2" placeholder="Müşteri İsmi" id="customerName${table.id}">
                    </div>
                    <div class="form-group">
                        <label for="reservationDateTime${table.id}">Tarih ve Saat:</label>
                        <input type="datetime-local" class="form-control mb-2" id="reservationDateTime${table.id}">
                    </div>
                    <button class="btn btn-primary btn-block reserve-btn" data-table="${table.id}">Rezerve Et</button>
                </div>
            `;
        }

        // Rezerve masa bilgisi
        function createReservedTableInfo(table) {
            return `
                <div class="kanban-card" id="table-${table.id}">
                    <h6>${table.name}</h6>
                    <p class="text-muted">Kapasite: ${table.capacity || 'N/A'}</p>
                    <p>Müşteri: ${table.customer_name}</p>
                    <p>Tarih ve Saat: ${table.reservation_date}</p>
                    <button class="btn btn-danger btn-sm mt-2 release-btn" data-table="${table.table_id}">Boşalt</button>
                </div>
            `;
        }

        // Masa rezerve et
        function reserveTable(tableId) {
            const customerName = $(`#customerName${tableId}`).val();
            const reservationDateTime = $(`#reservationDateTime${tableId}`).val();

            if (!customerName || !reservationDateTime) {
                alert("Lütfen müşteri ismi ve tarih/saat girin.");
                return;
            }

            $.ajax({
                url: '{{ route('reserve-table') }}',
                method: 'POST',
                data: {
                    table_id: tableId,
                    customer_name: customerName,
                    reservation_date: reservationDateTime,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    alert("Masa başarıyla rezerve edildi.");
                    loadTables(); // Yenile
                },
                error: function() {
                    alert("Rezerve işlemi sırasında hata oluştu. Lütfen tekrar deneyin.");
                }
            });
        }

        // Masa boşalt
        function releaseTable(tableId) {
            $.ajax({
                url: '{{ route('release-table') }}',
                method: 'POST',
                data: {
                    table_id: tableId,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    alert("Masa başarıyla boşaltıldı.");
                    loadTables(); // Yenile
                },
                error: function() {
                    alert("Boşaltma işlemi sırasında hata oluştu. Lütfen tekrar deneyin.");
                }
            });
        }

        // Buton tıklamaları için olay dinleyicileri
        $(document).on('click', '.reserve-btn', function() {
            const tableId = $(this).data('table');
            reserveTable(tableId);
        });

        $(document).on('click', '.release-btn', function() {
            const tableId = $(this).data('table');
            if (confirm("Masa " + tableId + " boşaltılacak. Devam etmek istiyor musunuz?")) {
                releaseTable(tableId);
            }
        });

        // Sayfa yüklendiğinde verileri yükle
        loadTables();
    });
</script>

@include('layouts.footer')

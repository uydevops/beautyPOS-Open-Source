@include('layouts.header')
@include('layouts.module.tables_add_modal')

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Masa Ayarları</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Analiz</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Masa Ayarları</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Masalar</h5>
                            <p class="card-title-desc">Masalarınızı buradan yönetebilirsiniz.</p>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-danger mb-2" data-bs-toggle="modal"
                                        data-bs-target="#addTableModal"><i class="fas fa-plus"></i> Yeni Masa Ekle</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Masa Adı</th>
                                            <th>Masa Kapasitesi</th>
                                            <th>Durumu</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tables as $table)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="{{ $table->name }}" onchange="updateTable({{ $table->id }}, 'name', this.value)">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="{{ $table->capacity }}" onchange="updateTable({{ $table->id }}, 'capacity', this.value)">
                                            </td>

                                            <td>
                                                <select class="form-select" onchange="updateTable({{ $table->id }}, 'status', this.value)">
                                                    <option value="1" {{ $table->status == 1 ? 'selected' : '' }}><p class="text-success"><i class="fas fa-check"></i> Aktif</p></option>
                                                    <option value="0" {{ $table->status == 0 ? 'selected' : '' }}> <p class="text-danger"><i class="fas fa-times"></i> Pasif</p></option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('tables.delete', $table->id) }}" class="btn btn-danger" onclick="return confirm('Bu masayı silmek istediğinize emin misiniz?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            @include('layouts.footer')
            @include('layouts.datatable')
        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->
</div> <!-- end main-content -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const ajaxSettings = {
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    };

    const messages = {
        successUpdate: 'Masa güncellendi.',
        errorUpdate: 'Masa güncellenirken bir hata oluştu.',
        generalError: 'Bir hata oluştu.'
    };

    const routes = {
        updateTable: "{{ route('tables.update', ':id') }}", 
    };

    function makeAjaxRequest(url, data, onSuccess, onError) {
        $.ajax({
            url: url,
            ...ajaxSettings,
            data: data,
            success: onSuccess,
            error: onError
        });
    }

    function showToast(type, message) {
        if (type === 'success') {
            toastr.success(message);
        } else if (type === 'error') {
            toastr.error(message);
        }
    }

    function updateTable(id, column, value) {
        const data = {
            [column]: value
        };

        const url = routes.updateTable.replace(':id', id);

        makeAjaxRequest(url, data, handleUpdateSuccess, handleUpdateError);
    }

    function handleUpdateSuccess(response) {
        if (response.message === 'Table updated successfully!') {
            showToast('success', messages.successUpdate);
        } else {
            showToast('error', messages.errorUpdate);
        }
    }

    function handleUpdateError(xhr) {
        console.error(xhr);
        const message = xhr.responseJSON?.message || messages.generalError;
        showToast('error', message);
    }
</script>
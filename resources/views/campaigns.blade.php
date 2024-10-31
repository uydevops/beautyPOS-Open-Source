@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Kampanyalar</h4>
                            <p class="card-title-desc">Güzellik salonu için kampanyaları buradan yönetebilirsiniz.</p>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">Kampanya Oluştur</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('campaigns.add') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="campaignName" class="form-label">Kampanya Adı</label>
                                                    <input type="text" class="form-control" id="campaignName" name="campaign_name" placeholder="Kampanya adını girin" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="sendType" class="form-label">Gönderim Türü Seçin:</label>
                                                    <select class="form-select" id="sendType" name="send_type">
                                                        <option value="sms">SMS</option>
                                                        <option value="app">Uygulama</option>
                                                    </select>
                                                </div> 

                                                <div class="mb-3">
                                                    <label for="customerType" class="form-label">Müşteri Türü Seçin:</label>
                                                    <select class="form-select" id="customerType" name="customer_type">
                                                        <option value="all">Tüm Müşteriler</option>
                                                        <option value="specific">Belirli Müşteriler</option>
                                                        <option value="vip">VIP Müşteriler</option>
                                                    </select>
                                                </div>


                                                <!------Gönderim Türü Seçin:------>
                                          

                                                <div class="mb-3 d-none" id="specificCustomers">
                                                    <label>Belirli Müşterileri Seçin:</label>
                                                    <div class="row">
                                                        @foreach($customers as $index => $customer)
                                                            <div class="col-md-3 mb-2"> <!-- Her müşteri için 3 sütun genişliği -->
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customer{{ $customer->id }}" name="customers[]" value="{{ $customer->name }}">
                                                                    <label class="form-check-label" for="customer{{ $customer->id }}">{{ $customer->name }}</label>
                                                                </div>
                                                            </div>
                                                            @if(($index + 1) % 4 == 0) <!-- Her 4 müşteriden sonra satır sonu -->
                                                                </div><div class="row">
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="campaignDetails" class="form-label">Kampanya Detayları:</label>
                                                    <textarea class="form-control" id="campaignDetails" name="campaign_details" rows="3" placeholder="Kampanya detaylarını girin..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success">Kampanyayı Oluştur</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <!-- Kampanya Geçmişi -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Kampanya Geçmişi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kampanya Adı</th>
                                        <th>Türü</th>
                                        <th>Tarih</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campaigns as $campaign)
                                        <tr>
                                            <td>{{ $campaign->campaign_name }}</td>
                                            <td>{{ $campaign->campaign_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($campaign->date)->locale('tr')->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('campaigns.delete', ['id' => $campaign->id]) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Diğer kampanyalar için satır ekleyebilirsiniz -->
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 
            </div>
        </div> 
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Müşteri türüne göre spesifik müşterileri göster
    $('#customerType').change(function() {
        var selectedType = $(this).val();
        if (selectedType === 'specific') {
            $('#specificCustomers').removeClass('d-none');
        } else {
            $('#specificCustomers').addClass('d-none');
        }
    });
</script>

@include('layouts.footer')

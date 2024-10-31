@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Ayarlar</h4>
                            <p class="card-title-desc">Güzellik salonu için ayarları buradan yönetebilirsiniz.</p>

                            <div class="row">
                                <!-- Genel Ayarlar -->
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">Genel Ayarlar</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="salonName" class="form-label">Salon Adı</label>
                                                    <input type="text" class="form-control" id="salonName" placeholder="Salon adını girin">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="salonEmail" class="form-label">E-posta</label>
                                                    <input type="email" class="form-control" id="salonEmail" placeholder="E-posta adresinizi girin">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- SMS Ayarları -->
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">SMS Ayarları</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('settings.sms') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="smsUsername" class="form-label">Kullanıcı Adı</label>
                                                    <input type="text" class="form-control" id="smsUsername" placeholder="Kullanıcı adınızı girin" name="username" value="{{ $smsSettings->username }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="smsPassword" class="form-label">Şifre</label>
                                                    <input type="password" class="form-control" id="smsPassword" placeholder="Şifrenizi girin" name="password" value="{{ $smsSettings->password }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="smsTitle" class="form-label">Başlık</label>
                                                    <input type="text" class="form-control" id="smsTitle" placeholder="SMS başlığınızı girin" name="title" value="{{ $smsSettings->title }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ödeme Ayarları -->
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">Ödeme Ayarları</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="paymentGateway" class="form-label">Ödeme Geçidi</label>
                                                    <select class="form-select" id="paymentGateway">
                                                        <option selected>Seçiniz...</option>
                                                        <option value="1">PayPal</option>
                                                        <option value="2">Stripe</option>
                                                        <option value="3">Kredi Kartı</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Diğer Ayarlar -->
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title">Diğer Ayarlar</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="workingHours" class="form-label">Çalışma Saatleri</label>
                                                    <input type="text" class="form-control" id="workingHours" placeholder="Örneğin: 09:00 - 18:00">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->
</div> <!-- end main-content -->

@include('layouts.footer')

<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Yeni Müşteri Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('customers.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="addCustomerTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info" aria-selected="true">
                                <i class="mdi mdi-account-circle"></i> Temel Bilgiler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-info-tab" data-bs-toggle="tab" href="#contact-info" role="tab" aria-controls="contact-info" aria-selected="false">
                                <i class="mdi mdi-phone"></i> İletişim Bilgileri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="extra-info-tab" data-bs-toggle="tab" href="#extra-info" role="tab" aria-controls="extra-info" aria-selected="false">
                                <i class="mdi mdi-information-outline"></i> Ek Bilgiler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notes-tab" data-bs-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">
                                <i class="mdi mdi-note"></i> Notlar
                            </a>
                        </li>
                    </ul>
                    

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="addCustomerTabContent">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Doğum Tarihi</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Seçiniz</option>
                                    <option value="male">Erkek</option>
                                    <option value="female">Kadın</option>
                                    <option value="other">Diğer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade" id="contact-info" role="tabpanel" aria-labelledby="contact-info-tab">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="address_line1" class="form-label">Adres Satırı 1</label>
                                <input type="text" class="form-control" id="address_line1" name="address_line1">
                            </div>
                            <div class="mb-3">
                                <label for="address_line2" class="form-label">Adres Satırı 2</label>
                                <input type="text" class="form-control" id="address_line2" name="address_line2">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Şehir</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Eyalet</label>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                            <div class="mb-3">
                                <label for="postal_code" class="form-label">Posta Kodu</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Ülke</label>
                                <input type="text" class="form-control" id="country" name="country" value="Turkey">
                            </div>
                        </div>

                        <!-- Extra Information Tab -->
                        <div class="tab-pane fade" id="extra-info" role="tabpanel" aria-labelledby="extra-info-tab">
                            <div class="mb-3">
                                <label for="is_vip" class="form-label">VIP Durumu</label>
                                <select class="form-control" id="is_vip" name="is_vip">
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="total_visits" class="form-label">Toplam Ziyaret</label>
                                <input type="number" class="form-control" id="total_visits" name="total_visits" value="0">
                            </div>
                            <div class="mb-3">
                                <label for="total_spent" class="form-label">Toplam Harcama</label>
                                <input type="number" step="0.01" class="form-control" id="total_spent" name="total_spent" value="0.00">
                            </div>
                            <div class="mb-3">
                                <label for="last_visit" class="form-label">Son Ziyaret</label>
                                <input type="date" class="form-control" id="last_visit" name="last_visit">
                            </div>
                            <div class="mb-3">
                                <label for="preferred_services" class="form-label">Tercih Edilen Hizmetler</label>
                                <input type="text" class="form-control" id="preferred_services" name="preferred_services" placeholder="Örneğin: Manikür, Pedikür">
                            </div>
                        </div>

                        <!-- Notes Tab -->
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notlar</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Müşteri Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>

 .modal-dialog {
    max-width: 800px;
}


.modal-dialog .modal-content {
    border: none;
}

.modal-dialog .modal-content .modal-header {
    border-bottom: none;
}

</style>
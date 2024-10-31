@foreach($customers as $customer)
<div class="modal fade" id="editCustomerModal{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Müşteri Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- PUT metodu belirtildi -->
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="editCustomerTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="edit-basic-info-tab" data-bs-toggle="tab" href="#edit-basic-info{{ $customer->id }}" role="tab" aria-controls="edit-basic-info" aria-selected="true">
                                <i class="mdi mdi-account-circle"></i> Temel Bilgiler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-contact-info-tab" data-bs-toggle="tab" href="#edit-contact-info{{ $customer->id }}" role="tab" aria-controls="edit-contact-info" aria-selected="false">
                                <i class="mdi mdi-phone"></i> İletişim Bilgileri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-extra-info-tab" data-bs-toggle="tab" href="#edit-extra-info{{ $customer->id }}" role="tab" aria-controls="edit-extra-info" aria-selected="false">
                                <i class="mdi mdi-information-outline"></i> Ek Bilgiler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="edit-notes-tab" data-bs-toggle="tab" href="#edit-notes{{ $customer->id }}" role="tab" aria-controls="edit-notes" aria-selected="false">
                                <i class="mdi mdi-note"></i> Notlar
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="editCustomerTabContent">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane fade show active" id="edit-basic-info{{ $customer->id }}" role="tabpanel" aria-labelledby="edit-basic-info-tab">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Doğum Tarihi</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $customer->date_of_birth }}">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Cinsiyet</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Seçiniz</option>
                                    <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Erkek</option>
                                    <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Kadın</option>
                                    <option value="other" {{ $customer->gender == 'other' ? 'selected' : '' }}>Diğer</option>
                                </select>
                            </div>
                        </div>

                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade" id="edit-contact-info{{ $customer->id }}" role="tabpanel" aria-labelledby="edit-contact-info-tab">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="address_line1" class="form-label">Adres Satırı 1</label>
                                <input type="text" class="form-control" id="address_line1" name="address_line1" value="{{ $customer->address_line1 }}">
                            </div>
                            <div class="mb-3">
                                <label for="address_line2" class="form-label">Adres Satırı 2</label>
                                <input type="text" class="form-control" id="address_line2" name="address_line2" value="{{ $customer->address_line2 }}">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Şehir</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city }}">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Eyalet</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ $customer->state }}">
                            </div>
                            <div class="mb-3">
                                <label for="postal_code" class="form-label">Posta Kodu</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $customer->postal_code }}">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Ülke</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $customer->country }}" placeholder="Türkiye">
                            </div>
                        </div>

                        <!-- Extra Information Tab -->
                        <div class="tab-pane fade" id="edit-extra-info{{ $customer->id }}" role="tabpanel" aria-labelledby="edit-extra-info-tab">
                            <div class="mb-3">
                                <label for="is_vip" class="form-label">VIP Durumu</label>
                                <select class="form-control" id="is_vip" name="is_vip">
                                    <option value="0" {{ $customer->is_vip == 0 ? 'selected' : '' }}>Hayır</option>
                                    <option value="1" {{ $customer->is_vip == 1 ? 'selected' : '' }}>Evet</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="total_visits" class="form-label">Toplam Ziyaret</label>
                                <input type="number" class="form-control" id="total_visits" name="total_visits" value="{{ $customer->total_visits }}">
                            </div>
                            <div class="mb-3">
                                <label for="total_spent" class="form-label">Toplam Harcama</label>
                                <input type="number" step="0.01" class="form-control" id="total_spent" name="total_spent" value="{{ $customer->total_spent }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_visit" class="form-label">Son Ziyaret</label>
                                <input type="date" class="form-control" id="last_visit" name="last_visit" value="{{ $customer->last_visit }}">
                            </div>
                        </div>

                        <!-- Notes Tab -->
                        <div class="tab-pane fade" id="edit-notes{{ $customer->id }}" role="tabpanel" aria-labelledby="edit-notes-tab">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notlar</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4">{{ $customer->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Çalışan Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab">Genel Bilgiler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab">İletişim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="employment-tab" data-bs-toggle="tab" href="#employment" role="tab">İş Bilgileri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="additional-tab" data-bs-toggle="tab" href="#additional" role="tab">Ek Bilgiler</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <!-- Genel Bilgiler Tab -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <form action="{{ route('employees.add') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Çalışan Adı <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required placeholder="Ad ve Soyadınızı girin">
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Pozisyon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" required placeholder="Pozisyonu girin">
                            </div>
                    </div>

                    <!-- İletişim Tab -->
                    <div class="tab-pane fade" id="contact" role="tabpanel">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="phone" required placeholder="Telefon numarasını girin">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required placeholder="E-posta adresinizi girin">
                        </div>
                    </div>

                    <!-- İş Bilgileri Tab -->
                    <div class="tab-pane fade" id="employment" role="tabpanel">
                        <div class="mb-3">
                            <label for="salary" class="form-label">Maaş <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="salary" required placeholder="Maaşınızı girin">
                        </div>
                        <div class="mb-3">
                            <label for="hire_date" class="form-label">İşe Giriş Tarihi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="hire_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="leave_days" class="form-label">Kullanılan İzin Günleri</label>
                            <input type="number" class="form-control" name="leave_days" placeholder="Kullanılan izin günlerini girin">
                        </div>
                        <div class="mb-3">
                            <label for="annual_leave_days" class="form-label">İzin Günleri</label>
                            <select class="form-select" name="annual_leave_days">
                                <option value="0">Seçiniz</option>
                                <option value="1">1 Gün</option>
                                <option value="2">2 Gün</option>
                                <option value="3">3 Gün</option>
                                <option value="4">4 Gün</option>
                                <option value="5">5 Gün</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ek Bilgiler Tab -->
                    <div class="tab-pane fade" id="additional" role="tabpanel">
                        <div class="mb-3">
                            <label for="skills" class="form-label">Beceriler</label>
                            <input type="text" class="form-control" id="skillsInput" name="skills" placeholder="Örnek: Dudak Dolgunlaştırma, Botoks, Dolgu">
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Aktif Durumu</label>
                            <select class="form-select" name="is_active">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-none" id="previousButton">Geri</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary" id="nextButton">Geç</button>
                <button type="submit" class="btn btn-success d-none" id="saveButton">Kaydet</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    const nextButton = document.getElementById('nextButton');
    const saveButton = document.getElementById('saveButton');
    const previousButton = document.getElementById('previousButton');
    const tabs = ['general', 'contact', 'employment', 'additional'];
    let currentIndex = 0;

    nextButton.addEventListener('click', () => {
        if (currentIndex < tabs.length - 1) {
            currentIndex++;
            updateTab();
            if (currentIndex === tabs.length - 1) {
                nextButton.classList.add('d-none');
                saveButton.classList.remove('d-none');
            }
            previousButton.classList.remove('d-none');
        }
    });

    previousButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateTab();
            if (currentIndex === 0) previousButton.classList.add('d-none');
            nextButton.classList.remove('d-none');
            saveButton.classList.add('d-none');
        }
    });

    function updateTab() {
        document.querySelectorAll('.nav-link').forEach((tab, index) => {
            tab.classList.toggle('active', index === currentIndex);
            document.querySelector(`#${tabs[index]}`).classList.toggle('show', index === currentIndex);
            document.querySelector(`#${tabs[index]}`).classList.toggle('active', index === currentIndex);
        });
    }

    saveButton.addEventListener('click', () => {
        document.querySelector('form').submit();
    });
</script>

<style>
/* Modal Başlık */
.modal-header {
    background-color: #007bff; /* Başlık arka plan rengi */
    color: #fff; /* Başlık yazı rengi */
}

/* Modal İçerik */
.modal-content {
    border-radius: 8px; /* Kenar yuvarlama */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Gölge efekti */
}

/* Tab Bağlantıları */
.nav-tabs .nav-link {
    border: none; /* Kenarları kaldır */
    border-radius: 0; /* Kenar yuvarlama kaldır */
    color: #007bff; /* Metin rengi */
    padding: 10px 20px; /* İç boşluk */
}

.nav-tabs .nav-link.active {
    background-color: #e9ecef; /* Aktif sekme arka plan rengi */
    color: #000; /* Aktif sekme yazı rengi */
    font-weight: bold; /* Kalın yazı */
}

/* Form Giriş Alanları */
.form-control {
    border: 1px solid #ced4da; /* Kenar rengi */
    border-radius: 5px; /* Kenar yuvarlama */
    transition: border-color 0.2s; /* Kenar rengi geçiş efekti */
}

.form-control:focus {
    border-color: #007bff; /* Odaklanınca kenar rengi */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Odaklanınca gölge efekti */
}

/* Modal Alt Kısmı */
.modal-footer {
    border-top: 1px solid #ced4da; /* Üst kenar rengi */
}

.modal-footer .btn {
    border-radius: 20px; /* Düğme kenar yuvarlama */
    padding: 10px 20px; /* Düğme iç boşluk */
    transition: background-color 0.2s, color 0.2s; /* Geçiş efekti */
}

.modal-footer .btn-primary {
    background-color: #007bff; /* Düğme arka plan rengi */
    color: #fff; /* Düğme yazı rengi */
}

.modal-footer .btn-primary:hover {
    background-color: #0056b3; /* Üzerine gelince arka plan rengi */
}

.modal-footer .btn-success {
    background-color: #28a745; /* Başarılı düğme rengi */
    color: #fff; /* Yazı rengi */
}

.modal-footer .btn-success:hover {
    background-color: #218838; /* Üzerine gelince başarılı düğme rengi */
}

/* Yetenek Girişi Alanı */
.skills-input {
    border: 1px solid #007bff; /* Kenar rengi */
    border-radius: 5px; /* Kenar yuvarlama */
    padding: 10px; /* İç boşluk */
    background-color: #f8f9fa; /* Arka plan rengi */
}

/* Yetenek Etiketleri */
.skills-input span {
    background-color: #007bff; /* Etiket arka plan rengi */
    color: #fff; /* Etiket yazı rengi */
    padding: 5px 10px; /* İç boşluk */
    border-radius: 12px; /* Kenar yuvarlama */
    font-size: 0.875rem; /* Yazı boyutu */
}

/* Yetenek Silme Düğmesi */
.skills-input span .remove-skill {
    cursor: pointer; /* İşaretçi değişimi */
    font-weight: bold; /* Kalın yazı */
    color: #fff; /* Yazı rengi */
    margin-left: 5px; /* Sol boşluk */
}

</style>

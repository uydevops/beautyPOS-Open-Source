<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm rounded-4 border-0">
                        <div class="card-body p-5">
                            <h4 class="card-title text-center mb-4"><i class="bi bi-calendar-plus"></i> Hızlı Randevu Oluştur</h4>
                            <p class="text-muted text-center mb-4">Güzellik salonu için hızlı randevu oluşturabilirsiniz.</p>

                            <form action="{{ route('add-reservation') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="service-section" class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label for="service-select" class="form-label"></label>
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-service-btn">
                                            <i class="bi bi-plus-lg"></i> İşlem Ekle
                                        </button>
                                    </div>

                                    <div class="service-group mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-person"></i> Müşteri Seçin
                                        </label>
                                        <select class="form-select select2" style="width: 100%; height: auto;">
                                            <option name="customer_id" selected disabled>Seçiniz</option>
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="date-select" class="form-label"><i class="bi bi-calendar-date"></i> Gün Seçin</label>
                                            <input type="text" class="form-control rounded-3" id="date-select" placeholder="Tarih seçin" name="reservation_date">
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label class="form-label"><i class="bi bi-clock"></i> Saat Seçin</label>
                                            <select class="form-select rounded-3" id="time-select" name="reservation_time">
                                                <option selected disabled>Seçiniz</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="service-select" class="form-label"><i class="bi bi-scissors"></i> İşlem Seçin</label>
                                            <select class="form-select rounded-3 service-select" name="services[]" id="service-select-0">
                                                <option value="" selected disabled>Seçiniz</option>
                                            </select>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label for="doctor-select" class="form-label"><i class="bi bi-person-badge"></i> Doktor Seçin</label>
                                            <select class="form-select rounded-3 doctor-select" name="doctor_id[]" id="doctor-select-0">
                                                <option selected disabled>Seçiniz</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="room-select" class="form-label"><i class="bi bi-door-open"></i> Oda Seçin</label>
                                    <select class="form-select rounded-3" id="room-select" name="room_id">
                                        <option selected disabled>Seçiniz</option>
                                        <option value="1">Oda 1</option>
                                        <option value="2">Oda 2</option>
                                        <option value="3">Oda 3</option>
                                    </select>
                                </div>
                               
                                
                                <div class="mb-3">
                                    <label for="note" class="form-label"><i class="bi bi-sticky"></i> Not</label>
                                    <textarea class="form-control rounded-3" id="note" rows="3" placeholder="Notunuzu buraya yazabilirsiniz" name="note"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="total-price" class="form-label"><i class="bi bi-currency-dollar"></i> Toplam Tutar</label>
                                    <input type="text" class="form-control rounded-3" id="total-price" placeholder="Toplam tutar" name="total_price" readonly>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                                        <i class="bi bi-calendar-check"></i> Randevu Oluştur
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
// Elementleri seç
const dateSelect = document.getElementById("date-select");
const serviceSection = document.getElementById("service-section");
const totalPriceInput = document.getElementById("total-price");
const servicePrices = {};
let serviceCount = 1; // Hizmet sayacı

// Tarih seçiciyi başlat
flatpickr(dateSelect, {
    dateFormat: "Y-m-d",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ["Paz", "Pzt", "Sal", "Çar", "Per", "Cum", "Cmt"],
            longhand: ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"]
        },
        months: {
            shorthand: ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"],
            longhand: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"]
        },
    },
    minDate: "today",
    disable: [(date) => date.getDay() === 0], // Pazar günlerini devre dışı bırak
});

// Hizmetleri yükle
const loadServices = async (selectElement) => {
    try {
        const response = await fetch("{{ route('ajax.selectedServices') }}");
        if (!response.ok) throw new Error('Ağ yanıtı uygun değil: ' + response.statusText);
        const data = await response.json();

        selectElement.innerHTML = '<option value="" selected disabled>Seçiniz</option>';
        data.services.forEach(service => {
            const option = new Option(service.service_name, service.service_id);
            selectElement.add(option);
            servicePrices[service.service_id] = service.service_price; // Hizmet fiyatını sakla
        });
    } catch (error) {
        console.error('Hata:', error);
        alert('Hizmetleri yüklerken bir hata oluştu. Lütfen tekrar deneyin.');
    }
};

// Doktorları yükle
const loadDoctorsForService = async (serviceId, doctorSelect) => {
    try {
        const response = await fetch(`{{ route('ajax.findServices', '') }}/${serviceId}`);
        if (!response.ok) throw new Error('Ağ yanıtı uygun değil: ' + response.statusText);
        const data = await response.json();
        updateDoctorSelect(data.doctors, doctorSelect);
    } catch (error) {
        console.error('Hata:', error);
        alert('Doktorları yüklerken bir hata oluştu. Lütfen tekrar deneyin.');
    }
};

// Doktor seçimini güncelle
const updateDoctorSelect = (doctors, doctorSelect) => {
    doctorSelect.innerHTML = '<option selected disabled>Seçiniz</option>';
    doctors.forEach(doctor => {
        const option = new Option(doctor.doctor_name, doctor.doctor_id);
        doctorSelect.add(option);
    });
};

// Toplam fiyatı hesapla
const calculateTotalPrice = () => {
    let total = 0; // Başlangıç değeri 0 olarak ayarlanıyor
    const serviceSelects = document.querySelectorAll('.service-select');

    serviceSelects.forEach(select => {
        const serviceId = select.value;
        if (serviceId && servicePrices[serviceId]) {
            // Metin olarak gelen fiyatı sayıya çevir
            const price = parseFloat(servicePrices[serviceId]);
            if (!isNaN(price)) { // Fiyat geçerli bir sayı mı kontrol et
                total += price; // Hizmet fiyatını ekle
            }
        }
    });

    totalPriceInput.value = total.toFixed(2); // Toplam tutarı güncelle, iki ondalık basamakla
};

// Ekle butonuna tıklanıldığında
const addServiceBtn = document.getElementById("add-service-btn");
addServiceBtn.addEventListener("click", () => {
    const newServiceGroup = document.createElement("div");
    newServiceGroup.classList.add("mb-3", "row", "service-group");

    // İşlem seçimi
    const serviceDiv = document.createElement("div");
    serviceDiv.classList.add("col-md-6");
    const serviceLabel = document.createElement("label");
    serviceLabel.className = "form-label";
    serviceLabel.innerHTML = '<i class="bi bi-scissors"></i> İşlem Seçin';
    const newServiceSelect = document.createElement("select");
    newServiceSelect.className = "form-select rounded-3 service-select";
    newServiceSelect.name = "services[]";

    serviceDiv.appendChild(serviceLabel);
    serviceDiv.appendChild(newServiceSelect);
    newServiceGroup.appendChild(serviceDiv);

    // Doktor seçimi
    const doctorDiv = document.createElement("div");
    doctorDiv.classList.add("col-md-6");
    const doctorLabel = document.createElement("label");
    doctorLabel.className = "form-label";
    doctorLabel.innerHTML = '<i class="bi bi-person-badge"></i> Doktor Seçin';
    const newDoctorSelect = document.createElement("select");
    newDoctorSelect.className = "form-select rounded-3 doctor-select";
    newDoctorSelect.name = "doctor_id[]"; // Doktor ID'si dizisi olarak ayarlanıyor

    doctorDiv.appendChild(doctorLabel);
    doctorDiv.appendChild(newDoctorSelect);
    newServiceGroup.appendChild(doctorDiv);

    serviceSection.appendChild(newServiceGroup);

    loadServices(newServiceSelect);

    newServiceSelect.addEventListener("change", () => {
        const serviceId = newServiceSelect.value;
        loadDoctorsForService(serviceId, newDoctorSelect); // Doktorları yükle
        calculateTotalPrice(); // Fiyatı güncelle
    });
});

// Başlangıçta hizmetleri yükle
loadServices(document.getElementById("service-select-0")); // İlk hizmeti yükle
document.getElementById("service-select-0").addEventListener("change", () => {
    const serviceId = document.getElementById("service-select-0").value;
    loadDoctorsForService(serviceId, document.getElementById("doctor-select-0")); // İlk doktor seçimini yükle
    calculateTotalPrice(); 
});

dateSelect.addEventListener("change", calculateTotalPrice);
</script>

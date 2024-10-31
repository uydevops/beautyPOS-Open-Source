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
                    <div class="card shadow-sm rounded-4">
                        <div class="card-body p-5">
                            <h4 class="card-title text-center mb-4"><i class="bi bi-calendar-plus"></i> Hızlı Randevu Oluştur</h4>
                            <p class="text-muted text-center">Güzellik salonu için hızlı randevu oluşturabilirsiniz.</p>

                            <form id="appointment-form">
                                <div id="service-section">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label for="service-select" class="form-label"><i class="bi bi-scissors"></i> İşlem Seçin</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-service-btn"><i class="bi bi-plus-lg"></i> İşlem Ekle</button>
                                    </div>
                                    <div class="service-group mb-3">
                                        <select class="form-select rounded-3 service-select" name="services[]"></select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="room-select" class="form-label"><i class="bi bi-door-open"></i> Oda Seçin</label>
                                    <select class="form-select rounded-3" id="room-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Oda 1</option>
                                        <option value="2">Oda 2</option>
                                        <option value="3">Oda 3</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="date-select" class="form-label"><i class="bi bi-calendar-date"></i> Gün Seçin</label>
                                    <input type="text" class="form-control rounded-3" id="date-select" placeholder="Tarih seçin">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><i class="bi bi-clock"></i> Saat Seçin</label>
                                    <select class="form-select rounded-3" id="time-select"></select>
                                </div>

                                <div class="mb-3">
                                    <label for="doctor-select" class="form-label"><i class="bi bi-person-badge"></i> Doktor Seçin</label>
                                    <select class="form-select rounded-3" id="doctor-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Dr. Ali Yılmaz</option>
                                        <option value="2">Dr. Ayşe Kaya</option>
                                        <option value="3">Dr. Mehmet Can</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2"><i class="bi bi-calendar-check"></i> Randevu Oluştur</button>
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
    const dateSelect = document.getElementById("date-select");
    const serviceSelect = document.querySelector(".service-select");
    const timeSelect = document.getElementById("time-select");
    const serviceSection = document.getElementById("service-section");
    const addServiceBtn = document.getElementById("add-service-btn");

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
        disable: [(date) => date.getDay() === 0],
    });

    const loadServices = async (selectElement) => {
        try {
            const response = await fetch("{{ route('ajax.selectedServices') }}");
            if (!response.ok) throw new Error('Ağ yanıtı uygun değil: ' + response.statusText);
            const data = await response.json();
            data.services.forEach(service => {
                selectElement.add(new Option(service.service_name, service.service_id));
            });
        } catch (error) {
            console.error('Hata:', error);
            alert('Hizmetleri yüklerken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    };

    const loadAvailableTimes = async (selectedDate) => {
        try {
            const response = await fetch(`{{ route('ajax.emptyDate', '') }}/${selectedDate}`);
            if (!response.ok) throw new Error('Ağ yanıtı uygun değil: ' + response.statusText);
            const data = await response.json();
            updateTimeSelect(data.reservations);
        } catch (error) {
            console.error('Hata:', error);
            alert('Tarih seçilirken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    };

    const updateTimeSelect = (reservations) => {
        const openingHour = 8;
        const closingHour = 18;
        const intervalMinutes = 20;

        const allSlots = [];
        for (let hour = openingHour; hour < closingHour; hour++) {
            for (let minute = 0; minute < 60; minute += intervalMinutes) {
                const timeSlot = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
                allSlots.push(timeSlot);
            }
        }
        const bookedSlots = reservations.map(reservation => reservation.reservation_date);
        timeSelect.innerHTML = '<option selected="">Seçiniz</option>';
        allSlots.forEach(slot => {
            if (!bookedSlots.includes(slot)) {
                const option = new Option(slot, slot);
                timeSelect.add(option);
            }
        });
    };

    const addServiceSelect = () => {
        const newServiceGroup = document.createElement("div");
        newServiceGroup.classList.add("service-group", "mb-3");

        const newSelect = document.createElement("select");
        newSelect.classList.add("form-select", "rounded-3", "service-select");
        newSelect.name = "services[]";
        newServiceGroup.appendChild(newSelect);

        serviceSection.appendChild(newServiceGroup);
        loadServices(newSelect);
    };

    addServiceBtn.addEventListener("click", addServiceSelect);

    dateSelect.addEventListener("change", () => {
        const selectedDate = dateSelect.value;
        loadAvailableTimes(selectedDate);
    });

    document.addEventListener("DOMContentLoaded", () => {
        loadServices(serviceSelect);
    });
</script>
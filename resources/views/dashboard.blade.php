<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@include('layouts.header')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Hızlı Randevu Oluştur</h4>
                            <p class="card-title-desc">Güzellik salonu için hızlı randevu oluşturabilirsiniz.</p>

                            <form id="appointment-form">
                                <div class="mb-3">
                                    <label for="service-select" class="form-label"><i class="bi bi-scissors"></i> İşlem Seçin</label>
                                    <select class="form-select" id="service-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Saç Kesimi</option>
                                        <option value="2">Cilt Bakımı</option>
                                        <option value="3">Manikür</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="room-select" class="form-label"><i class="bi bi-door-open"></i> Oda Seçin</label>
                                    <select class="form-select" id="room-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Oda 1</option>
                                        <option value="2">Oda 2</option>
                                        <option value="3">Oda 3</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="date-select" class="form-label"><i class="bi bi-calendar-date"></i> Gün Seçin</label>
                                    <input type="text" class="form-control" id="date-select" placeholder="Tarih seçin">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><i class="bi bi-clock"></i> Saat Seçin</label>
                                    <div id="time-slots" class="d-flex flex-wrap gap-2"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="doctor-select" class="form-label"><i class="bi bi-person-badge"></i> Doktor Seçin</label>
                                    <select class="form-select" id="doctor-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Dr. Ali Yılmaz</option>
                                        <option value="2">Dr. Ayşe Kaya</option>
                                        <option value="3">Dr. Mehmet Can</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-calendar-check"></i> Randevu Oluştur</button>
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
    flatpickr("#date-select", {
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr) {
            updateAvailableTimeSlots(dateStr);
        }
    });

    const bookedSlots = ["13:00"];

    function updateAvailableTimeSlots(dateStr) {
        const timeSlotsContainer = document.getElementById("time-slots");
        timeSlotsContainer.innerHTML = ""; 
        const interval = 20; 
        const openingHour = 9; 
        const closingHour = 18; 

        for (let hour = openingHour; hour < closingHour; hour++) {
            for (let minute = 0; minute < 60; minute += interval) {
                const time = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
                const isBooked = bookedSlots.includes(time);
                const timeSlotBox = document.createElement("button");
                timeSlotBox.type = "button";
                timeSlotBox.className = `time-slot btn ${isBooked ? 'btn-danger' : 'btn-outline-primary'}`;
                timeSlotBox.innerText = time;
                timeSlotBox.disabled = isBooked;
                if (!isBooked) {
                    timeSlotBox.addEventListener("click", () => {
                        document.querySelectorAll(".time-slot").forEach(slot => slot.classList.remove("btn-primary"));
                        timeSlotBox.classList.add("btn-primary");
                    });
                }
                timeSlotsContainer.appendChild(timeSlotBox);
            }
        }
    }
</script>

<style>
    .time-slot {
        width: 70px;
        margin-bottom: 5px;
    }
</style>

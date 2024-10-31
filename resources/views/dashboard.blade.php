<!-- Including Bootstrap CSS and JS CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Including Bootstrap Icons for form styling -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

<!-- Including Flatpickr for date picker functionality -->
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
                                <!-- Step 0: İşlem Seçtir -->
                                <div class="mb-3">
                                    <label for="service-select" class="form-label"><i class="bi bi-scissors"></i> İşlem Seçin</label>
                                    <select class="form-select" id="service-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Saç Kesimi</option>
                                        <option value="2">Cilt Bakımı</option>
                                        <option value="3">Manikür</option>
                                    </select>
                                </div>

                                <!-- Step 1: Oda Seçtir -->
                                <div class="mb-3">
                                    <label for="room-select" class="form-label"><i class="bi bi-door-open"></i> Oda Seçin</label>
                                    <select class="form-select" id="room-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Oda 1</option>
                                        <option value="2">Oda 2</option>
                                        <option value="3">Oda 3</option>
                                    </select>
                                </div>

                                <!-- Step 2: Gün Seçtir with Flatpickr Date Picker -->
                                <div class="mb-3">
                                    <label for="date-select" class="form-label"><i class="bi bi-calendar-date"></i> Gün Seçin</label>
                                    <input type="text" class="form-control" id="date-select" placeholder="Tarih seçin">
                                </div>

                                <!-- Step 3: Saat Seçtir with dynamically generated time slots -->
                                <div class="mb-3">
                                    <label class="form-label"><i class="bi bi-clock"></i> Saat Seçin</label>
                                    <div id="time-slots" class="d-flex flex-wrap gap-2"></div>
                                </div>

                                <!-- Step 4: Doktor Seçtir -->
                                <div class="mb-3">
                                    <label for="doctor-select" class="form-label"><i class="bi bi-person-badge"></i> Doktor Seçin</label>
                                    <select class="form-select" id="doctor-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">Dr. Ali Yılmaz</option>
                                        <option value="2">Dr. Ayşe Kaya</option>
                                        <option value="3">Dr. Mehmet Can</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-calendar-check"></i> Randevu Oluştur</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- End row -->
        </div> <!-- End container-fluid -->
    </div> <!-- End page-content -->
</div> <!-- End main-content -->

@include('layouts.footer')

<!-- Flatpickr Initialization Script -->
<script>
    // Initialize Flatpickr for date selection
    flatpickr("#date-select", {
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr) {
            // Call function to update available time slots based on the selected date
            updateAvailableTimeSlots(dateStr);
        }
    });

    // Example booked slots for demonstration (e.g., '13:00' is unavailable)
    const bookedSlots = ["13:00"];

    // Function to generate time slot boxes for the selected date
    function updateAvailableTimeSlots(dateStr) {
        const timeSlotsContainer = document.getElementById("time-slots");
        timeSlotsContainer.innerHTML = ""; // Clear previous slots

        const interval = 20; // 20-minute intervals
        const openingHour = 9; // 9:00 AM
        const closingHour = 18; // 6:00 PM

        for (let hour = openingHour; hour < closingHour; hour++) {
            for (let minute = 0; minute < 60; minute += interval) {
                const time = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
                const isBooked = bookedSlots.includes(time);
                const timeSlotBox = document.createElement("button");
                timeSlotBox.type = "button";
                timeSlotBox.className = `time-slot btn ${isBooked ? 'btn-danger' : 'btn-outline-primary'}`;
                timeSlotBox.innerText = time;
                timeSlotBox.disabled = isBooked;

                // Click event to select time slot
                if (!isBooked) {
                    timeSlotBox.addEventListener("click", () => {
                        // Deselect all other selected time slots
                        document.querySelectorAll(".time-slot").forEach(slot => slot.classList.remove("btn-primary"));
                        // Select this time slot
                        timeSlotBox.classList.add("btn-primary");
                    });
                }
                timeSlotsContainer.appendChild(timeSlotBox);
            }
        }
    }
</script>

<style>
    /* Custom styles for time slot selection */
    .time-slot {
        width: 70px;
        margin-bottom: 5px;
    }
</style>

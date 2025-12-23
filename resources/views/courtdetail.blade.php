<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Book Court - Padel Court Booking</x-slot:title>

    <section class="py-12 px-4 bg-gray-50 min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Select Your Court</h1>
                <p class="text-gray-600">Choose your preferred court type and time slot</p>
            </div>

            <!-- Court Type Selection - Hanya tampilkan court yang dipilih -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Court Type</h2>
                @php
                    // Ambil dari parameter 'type' atau 'category'
                    $selectedType = request('type');
                    $categoryId = request('category');

                    // Mapping category ID ke type
                    if ($categoryId == 1) {
                        $selectedType = 'indoor';
                    } elseif ($categoryId == 2) {
                        $selectedType = 'outdoor';
                    } elseif ($categoryId == 3) {
                        $selectedType = 'semi-outdoor';
                    }
                @endphp

                @if ($selectedType == 'indoor')
                    <!-- Indoor Court Only -->
                    <div class="max-w-md">
                        <div class="border-2 border-purple-600 bg-purple-50 rounded-xl p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Indoor Court</h3>
                            </div>
                            <img src="https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=400"
                                alt="Indoor Court" class="w-full h-40 object-cover rounded-lg mb-4">
                            <p class="text-gray-600 mb-3">Climate-controlled, professional lighting</p>
                            <p class="text-2xl font-bold text-purple-600">Rp 200.000<span
                                    class="text-sm text-gray-500">/hour</span></p>
                        </div>
                    </div>
                @elseif($selectedType == 'outdoor')
                    <!-- Outdoor Court Only -->
                    <div class="max-w-md">
                        <div class="border-2 border-green-600 bg-green-50 rounded-xl p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Outdoor Court</h3>
                            </div>
                            <img src="https://images.unsplash.com/photo-1622163642998-1ea32b0bbc67?w=400"
                                alt="Outdoor Court" class="w-full h-40 object-cover rounded-lg mb-4">
                            <p class="text-gray-600 mb-3">Open-air, natural environment</p>
                            <p class="text-2xl font-bold text-green-600">Rp 150.000<span
                                    class="text-sm text-gray-500">/hour</span></p>
                        </div>
                    </div>
                @elseif($selectedType == 'semi-outdoor')
                    <!-- Semi Outdoor Court Only -->
                    <div class="max-w-md">
                        <div class="border-2 border-blue-600 bg-blue-50 rounded-xl p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Semi Outdoor Court</h3>
                            </div>
                            <img src="https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=400"
                                alt="Semi Outdoor Court" class="w-full h-40 object-cover rounded-lg mb-4">
                            <p class="text-gray-600 mb-3">Partially covered, best of both worlds</p>
                            <p class="text-2xl font-bold text-blue-600">Rp 175.000<span
                                    class="text-sm text-gray-500">/hour</span></p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Silakan pilih kategori lapangan terlebih dahulu</p>
                    </div>
                @endif
            </div>

            <!-- Date Selection -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Select Date</h2>
                <input type="date" id="booking_date"
                    class="w-full md:w-auto px-6 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none text-lg"
                    min="{{ date('Y-m-d') }}">
            </div>

            <!-- Time Slots -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Available Time Slots</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @php
                        $timeSlots = [
                            '06:00 - 07:00',
                            '07:00 - 08:00',
                            '08:00 - 09:00',
                            '09:00 - 10:00',
                            '10:00 - 11:00',
                            '11:00 - 12:00',
                            '12:00 - 13:00',
                            '13:00 - 14:00',
                            '14:00 - 15:00',
                            '15:00 - 16:00',
                            '16:00 - 17:00',
                            '17:00 - 18:00',
                            '18:00 - 19:00',
                            '19:00 - 20:00',
                            '20:00 - 21:00',
                            '21:00 - 22:00',
                            '22:00 - 23:00',
                        ];
                    @endphp

                    @foreach ($timeSlots as $index => $slot)
                        <label class="cursor-pointer">
                            <input type="radio" name="time_slot" value="{{ $slot }}" class="hidden peer">
                            <div
                                class="border-2 border-gray-200 rounded-lg p-4 text-center peer-checked:border-purple-600 peer-checked:bg-purple-600 peer-checked:text-white hover:border-purple-300 transition">
                                <p class="font-semibold">{{ $slot }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Summary and Continue -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Booking Summary</h3>
                        <p class="text-purple-100 mb-4">Review your selection before proceeding</p>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-semibold">Court Type:</span> <span id="summary_court">Not
                                    selected</span></p>
                            <p><span class="font-semibold">Date:</span> <span id="summary_date">Not selected</span></p>
                            <p><span class="font-semibold">Time:</span> <span id="summary_time">Not selected</span></p>
                            <p class="text-2xl font-bold mt-4">Total: <span id="summary_price">Rp 0</span></p>
                        </div>
                    </div>
                    <button id="continue_btn"
                        class="bg-white text-purple-600 px-8 py-4 rounded-lg font-bold text-lg hover:shadow-2xl transition disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        Continue to Booking Details
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Ambil parameter dari URL
        const urlParams = new URLSearchParams(window.location.search);
        let selectedCourt = urlParams.get('type') || '';
        const categoryId = urlParams.get('category');

        // Mapping category ID ke type
        if (categoryId == 1) {
            selectedCourt = 'indoor';
        } else if (categoryId == 2) {
            selectedCourt = 'outdoor';
        } else if (categoryId == 3) {
            selectedCourt = 'semi-outdoor';
        }

        let selectedDate = '';
        let selectedTime = '';
        const courtPrices = {
            'indoor': 200000,
            'outdoor': 150000,
            'semi-outdoor': 175000
        };

        // Initialize court selection from URL parameter
        if (selectedCourt) {
            updateSummary();
        }

        // Date selection
        document.getElementById('booking_date').addEventListener('change', (e) => {
            selectedDate = e.target.value;
            updateSummary();
        });

        // Time slot selection
        document.querySelectorAll('input[name="time_slot"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                selectedTime = e.target.value;
                updateSummary();
            });
        });

        function updateSummary() {
            const summaryCourtEl = document.getElementById('summary_court');
            const summaryDateEl = document.getElementById('summary_date');
            const summaryTimeEl = document.getElementById('summary_time');
            const summaryPriceEl = document.getElementById('summary_price');
            const continueBtn = document.getElementById('continue_btn');

            // Update court type
            if (selectedCourt) {
                summaryCourtEl.textContent = selectedCourt.charAt(0).toUpperCase() + selectedCourt.slice(1) + ' Court';
            } else {
                summaryCourtEl.textContent = 'Not selected';
            }

            // Update date
            if (selectedDate) {
                const dateObj = new Date(selectedDate);
                summaryDateEl.textContent = dateObj.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            } else {
                summaryDateEl.textContent = 'Not selected';
            }

            // Update time
            summaryTimeEl.textContent = selectedTime || 'Not selected';

            // Update price
            if (selectedCourt) {
                const price = courtPrices[selectedCourt];
                summaryPriceEl.textContent = 'Rp ' + price.toLocaleString('id-ID');
            } else {
                summaryPriceEl.textContent = 'Rp 0';
            }

            // Enable/disable continue button
            if (selectedCourt && selectedDate && selectedTime) {
                continueBtn.disabled = false;
            } else {
                continueBtn.disabled = true;
            }
        }

        // Continue button action
        document.getElementById('continue_btn').addEventListener('click', () => {
            if (selectedCourt && selectedDate && selectedTime) {
                const price = courtPrices[selectedCourt];
                window.location.href =
                    `/booking-detail?type=${selectedCourt}&date=${selectedDate}&time=${selectedTime}&price=${price}`;
            }
        });
    </script>
</x-layout>
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

            <!-- Court Type Selection -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Court Info</h2>
                @if ($category)
                    @php
                        // Keep image mapping for aesthetics since DB might not have images
                        $images = [
                            1 => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=400', // Indoor
                            2 => 'https://images.unsplash.com/photo-1622163642998-1ea32b0bbc67?w=400', // Outdoor
                            3 => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=400', // Semi
                        ];
                        $bgColors = [
                            1 => 'bg-purple-50 border-purple-600',
                            2 => 'bg-green-50 border-green-600',
                            3 => 'bg-blue-50 border-blue-600',
                        ];
                        // Default fallback
                        if ($category->image) {
                            $img = Str::startsWith($category->image, 'http')
                                ? $category->image
                                : Storage::url($category->image);
                        } else {
                            $img = $images[$category->id] ?? 'https://via.placeholder.com/400x200';
                        }
                        $bg = $bgColors[$category->id] ?? 'bg-gray-50 border-gray-600';
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column: Court Visuals & Info -->
                        <div
                            class="border-2 {{ $bg }} rounded-xl p-6 transition transform hover:scale-[1.02] duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ $category->category_name }}</h3>
                                <span
                                    class="bg-white/80 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-600 shadow-sm">
                                    Premium
                                </span>
                            </div>
                            <div class="relative overflow-hidden rounded-lg mb-4 shadow-md group">
                                <img src="{{ $img }}" alt="{{ $category->category_name }}"
                                    class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-500">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                    <p class="text-white font-semibold text-sm">Best choice for professionals</p>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-3 leading-relaxed">{{ $category->description }}</p>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>High Quality Surface</span>
                            </div>
                        </div>

                        <!-- Right Column: Selection Area -->
                        <div class="flex flex-col justify-center">
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-xl p-8 shadow-sm h-full flex flex-col justify-center relative overflow-hidden">
                                <div
                                    class="absolute top-0 right-0 w-24 h-24 bg-purple-100 rounded-bl-full -mr-4 -mt-4 opacity-50">
                                </div>

                                <div class="relative z-10">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Ready to Play?</h3>
                                    <p class="text-gray-500 mb-8">Select specific court to check availability and book
                                        your slot.</p>

                                    <label for="court_select"
                                        class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">
                                        Choose Specific Court
                                    </label>
                                    <div class="relative">
                                        <select id="court_select"
                                            class="w-full p-4 pl-5 pr-10 border-2 border-purple-100 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 focus:outline-none appearance-none bg-white text-gray-700 font-medium text-lg transition shadow-sm cursor-pointer hover:border-purple-300">
                                            <option value="">-- Select a Court --</option>
                                            @foreach ($courts as $court)
                                                <option value="{{ $court->id }}"
                                                    data-price="{{ $court->price_per_hour }}"
                                                    data-name="{{ $court->court_name }}">
                                                    {{ $court->court_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-purple-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Price Preview Box -->
                                    <div id="price_preview_box"
                                        class="mt-6 p-4 bg-white rounded-lg border border-gray-100 shadow-sm opacity-0 transition-all duration-300 transform translate-y-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500 text-sm">Hourly Rate</span>
                                            <span id="price_preview_text" class="text-xl font-bold text-purple-600">Rp
                                                0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Kategori tidak ditemukan. Silakan pilih kategori lapangan terlebih
                            dahulu.</p>
                        <a href="/" class="text-purple-600 font-bold hover:underline">Kembali ke Home</a>
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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Available Time Slots</h2>
                    <span class="text-sm text-gray-500">Click to select multiple slots</span>
                </div>
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
                            <input type="checkbox" name="time_slot" value="{{ $slot }}"
                                class="hidden peer time-slot-checkbox">
                            <div
                                class="border-2 border-gray-200 rounded-lg p-4 text-center peer-checked:border-purple-600 peer-checked:bg-purple-600 peer-checked:text-white hover:border-purple-300 transition">
                                <p class="font-semibold">{{ $slot }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="clear_slots_btn" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                        Clear all selections
                    </button>
                </div>
            </div>

            <!-- Summary and Continue -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Booking Summary</h3>
                        <p class="text-purple-100 mb-4">Review your selection before proceeding</p>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-semibold">Court:</span> <span id="summary_court">Not
                                    selected</span></p>
                            <p><span class="font-semibold">Date:</span> <span id="summary_date">Not selected</span></p>
                            <p><span class="font-semibold">Time Slots:</span> <span id="summary_time">Not
                                    selected</span></p>
                            <p><span class="font-semibold">Duration:</span> <span id="summary_duration">0 hours</span>
                            </p>
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
        let selectedCourtId = '';
        let selectedCourtName = '';
        let selectedPricePerHour = 0;
        let selectedDate = '';
        let selectedTimeSlots = []; // Array to store multiple time slots

        // Court selection dropdown
        const courtSelect = document.getElementById('court_select');
        const pricePreviewBox = document.getElementById('price_preview_box');
        const pricePreviewText = document.getElementById('price_preview_text');

        if (courtSelect) {
            courtSelect.addEventListener('change', function() {
                if (this.value) {
                    selectedCourtId = this.value;
                    const selectedOption = this.options[this.selectedIndex];
                    selectedCourtName = selectedOption.getAttribute('data-name');
                    selectedPricePerHour = parseInt(selectedOption.getAttribute('data-price'));

                    // Show price preview
                    if (pricePreviewBox && pricePreviewText) {
                        pricePreviewText.textContent = 'Rp ' + selectedPricePerHour.toLocaleString('id-ID');
                        pricePreviewBox.classList.remove('opacity-0', 'translate-y-2');
                    }
                } else {
                    selectedCourtId = '';
                    selectedCourtName = '';
                    selectedPricePerHour = 0;

                    // Hide price preview
                    if (pricePreviewBox) {
                        pricePreviewBox.classList.add('opacity-0', 'translate-y-2');
                    }
                }
                updateSummary();
            });
        }

        // Date selection
        document.getElementById('booking_date').addEventListener('change', (e) => {
            selectedDate = e.target.value;
            updateSummary();
        });

        // Time slot selection (multiple checkboxes)
        document.querySelectorAll('input[name="time_slot"]').forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                if (e.target.checked) {
                    // Add to selected slots
                    selectedTimeSlots.push(e.target.value);
                } else {
                    // Remove from selected slots
                    selectedTimeSlots = selectedTimeSlots.filter(slot => slot !== e.target.value);
                }
                updateSummary();
            });
        });

        // Clear all selections button
        document.getElementById('clear_slots_btn').addEventListener('click', () => {
            document.querySelectorAll('input[name="time_slot"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            selectedTimeSlots = [];
            updateSummary();
        });

        function updateSummary() {
            const summaryCourtEl = document.getElementById('summary_court');
            const summaryDateEl = document.getElementById('summary_date');
            const summaryTimeEl = document.getElementById('summary_time');
            const summaryDurationEl = document.getElementById('summary_duration');
            const summaryPriceEl = document.getElementById('summary_price');
            const continueBtn = document.getElementById('continue_btn');

            // Update court name
            if (selectedCourtName) {
                summaryCourtEl.textContent = selectedCourtName;
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

            // Update time slots
            if (selectedTimeSlots.length > 0) {
                summaryTimeEl.textContent = selectedTimeSlots.join(', ');
            } else {
                summaryTimeEl.textContent = 'Not selected';
            }

            // Update duration
            const hours = selectedTimeSlots.length;
            summaryDurationEl.textContent = hours + ' hour' + (hours !== 1 ? 's' : '');

            // Update total price
            const totalPrice = selectedPricePerHour * hours;
            if (totalPrice > 0) {
                summaryPriceEl.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            } else {
                summaryPriceEl.textContent = 'Rp 0';
            }

            // Enable/disable continue button
            if (selectedCourtId && selectedDate && selectedTimeSlots.length > 0) {
                continueBtn.disabled = false;
            } else {
                continueBtn.disabled = true;
            }
        }

        // Continue button action
        document.getElementById('continue_btn').addEventListener('click', () => {
            if (selectedCourtId && selectedDate && selectedTimeSlots.length > 0) {
                // Calculate total price
                const totalPrice = selectedPricePerHour * selectedTimeSlots.length;

                // Encode time slots as JSON string
                const timeSlotsParam = encodeURIComponent(JSON.stringify(selectedTimeSlots));

                // Pass parameters including multiple time slots
                window.location.href =
                    `/booking-detail?court_id=${selectedCourtId}&type=${encodeURIComponent(selectedCourtName)}&date=${selectedDate}&time_slots=${timeSlotsParam}&price=${totalPrice}&hours=${selectedTimeSlots.length}`;
            }
        });
    </script>
</x-layout>

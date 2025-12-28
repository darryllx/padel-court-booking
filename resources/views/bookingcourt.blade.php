<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Booking Details - Padel Court Booking</x-slot:title>

    <section class="bg-neutral-100 py-[124px] min-h-screen">
        <div class="container justify-between px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-8">

                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <form action="{{ route('payment.confirmation') }}" method="POST" id="booking_form"
                        class="bg-white rounded-2xl p-8">
                        @csrf
                        <input type="hidden" name="court_id" value="{{ request('court_id') }}">
                        @php
                            // Parse time from time_slots if time is missing
                            $timeSlot = request('time');
                            if (!$timeSlot && request('time_slots')) {
                                $slots = json_decode(urldecode(request('time_slots')), true);
                                if (is_array($slots) && count($slots) > 0) {
                                    // Extract "06:00" from "06:00-07:00" if needed,
                                    // or just pass the full slot for display/processing
                                    $timeSlot = $slots[0];
                                }
                            }

                            // If time is "06:00-07:00", we might want to split it for cleaner display or processing
                            // But controller expects start_time.
                            // Let's assume controller and payment view can handle "06:00-07:00" or we split it here.
// Controller uses Carbon::parse(). "06:00-07:00" might fail Carbon parse if no format specified.
// Let's safe extract the start time part.
                            if ($timeSlot && str_contains($timeSlot, '-')) {
                                $parts = explode('-', $timeSlot);
                                $cleanTime = trim($parts[0]);
                            } else {
                                $cleanTime = $timeSlot;
                            }
                        @endphp

                        <input type="hidden" name="court_type" value="{{ request('court_id') }}">
                        <input type="hidden" name="booking_date" value="{{ request('date') }}">
                        <input type="hidden" name="time_slot" value="{{ $cleanTime }}">
                        <input type="hidden" name="players" value="{{ request('players') }}">
                        <input type="hidden" name="price" value="{{ request('price') }}">

                        <div class="space-y-1 mb-6">
                            <h1 class="text-2xl font-semibold text-neutral-800 tracking-tight">Fill personal information
                            </h1>
                            <p class="text-neutral-500">Complete your personal information to confirm the booking</p>
                        </div>

                        <!-- Full Name -->
                        <div class="mb-6">
                            <label for="full_name" class="block text-neutral-700 font-semibold mb-2">Full name</label>
                            <input type="text" id="full_name" name="full_name" required
                                value="{{ old('full_name', auth()->check() ? auth()->user()->name : '') }}"
                                class="w-full px-3 py-3 border-2 border-neutral-200 rounded-lg focus:border-blue-600 focus:outline-none"
                                placeholder="Enter your full name">

                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-neutral-700 font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                                class="w-full px-3 py-3 border-2 border-neutral-200 rounded-lg focus:border-blue-600 focus:outline-none"
                                placeholder="Enter your email">

                        </div>

                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-neutral-700 font-semibold mb-2">Phone number</label>
                            <input type="tel" id="phone" name="phone" required
                                value="{{ old('phone', auth()->check() ? auth()->user()->phone_number : '') }}"
                                class="w-full px-3 py-3 border-2 border-neutral-200 rounded-lg focus:border-blue-600 focus:outline-none"
                                placeholder="08xx xxxx xxxx">

                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="notes" class="block text-neutral-700 font-semibold mb-2">Notes
                                (optional)</label>
                            <textarea id="notes" name="notes" rows="4"
                                class="w-full px-3 py-3 border-2 border-neutral-200 rounded-lg focus:border-blue-600 focus:outline-none"
                                placeholder="Let us know if you have some requests"></textarea>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-8">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" id="terms" name="terms" required
                                    class="w-4 h-4 text-blue-600 border-neutral-300 rounded">
                                <span class="ml-3 text-neutral-700">I agree to the <a href="#"
                                        class="text-blue-600 cursor pointer">Terms and Conditions</a>
                                    and <a href="#" class="text-blue-600 cursor pointer">Cancellation
                                        Policy</a></span>
                            </label>
                        </div>

                    </form>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-8 sticky top-24">

                        <h2 class="text-2xl font-semibold text-neutral-800 mb-4 tracking-tight">Booking details</h2>

                        <div class="mb-6">
                            <!-- Court Type -->
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Court</span>
                                <span class="text-neutral-800 text-medium">
                                    {{ ucfirst(request('type')) }}
                                </span>
                            </div>

                            <!-- Date -->
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Date</span>
                                <span class="text-neutral-800 text-medium">
                                    {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}
                                </span>
                            </div>

                            <!-- Time -->
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Time</span>
                                <span class="text-neutral-800 text-medium">
                                    {{ $timeSlot }}
                                </span>
                            </div>

                            <!-- Duration -->
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Duration</span>
                                <span class="text-neutral-800 text-medium"></span>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Subtotal</span>
                                <span class="font-semibold text-neutral-700">Rp
                                    {{ number_format(request('price'), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-1">
                                <span class="text-neutral-500">Service fee</span>
                                <span class="font-semibold text-neutral-700">Rp
                                    {{ number_format(request('price') * 0.05, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="border-neutral-300 mb-4">

                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-neutral-900">Total</span>
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format(request('price') * 1.05, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" form="booking_form"
                                class="w-full bg-blue-500 text-white py-4 rounded-lg font-bold text-lg hover:bg-blue-600 shadow-md transition">
                                Continue payment
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>

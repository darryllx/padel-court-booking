<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Booking Details - Padel Court Booking</x-slot:title>

    <section class="py-12 px-4 bg-gray-50 min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="/book-court"
                    class="text-purple-600 hover:text-purple-700 font-medium inline-flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Court Selection
                </a>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Booking Details</h1>
                <p class="text-gray-600">Complete your information to confirm the booking</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <form action="/payment" method="POST" id="booking_form" class="bg-white rounded-2xl shadow-lg p-8">
                        @csrf
                        <input type="hidden" name="court_type" value="{{ request('type') }}">
                        <input type="hidden" name="booking_date" value="{{ request('date') }}">
                        <input type="hidden" name="time_slot" value="{{ request('time') }}">
                        <input type="hidden" name="price" value="{{ request('price') }}">

                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>

                        <!-- Full Name -->
                        <div class="mb-6">
                            <label for="full_name" class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none"
                                placeholder="Enter your full name">
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none"
                                placeholder="your.email@example.com">
                        </div>

                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none"
                                placeholder="08xx xxxx xxxx">
                        </div>

                        <!-- Number of Players -->
                        <div class="mb-6">
                            <label for="players" class="block text-gray-700 font-semibold mb-2">Number of Players
                                *</label>
                            <select id="players" name="players" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none">
                                <option value="">Select number of players</option>
                                <option value="2">2 Players (Singles)</option>
                                <option value="4">4 Players (Doubles)</option>
                            </select>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="notes" class="block text-gray-700 font-semibold mb-2">Special Requests
                                (Optional)</label>
                            <textarea id="notes" name="notes" rows="4"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none"
                                placeholder="Any special requests or notes..."></textarea>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-6">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" id="terms" name="terms" required
                                    class="mt-1 w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                <span class="ml-3 text-gray-700">
                                    I agree to the <a href="#" class="text-purple-600 hover:underline">Terms and
                                        Conditions</a>
                                    and <a href="#" class="text-purple-600 hover:underline">Cancellation
                                        Policy</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-lg font-bold text-lg hover:shadow-2xl transition">
                            Proceed to Payment
                        </button>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Order Summary</h2>

                        <div class="space-y-4 mb-6">
                            <!-- Court Type -->
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">Court Type</span>
                                <span class="font-semibold text-gray-800">
                                    {{ ucfirst(request('type')) }} Court
                                </span>
                            </div>

                            <!-- Date -->
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">Date</span>
                                <span class="font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}
                                </span>
                            </div>

                            <!-- Time -->
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">Time Slot</span>
                                <span class="font-semibold text-gray-800">
                                    {{ request('time') }}
                                </span>
                            </div>

                            <!-- Duration -->
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">Duration</span>
                                <span class="font-semibold text-gray-800">1 Hour</span>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">Rp
                                    {{ number_format(request('price'), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Service Fee</span>
                                <span class="font-semibold">Rp
                                    {{ number_format(request('price') * 0.05, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-300 pt-3 mt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total</span>
                                    <span class="text-2xl font-bold text-purple-600">
                                        Rp {{ number_format(request('price') * 1.05, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Security Badge -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                            <div class="flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-green-700 font-semibold">Secure Booking</span>
                            </div>
                            <p class="text-green-600 text-sm">Your information is protected</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>

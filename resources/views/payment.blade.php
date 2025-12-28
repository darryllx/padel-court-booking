<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Payment - Padel Court Booking</x-slot:title>

    <style>
        .payment-radio:checked+.payment-option {
            border-color: rgb(147 51 234);
            background-color: rgb(250 245 255);
        }

        .payment-radio:checked+.payment-option .check-circle {
            background-color: rgb(34 197 94);
            border-color: rgb(34 197 94);
        }

        .payment-radio:checked+.payment-option .checkmark {
            display: block;
        }
    </style>

    <section class="py-12 px-4 bg-gray-50 min-h-screen">
        <div class="container mx-auto max-w-6xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="/booking-detail"
                    class="text-purple-600 hover:text-purple-700 font-medium inline-flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Booking Details
                </a>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Payment</h1>
                <p class="text-gray-600">Complete your payment to confirm the booking</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Payment Methods -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Select Payment Method</h2>

                        @if ($errors->any())
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Payment Failed!</strong>
                                <span class="block sm:inline">Please check the errors below.</span>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/payment/process" method="POST" id="payment_form">
                            @csrf
                            <!-- Hidden inputs to pass booking data -->
                            <input type="hidden" name="court_id" value="{{ old('court_id', request('court_id')) }}">
                            <!-- Use date format Y-m-d for value if possible, but keep as passed for now -->
                            <input type="hidden" name="booking_date"
                                value="{{ old('booking_date', request('booking_date')) }}">
                            <input type="hidden" name="start_time"
                                value="{{ old('start_time', request('time_slot')) }}">
                            <input type="hidden" name="total_price" value="{{ old('total_price', request('price')) }}">

                            <input type="hidden" name="customer_name"
                                value="{{ old('customer_name', request('full_name')) }}">
                            <input type="hidden" name="customer_email"
                                value="{{ old('customer_email', request('email')) }}">
                            <input type="hidden" name="customer_phone"
                                value="{{ old('customer_phone', request('phone')) }}">

                            <!-- Additional fields needed for persistence -->
                            <input type="hidden" name="court_type"
                                value="{{ old('court_type', request('court_type')) }}">
                            <input type="hidden" name="players" value="{{ old('players', request('players')) }}">
                            <input type="hidden" name="notes" value="{{ old('notes', request('notes')) }}">

                            <!-- Helper inputs for Request access in view if needed (not standard but useful for the logic below) -->
                            <!-- Or better, update Logic below to use old() -->

                            <!-- E-Wallet -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">E-Wallet</h3>
                                <div class="space-y-3">
                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="gopay"
                                            class="payment-radio hidden" required>
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold">GO</span>
                                                </div>
                                                <span class="font-semibold text-black-800">GoPay</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="ovo"
                                            class="payment-radio hidden">
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold">OVO</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">OVO</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="dana"
                                            class="payment-radio hidden">
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold">DANA</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">DANA</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">Bank Transfer</h3>
                                <div class="space-y-3">
                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="bca"
                                            class="payment-radio hidden">
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold">BCA</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">Bank BCA</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="mandiri"
                                            class="payment-radio hidden">
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold text-xs">MANDIRI</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">Bank Mandiri</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer block">
                                        <input type="radio" name="payment_method" value="bni"
                                            class="payment-radio hidden">
                                        <div
                                            class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-white font-bold">BNI</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">Bank BNI</span>
                                            </div>
                                            <div
                                                class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                                <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Credit/Debit Card -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">Credit/Debit Card</h3>
                                <label class="cursor-pointer block">
                                    <input type="radio" name="payment_method" value="card"
                                        class="payment-radio hidden">
                                    <div
                                        class="payment-option border-2 border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-purple-300 transition">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </div>
                                            <span class="font-semibold text-gray-800">Credit/Debit Card</span>
                                        </div>
                                        <div
                                            class="check-circle w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition">
                                            <svg class="checkmark w-4 h-4 text-white hidden" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-4 rounded-lg font-bold text-lg hover:shadow-2xl transition">
                                Pay Now
                            </button>
                        </form>
                    </div>

                    <!-- Security Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-900 mb-2">Secure Payment</h4>
                                <p class="text-blue-700 text-sm">Your payment information is encrypted and secure. We
                                    never store your card details.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Booking Summary</h2>

                        <!-- Customer Info -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-gray-800 mb-3">Customer Information</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="text-gray-600">Name:</span> <span
                                        class="font-medium">{{ old('customer_name', request('full_name')) }}</span>
                                </p>
                                <p><span class="text-gray-600">Email:</span> <span
                                        class="font-medium">{{ old('customer_email', request('email')) }}</span></p>
                                <p><span class="text-gray-600">Phone:</span> <span
                                        class="font-medium">{{ old('customer_phone', request('phone')) }}</span></p>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600 text-sm">Court Type</span>
                                <span
                                    class="font-semibold text-sm">{{ ucfirst(old('court_type', request('court_type'))) }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600 text-sm">Date</span>
                                <span
                                    class="font-semibold text-sm">{{ \Carbon\Carbon::parse(old('booking_date', request('booking_date')))->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600 text-sm">Time</span>
                                <span
                                    class="font-semibold text-sm">{{ old('start_time', request('time_slot')) }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                                <span class="text-gray-600 text-sm">Players</span>
                                <span class="font-semibold text-sm">{{ old('players', request('players')) }}
                                    Players</span>
                            </div>
                        </div>

                        <!-- Price Details -->
                        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg p-6 text-white">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-purple-100">Subtotal</span>
                                <span class="font-semibold">Rp
                                    {{ number_format(old('total_price', request('price')), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-purple-100">Service Fee (5%)</span>
                                <span class="font-semibold">Rp
                                    {{ number_format(old('total_price', request('price')) * 0.05, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-purple-400 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold">Total Payment</span>
                                    <span class="text-2xl font-bold">
                                        Rp
                                        {{ number_format(old('total_price', request('price')) * 1.05, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>

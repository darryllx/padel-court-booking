<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home - Courtletics Padel Court Booking</x-slot:title>

    <!-- Hero Section -->
    <section class="py-15 bg-gradient-to-r from-blue-300 to-purple-600 text-white">
        <div class="container mx-auto px-4 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <div
                        class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        🎾 Best Padel Court in Bandung
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Let's play at the #1 padel court in Bandung
                    </h1>
                    <p class="text-xl text-black-100 mb-8">
                        Book your favorite court easily and quickly. Modern facilities, professional equipment, and
                        comfortable atmosphere.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#facilities"
                            class="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 transition font-bold text-center shadow-lg hover:shadow-xl transform hover:scale-105">
                            Play now
                        </a>
                        {{-- <a href="/book-court"
                            class="bg-white text-blue-600 px-8 py-4 rounded-xl hover:bg-blue-50 transition font-bold text-center shadow-lg hover:shadow-xl transform hover:scale-105">
                            Book Court
                        </a> --}}
                    </div>
                </div>

                <!-- Right Content - Image -->
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=800&h=600&fit=crop"
                            alt="Padel Court" class="w-full h-[400px] lg:h-[500px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <!-- Floating Badge -->
                        <div class="absolute bottom-6 left-6 bg-white rounded-2xl p-4 shadow-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xl font-bold text-gray-800">Available Now</div>
                                    <div class="text-sm text-gray-500">Book your slot</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Facilities</h2>
                <p class="text-xl text-gray-600">Premium courts and modern amenities</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                <!-- Indoor Court Card -->
                <div class="court-card bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1622163642998-1ea32b0bbc67?w=800&h=400&fit=crop"
                            alt="Indoor Court" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            Indoor
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Available
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Indoor Court</h3>
                        <p class="text-gray-600 mb-6">Air conditioned court with LED lighting system and premium
                            synthetic turf</p>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Air Conditioned</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>LED Lighting System</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Professional Equipment</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Changing Room & Shower</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div>
                                <div class="text-sm text-gray-500">Starting from</div>
                                <div class="text-2xl font-bold text-blue-600">Rp 150,000</div>
                                <div class="text-xs text-gray-500">per hour</div>
                            </div>
                            <a href="/book-court?type=indoor"
                                class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition font-semibold shadow-md hover:shadow-lg">
                                Booking
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Outdoor Court Card -->
                <div class="court-card bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=800&h=400&fit=crop"
                            alt="Outdoor Court" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            Outdoor
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Available
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Outdoor Court</h3>
                        <p class="text-gray-600 mb-6">Premium outdoor court with natural lighting and fresh air
                            environment</p>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Natural Lighting</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Fresh Air Environment</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Premium Synthetic Turf</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Night Lighting Available</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div>
                                <div class="text-sm text-gray-500">Starting from</div>
                                <div class="text-2xl font-bold text-green-600">Rp 120,000</div>
                                <div class="text-xs text-gray-500">per hour</div>
                            </div>
                            <a href="/book-court?type=outdoor"
                                class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition font-semibold shadow-md hover:shadow-lg">
                                Booking
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">1500+</div>
                    <div class="text-blue-100">Happy Players</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">8</div>
                    <div class="text-blue-100">Courts Available</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">4.9</div>
                    <div class="text-blue-100">Average Rating</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Customer Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Why Choose Us?</h2>
                <p class="text-xl text-gray-600">Premium facilities for the best playing experience</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Professional Courts</h3>
                    <p class="text-gray-600">International standard padel courts with high-quality equipment and proper
                        maintenance.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Flexible Schedule</h3>
                    <p class="text-gray-600">Book anytime from 6 AM to 10 PM every day. Choose the time that suits you
                        best.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Easy Payment</h3>
                    <p class="text-gray-600">Multiple payment methods available with secure and fast transaction
                        process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section (ajakan tindakan agar pengguna langsung memesan)-->
    <section class="py-20 hero-gradient text-black">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Play?</h2>
            <p class="text-xl text-black-100 mb-8 max-w-2xl mx-auto">
                Book your court now and experience the best padel facilities in Bandung!
            </p>
            <a href="/book-court"
                class="inline-block bg-white text-blue-600 px-10 py-5 rounded-xl hover:bg-blue-50 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                Book Your Court Now
            </a>
        </div>
    </section>

</x-layout>

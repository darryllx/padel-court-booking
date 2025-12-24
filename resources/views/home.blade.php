<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home - Courtletics Padel Court Booking</x-slot:title>

    <section class="py-15 bg-gradient-to-r from-blue-300 to-purple-600 text-white">
        <div class="container mx-auto px-4 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <div
                        class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        🎾 Best Padel Court in Bandung
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Let's play at the #1 padel court in Bandung
                    </h1>
                    <p class="text-xl text-black-100 mb-8">
                        Booking lapangan padel indoor & outdoor dengan mudah, cepat, dan transparan.
                    </p>
                    <a href="/book-court"
                        class="inline-block bg-white text-blue-600 px-10 py-5 rounded-xl hover:bg-blue-50 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        Book Now
                    </a>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=800&h=500&fit=crop"
                        alt="Padel Court" class="rounded-3xl shadow-2xl w-full h-[400px] object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Our Categories</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Choose Your Court Type</h2>
                <div class="h-1 w-20 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($categories as $category)
                    @php
                        // 1. Logika Pengambilan Gambar
                        if ($category->image) {
                            $imageUrl = Storage::url($category->image);
                        } else {
                            $firstCourt = $category->courts->first();
                            $firstImage = $firstCourt ? $firstCourt->images->first() : null;
                            $imageUrl = $firstImage
                                ? asset($firstImage->image_path)
                                : 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&h=500&fit=crop';
                        }

                        $courtCount = $category->courts->count();

                        // 2. Logika Penentuan Warna Berdasarkan Nama Kategori
                        $catName = strtolower($category->category_name);

                        // Default (Indoor/Lainnya) - Biru
                        $theme = [
                            'badge_text' => 'text-blue-800',
                            'title_hover' => 'group-hover:text-blue-600',
                            'link_hover' => 'group-hover:text-blue-600',
                            'btn_hover_bg' => 'group-hover:bg-blue-600',
                        ];

                        if (str_contains($catName, 'semi')) {
                            // Semi Outdoor - Kuning
                            $theme = [
                                'badge_text' => 'text-yellow-800',
                                'title_hover' => 'group-hover:text-yellow-600',
                                'link_hover' => 'group-hover:text-yellow-600',
                                'btn_hover_bg' => 'group-hover:bg-yellow-500',
                            ];
                        } elseif (str_contains($catName, 'outdoor')) {
                            // Outdoor - Hijau
                            $theme = [
                                'badge_text' => 'text-green-800',
                                'title_hover' => 'group-hover:text-green-600',
                                'link_hover' => 'group-hover:text-green-600',
                                'btn_hover_bg' => 'group-hover:bg-green-600',
                            ];
                        }
                    @endphp

                    <div
                        class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">

                        <div class="relative h-64 overflow-hidden">
                            <div
                                class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all duration-300 z-10">
                            </div>

                            <img src="{{ $imageUrl }}" alt="{{ $category->category_name }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                            <div class="absolute top-4 right-4 z-20">
                                <span
                                    class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold {{ $theme['badge_text'] }} shadow-sm flex items-center gap-1">
                                    🎾 {{ $courtCount }} Courts
                                </span>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-grow relative">

                            <h3
                                class="text-2xl font-bold text-gray-900 mb-3 {{ $theme['title_hover'] }} transition-colors">
                                {{ $category->category_name }}
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                                {{ $category->description ?? 'Nikmati pengalaman bermain padel terbaik dengan fasilitas standar internasional.' }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                                <span
                                    class="text-sm font-medium text-gray-400 {{ $theme['link_hover'] }} transition-colors">
                                    View Details
                                </span>

                                <a href="/book-court?category={{ $category->id }}"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 text-gray-600 {{ $theme['btn_hover_bg'] }} group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md">
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum ada kategori lapangan yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


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
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold tracking-widest uppercase text-sm">— TESTIMONIALS & REVIEWS —</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-2 text-gray-900" style="font-style: italic;">HEAR IT FROM OUR</h2>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900" style="font-style: italic;">PADEL ENTHUSIASTS</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <div class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Lapangan padel terbaik di Bandung! Fasilitas sangat lengkap dan terawat dengan baik. Sistem booking online sangat memudahkan."
                    </p>
                    <h4 class="text-xl font-bold text-center text-gray-900">Ahmad Rizki</h4>
                </div>

                <div class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Courtletics memberikan pengalaman bermain yang luar biasa. Pelayanan ramah dan profesional. Sangat direkomendasikan!"
                    </p>
                    <h4 class="text-xl font-bold text-center text-gray-900">Siti Nurhaliza</h4>
                </div>

                <div class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Tempat yang sempurna untuk bermain padel bersama teman dan keluarga. Harga terjangkau dengan kualitas terbaik di kelasnya."
                    </p>
                    <h4 class="text-xl font-bold text-center text-gray-900">Budi Santoso</h4>
                </div>
            </div>
        </div>
    </section>

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

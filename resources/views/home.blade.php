<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home - Courtletics Padel Court Booking</x-slot:title>

    <!-- Hero section -->
    <section class="relative min-h-screen pt-[92px] flex items-center justify-center">
        
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=1920&h=1080&fit=crop" 
                 alt="Padel Court" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center text-white px-8 max-w-4xl mx-auto">
            <p class="mb-4 text-lg font-medium">100+ pro players play here.</p>
            <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-6">
                Play Padel with Pro Players
            </h1>
            <p class="text-xl md:text-1xl mb-10 text-white/90">
                Book your court in seconds—no hassle, no waiting.
            </p>

            <button 
                onclick="document.getElementById('court-categories').scrollIntoView({ behavior: 'smooth' })"
                class="bg-neutral-800 hover:bg-blue-700 text-white px-12 py-4 rounded-lg text-lg font-semibold transition-all duration-300 cursor-pointer shadow-lg hover:shadow-xl transform hover:scale-105">
                Play now
            </button>
        </div>

    </section>

    <!-- Court Categories Section -->
    <section id="court-categories" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Our Court Categories</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Choose where you want to play</h2>
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


    <section class="py-16 bg-neutral-800 text-white">
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
                <span class="text-blue-600 font-semibold tracking-widest uppercase text-sm">— TESTIMONIALS & REVIEWS
                    —</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-2 text-gray-900" style="font-style: italic;">HEAR IT
                    FROM OUR</h2>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900" style="font-style: italic;">PADEL ENTHUSIASTS
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <div
                    class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Lapangan padel terbaik di Bandung! Fasilitas sangat lengkap dan terawat dengan baik. Sistem
                        booking online sangat memudahkan."
                    </p>
                    <h4 class="text-xl font-bold text-center text-gray-900">Ahmad Rizki</h4>
                </div>

                <div
                    class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Courtletics memberikan pengalaman bermain yang luar biasa. Pelayanan ramah dan profesional.
                        Sangat direkomendasikan!"
                    </p>
                    <h4 class="text-xl font-bold text-center text-gray-900">Siti Nurhaliza</h4>
                </div>

                <div
                    class="bg-white rounded-2xl p-8 border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-6 justify-center">
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                        <span class="text-yellow-400 text-2xl">★</span>
                    </div>
                    <p class="text-gray-700 text-center mb-8 leading-relaxed">
                        "Tempat yang sempurna untuk bermain padel bersama teman dan keluarga. Harga terjangkau dengan
                        kualitas terbaik di kelasnya."
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
                Book your court now and experience playing padel with pro players!
            </p>
            <button onclick="document.getElementById('court-categories').scrollIntoView({ behavior: 'smooth' })"
                class="inline-block bg-neutral-800 text-blue-600 px-10 py-5 rounded-xl hover:bg-blue-50 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 cursor-pointer">
                Play Now
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                
                <!-- Company Info -->
                <div>
                    <h3 class="text-white text-2xl font-bold mb-6">Courtletics</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Premium padel court facilities in Bandung. Book your court easily and play with pro players.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white text-lg font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="hover:text-blue-400 transition-colors">Home</a></li>
                        <li><a href="/about" class="hover:text-blue-400 transition-colors">About Us</a></li>
                        <li><a href="/book-court" class="hover:text-blue-400 transition-colors">Book Court</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white text-lg font-semibold mb-6">Contact Info</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-400">Jl. Setiabudhi No. 123, Bandung, Jawa Barat 40164</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:+6222123456" class="text-gray-400 hover:text-blue-400 transition-colors">+62 22 123 456</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:info@courtletics.com" class="text-gray-400 hover:text-blue-400 transition-colors">info@courtletics.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Opening Hours -->
                <div>
                    <h4 class="text-white text-lg font-semibold mb-6">Opening Hours</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex justify-between">
                            <span>Monday - Friday</span>
                            <span class="text-white font-semibold">06:00 - 22:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Saturday</span>
                            <span class="text-white font-semibold">06:00 - 23:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sunday</span>
                            <span class="text-white font-semibold">07:00 - 22:00</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-500 text-sm">
                        © 2025 Courtletics. All rights reserved.
                    </p>
                    <div class="flex gap-6 text-sm">
                        <a href="/privacy-policy" class="text-gray-500 hover:text-blue-400 transition-colors">Privacy Policy</a>
                        <a href="/terms-of-service" class="text-gray-500 hover:text-blue-400 transition-colors">Terms of Service</a>
                        <a href="/faq" class="text-gray-500 hover:text-blue-400 transition-colors">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</x-layout>


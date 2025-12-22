<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>About - Courtletics Padel Court Booking</x-slot:title>

    <!-- About Hero -->
    <section class="py-20 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">About Courtletics</h1>
            <p class="text-xl max-w-3xl mx-auto">
                Courtletics adalah platform booking lapangan padel terbaik di Bandung
                dengan fasilitas modern dan pelayanan profesional.
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Our Story
                    </h2>
                    <p class="text-gray-600 mb-4">
                        Courtletics didirikan untuk memenuhi kebutuhan pecinta olahraga padel
                        dengan sistem booking yang mudah, cepat, dan transparan.
                    </p>
                    <p class="text-gray-600">
                        Kami menyediakan lapangan indoor dan outdoor dengan standar internasional
                        serta fasilitas pendukung yang lengkap.
                    </p>
                </div>

                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img
                        src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?w=800&h=600&fit=crop"
                        alt="Padel Court"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white p-8 rounded-2xl shadow">
                    <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                    <p class="text-gray-600">
                        Menjadi pusat padel terbaik dan terpercaya di Indonesia
                        dengan layanan digital yang inovatif.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow">
                    <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Menyediakan lapangan berkualitas tinggi</li>
                        <li>Sistem booking yang mudah dan cepat</li>
                        <li>Pelayanan pelanggan profesional</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-layout>

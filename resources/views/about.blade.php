<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>About - Courtletics Padel Court Booking</x-slot:title>

    {{-- <!-- About Hero -->
    <section class="py-20 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">About Courtletics</h1>
            <p class="text-xl max-w-3xl mx-auto">
                Courtletics adalah platform booking lapangan padel terbaik di Bandung
                dengan fasilitas modern dan pelayanan profesional.
            </p>
        </div>
    </section> --}}

    <!-- About Content -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Our Story
                    </h2>
                    <p class="text-gray-600 mb-4">
                        Padel is fun.Booking a court? Not always.
                        We’ve been there—jumping between chats, waiting for replies, and missing playtime just because booking was a mess. That frustration is what started this platform.
                        We’re not a big corporation or a global brand. 
                    </p>
                    <p class="text-gray-600 mb-4">
                        We’re players, builders, and people who simply wanted a better way to book padel courts. So we started small, focused on one thing: making booking simple and fast.
                        This platform is still growing, still learning, and still improving. Just like the players using it.
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

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Our Goals
                    </h2>
                    <p class="text-gray-600 mb-4">
                        Our goal is simple: make booking padel courts effortless.
                    </p>
                    <p class="text-gray-600">
                        We want players to spend less time figuring things out and more time on the court. 
                        No unnecessary steps, no confusing flows—just clear options and smooth booking.
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

</x-layout>

<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">P</span>                  
                </div>
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    PadelBookBandung
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('/') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    Home
                </a>
                <a href="/about"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('/about') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    About
                </a>
                <a href="/book-court"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('book-court*') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    Book Court
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition">
                    Login
                </a>
                <a href="/register"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                    Sign Up
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200 pt-4">
            <div class="flex flex-col space-y-4">
                <a href="/" class="text-gray-700 hover:text-purple-600 font-medium transition">Home</a>
                <a href="/about" class="text-gray-700 hover:text-purple-600 font-medium transition">About</a>
                <a href="/book-court" class="text-gray-700 hover:text-purple-600 font-medium transition">Book Court</a>
                <a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition">Login</a>
                <a href="/register" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium text-center">Sign Up</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</nav>

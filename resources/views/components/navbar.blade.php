<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">C</span>
                </div>
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                    Courtletics
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('/') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    Home
                </a>
                <a href="/about"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('about') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    About
                </a>
                <a href="/book-court"
                    class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('book-court*') ? 'text-purple-600 border-b-2 border-purple-600' : '' }}">
                    Book Court
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Show Admin link for admin users -->
                    @if (Auth::user()->isAdmin())
                        <a href="/admin/dashboard"
                            class="text-gray-700 hover:text-purple-600 font-medium transition">
                            Admin Panel
                        </a>
                    @endif

                    <!-- Profile dropdown or link -->
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 font-medium transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                            <a href="/profile"
                                class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                                Profile
                            </a>
                            <a href="/my-bookings"
                                class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                                My Bookings
                            </a>
                            <hr class="my-2">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition">
                        Login
                    </a>
                    <a href="/register"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                        Sign Up
                    </a>
                @endauth
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

                @auth
                    @if (Auth::user()->isAdmin())
                        <a href="/admin/dashboard"
                            class="text-gray-700 hover:text-purple-600 font-medium transition">Admin Panel</a>
                    @endif
                    <a href="/profile" class="text-gray-700 hover:text-purple-600 font-medium transition">Profile</a>
                    <a href="/my-bookings" class="text-gray-700 hover:text-purple-600 font-medium transition">My
                        Bookings</a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-red-600 hover:text-red-700 font-medium transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-gray-700 hover:text-purple-600 font-medium transition">Login</a>
                    <a href="/register"
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium text-center">Sign
                        Up</a>
                @endauth
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

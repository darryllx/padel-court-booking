<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Login - Padel Court Booking</x-slot:title>

    <section class="py-12 px-4 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="container mx-auto max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-8 text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome Back!</h1>
                    <p class="text-purple-100">Login to book your court</p>
                </div>

                <!-- Login Form -->
                <div class="p-8">
                    <form action="/login" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="your.email@example.com">
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Enter your password">
                        </div>


                        <!-- Login Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-bold text-lg hover:shadow-2xl transition mb-4">
                            Login
                        </button>                    

                        <!-- Sign Up Link -->
                        <p class="text-center text-gray-600">
                            Don't have an account?
                            <a href="/register" class="text-purple-600 hover:text-purple-700 font-semibold">
                                Sign Up
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>
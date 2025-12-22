<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Sign Up - Padel Court Booking</x-slot:title>

    <section class="py-12 px-4 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="container mx-auto max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-8 text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
                    <p class="text-purple-100">Join us and start booking!</p>
                </div>

                <!-- Register Form -->
                <div class="p-8">
                    <form action="/register" method="POST">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Your full name">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="your.email@example.com">
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="08xx xxxx xxxx">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                            <input type="password" id="password" name="password" required minlength="8"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Minimum 8 characters">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                minlength="8"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Re-enter your password">
                        </div>

                        <!-- Sign Up Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-bold text-lg hover:shadow-2xl transition mb-4">
                            Sign Up
                        </button>

                        <!-- Login Link -->
                        <p class="text-center text-gray-600">
                            Already have an account?
                            <a href="/login" class="text-purple-600 hover:text-purple-700 font-semibold">
                                Login
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>
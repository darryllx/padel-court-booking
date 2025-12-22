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
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 border-2 @error('name') border-red-500 @else border-gray-200 @enderror rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Your full name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border-2 @error('email') border-red-500 @else border-gray-200 @enderror rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="your.email@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-3 border-2 @error('phone') border-red-500 @else border-gray-200 @enderror rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="08xx xxxx xxxx">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                            <input type="password" id="password" name="password" required minlength="8"
                                class="w-full px-4 py-3 border-2 @error('password') border-red-500 @else border-gray-200 @enderror rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Minimum 8 characters">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                minlength="8"
                                class="w-full px-4 py-3 border-2 @error('password_confirmation') border-red-500 @else border-gray-200 @enderror rounded-lg focus:border-purple-600 focus:outline-none transition"
                                placeholder="Re-enter your password">
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
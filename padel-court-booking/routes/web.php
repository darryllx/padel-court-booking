<?php

use Illuminate\Support\Facades\Route;
use App\Models\CourtCategories;

// Update bagian route home '/'
Route::get('/', function () {
    // Mengambil kategori beserta courts dan images-nya
    $categories = CourtCategories::with(['courts.images'])->get();
    return view('home', compact('categories'));
});


// About Page
Route::get('/about', function () {
    return view('about');
});

// Book Court - Court Selection
Route::get('/book-court', function () {
    return view('courtdetail');  
});

// Booking Detail Form
Route::get('/booking-detail', function () {
    return view('bookingcourt');  
});

// Payment Page (GET)
Route::get('/payment', function () {
    return view('payment');
});

// Payment Page (POST dari booking form)
Route::post('/payment', function () {
    return view('payment');
});

// Payment Process
Route::post('/payment/process', function () {
    return redirect('/booking-success')->with('success', 'Payment successful!');
});

// Success Page
Route::get('/booking-success', function () {
    return view('success');
});

// Authentication Routes

// Login
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function () {
    return redirect('/')->with('success', 'Login successful!');
});

// Register
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function () {
    return redirect('/login')->with('success', 'Registration successful! Please login.');
});

// Forgot Password (optional)
Route::get('/forgot-password', function () {
    return view('forgot-password');
});

// Logout (optional)
Route::post('/logout', function () {
    return redirect('/')->with('success', 'Logged out successfully!');
});


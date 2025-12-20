<?php

use Illuminate\Support\Facades\Route;

// Home page (sama dengan welcome)
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function() {
    return view('about');
});

// // Book Court - Court Selection
Route::get('/book-court', function () {
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

// note : login,register dan logout belom bisa dijalankan masih baru tampilan aja (ama)
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtCategoriesController;
use App\Http\Controllers\CourtsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserController;

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('home');
});

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

// Route Resource CRUD untuk masing-masing controller
Route::resource('users', UserController::class);
Route::resource('court-categories', CourtCategoriesController::class);
Route::resource('courts', CourtsController::class);
Route::resource('bookings', BookingsController::class);
Route::resource('payments', PaymentsController::class);
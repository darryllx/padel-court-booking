<?php

use Illuminate\Support\Facades\Route;
use App\Models\CourtCategories;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

// Update bagian route home '/'
Route::get('/', function () {
    // Mengambil kategori beserta courts dan images-nya
    $categories = CourtCategories::with(['courts.images'])->get();
    return view('home', compact('categories'));
});

// CSRF Token Refresh Route
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});

// CSRF Token Refresh Route
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password (optional)
Route::get('/forgot-password', function () {
    return view('forgot-password');
});

// Admin Routes - Protected with auth middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    
    // User Management Routes (CRUD) - Only for Admin
    Route::resource('users', UserController::class);
});


<?php

use Illuminate\Support\Facades\Route;
use App\Models\CourtCategories;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourtCategoriesController;
use App\Http\Controllers\CourtsController;

Route::get('/', function () {
    $categories = CourtCategories::all();
    return view('home', compact('categories'));
});

// CSRF Token Refresh Route
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});

// // Home page (sama dengan welcome)
// Route::get('/', function () {
//     return view('home');
// });

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
    Route::get('/users/export-pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');
    Route::resource('users', UserController::class);
});

// Court Categories & Courts Management - Protected with auth and role:admin middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Court Categories Routes
    Route::resource('court-categories', CourtCategoriesController::class);
    
    // Courts Routes
    Route::resource('courts', CourtsController::class);
});


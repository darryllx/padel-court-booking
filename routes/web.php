<?php

use Illuminate\Support\Facades\Route;
use App\Models\CourtCategories;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourtCategoriesController;
use App\Http\Controllers\CourtsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingsController; // Tambahkan ini untuk mengimpor BookingsController    


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
    $category = null;
    $courts = [];
    
    if (request()->has('category')) {
        $category = CourtCategories::with('courts')->find(request('category'));
        if ($category) {
            $courts = $category->courts;
        }
    }
    
    return view('courtdetail', compact('category', 'courts'));
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

// Profile Routes - Accessible by all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

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
    Route::get('/court-categories/export-pdf', [CourtCategoriesController::class, 'exportPdf'])->name('court-categories.exportPdf');
    Route::resource('court-categories', CourtCategoriesController::class);

    // Courts Routes
    Route::get('/courts/export-pdf', [CourtsController::class, 'exportPdf'])->name('courts.exportPdf');
    Route::resource('courts', CourtsController::class);
});


// my bookings user
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [BookingsController::class, 'myBookings'])->name('my.bookings');
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtCategoriesController;
use App\Http\Controllers\CourtsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserController;

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route Resource CRUD untuk masing-masing controller
Route::resource('users', UserController::class);
Route::resource('court-categories', CourtCategoriesController::class);
Route::resource('courts', CourtsController::class);
Route::resource('bookings', BookingsController::class);
Route::resource('payments', PaymentsController::class);
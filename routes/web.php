<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Homepage
Route::view('/', 'index')->name('home');

// Authentication Routes (Laravel Breeze or Jetstream handles these automatically)
Auth::routes();

// Protected Routes (only accessible by authenticated users)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Example of user-specific routes
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('devices', App\Http\Controllers\DeviceController::class);
    Route::resource('reservations', App\Http\Controllers\ReservationController::class);
    Route::resource('loans', App\Http\Controllers\LoanController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

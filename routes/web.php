<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Homepage
Route::view('/', 'index')->name('home');

// Authentication Routes
Auth::routes();

// Protected Routes (only accessible by authenticated users)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource Routes for CRUD Operations
    Route::resource('users', UserController::class);
    Route::resource('device-types', DeviceTypeController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('studios', StudioController::class);
});

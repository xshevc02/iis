<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Homepage
Route::view('/', 'index')->name('home');

// Authentication Routes
Auth::routes();

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
});

// Protected Routes (only accessible by authenticated users)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Administrator-only routes
    Route::middleware(['role:administrátor'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('studios', StudioController::class);
    });

    // Studio Manager routes
    Route::middleware(['role:správce ateliéru'])->group(function () {
        Route::resource('device-types', DeviceTypeController::class);
        Route::get('studios/{studio}/manage', [StudioController::class, 'manage'])->name('studios.manage');
    });

    // Teacher routes
    Route::middleware(['role:vyučující'])->group(function () {
        Route::resource('devices', DeviceController::class);
        Route::post('devices/{device}/toggle-availability', [DeviceController::class, 'toggleAvailability'])
            ->name('devices.toggle-availability');
    });

    // Registered User routes
    Route::middleware(['role:registrovaný uživatel'])->group(function () {
        Route::resource('reservations', ReservationController::class);
        Route::resource('loans', LoanController::class);
    });
});

// Fallback for unauthorized access
Route::fallback(function () {
    return response()->view('restricted', [], 403);
});

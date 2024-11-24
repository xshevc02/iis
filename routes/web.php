<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Models\Reservation;
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
 //   Route::resource('reservations', ReservationController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('studios', StudioController::class);
    Route::get('/no-access', function () {
        return view('no-access');
    })->name('no-access');

//    if (session('role_id') == 1 || session('role_id') == 2) {
//
//        Route::resource('users', UserController::class);
//        Route::resource('studios', StudioController::class);
//    }

    Route::middleware(['auth', 'Administrator'])->group(function () {
        Route::resource('device-types', DeviceTypeController::class);
        Route::get('studios/{studio}/manage', [StudioController::class, 'manage'])->name('studios.manage');
    });

    Route::middleware(['auth', '1'])->group(function () {
        Route::resource('devices', DeviceController::class);
        Route::post('devices/{device}/toggle-availability', [DeviceController::class, 'toggleAvailability'])->name('devices.toggle-availability');
    });

    Route::middleware(['auth', 'studio'])->group(function () {
        Route::resource('reservations', ReservationController::class);
        Route::resource('loans', LoanController::class);
    });
    Route::get('/Reservations', function () {
        // Проверяем роль пользователя в сессии
        if (session('role_id') == '1') {
            $reservations = Reservation::with(['user', 'device'])->get(); // Ensure the Reservation model is imported

            return view('reservations.index', compact('reservations'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('reservations.index');

});

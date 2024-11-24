<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Models\Device;
use App\Models\Loan;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
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

    //   Resource Routes for CRUD Operations
    Route::resource('users', UserController::class);
    Route::resource('device-types', DeviceTypeController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('studios', StudioController::class);

    Route::get('/no-access', function () {
        return view('no-access');
    })->name('no-access');

    Route::get('/Reservations', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3' || session('role_id') == '4') {
            $reservations = Reservation::with(['user', 'device'])->get(); // Ensure the Reservation model is imported

            return view('reservations.index', compact('reservations'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('reservations.index');

    Route::get('/Devices', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3' || session('role_id') == '4') {
            $devices = Device::all();

            return view('devices.index', compact('devices'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('devices.index');

    Route::get('/Users', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3') {
            $users = User::with(['role', 'studio'])->get(); // Eager load role and studio
            $roles = Role::all(); // Fetch all roles
            $studios = Studio::all(); // Fetch all studios

            return view('users.index', compact('users', 'roles', 'studios'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('users.index');

    Route::get('/Loans', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3' || session('role_id') == '4') {
            $loans = Loan::with('device', 'user')->get(); // Eager load related data

            return view('loans.index', compact('loans'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('loans.index');

    Route::get('/Studio', function () {
        if (session('role_id') == '1' || session('role_id') == '2') {
            $studios = Studio::all();

            return view('studios.index', compact('studios'));
        } else {
            return redirect()->route('no-access');
        }
    })->name('studios.index');



});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

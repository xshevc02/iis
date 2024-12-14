
<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StudiosController;
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
    Route::post('/users/{user}/assign-to-studio', [UserController::class, 'assignToStudio'])->name('users.assignToStudio');

    //   Resource Routes for CRUD Operations
    Route::resource('users', UserController::class);
    Route::resource('device-types', DeviceTypeController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('studios', StudiosController::class);

    Route::get('/no-access', function () {
        return view('no-access');
    })->name('no-access');


});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

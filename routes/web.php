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

    Route::get('/Reservations', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3' || session('role_id') == '4') {
            $user = auth()->user(); // Get the authenticated user

            // Fetch only the reservations of the authenticated user
            $reservations = Reservation::where('user_id', $user->id)->get();

            // Pass the reservations to the view
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
        $authUser = auth()->user(); // Get the authenticated user

        if (session('role_id') == '1') { // Admin role
            $users = User::with(['role', 'studio'])->get();
        } elseif (session('role_id') == '2' || session('role_id') == '3') { // Manager or teacher roles
            $users = User::with(['role', 'studio'])
                ->where('studio_id', $authUser->studio_id)
                ->get();
        } else {
            return redirect()->route('no-access'); // Redirect for unauthorized roles
        }

        $roles = Role::all(); // Fetch all roles
        $studios = Studio::all(); // Fetch all studios

        return view('users.index', compact('users', 'roles', 'studios'));
    })->name('users.index');

    Route::get('/Loans', function () {
        if (session('role_id') == '1' || session('role_id') == '2' || session('role_id') == '3' || session('role_id') == '4') {
            // Get the authenticated user
            $user = auth()->user();
            $loans = Loan::where('user_id', $user->id)->get();

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

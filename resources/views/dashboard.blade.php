@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col text-center">
                @php
                    $hour = now()->hour;
                    $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
                @endphp
                <h1 class="text-primary mb-2">{{ $greeting }}, {{ Auth::user()->name }}! </h1>
                <p class="text-muted">Your dashboard is here to help you stay organized and productive!</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop fa-2x mb-3"></i>
                        <h5 class="card-title">Devices</h5>
                    </div>
                    <div class="card-footer bg-primary border-0 text-center">
                        <a href="{{ route('devices.index') }}" class="text-white text-decoration-none">View Devices →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-3"></i>
                        <h5 class="card-title">Users</h5>
                    </div>
                    <div class="card-footer bg-success border-0 text-center">
                        <a href="{{ route('users.index') }}" class="text-white text-decoration-none">Manage Users →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                        <h5 class="card-title">Reservations</h5>
                    </div>
                    <div class="card-footer bg-warning border-0 text-center">
                        <a href="{{ route('reservations.index') }}" class="text-white text-decoration-none">Check Reservations →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-2x mb-3"></i>
                        <h5 class="card-title">Loans</h5>
                    </div>
                    <div class="card-footer bg-info border-0 text-center">
                        <a href="{{ route('loans.index') }}" class="text-white text-decoration-none">Manage Loans →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-primary">Quick Actions</h3>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <a href="{{ route('devices.create') }}" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-plus"></i> Add Device
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('users.create') }}" class="btn btn-success w-100 mb-3">
                            <i class="fas fa-user-plus"></i> Add User
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('reservations.create') }}" class="btn btn-warning w-100 mb-3">
                            <i class="fas fa-calendar-plus"></i> Add Reservation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card .fa-2x {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .card-footer a {
            font-size: 1rem;
            font-weight: bold;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }

        body {
            background: linear-gradient(120deg, #f8f9fa, #e9ecef);
        }
    </style>
@endpush

{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')
    <div class="container py-5" style=" border-radius: 12px; padding: 2rem;">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col text-center">
                @php
                    $hour = now()->hour;
                    $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
                @endphp
                <h1 class="mb-2" style="color: #2D2D2D; font-weight: bold; font-size: 2.5rem;">{{ $greeting }}, {{ Auth::user()->name }}! </h1>
                <p class="text-muted" style="font-size: 1.2rem;">Your dashboard is here to help you stay organized and productive!</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm h-100" style="background: linear-gradient(to top, #e6f0ff, #cce5ff); color: #2D2D2D;">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop fa-2x mb-3" style="color: #4A90E2;"></i>
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">Devices</h5>
                    </div>
                    <div class="card-footer border-0 text-center" style="background: #cce5ff;">
                        <a href="{{ route('devices.index') }}" class="text-dark text-decoration-none" style="font-weight: bold;">View Devices →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100" style="background: linear-gradient(to top, #e8ffe8, #c9f7c9); color:#2D2D2D;">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-3" style="color: #5CB85C;"></i>
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">Users</h5>
                    </div>
                    <div class="card-footer border-0 text-center" style="background: #c9f7c9;">
                        <a href="{{ route('users.index') }}" class="text-dark text-decoration-none" style="font-weight: bold;">Manage Users →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100" style="background: linear-gradient(to top, #fff5e6, #ffe4cc); color: #2D2D2D;">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-2x mb-3" style="color: #F0AD4E;"></i>
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">Reservations</h5>
                    </div>
                    <div class="card-footer border-0 text-center" style="background: #ffe4cc;">
                        <a href="{{ route('reservations.index') }}" class="text-dark text-decoration-none" style="font-weight: bold;">Check Reservations →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm h-100" style="background: linear-gradient(to top, #f6e6ff, #e6ccff); color: #2D2D2D;">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-2x mb-3" style="color: #C399FF;"></i>
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">Loans</h5>
                    </div>
                    <div class="card-footer border-0 text-center" style="background: #e6ccff;">
                        <a href="{{ route('loans.index') }}" class="text-dark text-decoration-none" style="font-weight: bold;">Manage Loans →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 style="color: #2D2D2D; font-weight: bold;">Quick Actions</h3>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <a href="{{ route('devices.create') }}" class="btn w-100 mb-3" style="background: #cce5ff; color: #2D2D2D; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-plus"></i> Add Device
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('reservations.create') }}" class="btn w-100 mb-3" style="background: #ffe4cc; color: #2D2D2D; font-weight: bold; border-radius: 8px;">
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
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
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

        .btn {
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

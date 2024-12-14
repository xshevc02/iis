@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0" style="color: #2D2D2D; font-weight: bold;">Devices</h1>
            <div>
                <!-- Add New Device Button -->
                <a href="{{ route('devices.create') }}" class="btn" style="background-color: #A8DFFF; color: #2D2D2D; border-radius: 8px; font-weight: bold;">
                    <i class="fas fa-plus"></i> Add New Device
                </a>

                <!-- Manage Device Types Button -->
                <a href="{{ route('device-types.index') }}" class="btn" style="background-color: #B3E7A8; color: #2D2D2D; border-radius: 8px; font-weight: bold;">
                    <i class="fas fa-cogs"></i> Manage Device Types
                </a>

                <!-- Make a Reservation Button -->
                <a href="{{ route('reservations.create') }}" class="btn" style="background-color: #D9A8FF; color: #2D2D2D; border-radius: 8px; font-weight: bold;">
                    <i class="fas fa-calendar-check"></i> Make a Reservation
                </a>
            </div>
        </div>


        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif



        <!-- Filter Section -->
        <form method="GET" action="{{ route('devices.index') }}" class="mb-4">
            <div class="row g-2">
                <!-- Filter by Device Type -->
                <div class="col-md-4">
                    <select name="device_type" class="form-select">
                        <option value="">All Types</option>
                        @foreach($deviceTypes as $type)
                            <option value="{{ $type->id }}" {{ request('device_type') == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Filter Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn w-100" style="background: #4A90E2; color: white; font-weight: bold;">
                        Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Devices Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($devices as $device)
                <div class="col">
                    <!-- Clickable Card -->
                    <a href="{{ route('devices.show', $device->id) }}" class="card h-100 shadow-sm text-decoration-none text-dark" style=" border-radius: 15px;">
                        <!-- Display the image if available, else display a default placeholder -->
                        <img src="{{ $device->photo ? asset('storage/' . $device->photo) : asset('images/placeholder-device.png') }}"
                             class="card-img-top"
                             alt="{{ $device->name }}"
                             style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">

                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: #2D2D2D;">{{ $device->name }}</h5>
                            <p class="card-text" style="color: #2D2D2D;">
                                <strong>Type:</strong> {{ $device->type->type_name }}<br>
                                <strong>Studio:</strong> {{ $device->studio->name }}<br>
                                <strong>Year:</strong> {{ $device->year_of_manufacture }}<br>
                            <p><strong>Available:</strong>
                                @if ($device->available)
                                    <i class="fas fa-check-circle text-success"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                @endif
                            </p>
                            </p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No devices found. Add some to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02); /* Slight zoom on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn {
            transition: all 0.3s ease;
        }
    </style>
@endpush

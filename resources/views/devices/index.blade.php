@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="text-white py-4" style="background: linear-gradient(90deg, #aabfeb, #577ef1); border-radius: 10px;">
                Devices
            </h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buttons Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <!-- Add New Device Button -->
                <a href="{{ route('devices.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Add New Device
                </a>

                <!-- Manage Device Types Button -->
                <a href="{{ route('device-types.index') }}" class="btn btn-secondary">
                    <i class="fas fa-cogs"></i> Manage Device Types
                </a>
            </div>

            <!-- Make a Reservation Button -->
            @if(auth()->user()->can_make_reservations)
                <a href="{{ route('reservations.create') }}" class="btn btn-success">
                    <i class="fas fa-calendar-check"></i> Make a Reservation
                </a>
            @else
                <p class="text-danger mb-0"><i class="fas fa-exclamation-circle"></i> You are not allowed to make reservations.</p>
            @endif
        </div>

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
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Devices Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($devices as $device)
                <div class="col">
                    <!-- Clickable Card -->
                    <a href="{{ route('devices.show', $device->id) }}" class="card h-100 shadow-sm text-decoration-none text-dark">
                        <!-- Display the image if available, else display a default placeholder -->
                        <img src="{{ $device->photo ? asset('storage/' . $device->photo) : asset('images/placeholder-device.png') }}"
                             class="card-img-top"
                             alt="{{ $device->name }}"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $device->name }}</h5>
                            <p class="card-text">
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
    </style>
@endpush

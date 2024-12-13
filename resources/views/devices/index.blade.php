@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="text-white py-4" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;">
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
                <a href="{{ route('devices.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Add New Device
                </a>
                <a href="{{ route('device-types.index') }}" class="btn btn-secondary">
                    <i class="fas fa-cogs"></i> Manage Device Types
                </a>
            </div>
            @if(auth()->user()->can_make_reservations)
                <a href="{{ route('reservations.create') }}" class="btn btn-success">
                    <i class="fas fa-calendar-check"></i> Make a Reservation
                </a>
            @else
                <p class="text-danger mb-0"><i class="fas fa-exclamation-circle"></i> You are not allowed to make reservations.</p>
            @endif
        </div>

        <!-- Devices Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($devices as $device)
                <div class="col">
                    <div class="card h-100 shadow-sm">
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
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                            @if (auth()->user()->role->name === 'administrator' || auth()->user()->role->name === 'instructor')
                                <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('devices.destroy', $device->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this device?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @else
                                <small class="text-muted d-block mt-1"><i class="fas fa-lock"></i> No permission to modify.</small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No devices found. Add some to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

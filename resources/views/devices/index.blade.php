@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Devices</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buttons Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('devices.create') }}" class="btn btn-primary me-2">Add New Device</a>
                <a href="{{ route('device-types.index') }}" class="btn btn-secondary">Manage Device Types</a>
            </div>
            @if(auth()->user()->can_make_reservations)
                <a href="{{ route('reservations.create') }}" class="btn btn-success">Make a Reservation</a>
            @else
                <p class="text-danger mb-0">Oops! You are not allowed to make reservations.</p>
            @endif
        </div>

        <!-- Devices Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($devices as $device)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <!-- Display the image if available, else display a default image -->
                        <img src="{{ $device->photo ? Storage::url($device->photo) : asset('images/default_device.jpg') }}" class="card-img-top" alt="{{ $device->name }}">

                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $device->name }}</h5>
                            <p class="card-text">
                                <strong>Type:</strong> {{ $device->type->type_name }}<br>
                                <strong>Studio:</strong> {{ $device->studio->name }}<br>
                                <strong>Owner:</strong> {{ $device->user->name ?? 'N/A' }}<br>
                                <strong>Year:</strong> {{ $device->year_of_manufacture }}<br>
                                <strong>Available:</strong> {{ $device->available ? 'Yes' : 'No' }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info btn-sm">View</a>
                            @if (auth()->user()->role->name === 'administrator' || auth()->user()->role->name === 'instructor')
                                <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('devices.destroy', $device->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this device?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <small class="text-muted d-block mt-1">No permission to modify this device.</small>
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

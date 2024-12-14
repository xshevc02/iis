@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Reservations</h1>
            <a href="{{ route('reservations.create') }}" class="btn" style="background-color: #85D177; font-weight: bold;">
                Add Reservation
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('reservations.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by device or user" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Approved" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') ? \Carbon\Carbon::parse(request('date'))->format('Y-m-d') : '' }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Reservation List -->
        @if ($reservations->isEmpty())
            <div class="alert alert-info text-center">
                No reservations found. Use the "Add Reservation" button to create one!
            </div>
        @else
            <div class="list-group shadow-sm">
                @foreach ($reservations as $reservation)
                    <a href="{{ route('reservations.show', $reservation->id) }}" class="list-group-item list-group-item-action d-flex align-items-start">
                        <!-- Image Section -->
                        <img src="{{ $reservation->device->photo ? asset('storage/' . $reservation->device->photo) : asset('images/placeholder-device.png') }}"
                             alt="{{ $reservation->device->name }}"
                             class="rounded"
                             style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">

                        <!-- Text Content -->
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">{{ $reservation->device->name }}</h5>
                                <small class="text-muted">
                                    {{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') : 'N/A' }}
                                </small>
                            </div>
                            <p class="mb-1 text-muted">
                                <strong>Duration:</strong> {{ $reservation->duration }} days
                            </p>
                            <span class="badge
                            @if ($reservation->status == 'Approved') bg-success
                            @elseif ($reservation->status == 'Pending') bg-warning text-dark
                            @else bg-danger
                            @endif">
                            {{ ucfirst($reservation->status) }}
                        </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .list-group-item {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 0.9rem;
            padding: 5px 10px;
        }

        h5 {
            font-size: 1.1rem;
            font-weight: bold;
        }
    </style>
@endpush

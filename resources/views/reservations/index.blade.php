@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Reservations</h1>
            <a href="{{ route('reservations.create') }}" class="btn btn-success">Add Reservation</a>
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
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <p>Showing reservations filtered by:
                    @if(request('search')) Search: "{{ request('search') }}", @endif
                    @if(request('status')) Status: "{{ request('status') }}", @endif
                    @if(request('date')) Date: "{{ request('date') }}" @endif
                </p>

            </div>
        </form>





        <!-- Reservation Cards -->
        @if($reservations->count() > 0)
            <div class="row">
                @foreach($reservations as $reservation)
                    <div class="col-12 mb-3">
                        <div class="card reservation-card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <!-- Left Section -->
                                <div>
                                    <h5 class="mb-1">{{ $reservation->device->name }}</h5>
                                    <p class="mb-1 text-muted">
                                        <strong>User:</strong> {{ $reservation->user->name }}
                                    </p>
                                    <p class="mb-0 text-muted">
                                        <strong>Date:</strong> {{ $reservation->reservation_date }} <br>
                                        <strong>Duration:</strong> {{ $reservation->duration }} days
                                    </p>
                                </div>

                                <!-- Middle Section -->
                                <div class="d-flex flex-column align-items-center">
                                    <span class="reservation-status
                                        @if($reservation->status == 'active') text-success
                                        @elseif($reservation->status == 'pending') text-warning
                                        @else text-danger
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                    <hr class="my-2 w-75">
                                    <p class="text-muted small mb-0">#{{ $reservation->id }}</p>
                                </div>

                                <!-- Right Section -->
                                <div>
                                    <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-sm btn-info mb-1">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                No reservations found. Use the "Add Reservation" button to create one!
            </div>
        @endif

    </div>


@endsection

@push('styles')
    <style>
        /* Reservation Card Styles */
        .reservation-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
        }
        .reservation-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
        }
        .reservation-status {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endpush

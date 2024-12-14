{{--
    Author: Veronika Novikova
    Login: xnovik03
--}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-primary">Reservation Details</h1>

        <!-- Reservation Card -->
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Reservation Information</h4>
            </div>
            <div class="card-body px-5 py-4">
                <div class="row mb-4">
                    <!-- Device Image -->
                    <div class="col-md-4 text-center">
                        <img src="{{ $reservation->device->photo ? asset('storage/' . $reservation->device->photo) : asset('images/placeholder-device.png') }}"
                             alt="{{ $reservation->device->name }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 200px; object-fit: cover;">
                    </div>
                    <!-- Device and User Details -->
                    <div class="col-md-8">
                        <p><strong>User:</strong> {{ $reservation->user->name }}</p>
                        <p><strong>Device:</strong> {{ $reservation->device->name }}</p>
                        <p>
                            <strong>Reservation Date:</strong>
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            {{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('jS F Y') : 'N/A' }}
                        </p>
                        <p><strong>Duration:</strong> {{ $reservation->duration }} days</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $reservation->status === 'active' ? 'bg-success' : ($reservation->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Outside Card -->
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary mx-2" aria-label="Back to Reservations">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning mx-2" aria-label="Edit Reservation">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline mx-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?')" aria-label="Delete Reservation">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: none;
        }

        .badge {
            font-size: 1rem;
            padding: 0.5em 0.75em;
        }

        .img-fluid {
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f8f9fa;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

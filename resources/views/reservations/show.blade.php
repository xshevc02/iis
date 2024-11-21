@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>

        <!-- Reservation Information Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reservation #{{ $reservation->id }}</h5>

                <p><strong>User:</strong> {{ $reservation->user->name }}</p>
                <p><strong>Device:</strong> {{ $reservation->device->name }}</p>
                <p><strong>Reservation Date:</strong> {{ $reservation->reservation_date }}</p>
                <p><strong>Duration:</strong> {{ $reservation->duration }} days</p>
                <p><strong>Status:</strong> {{ $reservation->status }}</p>

                <!-- Actions -->
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                </form>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection

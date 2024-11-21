@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reservation</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Reservation Form -->
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled>Select a User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $reservation->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Device -->
            <div class="form-group">
                <label for="device_id">Device</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    <option value="" disabled>Select a Device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}" {{ $reservation->device_id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Reservation Date -->
            <div class="form-group">
                <label for="reservation_date">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control"
                       value="{{ $reservation->reservation_date }}" required>
            </div>

            <!-- Duration -->
            <div class="form-group">
                <label for="duration">Duration (in days)</label>
                <input type="number" name="duration" id="duration" class="form-control"
                       value="{{ $reservation->duration }}" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pending" {{ $reservation->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $reservation->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ $reservation->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

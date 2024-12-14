{{--
    Author: Veronika Novikova
    Login: xnovik03
--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Reservation</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <!-- User -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select a User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ Auth::id() == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Device -->
            <div class="form-group">
                <label for="device_id">Device</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    <option value="" disabled {{ $selectedDevice ? '' : 'selected' }}>Select a Device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}" {{ $selectedDevice && $selectedDevice->id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Reservation Date -->
            <div class="form-group">
                <label for="reservation_date">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
            </div>
            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>
            <!-- Duration -->
            <div class="form-group">
                <label for="duration">Duration (in days)</label>
                <input type="number" name="duration" id="duration" class="form-control" required min="1">
            </div>

            <button type="submit" class="btn btn-primary">Create Reservation</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

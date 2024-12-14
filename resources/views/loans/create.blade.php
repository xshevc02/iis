{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Loan</h1>

        <form action="{{ route('loans.store') }}" method="POST">
            @csrf

            <!-- User -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="" disabled selected>Select a User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Device -->
            <div class="form-group">
                <label for="device_id">Device</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    <option value="" disabled selected>Select a Device</option>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Issue Date -->
            <div class="form-group">
                <label for="issue_date">Issue Date</label>
                <input type="date" name="issue_date" id="issue_date" class="form-control" required>
            </div>

            <!-- Return Date -->
            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" id="return_date" class="form-control">
            </div>

            <!-- Time From -->
            <div class="form-group">
                <label for="time_from">Time From</label>
                <input type="time" name="time_from" id="time_from" class="form-control" required>
            </div>

            <!-- Time To -->
            <div class="form-group">
                <label for="time_to">Time To</label>
                <input type="time" name="time_to" id="time_to" class="form-control" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Loaned">Loaned</option>
                    <option value="Returned">Returned</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create Loan</button>
            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

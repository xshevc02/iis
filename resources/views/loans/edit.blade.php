@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Loan</h1>

        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $loan->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Device -->
            <div class="form-group">
                <label for="device_id">Device</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    @foreach($devices as $device)
                        <option value="{{ $device->id }}" {{ $loan->device_id == $device->id ? 'selected' : '' }}>
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Issue Date -->
            <div class="form-group">
                <label for="issue_date">Issue Date</label>
                <input type="datetime-local" name="issue_date" id="issue_date" class="form-control"
                       value="{{ \Carbon\Carbon::parse($loan->issue_date)->format('Y-m-d\TH:i') }}" required>
            </div>

            <!-- Return Date -->
            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="datetime-local" name="return_date" id="return_date" class="form-control"
                       value="{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('Y-m-d\TH:i') : '' }}">
            </div>

            <!-- Time From -->
            <div class="form-group">
                <label for="time_from">Time From</label>
                <input type="time" name="time_from" id="time_from" class="form-control" value="{{ $loan->time_from }}" required>
            </div>

            <!-- Time To -->
            <div class="form-group">
                <label for="time_to">Time To</label>
                <input type="time" name="time_to" id="time_to" class="form-control" value="{{ $loan->time_to }}" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Loaned" {{ $loan->status == 'Loaned' ? 'selected' : '' }}>Loaned</option>
                    <option value="Returned" {{ $loan->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                    <option value="Pending" {{ $loan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Loan</button>
        </form>
    </div>
@endsection

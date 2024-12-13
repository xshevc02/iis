@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Create a New Device</h1>

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

        <!-- Device Creation Form -->
        <form action="{{ route('devices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="type_id">Device Type</label>
                <select name="type_id" id="type_id" class="form-control" required>
                    <option value="" disabled selected>Select a type</option>
                    @foreach ($device_types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="studio_id">Studio</label>
                <select name="studio_id" id="studio_id" class="form-control" required>
                    <option value="" disabled selected>Select a studio</option>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Assigned User</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="" selected>None</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="year_of_manufacture">Year of Manufacture</label>
                <input type="number" name="year_of_manufacture" id="year_of_manufacture" class="form-control" value="{{ old('year_of_manufacture') }}" required>
            </div>

            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="{{ old('purchase_date') }}" required>
            </div>

            <div class="form-group">
                <label for="max_loan_duration">Max Loan Duration (days)</label>
                <input type="number" name="max_loan_duration" id="max_loan_duration" class="form-control" value="{{ old('max_loan_duration') }}" required>
            </div>

            <div class="form-group">
                <label for="available">Availability</label>
                <select name="available" id="available" class="form-control" required>
                    <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <!-- Device Photo Upload -->
            <div class="form-group">
                <label for="photo">Device Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create Device</button>
            <a href="{{ route('devices.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

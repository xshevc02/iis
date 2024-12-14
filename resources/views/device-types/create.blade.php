{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Add New Device Type</h1>

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

        <!-- Add Device Type Form -->
        <form action="{{ route('device-types.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <!-- Device Type Name -->
            <div class="form-group mb-3">
                <label for="type_name" class="form-label">Device Type Name</label>
                <input
                    type="text"
                    id="type_name"
                    name="type_name"
                    class="form-control"
                    value="{{ old('type_name') }}"
                    required
                >
            </div>

            <!-- Buttons -->
            <div class="text-center">
                <button type="submit" class="btn btn-success me-2">Add Device Type</button>
                <a href="{{ route('device-types.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

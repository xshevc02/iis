@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Device Types</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Device Type Button -->
        <div class="text-center mb-4">
            <a href="{{ route('device-types.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Device Type
            </a>
        </div>

        <!-- Device Types Cards -->
        <div class="d-flex flex-wrap justify-content-center">
            @forelse ($deviceTypes as $deviceType)
                <div class="card m-3 shadow-sm" style="width: 13rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $deviceType->type_name }}</h5>
                    </div>
                    <div class="card-footer d-flex justify-content-around">
                        <a href="{{ route('device-types.edit', $deviceType->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('device-types.destroy', $deviceType->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this device type?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No device types available. Please add one.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

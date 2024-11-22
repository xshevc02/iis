@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Devices</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">                <th>#</th>
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Device Button -->
    <a href="{{ route('devices.create') }}" class="btn btn-primary mb-3">Add New Device</a>

    <!-- Devices Table -->
    <table class="table table-bordered">
        <thead>
        <tr>

        <th>Name</th>
                <th>Type</th>
                <th>Studio</th>
                <th>Owner</th>
                <th>Year of Manufacture</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($devices as $device)
                <tr>
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->type->type_name }}</td>
                    <td>{{ $device->studio->name }}</td>
                    <td>{{ $device->user->name ?? 'N/A' }}</td>
                    <td>{{ $device->year_of_manufacture }}</td>
                    <td>{{ $device->available ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('devices.destroy', $device->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this device?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No devices found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection


@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white py-2 px-4" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 5px;">
                Device Types
            </h1>
            <a href="{{ route('device-types.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Device Type
            </a>
        </div>

        <!-- Device Types List -->
        @if ($deviceTypes->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No device types available. Please add one to get started.
            </div>
        @else
            <ul class="list-group shadow-sm">
                @foreach ($deviceTypes as $deviceType)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Dynamic Icon Based on Device Type -->
                            @php
                                $icons = [
                                    'Laptop' => 'fas fa-laptop',
                                    'Camera' => 'fas fa-camera',
                                    'Kitchen' => 'fas fa-blender',
                                    'Telefon' => 'fas fa-phone',
                                    'Camcorder' => 'fas fa-video',
                                    // Add more mappings here
                                ];
                                $icon = $icons[$deviceType->type_name] ?? 'fas fa-cog'; // Default icon
                            @endphp
                            <i class="{{ $icon }} fa-lg text-primary me-3"></i>
                            <span class="fw-bold">{{ $deviceType->type_name }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('device-types.edit', $deviceType->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('device-types.destroy', $deviceType->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this device type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection



@push('styles')
    <style>
        .list-group-item {
            padding: 15px 20px;
            margin-outside: 10px;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .list-group-item .fw-bold {
            font-size: 1.1rem;
        }

        .list-group-item i {
            font-size: 1.5rem;
            margin-outside: 10px;

        }

        .btn {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0;
        }

    </style>
@endpush

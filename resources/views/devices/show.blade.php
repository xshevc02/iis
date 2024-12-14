{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="text-white py-3" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;">
                Device Details
            </h1>
        </div>

        <!-- Device Details Card -->
        <div class="card shadow-lg border-0 rounded">
            <!-- Device Image -->
            <div class="card-img-top text-center py-3" style="background-color: #f8f9fa;">
                <img src="{{ $device->photo ? asset('storage/' . $device->photo) : asset('images/placeholder-device.png') }}"
                     alt="{{ $device->name }}"
                     style="max-width: 300px; max-height: 200px; object-fit: cover; border-radius: 10px;">
            </div>

            <div class="card-body px-5 py-4">
                <h3 class="text-primary text-center mb-4">{{ $device->name }}</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Type:</strong> {{ $device->type->type_name }}</p>
                        <p><strong>Studio:</strong> {{ $device->studio->name }}</p>
                        <p><strong>Year of Manufacture:</strong> {{ $device->year_of_manufacture }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Owner:</strong> {{ $device->user->name ?? 'N/A' }}</p>
                        <p>
                            <strong>Purchase Date:</strong>
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            {{ $device->purchase_date ? \Carbon\Carbon::parse($device->purchase_date)->format('jS F Y') : 'N/A' }}
                        </p>
                        <p><strong>Available:</strong>
                            @if ($device->available)
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center bg-light">
                <a href="{{ route('devices.index') }}" class="btn btn-secondary mx-2">
                    <i class="fas fa-arrow-left"></i> Back to Devices
                </a>
                <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning mx-2">
                    <i class="fas fa-edit"></i> Edit Device
                </a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 10px;
        }

        .card-body p {
            font-size: 1.1rem;
        }

        .card-footer {
            border-top: 1px solid #ddd;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-img-top img {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
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

        <!-- Device Types Cards -->
        @if ($deviceTypes->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No device types available. Please add one to get started.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($deviceTypes as $deviceType)
                    <div class="col">
                        <!-- Wrap the card in an anchor tag -->
                        <a href="{{ route('devices.index', ['device_type' => $deviceType->id]) }}" class="text-decoration-none">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <!-- Dynamic Icon Based on Device Type -->
                                    @php
                                        $icons = [
                                            'Laptop' => 'fas fa-laptop',
                                            'Camera' => 'fas fa-camera',
                                            'Kitchen' => 'fas fa-blender',
                                            'Telefon' => 'fas fa-phone',
                                            'Camcorder' => 'fas fa-video',
                                            'Monitor' => 'fas fa-desktop',
                                            'Printer' => 'fas fa-print',
                                            'Tablet' => 'fas fa-tablet-alt',
                                            'Speaker' => 'fas fa-volume-up',
                                            'Projector' => 'fas fa-projector',
                                            'Gaming Console' => 'fas fa-gamepad',
                                            'Smartphone' => 'fas fa-mobile-alt',
                                            'Headphones' => 'fas fa-headphones',
                                            'TV' => 'fas fa-tv',
                                            'Microwave' => 'fas fa-microchip',
                                            'Fridge' => 'fas fa-snowflake',
                                            'Washer' => 'fas fa-tint',
                                            'Router' => 'fas fa-wifi',
                                            'Scanner' => 'fas fa-qrcode',
                                            'Lighting' => 'fas fa-lightbulb',
                                            'Electric Oven' => 'fas fa-bread-slice',
                                            'Smartwatch' => 'fas fa-watch',
                                            'Camera Tripod' => 'fas fa-camera-retro',
                                            'VR Headset' => 'fas fa-vr-cardboard',
                                            '3D Printer' => 'fas fa-cube',
                                            'Server' => 'fas fa-server',
                                            'Hard Drive' => 'fas fa-hdd',
                                            'External Drive' => 'fas fa-database',
                                            'Keyboard' => 'fas fa-keyboard',
                                            'Mouse' => 'fas fa-mouse-pointer',
                                            'Fitness Tracker' => 'fas fa-heartbeat',
                                            'Drone' => 'fas fa-plane',
                                            'Smart Doorbell' => 'fas fa-bell',
                                            'Alarm System' => 'fas fa-shield-alt',
                                            'Thermostat' => 'fas fa-thermometer-half',
                                            'Fire Alarm' => 'fas fa-fire',
                                            'Security Camera' => 'fas fa-video-slash',
                                        ];

                                        $icon = $icons[$deviceType->type_name] ?? 'fas fa-cog'; // Default icon
                                    @endphp
                                    <i class="{{ $icon }} fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title text-center">{{ $deviceType->type_name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.02); /* Slight zoom on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
        }

        .card .fa-3x {
            font-size: 3rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .btn {
            font-size: 0.9rem;
        }
    </style>
@endpush

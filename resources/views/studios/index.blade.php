{{--
    Author: Veronika Novikova
    Login: xnovik03
--}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0" style="color: #2D2D2D; font-weight: bold;">Studios</h1>
            <a href="{{ route('studios.create') }}" class="btn" style="background: #A8DFFF; color: #2D2D2D; font-weight: bold; border-radius: 8px;">
                Create New Studio
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Message -->
        @if(isset($search) && $search)
            <p class="text-muted">
                Showing results for "<strong>{{ $search }}</strong>". {{ $studios->total() }} studios found.
            </p>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('studios.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or location" value="{{ $search ?? '' }}">
                <button class="btn " type="submit" style="background: #85D177; color: #2D2D2D; font-weight: bold;">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <!-- No Studios Found -->
        @if ($studios->isEmpty())
            <div class="alert alert-info text-center">
                No studios found. Click "Create New Studio" to add one.
            </div>
        @else
            <!-- Studios Grid -->
            <div class="row g-4">
                @foreach ($studios as $studio)
                    <div class="col-md-6 col-lg-4">
                        <!-- Clickable Card -->
                        <a href="{{ route('studios.show', $studio->id) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100">
                                <!-- Studio Image -->
                                <img src="{{ $studio->photo ? Storage::url($studio->photo) : asset('images/placeholder.jpg') }}"
                                     alt="{{ $studio->name }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">

                                <!-- Card Body -->
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #2D2D2D; font-weight: bold;">{{ $studio->name }}</h5>
                                    <p class="card-text" style="color: #2D2D2D;">
                                        <strong>Location:</strong> {{ $studio->location }}
                                    </p>
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
        body {
            background: linear-gradient(to bottom, #f8f9fa, #e9ecef); /* Light and subtle background */
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.02); /* Slight zoom on hover */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .btn-primary,
        .btn-success {
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease;
            outline: none; /* Removes default blue outline */
            border: none; /* Removes any border */
            box-shadow: none; /* Removes shadow effect */
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: translateY(-2px);
        }

        .btn-primary:focus,
        .btn-success:focus {
            outline: none; /* Removes focus outline */
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25); /* Adds a subtle focus ring */
        }

    </style>
@endpush

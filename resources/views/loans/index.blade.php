{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="font-size: 2.5rem; font-weight: bold; color: #2D2D2D;">Loans</h1>
            @if(auth()->user()->role->name === 'administrator')
                <a href="{{ route('loans.create') }}" class="btn" style="background-color: #85D177; font-weight: bold;">
                    Add Loan
                </a>
            @endif
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Overview Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Total Loans</h6>
                        <p class="display-6 text-primary">{{ $loans->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Active Loans</h6>
                        <p class="display-6 text-success">{{ $loans->where('status', 'Loaned')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Returned</h6>
                        <p class="display-6 text-danger">{{ $loans->where('status', 'Returned')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6>Pending</h6>
                        <p class="display-6 text-warning">{{ $loans->where('status', 'Pending')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('loans.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by user or device" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="issue_date" class="form-control" placeholder="Issue Date" value="{{ request('issue_date') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Loans Grid -->
        @if($loans->count() > 0)
            <div class="row">
                @foreach($loans as $loan)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('loans.show', $loan->id) }}" class="card shadow-sm h-100 text-decoration-none text-dark">
                            <!-- Device Image -->
                            <img src="{{ $loan->device->photo ? asset('storage/' . $loan->device->photo) : asset('images/placeholder-device.png') }}"
                                 alt="{{ $loan->device->name }}"
                                 class="card-img-top"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $loan->device->name }}</h5>
                                <p class="text-muted mb-2">
                                    <strong>User:</strong> {{ $loan->user->name }}<br>
                                    <strong>Room:</strong> {{ $loan->room }}
                                </p>
                                <p class="mb-0">
                                    <strong>Issue Date:</strong> {{ $loan->issue_date }}<br>
                                    <strong>Return Date:</strong> {{ $loan->return_date ?? 'Not Returned Yet' }}
                                </p>
                                <hr>
                                <span class="badge
                                    @if($loan->status == 'active') bg-success
                                    @elseif($loan->status == 'overdue') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                No loans found. Click "Add Loan" to create one!
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        /* Card Styles */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .badge {
            font-size: 1rem;
            padding: 0.5em;
        }

        .card-img-top {
            border-bottom: 1px solid #ddd;
        }
    </style>
@endpush

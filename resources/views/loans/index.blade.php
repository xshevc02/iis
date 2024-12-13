@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Loans</h1>
            @if(auth()->user()->role->name === 'administrator')
                <a href="{{ route('loans.create') }}" class="btn btn-success">Add Loan</a>
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
                        <div class="card shadow-sm h-100">
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
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                @if(auth()->user()->role->name === 'administrator')
                                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this loan?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
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
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            background: #f8f9fa;
            padding: 10px;
        }
    </style>
@endpush

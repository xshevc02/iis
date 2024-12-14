@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-primary">Loan Details</h1>

        <!-- Loan Card -->
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Loan</h4>
            </div>
            <div class="card-body px-5 py-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>User:</strong> {{ $loan->user->name }}</p>
                        <p><strong>Device:</strong> {{ $loan->device->name }}</p>
                        <p><strong>Issue Date:</strong> {{ $loan->issue_date }}</p>
                        <p><strong>Return Date:</strong> {{ $loan->return_date ?? 'Not Returned Yet' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Time From:</strong> {{ $loan->time_from }}</p>
                        <p><strong>Time To:</strong> {{ $loan->time_to }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $loan->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </p>
                        <p><strong>Room:</strong> {{ $loan->room }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Available From:</strong> {{ $loan->available_from }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Available To:</strong> {{ $loan->available_to }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card-footer bg-light text-center py-3">
                <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-primary mx-2" aria-label="Edit Loan">
                    <i class="fas fa-edit"></i> Edit Loan
                </a>
                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline mx-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this loan?')" aria-label="Delete Loan">
                        <i class="fas fa-trash-alt"></i> Delete Loan
                    </button>
                </form>
                <a href="{{ route('loans.index') }}" class="btn btn-secondary mx-2" aria-label="Back to Loans">
                    <i class="fas fa-arrow-left"></i> Back to Loans
                </a>
            </div>
        </div>
    </div>
@endsection

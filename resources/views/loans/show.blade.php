@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loan Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Loan #{{ $loan->id }}</h5>

                <p><strong>User:</strong> {{ $loan->user->name }}</p>
                <p><strong>Device:</strong> {{ $loan->device->name }}</p>
                <p><strong>Issue Date:</strong> {{ $loan->issue_date }}</p>
                <p><strong>Return Date:</strong> {{ $loan->return_date ?? 'Not Returned Yet' }}</p>
                <p><strong>Time From:</strong> {{ $loan->time_from }}</p>
                <p><strong>Time To:</strong> {{ $loan->time_to }}</p>
                <p><strong>Status:</strong> {{ $loan->status }}</p>
                <p><strong>Room:</strong> {{ $loan->room }}</p>
                <p><strong>Available from</strong> {{ $loan->available_from }}</p>
                <p><strong>Available to</strong> {{ $loan->available_to }}</p>

                <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-primary">Edit Loan</a>
                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this loan?')">Delete Loan</button>
                </form>
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back to Loans</a>
            </div>
        </div>
    </div>
@endsection

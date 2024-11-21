@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Loans</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Loan Button -->
        <a href="{{ route('loans.create') }}" class="btn btn-primary mb-3">Add New Loan</a>

        <!-- Loans Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Device</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->device->name }}</td>
                    <td>{{ $loan->issue_date }}</td>
                    <td>{{ $loan->return_date ?? 'Not Returned Yet' }}</td>
                    <td>{{ $loan->status }}</td>
                    <td>
                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this loan?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No loans found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
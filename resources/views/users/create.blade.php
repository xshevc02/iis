@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>

        <!-- User Information Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>

                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role->name ?? 'N/A' }}</p>
                <p><strong>Studio:</strong> {{ $user->studio->name ?? 'N/A' }}</p>
                <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y') }}</p>
                <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y') }}</p>

                <!-- Actions -->
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
            </div>
        </div>
    </div>
@endsection

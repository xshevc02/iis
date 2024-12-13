@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Manage Users</h1>
            <a href="{{ route('users.create') }}" class="btn btn-success">Add User to Studio</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($users->count() > 0)
            <ul class="list-group">
                @foreach ($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Optional Avatar -->
                            <img src="{{ $user->avatar_url ?? asset('default-avatar.png') }}"
                                 alt="{{ $user->name }}"
                                 class="rounded-circle me-3"
                                 style="width: 50px; height: 50px;">
                            <div>
                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <p class="mb-0 text-muted small">
                                    {{ $user->email }} <br>
                                    Role: {{ $user->role->name ?? 'N/A' }} | Studio: {{ $user->studio->name ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info text-center">
                No users found. Click "Add User to Studio" to get started!
            </div>
        @endif
    </div>
@endsection

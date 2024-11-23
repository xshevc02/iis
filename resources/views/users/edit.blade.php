@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit User Form -->
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name (Read-Only) -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" readonly>
            </div>

            <!-- Email (Read-Only) -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="" disabled>Select a Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Studio -->
            <div class="form-group">
                <label for="studio_id">Studio</label>
                <select name="studio_id" id="studio_id" class="form-control">
                    <option value="" disabled>Select a Studio</option>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}" {{ $user->studio_id == $studio->id ? 'selected' : '' }}>
                            {{ $studio->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

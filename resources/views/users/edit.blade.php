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
                @if (auth()->user()->role->name === 'administrator' || auth()->user()->role->name === 'studio manager')
                    <!-- If the current logged-in user is either an administrator or a studio manager -->
                    <select name="role_id" id="role_id" class="form-control">

                        <option value="{{ $user->role->id }}" selected>{{ ucfirst($user->role->name) }}</option>

                        @if ($user->role->name === 'registered user')
                            <!-- If editing a "registered user", allow role assignment -->
                            <option value="" disabled>Select Role</option>

                            @foreach ($roles as $role)
                                <!-- Admin can assign "instructor" or "studio manager" -->
                                <!-- Studio manager can only assign "instructor" -->
                                @if (
                                    (auth()->user()->role->name === 'administrator' && ($role->name === 'instructor' || $role->name === 'studio manager')) ||
                                    (auth()->user()->role->name === 'studio manager' && $role->name === 'instructor')
                                )
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endif
                            @endforeach
                        @else
                            <!-- Display current role for any other role -->
                            <option value="{{ $user->role->id }}" selected>{{ ucfirst($user->role->name) }}</option>
                        @endif
                    </select>
                @else
                    <!-- If the current logged-in user is not an administrator or studio manager -->
                    <p class="form-control-plaintext">
                        {{ ucfirst($user->role->name) }}
                        <!-- Display the current role of the user being edited as plain text, making it read-only -->
                    </p>
                @endif
            </div>





            <!-- Studio -->
            <div class="form-group">
                <label for="studio_id" class="form-label">Studio</label>
                <div class="p-2 border rounded bg-light">
                    {{ $user->studio->name ?? 'N/A' }}
                </div>
            </div>

            <!-- Can Make Reservations -->
            <div class="form-group form-check my-3">
                <input type="checkbox" name="can_make_reservations" id="can_make_reservations" class="form-check-input"
                    {{ $user->can_make_reservations ? 'checked' : '' }}>
                <label for="can_make_reservations" class="form-check-label">Allow this user to make reservations</label>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

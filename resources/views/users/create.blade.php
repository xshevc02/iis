{{--
    Author: Anna Shevchenko
    Login: xshevc02
--}}
@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Create User</h1>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Profile Photo -->
            <div class="form-group mb-3">
                <label for="photo">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>

            <!-- Role -->
            <div class="form-group mb-3">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>

@endsection

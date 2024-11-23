@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Role</h1>
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection

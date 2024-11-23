@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Role</h1>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection

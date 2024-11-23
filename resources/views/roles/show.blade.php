@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Role Details</h2>
            </div>
            <div class="card-body">
                <h4>Role Name:</h4>
                <p>{{ $role->name }}</p>

                <h4>Assigned Users:</h4>
                @if ($role->users->count() > 0)
                    <ul>
                        @foreach ($role->users as $user)
                            <li>{{ $user->name }} ({{ $user->email }})</li>
                        @endforeach
                    </ul>
                @else
                    <p>No users assigned to this role.</p>
                @endif

                <h4>Permissions:</h4>
                @if ($role->permissions->count() > 0)
                    <ul>
                        @foreach ($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No permissions assigned to this role.</p>
                @endif

                <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Back to Roles</a>
            </div>
        </div>
    </div>
@endsection

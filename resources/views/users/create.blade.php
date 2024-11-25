@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h1 class="mb-4 text-center">Users Without Studio</h1>

    @if ($usersWithoutStudio->count() > 0)
        <table class="table table-striped table-bordered">
            <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($usersWithoutStudio as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('users.assignToStudio', $user->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                Add to Studio
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info text-center mt-4">
            <strong>No users without a studio available.</strong>
        </div>
    @endif
</div>
@endsection

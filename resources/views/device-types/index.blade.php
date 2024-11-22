@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Device Types</h1>
        <a href="{{ route('device-types.create') }}" class="btn btn-primary">Add Device Type</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($deviceTypes as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->type_name }}</td>
                    <td>
                        <a href="{{ route('device-types.edit', $type) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('device-types.destroy', $type) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

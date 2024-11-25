@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Studio Details</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $studio->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $studio->name }}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ $studio->location }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $studio->created_at ? $studio->created_at->format('d M Y, H:i') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $studio->updated_at ? $studio->updated_at->format('d M Y, H:i') : 'N/A' }}</td>
                            </tr>

                        </table>

                        <div class="mt-4">
                            <a href="{{ route('studios.index') }}" class="btn btn-secondary">Back to List</a>
                            <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-primary">Edit Studio</a>

                            <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this studio?')">Delete Studio</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

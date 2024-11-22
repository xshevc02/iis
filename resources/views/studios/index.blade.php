@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Studios</h4>
                        <a href="{{ route('studios.create') }}" class="btn btn-primary">Create New Studio</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($studios->isEmpty())
                            <p>No studios found.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($studios as $studio)
                                    <tr>
                                        <td>{{ $studio->id }}</td>
                                        <td>{{ $studio->name }}</td>
                                        <td>{{ $studio->location }}</td>
                                        <td>
                                            <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $studios->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

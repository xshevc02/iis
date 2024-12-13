@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Studios</h1>
            <a href="{{ route('studios.create') }}" class="btn btn-primary">Create New Studio</a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Message -->
        @if(isset($search) && $search)
            <p class="text-muted">
                Showing results for "<strong>{{ $search }}</strong>". {{ $studios->total() }} studios found.
            </p>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('studios.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or location" value="{{ $search ?? '' }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <!-- No Studios Found -->
        @if ($studios->isEmpty())
            <div class="alert alert-info text-center">
                No studios found. Click "Create New Studio" to add one.
            </div>
        @else
            <!-- Studios Grid -->
            <div class="row g-4">
                @foreach ($studios as $studio)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <!-- Studio Image -->
                            <img src="{{ $studio->image_url ?? asset('images/placeholder.jpg') }}"
                                 class="card-img-top"
                                 alt="{{ $studio->name }}"
                                 style="height: 200px; object-fit: cover;">

                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $studio->name }}</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> {{ $studio->location }}
                                </p>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-sm btn-primary" aria-label="View Studio">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-sm btn-warning" aria-label="Edit Studio">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" aria-label="Delete Studio">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Studio</h4>
                    </div>
                    <div class="card-body">
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

                        <!-- Edit Studio Form -->
                        <form action="{{ route('studios.update', $studio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name">Studio Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $studio->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="location">Building</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') ?? $studio->location }}" required>
                            </div>

                            <!-- Display current photo if available -->
                            @if($studio->photo)
                                <div class="form-group mb-3">
                                    <label for="current_photo">Current Photo</label>
                                    <img src="{{ Storage::url($studio->photo) }}" alt="Studio Photo" class="img-thumbnail" style="width: 200px;">
                                    <br>
                                    <label for="photo">Change Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>
                            @else
                                <div class="form-group mb-3">
                                    <label for="photo">Upload a Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('studios.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

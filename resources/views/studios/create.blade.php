@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Studio</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('studios.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Studio Name -->
                            <div class="form-group mb-3">
                                <label for="name">Studio Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <!-- Studio Location -->
                            <div class="form-group mb-3">
                                <label for="location">Studio Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                            </div>

                            <!-- Studio Photo -->
                            <div class="form-group mb-3">
                                <label for="photo">Studio Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Studio</button>
                            <a href="{{ route('studios.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

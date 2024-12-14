@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Manage Users</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($users->count() > 0)
            <div class="row g-4">
                @foreach ($users as $user)
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <!-- User Photo -->
                            <img src="{{ Storage::url($user->photo ?? 'default-avatar.png') }}"
                                 alt="{{ $user->name }}"
                                 class="card-img-top rounded-circle"
                                 style="width: 100px; height: 100px; object-fit: cover; margin: 20px auto;">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $user->name }}</h5>
                                <p class="card-text text-center">
                                    <strong>Email:</strong> {{ $user->email }} <br>

                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                No users found. Click "Add User to Studio" to get started!
            </div>
        @endif
    </div>
@endsection

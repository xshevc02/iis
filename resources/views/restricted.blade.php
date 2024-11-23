@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="alert alert-danger mt-5">
            <h1 class="display-4">Access Denied</h1>
            <p class="lead">You do not have the necessary permissions to view this page or perform this action.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Return to Homepage</a>
    </div>
@endsection

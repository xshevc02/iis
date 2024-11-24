@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Device Details</h1>
        <p><strong>Name:</strong> {{ $device->name }}</p>
        <p><strong>Type:</strong> {{ $device->type->type_name }}</p>
        <p><strong>Studio:</strong> {{ $device->studio->name }}</p>
        <p><strong>Year of Manufacture:</strong> {{ $device->year_of_manufacture }}</p>
        <p><strong>Purchase Date:</strong> {{ $device->purchase_date }}</p>
        <p><strong>Available:</strong> {{ $device->available ? 'Yes' : 'No' }}</p>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <!-- Welcome Message -->
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
            <p class="font-bold">Welcome Back!</p>
            <p>Hello, {{ Auth::user()->name }}. Here's an overview of your account.</p>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Example Cards -->
            <a href="{{ route('reservations.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="text-lg font-bold">My Reservations</h5>
                <p class="mt-2 text-sm text-gray-600">View and manage your reservations.</p>
            </a>

            <a href="{{ route('devices.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="text-lg font-bold">Available Devices</h5>
                <p class="mt-2 text-sm text-gray-600">Browse and reserve devices.</p>
            </a>

            <a href="{{ route('loans.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <h5 class="text-lg font-bold">My Loans</h5>
                <p class="mt-2 text-sm text-gray-600">Check your loaned items and history.</p>
            </a>
        </div>
    </div>
@endsection

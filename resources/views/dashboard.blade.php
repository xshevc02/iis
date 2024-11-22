@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-3xl font-bold mb-6">
                🌟 Welcome Back, {{ Auth::user()->name }}! 🎉
            </h1>

            <p class="text-gray-700 mb-6">We're thrilled to have you here. Take a moment to explore your dashboard:</p>

            <!-- Quick Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Devices Card -->
                <div class="bg-blue-100 p-4 rounded shadow">
                    <h2 class="text-lg font-bold">Devices</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ $deviceCount ?? 0 }}</p>
                    <a href="{{ route('devices.index') }}" class="text-blue-500 hover:underline">View Devices</a>
                </div>
                <!-- Users Card -->
                <div class="bg-green-100 p-4 rounded shadow">
                    <h2 class="text-lg font-bold">Users</h2>
                    <p class="text-2xl font-bold text-green-600">{{ $userCount ?? 0 }}</p>
                    <a href="{{ route('users.index') }}" class="text-green-500 hover:underline">Manage Users</a>
                </div>
                <!-- Reservations Card -->
                <div class="bg-yellow-100 p-4 rounded shadow">
                    <h2 class="text-lg font-bold">Reservations</h2>
                    <p class="text-2xl font-bold text-yellow-600">{{ $reservationCount ?? 0 }}</p>
                    <a href="{{ route('reservations.index') }}" class="text-yellow-500 hover:underline">Check Reservations</a>
                </div>
                <!-- Loans Card -->
                <div class="bg-purple-100 p-4 rounded shadow">
                    <h2 class="text-lg font-bold">Loans</h2>
                    <p class="text-2xl font-bold text-purple-600">{{ $loanCount ?? 0 }}</p>
                    <a href="{{ route('loans.index') }}" class="text-purple-500 hover:underline">Manage Loans</a>
                </div>
            </div>

            <!-- Motivational Message -->
            <div class="mt-8 bg-gray-100 p-6 rounded shadow text-center">
                <h2 class="text-xl font-bold mb-4">"The best way to predict the future is to create it." 🌟</h2>
                <p class="text-gray-600">Make today amazing by organizing and managing your resources efficiently!</p>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-12">
        <!-- Intro Section -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-black p-8 rounded-lg shadow-md text-center mb-10">
            <h1 class="text-5xl font-extrabold mb-4">Streamline Your Workflow</h1>
            <p class="text-lg">
                Manage devices, studios, reservations, and more — all in one place.
            </p>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl font-bold text-blue-600 mb-2">Devices</h2>
                <p class="text-gray-700">Track and organize your equipment with ease.</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl font-bold text-green-600 mb-2">Studios</h2>
                <p class="text-gray-700">Keep your studios booked and ready.</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl font-bold text-yellow-600 mb-2">Reservations</h2>
                <p class="text-gray-700">Simplify bookings with our smart tools.</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                <h2 class="text-2xl font-bold text-red-600 mb-2">Loans</h2>
                <p class="text-gray-700">Manage lending with full transparency.</p>
            </div>
        </div>

        <!-- Call-to-Action -->
        <div class="text-center mt-12">
            @guest
                <a href="{{ route('login') }}" class="bg-blue-600 text-black px-8 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition-all">
                    Get Started
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-black px-8 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition-all">
                    Go to Dashboard
                </a>
            @endguest
        </div>
    </div>
@endsection

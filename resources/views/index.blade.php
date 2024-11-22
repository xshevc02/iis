<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Umělecká škola<</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Header -->
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Umělecká škola</h1>
        <!-- Navigation -->
        <nav>
            <ul class="flex space-x-4 items-center">
                <li><a href="{{ route('home') }}" class="text-white hover:underline">Home</a></li>
                <li><a href="{{ route('devices.index') }}" class="text-white hover:underline">Devices</a></li>
                <li><a href="{{ route('studios.index') }}" class="text-white hover:underline">Studios</a></li>
                <li><a href="{{ route('users.index') }}" class="text-white hover:underline">Users</a></li>
                <li><a href="{{ route('reservations.index') }}" class="text-white hover:underline">Reservations</a></li>
                <li><a href="{{ route('loans.index') }}" class="text-white hover:underline">Loans</a></li>

                @auth
                    <!-- User is logged in -->
                    <li class="ml-4">Welcome, {{ Auth::user()->name }}</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:underline">Log Out</button>
                        </form>
                    </li>
                @else
                    <!-- Guest user -->
                    <li><a href="{{ route('login') }}" class="text-white hover:underline">Sign In</a></li>
                    <li><a href="{{ route('register') }}" class="text-white hover:underline">Sign Up</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>


<!-- Main Content -->
<main class="container mx-auto py-8">
    <h1 class="text-3xl font-bold underline">
        Welcome to Laravel Application
    </h1>
    <p class="mt-4">This is your application’s landing page. Customize it as needed!</p>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-4 mt-8">
    <div class="container mx-auto text-center">
        <p>&copy; {{ date('Y') }} Laravel Application. All rights reserved.</p>
    </div>
</footer>
</body>
</html>

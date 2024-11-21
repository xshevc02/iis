<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Application</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Header -->
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Laravel Application</h1>
        <!-- Navigation -->
        <nav>
            <ul class="flex space-x-4">
                @auth
                    <!-- User is logged in -->
                    <li>Welcome, {{ Auth::user()->name }}</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
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

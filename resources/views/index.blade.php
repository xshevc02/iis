@extends('layouts.app')

@section('content')
    <div class="hero-section text-white text-center py-12 px-6" style="background: linear-gradient(to bottom, rgba(255, 174, 0, 0.9), rgba(255, 87, 34, 0.9), rgba(30, 136, 229, 0.9)); min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">

        <!-- Main Heading -->
        <h1 class="text-5xl font-extrabold mb-6 text-shadow">
            Welcome to Our Community for Tourists
        </h1>

        <!-- Brief Info -->
        <p class="text-xl text-white mb-6">
            We are a community of people who help tourists by offering free device rentals for their adventures. In return, you can borrow something useful for your own travels!
        </p>

        <!-- Details Section -->
        <div class="text-left mx-auto w-full max-w-4xl py-8">
            <h2 class="text-3xl font-bold mb-4">How It Works</h2>
            <p class="text-lg mb-6">
                Our community connects tourists with locals who offer their devices for free, helping travelers experience new places without the worry of renting expensive equipment. All you need to do is sign up, and you can borrow the tools you need for your journey—whether it's a camera, a portable charger, or even a GPS device!
            </p>

            <h2 class="text-3xl font-bold mb-4">Why Join Us?</h2>
            <p class="text-lg mb-6">
                By joining our community, you’re not just gaining access to free resources; you're becoming part of a network that believes in sharing and supporting one another. It’s a win-win situation! Tourists get free devices, and you get access to what you need for your own travels. Together, we create a more sustainable and resourceful travel experience.
            </p>

            <h2 class="text-3xl font-bold mb-4">Benefits</h2>
            <ul class="list-disc pl-5 text-lg">
                <li>Free device rentals from the community</li>
                <li>Borrow tools that will enhance your travel experience</li>
                <li>Help fellow travelers and connect with like-minded people</li>
                <li>Support sustainable travel by reducing the need for rentals</li>
            </ul>
        </div>

        <!-- Call to Action -->
        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="inline-block bg-white text-black font-bold py-3 px-8 rounded-full text-lg shadow-md hover:bg-gray-200 transition-all">
                Go to Dashboard
            </a>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .hero-section {
            background: linear-gradient(to bottom, rgba(255, 174, 0, 0.9), rgba(255, 87, 34, 0.9), rgba(30, 136, 229, 0.9));
            color: white;
            text-align: center;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .inline-block {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .inline-block:hover {
            transform: scale(1.05);
            background-color: #f0f0f0;
        }

        .rounded-full {
            border-radius: 30px;
        }

        a:hover {
            text-decoration: none;
        }

        .list-disc {
            margin-top: 2rem;
        }

        ul {
            margin: 0 auto;
            max-width: 600px;
            list-style-position: outside;
        }
    </style>
@endsection

@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section py-5" style="background: linear-gradient(to bottom, #C399FF,  #4A90E2);">
        <div class="container text-center">
            <!-- Main Heading with space above -->
            <h1 class="display-4 text-white font-weight-bold mb-3 text-shadow" style="padding-top: 2rem;">
                Welcome to Our Community for Tourists
            </h1>

            <!-- Subheading -->
            <p class="lead text-light mb-4">
                A place where travelers can borrow and share devices, creating a sustainable and collaborative travel experience.
            </p>

            <!-- Call to Action Button -->
            <a href="{{ route('dashboard') }}" class="btn btn-lg btn-light text-dark rounded-pill px-5 py-2 shadow-sm">
                Go to Dashboard
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section py-5" style="background-color: #4A90E2;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fas fa-camera fa-3x text-primary mb-3"></i>
                        <h4 class="font-weight-bold">How It Works</h4>
                        <p class="text-muted">
                            Borrow tools you need for your journey, such as cameras or portable chargers, from our community for free.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h4 class="font-weight-bold">Why Join Us?</h4>
                        <p class="text-muted">
                            Connect with fellow travelers, share resources, and reduce the environmental impact of travel.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fas fa-gift fa-3x text-warning mb-3"></i>
                        <h4 class="font-weight-bold">Benefits</h4>
                        <p class="text-muted">
                            Enjoy free rentals, share knowledge, and become part of a sustainable travel community.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials-section py-5" style="background: linear-gradient(to bottom, #4A90E2,  #9257f1);">
        <div class="container text-center text-white">
            <h2 class="display-5 mb-4">What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial bg-white text-dark rounded shadow-sm p-4 mb-3">
                        <p>"This community helped me find a camera for my trip to Prague. It was amazing!"</p>
                        <h5 class="mt-3 mb-0 font-weight-bold">- Anna</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white text-dark rounded shadow-sm p-4 mb-3">
                        <p>"I love how easy it is to borrow devices. It's sustainable and affordable!"</p>
                        <h5 class="mt-3 mb-0 font-weight-bold">- Mark</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white text-dark rounded shadow-sm p-4 mb-3">
                        <p>"This platform saved my trip by letting me borrow a power bank. Highly recommend!"</p>
                        <h5 class="mt-3 mb-0 font-weight-bold">- Sophie</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Hero Section Styling */
        .hero-section {
            background: linear-gradient(to bottom, #9257f1, #4A90E2);
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Features Section */
        .feature-box {
            border: 1px solid #e0e0e0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Testimonials Section */
        .testimonial {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .testimonial:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

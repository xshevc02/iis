{{--
    Author: Veronika Novikova
    Login: xnovik03
--}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Studio Card -->
                <div class="card shadow-sm border-0 rounded">
                    <!-- Header Section -->
                    <div class="card-header text-center bg-light py-4 rounded-top">
                        <h1 class="fw-bold mb-0" style="color: white;">{{ $studio->name }}</h1>
                    </div>

                    <!-- Studio Details -->
                    <div class="card-body px-4 py-5">
                        <!-- Location Section -->
                        <div class="text-center mb-4">
                            <!-- Studio Photo -->
                            <div class="text-center my-4">
                                <img src="{{ $studio->photo ? asset('storage/' . $studio->photo) : asset('images/placeholder.png') }}"
                                     class="img-fluid"
                                     alt="{{ $studio->name }}"
                                     style="max-height: 300px; object-fit: cover; border-radius: 10px;">
                            </div>
                            <h5 class="text-primary"><i class="fas fa-map-marker-alt"></i> Location</h5>
                            <p class="text-muted">{{ $studio->location }}</p>
                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($studio->location) }}"
                                target="_blank"
                                class="btn btn-primary">
                                <i class="fas fa-map"></i> Show on Maps
                            </a>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-footer bg-light text-center py-3">
                        <a href="{{ route('studios.index') }}" class="btn btn-outline-secondary mx-2">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-primary mx-2">
                            <i class="fas fa-edit"></i> Edit Studio
                        </a>
                        <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" class="d-inline mx-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this studio?')">
                                <i class="fas fa-trash-alt"></i> Delete Studio
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>


/* Card Styling */
.card {
background-color: #ffffff;
border-radius: 12px;
box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow for floating effect */
}

/* Card Header Gradient */
.card-header {
background: linear-gradient(90deg, #007bff, #0056b3); /* Eye-catching gradient */
text-decoration-color: #ffffff;
font-size: 1.5rem;
font-weight: bold;
text-align: center;
border-top-left-radius: 12px;
border-top-right-radius: 12px;
}

/* Buttons */
.btn {
font-size: 1rem;
padding: 10px 20px;
transition: all 0.3s ease-in-out;
}

.btn:hover {
transform: translateY(-2px); /* Subtle hover effect for buttons */
box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}
/* Location Section */
h5.text-primary {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.location-section {
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 10px;
}

.location-section p {
    font-size: 1rem;
    color: #6c757d; /* Muted text color */
}
/* Location Section Styling */
.text-center h5 {
    font-size: 1.2rem;
    font-weight: bold;
}

.text-center p {
    font-size: 1rem;
    margin-bottom: 15px;
    color: #6c757d;
}

.btn-primary {
    padding: 10px 20px;
    font-size: 1rem;
    transition: all 0.2s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}


    </style>
@endpush

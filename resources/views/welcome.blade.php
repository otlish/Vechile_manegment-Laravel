<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VehicleRent') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0f172a; /* Slate 900 - Deep Navy */
            --accent-color: #d97706; /* Amber 600 - Muted Gold */
            --text-dark: #1e293b;
            --text-light: #64748b;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
            color: var(--text-dark);
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 1.2rem 0;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 600;
            color: var(--text-dark) !important;
            margin-left: 1.5rem;
            transition: color 0.3s;
            font-size: 0.95rem;
        }
        .nav-link:hover {
            color: var(--accent-color) !important;
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            background-color: var(--primary-color);
            padding: 9rem 0 7rem;
            overflow: hidden;
        }
        .hero-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
            mix-blend-mode: overlay;
        }
        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: white;
            line-height: 1.1;
        }
        .btn-primary-custom {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        .btn-primary-custom:hover {
            background-color: #b45309; /* Darker Amber */
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(217, 119, 6, 0.4);
            color: white;
        }
        .btn-outline-custom {
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            padding: 0.9rem 2.5rem;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        .btn-outline-custom:hover {
            background-color: white;
            color: var(--primary-color);
            border-color: white;
        }
        
        /* Features */
        .feature-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: var(--accent-color);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        /* Vehicle Cards */
        .vehicle-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            background: white;
        }
        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .vehicle-img {
            height: 240px;
            object-fit: cover;
        }
        .price-tag {
            color: var(--primary-color);
            font-weight: 800;
            font-size: 1.5rem;
        }
        .btn-rent {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 700;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s;
        }
        .btn-rent:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: #94a3b8;
            padding: 5rem 0 3rem;
        }
        .footer-heading {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.5px;
        }
        .footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer a:hover {
            color: var(--accent-color);
        }
        
        /* Utilities */
        .text-primary-dark {
            color: var(--primary-color);
        }
        .text-accent {
            color: var(--accent-color);
        }
        .badge-brand {
            background-color: #f1f5f9;
            color: var(--text-dark);
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-car-side me-2 text-accent"></i>VehicleRent
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary-custom ms-3" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <img src="https://images.unsplash.com/photo-1503376763036-066120622c74?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Car Background" class="hero-bg-image">
        <div class="container hero-content text-center">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <h1 class="hero-title">Elevate Your Journey</h1>
                    <p class="lead mb-5 opacity-90 fs-4">Premium fleet. Transparent prices. Unforgettable experiences.</p>
                    <div class="d-flex justify-content-center gap-3">
                        @auth
                             <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">Book Your Ride</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary-custom">Start Now</a>
                            <a href="#featured" class="btn btn-outline-custom">View Fleet</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-accent fw-bold text-uppercase letter-spacing-2">Why Choose Us</h6>
                <h2 class="fw-bold display-5 text-primary-dark">Excellence in Motion</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-car feature-icon"></i>
                        <h4 class="fw-bold mb-3 text-primary-dark">Premium Selection</h4>
                        <p class="text-muted">Curated collection of top-tier vehicles maintained to the highest standards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h4 class="fw-bold mb-3 text-primary-dark">Secure & Safe</h4>
                        <p class="text-muted">Comprehensive insurance coverage and 24/7 roadside assistance included.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-bolt feature-icon"></i>
                        <h4 class="fw-bold mb-3 text-primary-dark">Instant Booking</h4>
                        <p class="text-muted">Digital-first experience. From selection to ignition in under 5 minutes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Vehicles -->
    @if(isset($featuredVehicles) && $featuredVehicles->count() > 0)
    <section id="featured" class="py-5 bg-white">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="fw-bold mb-0 text-primary-dark">Featured Models</h2>
                    <p class="text-muted mb-0">High-performance vehicles ready for deployment.</p>
                </div>
                <a href="#" class="text-decoration-none fw-bold text-accent">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row g-4">
                @foreach($featuredVehicles as $vehicle)
                <div class="col-md-6 col-lg-4">
                    <div class="card vehicle-card h-100">
                         @php
                            $randomImage = 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'Toyota') !== false) $randomImage = 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'Honda') !== false) $randomImage = 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'BMW') !== false) $randomImage = 'https://images.unsplash.com/photo-1555215695-3004980adade?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             
                             $image = $vehicle->image ? asset('storage/' . $vehicle->image) : $randomImage;
                        @endphp
                        <img src="{{ $image }}" class="card-img-top vehicle-img" alt="{{ $vehicle->name }}">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-brand">{{ $vehicle->brand }}</span>
                                <small class="text-muted"><i class="fas fa-gas-pump me-1"></i>Petrol</small>
                            </div>
                            <h5 class="card-title fw-bold mb-3 text-primary-dark">{{ $vehicle->name }}</h5>
                            <div class="d-flex justify-content-between align-items-end mt-4">
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Daily Rate</small>
                                    <span class="price-tag">${{ number_format($vehicle->daily_rent_price, 0) }}</span>
                                </div>
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-rent">Rent</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-rent">Rent</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <div class="rounded-3 p-5 text-center text-white position-relative overflow-hidden" style="background-color: var(--primary-color);">
                <div class="position-relative z-1">
                    <h2 class="fw-bold mb-3">Ready to start your journey?</h2>
                    <p class="lead mb-4 opacity-75">Join thousands of satisfied customers today.</p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">Go to Dashboard</a>
                    @else
                         <a href="{{ route('register') }}" class="btn btn-primary-custom">Create Account</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="footer-heading">VehicleRent</h4>
                    <p class="mb-4">Your trusted partner for reliable, affordable, and luxury vehicle rentals. Located in the heart of the city.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="fs-5"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Press</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="text-white mb-3">Support</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Help Center</a></li>
                        <li class="mb-2"><a href="#">Terms of Service</a></li>
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-white mb-3">Subscribe</h5>
                    <p>Get the latest updates and offers.</p>
                    <form class="d-flex gap-2">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </form>
                </div>
            </div>
            <hr class="my-5 border-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} VehicleRent. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'VehicleRent') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50 text-gray-900 font-sans">
        
        <!-- Navbar -->
        <nav class="bg-white shadow-sm fixed w-full z-10 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="font-bold text-xl tracking-tight text-gray-800">VehicleRent</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-700 transition">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gray-900 overflow-hidden pt-16">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover opacity-40" src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Luxury Car Background">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Drive Your Dreams <br class="hidden sm:block"> <span class="text-indigo-400">Today</span>
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                    Experience the thrill of the open road with our premium fleet of vehicles. Affordable rates, flexible booking, and 24/7 support.
                </p>
                <div class="mt-10 max-w-sm sm:flex sm:max-w-none">
                    @auth
                         <a href="{{ url('/dashboard') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10">
                            Book Now
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10">
                            Get Started
                        </a>
                        <a href="#featured" class="mt-3 w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 sm:mt-0 sm:ml-3">
                            View Cars
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Why Choose Us</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        A better way to rent
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        We prioritize your comfort and safety with our top-notch services.
                    </p>
                </div>

                <div class="mt-10">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Wide Selection</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                From economy to luxury, SUVs to sports cars, we have the perfect ride for any occasion.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Best Prices</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Competitive daily rates and special weekend offers to keep your wallet happy.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Easy Booking</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Seamless online booking experience. Reserve your car in just a few clicks.
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Featured Vehicles Section -->
        @if(isset($featuredVehicles) && $featuredVehicles->count() > 0)
        <div id="featured" class="bg-gray-100 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-gray-900">Available Now</h2>
                    <p class="mt-4 text-lg text-gray-500">Check out some of our latest additions.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredVehicles as $vehicle)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Placeholder image logic -->
                        @php
                            $randomImage = 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if($vehicle->brand == 'Toyota') $randomImage = 'https://images.unsplash.com/photo-1590362891991-f776e747a588?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if($vehicle->brand == 'Honda') $randomImage = 'https://images.unsplash.com/photo-1627483262769-04d0a1401487?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             // Add more mock logic or use featured image if available
                             $image = $vehicle->image ? asset('storage/' . $vehicle->image) : $randomImage;
                        @endphp
                        <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $vehicle->name }}">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $vehicle->brand }} {{ $vehicle->name }}</h3>
                            <p class="mt-2 text-gray-600 text-sm">Valid License Plate: {{ $vehicle->plate_number }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600">${{ $vehicle->daily_rent_price }}<span class="text-sm text-gray-500 font-normal">/day</span></span>
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 text-sm font-medium">Rent</a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 text-sm font-medium">Rent</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">VehicleRent</h3>
                    <p class="text-gray-400 text-sm">
                        Trusted by thousands of drivers. We make renting cars easy, affordable, and safe.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                     <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                         <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                     <ul class="space-y-2 text-sm text-gray-400">
                        <li>123 Main Street, Cityville</li>
                        <li>support@vehiclerent.com</li>
                        <li>+1 (555) 123-4567</li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-700 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} VehicleRent. All rights reserved.
            </div>
        </footer>

    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                --bg-light: #f1f5f9;
            }
            
            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--bg-light);
                color: var(--text-dark);
            }

            /* Navbar */
            .navbar {
                background-color: white;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                padding: 1rem 0;
            }
            .navbar-brand {
                font-weight: 800;
                color: var(--primary-color) !important;
                letter-spacing: -0.5px;
            }
            .nav-link {
                font-weight: 600;
                color: var(--text-dark) !important;
                margin-left: 1rem;
                transition: color 0.3s;
            }
            .nav-link:hover, .nav-link.active {
                color: var(--accent-color) !important;
            }

            /* Cards */
            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                transition: transform 0.2s;
            }
            .card-header {
                background-color: white;
                border-bottom: 1px solid #e2e8f0;
                font-weight: 700;
                color: var(--primary-color);
                padding: 1.5rem;
                border-radius: 12px 12px 0 0 !important;
            }
            .card-body {
                padding: 1.5rem;
            }
            
            /* Buttons */
            .btn-primary-custom {
                background-color: var(--primary-color);
                color: white;
                border: none;
                padding: 0.5rem 1.5rem;
                font-weight: 600;
                border-radius: 6px;
                transition: all 0.3s;
            }
            .btn-primary-custom:hover {
                background-color: #1e293b;
                color: white;
            }
            
            .btn-accent {
                background-color: var(--accent-color);
                color: white;
                font-weight: 600;
            }
            .btn-accent:hover {
                background-color: #b45309;
                color: white;
            }

            /* Tables */
            .table th {
                font-weight: 600;
                color: var(--text-light);
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                background-color: #f8fafc;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo_v2.png') }}" height="50" class="me-2" alt="Vehicle Rent">VehicleRent
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @if(Auth::user()->role === 'customer')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('customer.history') ? 'active' : '' }}" href="{{ route('customer.history') }}">Rental History</a>
                        </li>
                        @endif
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-5">
            <div class="container">
                {{ $slot }}
            </div>
        </main>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

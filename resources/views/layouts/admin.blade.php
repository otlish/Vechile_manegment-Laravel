<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - VehicleRent</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 800;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }

        .wrapper { display: flex; flex: 1; }
        
        .sidebar { 
            min-width: 260px; 
            background: var(--primary-color);
            color: white; 
            min-height: calc(100vh - 70px);
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        
        .sidebar .nav-link { 
            color: rgba(255,255,255,0.7) !important; 
            padding: 1rem 1.5rem; 
            font-weight: 500;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            color: white !important; 
            background: rgba(255,255,255,0.05); 
            border-left-color: var(--accent-color);
        }
        
        .sidebar .nav-link i { 
            width: 25px; 
            text-align: center; 
            margin-right: 10px; 
            color: var(--accent-color);
        }
        
        .content { 
            flex: 1; 
            padding: 2rem; 
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        .card-icon { 
            font-size: 3rem; 
            opacity: 0.2; 
            position: absolute; 
            right: 20px; 
            top: 20px; 
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_v2.png') }}" alt="Vehicle Rent" height="35" class="d-inline-block align-text-top me-2">VehicleRent <span class="badge bg-light text-dark ms-2 border" style="font-size: 0.7rem; vertical-align: middle;">ADMIN</span>
            </a>
            <div class="d-flex align-items-center">
                 <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2 border-0" type="button" data-bs-toggle="dropdown">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="d-none d-md-block fw-bold small text-dark">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="py-4 px-4">
                <small class="text-uppercase fw-bold" style="color: rgba(255,255,255,0.5); font-size: 0.7rem; letter-spacing: 1px;">Main Menu</small>
            </div>
            <div class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="nav-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                    <i class="fas fa-car"></i> Vehicles
                </a>
                <a href="{{ route('admin.customers') }}" class="nav-link {{ request()->routeIs('admin.customers') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="{{ route('admin.rentals') }}" class="nav-link {{ request()->routeIs('admin.rentals') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Rentals
                </a>
                 <a href="{{ route('admin.returns') }}" class="nav-link {{ request()->routeIs('admin.returns') ? 'active' : '' }}">
                    <i class="fas fa-undo"></i> Returns
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

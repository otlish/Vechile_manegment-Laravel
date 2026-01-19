<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Vehicle Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { min-height: 100vh; display: flex; flex-direction: column; }
        .wrapper { display: flex; flex: 1; }
        .sidebar { min-width: 250px; background: #343a40; color: white; min-height: 100vh; }
        .sidebar .nav-link { color: rgba(255,255,255,.8); padding: 15px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,.1); }
        .sidebar .nav-link i { width: 25px; text-align: center; margin-right: 10px; }
        .content { flex: 1; background: #f8f9fa; padding: 20px; }
        .card-icon { font-size: 3rem; opacity: 0.3; position: absolute; right: 20px; top: 20px; }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Vehicle Admin</a>
            <div class="d-flex">
                 <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
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
            <div class="py-3 text-center border-bottom border-secondary">
                <h5>Admin Panel</h5>
            </div>
            <div class="nav flex-column mt-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-car"></i> Vehicles
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-check"></i> Rentals
                </a>
                 <a href="#" class="nav-link">
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

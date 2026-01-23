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
            }
            
            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--primary-color);
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow-x: hidden;
            }

            /* Background Elements */
            .bg-image {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0.2;
                mix-blend-mode: overlay;
                z-index: 0;
            }
            
            .auth-card {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                border: 1px solid rgba(255, 255, 255, 0.1);
                overflow: hidden;
                width: 100%;
                max-width: 450px;
                position: relative;
                z-index: 10;
                padding: 2.5rem;
            }

            .auth-logo {
                font-size: 2rem;
                font-weight: 800;
                color: var(--primary-color);
                text-decoration: none;
                margin-bottom: 2rem;
                display: block;
                text-align: center;
                letter-spacing: -1px;
            }

            .form-control {
                padding: 0.75rem 1rem;
                border: 2px solid #e2e8f0;
                border-radius: 8px;
                font-weight: 500;
                transition: all 0.3s;
            }

            .form-control:focus {
                border-color: var(--accent-color);
                box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.1);
            }

            .btn-primary-custom {
                background-color: var(--accent-color);
                color: white;
                border: none;
                padding: 0.8rem;
                font-weight: 700;
                border-radius: 8px;
                width: 100%;
                transition: all 0.3s;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .btn-primary-custom:hover {
                background-color: #b45309;
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.3);
                color: white;
            }

            .form-check-input:checked {
                background-color: var(--accent-color);
                border-color: var(--accent-color);
            }
            
            .text-link {
                color: var(--text-light);
                text-decoration: none;
                font-size: 0.9rem;
                transition: color 0.3s;
            }
            
            .text-link:hover {
                color: var(--accent-color);
            }
        </style>
    </head>
    <body>
        <img src="https://images.unsplash.com/photo-1493238792015-8098424706af?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Background" class="bg-image">
        
        <div class="auth-card">
            {{ $slot }}
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

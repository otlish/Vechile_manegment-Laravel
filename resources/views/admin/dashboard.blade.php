@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Admin Dashboard</h1>
            <p class="text-muted small">Welcome back, {{ Auth::user()->name }}</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Vehicles -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-start border-4 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small fw-bold mb-1">Total Vehicles</p>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalVehicles }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                             <i class="fas fa-car fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex align-items-center justify-content-between small">
                    <a class="text-primary fw-bold text-decoration-none" href="#">View Details</a>
                    <i class="fas fa-angle-right text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Available Vehicles -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-start border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small fw-bold mb-1">Available</p>
                            <h2 class="mb-0 fw-bold text-dark">{{ $availableVehicles }}</h2>
                        </div>
                         <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                             <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex align-items-center justify-content-between small">
                    <a class="text-success fw-bold text-decoration-none" href="#">View Fleet</a>
                    <i class="fas fa-angle-right text-success"></i>
                </div>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-start border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small fw-bold mb-1">On Rent</p>
                            <h2 class="mb-0 fw-bold text-dark">{{ $activeRentals }}</h2>
                        </div>
                         <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                             <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex align-items-center justify-content-between small">
                    <a class="text-warning fw-bold text-decoration-none" href="{{ route('admin.rentals') }}">View Rentals</a>
                    <i class="fas fa-angle-right text-warning"></i>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 border-start border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small fw-bold mb-1">Customers</p>
                            <h2 class="mb-0 fw-bold text-dark">{{ $totalCustomers }}</h2>
                        </div>
                         <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                             <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex align-items-center justify-content-between small">
                    <a class="text-info fw-bold text-decoration-none" href="{{ route('admin.customers') }}">View Users</a>
                    <i class="fas fa-angle-right text-info"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

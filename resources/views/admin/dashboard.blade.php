@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Vehicles -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Vehicles</h5>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <h2 class="mb-0">{{ $totalVehicles }}</h2>
                         <i class="fas fa-car card-icon text-white"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small border-0 bg-primary opacity-75">
                    <a class="text-white stretched-link text-decoration-none" href="#">View Details</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Available Vehicles -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Available Vehicles</h5>
                     <div class="d-flex align-items-center justify-content-between mt-3">
                        <h2 class="mb-0">{{ $availableVehicles }}</h2>
                         <i class="fas fa-check-circle card-icon text-white"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small border-0 bg-success opacity-75">
                    <a class="text-white stretched-link text-decoration-none" href="#">View Details</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Active Rentals</h5>
                     <div class="d-flex align-items-center justify-content-between mt-3">
                        <h2 class="mb-0">{{ $activeRentals }}</h2>
                         <i class="fas fa-clock card-icon text-dark"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small border-0 bg-warning opacity-75">
                    <a class="text-dark stretched-link text-decoration-none" href="#">View Details</a>
                    <div class="text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                     <div class="d-flex align-items-center justify-content-between mt-3">
                        <h2 class="mb-0">{{ $totalCustomers }}</h2>
                         <i class="fas fa-users card-icon text-white"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small border-0 bg-info opacity-75">
                    <a class="text-white stretched-link text-decoration-none" href="#">View Details</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

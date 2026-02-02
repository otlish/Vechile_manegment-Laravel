@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Add New Vehicle</h1>
            <p class="text-muted small">Expand your fleet</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
             <a href="{{ route('admin.vehicles.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Fleet
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Vehicle Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="e.g. Civic Type R">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Brand</label>
                                <input type="text" name="brand" class="form-control" required placeholder="e.g. Honda">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Model</label>
                                <input type="text" name="model" class="form-control" required placeholder="e.g. 2024 Sport">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Year</label>
                                <input type="number" name="year" class="form-control" required min="1900" max="2100" value="{{ date('Y') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Plate Number</label>
                                <input type="text" name="plate_number" class="form-control" required placeholder="e.g. ABC 1234">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Daily Rent Price (Rs.)</label>
                                <input type="number" name="daily_rent_price" class="form-control" required min="0" step="0.01" placeholder="0.00">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                                <select name="status" class="form-select">
                                    <option value="available">Available</option>
                                    <option value="rented">Rented</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Vehicle Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            
                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="fas fa-save me-1"></i> Save Vehicle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

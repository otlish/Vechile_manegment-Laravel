@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Edit Vehicle</h1>
            <p class="text-muted small">Update vehicle details</p>
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
                    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Vehicle Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ $vehicle->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Brand</label>
                                <input type="text" name="brand" class="form-control" required value="{{ $vehicle->brand }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Model</label>
                                <input type="text" name="model" class="form-control" required value="{{ old('model', $vehicle->model) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Year</label>
                                <input type="number" name="year" class="form-control" required min="1900" max="2100" value="{{ old('year', $vehicle->year) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Plate Number</label>
                                <input type="text" name="plate_number" class="form-control" required value="{{ $vehicle->plate_number }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Daily Rent Price (Rs.)</label>
                                <input type="number" name="daily_rent_price" class="form-control" required min="0" step="0.01" value="{{ $vehicle->daily_rent_price }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                                <select name="status" class="form-select">
                                    <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ $vehicle->status == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Update Image</label>
                                <input type="file" name="image" class="form-control">
                                @if($vehicle->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current:</small>
                                        <img src="{{ asset('storage/' . $vehicle->image) }}" class="d-block mt-1 rounded border" style="height: 50px;">
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="fas fa-save me-1"></i> Update Vehicle
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

@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Vehicle Fleet</h1>
            <p class="text-muted small">Manage your entire vehicle inventory</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
             <a href="{{ route('admin.vehicles.create') }}" class="btn btn-sm btn-primary-custom shadow-sm">
                <i class="fas fa-plus me-1"></i> Add Vehicle
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 text-uppercase text-muted small fw-bold">Vehicle</th>
                            <th class="text-uppercase text-muted small fw-bold">Plate Number</th>
                            <th class="text-uppercase text-muted small fw-bold">Daily Rate</th>
                            <th class="text-uppercase text-muted small fw-bold">Status</th>
                            <th class="text-uppercase text-muted small fw-bold text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicles as $vehicle)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-2 me-3 d-flex align-items-center justify-content-center border" style="width: 50px; height: 50px; overflow: hidden;">
                                        @if($vehicle->image)
                                            <img src="{{ asset('storage/' . $vehicle->image) }}" class="img-fluid" alt="Vehicle">
                                        @else
                                            <i class="fas fa-car text-muted opacity-50"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $vehicle->name }}</h6>
                                        <small class="text-muted">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace">{{ $vehicle->plate_number }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">${{ number_format($vehicle->daily_rent_price, 0) }}</span>
                            </td>
                            <td>
                                @if($vehicle->status === 'available')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill border border-success">Available</span>
                                @elseif($vehicle->status === 'rented')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill border border-warning">Rented</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill border border-secondary">{{ ucfirst($vehicle->status) }}</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure? This will delete the vehicle forever.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-car fa-3x opacity-25 mb-3"></i>
                                    <p class="mb-2">No vehicles found.</p>
                                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-sm btn-primary-custom">Add your first vehicle</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

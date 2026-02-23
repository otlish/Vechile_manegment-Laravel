@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Rental Management</h1>
            <p class="text-muted small">Manage booking requests and active rentals</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
             <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Pending Requests Section -->
    @if($pendingBookings->count() > 0)
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 fw-bold text-warning"><i class="fas fa-clock me-2"></i>Pending Requests</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                         <tr>
                            <th class="ps-4 text-uppercase text-muted small fw-bold">ID</th>
                            <th class="text-uppercase text-muted small fw-bold">Customer</th>
                            <th class="text-uppercase text-muted small fw-bold">Vehicle</th>
                            <th class="text-uppercase text-muted small fw-bold">Dates</th>
                             <th class="text-uppercase text-muted small fw-bold">Total Price</th>
                            <th class="text-uppercase text-muted small fw-bold text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingBookings as $booking)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">#{{ $booking->id }}</td>
                            <td>
                                <div>
                                    <div class="fw-bold text-dark">{{ $booking->user->name }}</div>
                                    <div class="small text-muted" style="font-size: 0.8rem;">{{ $booking->user->email }}</div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold text-primary-dark">{{ $booking->vehicle->name }}</div>
                                    <div class="small text-muted">{{ $booking->vehicle->plate_number }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2 py-1 bg-light rounded d-inline-block border">
                                    <div class="fw-bold text-dark small">{{ $booking->start_date->format('M d') }} - {{ $booking->end_date->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold" style="color: #006400;">Rs. {{ number_format($booking->total_price, 2) }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success text-white fw-bold shadow-sm" title="Approve">
                                            <i class="fas fa-check me-1"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this booking?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold shadow-sm" title="Reject">
                                            <i class="fas fa-times me-1"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Active Rentals Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 fw-bold text-success"><i class="fas fa-play-circle me-2"></i>Active Rentals</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                         <tr>
                            <th class="ps-4 text-uppercase text-muted small fw-bold">ID</th>
                            <th class="text-uppercase text-muted small fw-bold">Customer</th>
                            <th class="text-uppercase text-muted small fw-bold">Vehicle</th>
                            <th class="text-uppercase text-muted small fw-bold">Dates</th>
                             <th class="text-uppercase text-muted small fw-bold">Total Price</th>
                            <th class="text-uppercase text-muted small fw-bold">Status</th>
                            <th class="text-uppercase text-muted small fw-bold text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeRentals as $rental)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">#{{ $rental->id }}</td>
                            <td>
                                <div>
                                    <div class="fw-bold text-dark">{{ $rental->user->name }}</div>
                                    <div class="small text-muted" style="font-size: 0.8rem;">{{ $rental->user->email }}</div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold text-primary-dark">{{ $rental->vehicle->name }}</div>
                                    <div class="small text-muted">{{ $rental->vehicle->plate_number }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="px-2 py-1 bg-light rounded d-inline-block border">
                                    <div class="fw-bold text-dark small">{{ $rental->start_date->format('M d') }} - {{ $rental->end_date->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold" style="color: #006400;">Rs. {{ number_format($rental->total_price, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill border border-success">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.bookings.return', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this vehicle as returned?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary text-white fw-bold shadow-sm">
                                        <i class="fas fa-undo me-1"></i> Return
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-check fa-3x opacity-25 mb-3"></i>
                                    <p>No active rentals found.</p>
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

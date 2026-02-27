@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark mb-1">Rental Management</h1>
            <p class="text-muted small mb-0">Manage booking requests and active rentals</p>
        </div>

        <div>
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- ===================== PENDING REQUESTS ===================== --}}
    @if($pendingBookings->count())
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-warning">
                <i class="fas fa-clock me-2"></i> Pending Requests
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 text-uppercase small text-muted fw-bold">ID</th>
                        <th class="text-uppercase small text-muted fw-bold">Customer</th>
                        <th class="text-uppercase small text-muted fw-bold">Vehicle</th>
                        <th class="text-uppercase small text-muted fw-bold">Dates</th>
                        <th class="text-uppercase small text-muted fw-bold">Total Price</th>
                        <th class="text-uppercase small text-muted fw-bold text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pendingBookings as $booking)
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">
                            #{{ $booking->id }}
                        </td>

                        <td>
                            <div class="fw-bold">{{ $booking->user->name }}</div>
                            <div class="small text-muted">{{ $booking->user->email }}</div>
                        </td>

                        <td>
                            <div class="fw-bold text-primary-dark">
                                {{ $booking->vehicle->name }}
                            </div>
                            <div class="small text-muted">
                                {{ $booking->vehicle->plate_number }}
                            </div>
                        </td>

                        <td>
                            <div class="badge bg-light text-dark border px-3 py-2">
                                {{ $booking->start_date->format('M d') }}
                                –
                                {{ $booking->end_date->format('M d, Y') }}
                            </div>
                        </td>

                        <td class="fw-bold text-success">
                            Rs. {{ number_format($booking->total_price, 2) }}
                        </td>

                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">

                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-success fw-bold shadow-sm"
                                            onclick="return confirm('Approve this booking?')">
                                        <i class="fas fa-check me-1"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.reject', $booking->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to reject this booking?');">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger fw-bold shadow-sm">
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
    @endif


    {{-- ===================== ACTIVE RENTALS ===================== --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-success">
                <i class="fas fa-play-circle me-2"></i> Active Rentals
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 text-uppercase small text-muted fw-bold">ID</th>
                        <th class="text-uppercase small text-muted fw-bold">Customer</th>
                        <th class="text-uppercase small text-muted fw-bold">Vehicle</th>
                        <th class="text-uppercase small text-muted fw-bold">Dates</th>
                        <th class="text-uppercase small text-muted fw-bold">Total Price</th>
                        <th class="text-uppercase small text-muted fw-bold">Status</th>
                        <th class="text-uppercase small text-muted fw-bold text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($activeRentals as $rental)
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">
                            #{{ $rental->id }}
                        </td>

                        <td>
                            <div class="fw-bold">{{ $rental->user->name }}</div>
                            <div class="small text-muted">{{ $rental->user->email }}</div>
                        </td>

                        <td>
                            <div class="fw-bold text-primary-dark">
                                {{ $rental->vehicle->name }}
                            </div>
                            <div class="small text-muted">
                                {{ $rental->vehicle->plate_number }}
                            </div>
                        </td>

                        <td>
                            <div class="badge bg-light text-dark border px-3 py-2">
                                {{ $rental->start_date->format('M d') }}
                                –
                                {{ $rental->end_date->format('M d, Y') }}
                            </div>
                        </td>

                        <td>
    <span class="fw-bold" style="color: #006400;">
        Rs. {{ number_format($rental->total_price, 2) }}
    </span>
</td>

                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </td>

                        <td class="text-end pe-4">
                            <form action="{{ route('admin.bookings.return', $rental->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Mark this vehicle as returned?');">
                                @csrf
                                <button type="submit"
                                        class="btn btn-sm btn-primary fw-bold shadow-sm">
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
                                <p class="mb-0">No active rentals found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
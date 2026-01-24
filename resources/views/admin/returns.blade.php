@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Returned Rentals</h1>
            <p class="text-muted small">History of completed bookings</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returns as $rental)
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
                                    <div class="fw-bold text-dark small">{{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">${{ number_format($rental->total_price, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill border border-secondary">
                                    Completed
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-history fa-3x opacity-25 mb-3"></i>
                                    <p>No returned rentals found.</p>
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

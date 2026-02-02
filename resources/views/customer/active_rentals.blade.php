<x-app-layout>
    <div class="container py-4">
        <h2 class="fw-bold text-primary-dark mb-4">My Active Rentals</h2>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($activeRentals->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-car fa-3x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted fw-bold">No active rentals</h5>
                        <p class="text-muted small mb-4">You don't have any ongoing rentals at the moment.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary-custom">
                            Browse Vehicles
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Vehicle</th>
                                    <th>Dates</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeRentals as $rental)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded p-2 me-3 text-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-car text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $rental->vehicle->name ?? 'Unknown' }}</h6>
                                                <small class="text-muted">{{ $rental->vehicle->brand ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</div>
                                            <div class="text-muted">to {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">Rs. {{ number_format($rental->total_price, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light text-muted" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

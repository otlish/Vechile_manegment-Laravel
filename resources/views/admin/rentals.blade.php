@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Active Rentals</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Dates</th>
                             <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>
                                <div>{{ $rental->user->name }}</div>
                                <div class="small text-muted">{{ $rental->user->email }}</div>
                            </td>
                            <td>
                                <div>{{ $rental->vehicle->name }}</div>
                                <div class="small text-muted">{{ $rental->vehicle->plate_number }}</div>
                            </td>
                            <td>
                                <div>{{ $rental->start_date }}</div>
                                <div class="small text-muted">to {{ $rental->end_date }}</div>
                            </td>
                            <td>${{ number_format($rental->total_price, 2) }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ ucfirst($rental->status) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.bookings.return', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this vehicle as returned?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-undo me-1"></i> Return
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No active rentals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

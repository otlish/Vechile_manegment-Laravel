@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Bookings</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Vehicle</th>
                <th>User</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $booking->vehicle->name ?? 'N/A' }}</td>
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>₹ {{ number_format($booking->total_price, 2) }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ ucfirst($booking->status) }}</span>
                </td>
                <td>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">Edit</a>

                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">No bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

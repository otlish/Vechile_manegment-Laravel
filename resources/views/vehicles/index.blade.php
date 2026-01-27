@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Vehicles List</h2>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add New Vehicle</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Plate Number</th>
                <th>Daily Rent</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($vehicle->image)
                            <img src="{{ asset('storage/'.$vehicle->image) }}" alt="{{ $vehicle->name }}" width="80" class="img-thumbnail">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>₹ {{ number_format($vehicle->daily_rent_price, 2) }}</td>
                    <td>
                        @if($vehicle->status == 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($vehicle->status == 'rented')
                            <span class="badge bg-warning text-dark">Rented</span>
                        @else
                            <span class="badge bg-secondary">Maintenance</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No vehicles found. Add new vehicles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

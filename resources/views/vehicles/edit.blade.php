@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Vehicle</h2>

    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Vehicle Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $vehicle->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand', $vehicle->brand) }}" required>
        </div>

        <div class="mb-3">
            <label for="plate_number" class="form-label">Plate Number</label>
            <input type="text" class="form-control" name="plate_number" id="plate_number" value="{{ old('plate_number', $vehicle->plate_number) }}" required>
        </div>

        <div class="mb-3">
            <label for="daily_rent_price" class="form-label">Daily Rent Price</label>
            <input type="number" class="form-control" name="daily_rent_price" id="daily_rent_price" value="{{ old('daily_rent_price', $vehicle->daily_rent_price) }}" min="0" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status" required>
                <option value="available" {{ old('status', $vehicle->status)=='available'?'selected':'' }}>Available</option>
                <option value="rented" {{ old('status', $vehicle->status)=='rented'?'selected':'' }}>Rented</option>
                <option value="maintenance" {{ old('status', $vehicle->status)=='maintenance'?'selected':'' }}>Maintenance</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Vehicle Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            @if($vehicle->image)
                <img src="{{ asset('storage/'.$vehicle->image) }}" alt="{{ $vehicle->name }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
</div>
@endsection

<x-app-layout>


    <!-- Active Rentals Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Active Rentals</h5>
                </div>
                <div class="card-body p-0">
                    @if($activeRentals->isEmpty())
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <img src="{{ asset('images/logo_v2.png') }}" style="height: 80px; opacity: 0.5;" class="mb-3" alt="No Rentals">
                            </div>
                            <h5 class="text-muted fw-bold">No active rentals</h5>
                            <p class="text-muted small mb-4">You don't have any ongoing rentals at the moment.</p>
                            <a href="#available-cars" class="btn btn-outline-primary rounded-pill">
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
                                                <div class="bg-light rounded me-3 text-center overflow-hidden" style="width: 50px; height: 50px;">
                                                    @if($rental->vehicle->image)
                                                        <img src="{{ asset('storage/' . $rental->vehicle->image) }}" alt="{{ $rental->vehicle->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                    @else
                                                        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=100&q=80" alt="Car" style="width: 100%; height: 100%; object-fit: cover;">
                                                    @endif
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
                                            <span class="fw-bold" style="color: #006400;">Rs. {{ number_format($rental->total_price, 2) }}</span>
                                        </td>
                                        <td>
                                            @if($rental->status == 'active')
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                                    Active
                                                </span>
                                            @elseif($rental->status == 'pending')
                                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                                    {{ ucfirst($rental->status) }}
                                                </span>
                                            @endif
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
    <!-- Pending Reviews Section -->
    @if(isset($pendingReviews) && $pendingReviews->isNotEmpty())
    <style>
        .star-rating-custom {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating-custom input[type="radio"] {
            display: none;
        }
        .star-rating-custom label {
            font-size: 1.5rem;
            color: #dee2e6;
            cursor: pointer;
            margin-left: 0.2rem;
            transition: color 0.2s ease-in-out;
        }
        .star-rating-custom input[type="radio"]:checked ~ label,
        .star-rating-custom label:hover,
        .star-rating-custom label:hover ~ label {
            color: #ffc107;
        }
    </style>
    <div class="row mt-5">
        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary-dark">Pending Reviews</h4>
            <p class="text-muted">Please leave a review for your recently returned vehicles.</p>
        </div>
        
        <div class="col-md-12">
            <div class="row g-4">
                @foreach($pendingReviews as $booking)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded me-3 text-center overflow-hidden" style="width: 50px; height: 50px;">
                                    @if($booking->vehicle->image)
                                        <img src="{{ asset('storage/' . $booking->vehicle->image) }}" alt="{{ $booking->vehicle->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=100&q=80" alt="Car" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $booking->vehicle->name ?? 'Unknown' }}</h6>
                                    <small class="text-muted">Returned on {{ \Carbon\Carbon::parse($booking->updated_at)->format('M d, Y') }}</small>
                                </div>
                            </div>
                            
                            <form action="{{ route('reviews.store', $booking->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Rating</label>
                                    <div class="star-rating-custom">
                                        @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="rating" id="rating{{ $booking->id }}_{{ $i }}" value="{{ $i }}" required>
                                        <label for="rating{{ $booking->id }}_{{ $i }}" title="{{ $i }} stars">
                                            <i class="fas fa-star"></i>
                                        </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small text-muted" for="comment_{{ $booking->id }}">Comment (Optional)</label>
                                    <textarea class="form-control" name="comment" id="comment_{{ $booking->id }}" rows="2" placeholder="How was your experience?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 rounded-pill">Submit Review</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Available Vehicles Section -->
    <div class="row mt-5" id="available-cars">
        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary-dark">Available for Rent</h4>
            <p class="text-muted">Choose your next ride from our premium fleet.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        @if(isset($availableVehicles) && $availableVehicles->count() > 0)
            @foreach($availableVehicles as $vehicle)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    @php
                        // Reusing the image logic
                        $randomImage = 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                        if(stripos($vehicle->brand, 'Toyota') !== false) $randomImage = 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                        if(stripos($vehicle->brand, 'Honda') !== false) $randomImage = 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                        if(stripos($vehicle->brand, 'BMW') !== false) $randomImage = 'https://images.unsplash.com/photo-1555215695-3004980adade?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                        
                        $image = $vehicle->image ? asset('storage/' . $vehicle->image) : $randomImage;
                    @endphp
                    <img src="{{ $image }}" class="card-img-top" alt="{{ $vehicle->name }}" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-light text-dark border">{{ $vehicle->brand }}</span>
                            <div class="text-warning small" title="{{ number_format($vehicle->averageRating(), 1) }} Average Rating">
                                <i class="fas fa-star"></i>{{ number_format($vehicle->averageRating(), 1) }}
                            </div>
                        </div>
                        
                        <h5 class="card-title fw-bold text-primary-dark mb-3">{{ $vehicle->name }}</h5>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Daily Rate</small>
                                <span class="fw-bold fs-5" style="color: #006400;">Rs. {{ number_format($vehicle->daily_rent_price, 0) }}</span>
                            </div>
                            <a href="{{ route('bookings.create', $vehicle->id) }}" class="btn btn-primary-custom">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <p class="text-muted">No vehicles currently available.</p>
            </div>
        @endif
    </div>
</x-app-layout>

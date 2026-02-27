<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <!-- Vehicle Details Column -->
                <div class="col-md-5 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        @php
                             // Reusing the image logic for consistency
                             $randomImage = 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'Toyota') !== false) $randomImage = 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'Honda') !== false) $randomImage = 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             if(stripos($vehicle->brand, 'BMW') !== false) $randomImage = 'https://images.unsplash.com/photo-1555215695-3004980adade?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                             
                             $image = $vehicle->image ? asset('storage/' . $vehicle->image) : $randomImage;
                        @endphp
                        <img src="{{ $image }}" class="card-img-top" alt="{{ $vehicle->name }}" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h3 class="card-title fw-bold text-primary-dark mb-3">{{ $vehicle->brand }} {{ $vehicle->name }}</h3>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark border me-2">{{ $vehicle->year }}</span>
                                <span class="badge bg-light text-dark border">{{ $vehicle->model }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-tag text-muted me-2"></i>
                                <span class="fs-4 fw-bold text-success">Rs. {{ number_format($vehicle->daily_rent_price, 0) }}</span>
                                <span class="text-muted ms-1">/ day</span>
                            </div>
                            <p class="text-muted small">
                                <i class="fas fa-check-circle text-success me-1"></i> Well maintained
                                <br>
                                <i class="fas fa-check-circle text-success me-1"></i> Insurance included
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Booking Form Column -->
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Complete Your Booking</h5>
                        </div>
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('bookings.store', $vehicle->id) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label fw-bold">Pick-up Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" 
                                               min="{{ date('Y-m-d') }}" value="{{ old('start_date') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label fw-bold">Return Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" 
                                               min="{{ date('Y-m-d') }}" value="{{ old('end_date') }}" required>
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <div class="alert alert-info border-0 bg-light d-flex align-items-center">
                                            <i class="fas fa-info-circle text-info me-3 fs-4"></i>
                                            <div>
                                                <small class="text-muted d-block">Booking Policy</small>
                                                <span class="small">Your booking will be pending approval. Payment is collected upon pick-up.</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                                            Confirm Booking Request
                                        </button>
                                        <a href="{{ route('customer.browse') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Customer Reviews ({{ $vehicle->reviewCount() }})</h5>
                            <div class="text-warning fs-5">
                                @php $rating = round($vehicle->averageRating()); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="text-dark ms-2 fw-bold">{{ number_format($vehicle->averageRating(), 1) }} / 5</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if($hasCompletedBooking)
                                <!-- Review Submission Form -->
                                <div class="mb-5 bg-light p-4 rounded">
                                    <h6 class="fw-bold mb-3">Write a Review</h6>
                                    <form action="{{ route('reviews.store', $vehicle->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Rating</label>
                                            <select class="form-select" name="rating" required>
                                                <option value="5" selected>5 - Excellent</option>
                                                <option value="4">4 - Very Good</option>
                                                <option value="3">3 - Average</option>
                                                <option value="2">2 - Poor</option>
                                                <option value="1">1 - Terrible</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Comment (Optional)</label>
                                            <textarea class="form-control" name="comment" rows="3" placeholder="Share your experience..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary fw-bold">Submit Review</button>
                                    </form>
                                </div>
                            @endif

                            <!-- List Reviews -->
                            @forelse($vehicle->reviews as $review)
                                <div class="border-bottom pb-4 mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                        <div class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mb-2">{{ $review->created_at->format('M d, Y') }}</small>
                                    @if($review->comment)
                                        <p class="mb-0">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">
                                    <i class="far fa-comment-alt fs-1 mb-3 opacity-50"></i>
                                    <p>No reviews yet for this vehicle.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

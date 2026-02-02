<x-app-layout>
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold text-primary-dark">Browse Our Fleet</h2>
            <p class="text-muted">Choose from our premium collection of vehicles.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse($vehicles as $vehicle)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                @php
                     // Reusing the image logic from welcome page for consistency
                     $randomImage = 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                     if(stripos($vehicle->brand, 'Toyota') !== false) $randomImage = 'https://images.unsplash.com/photo-1592198084033-aade902d1aae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                     if(stripos($vehicle->brand, 'Honda') !== false) $randomImage = 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                     if(stripos($vehicle->brand, 'BMW') !== false) $randomImage = 'https://images.unsplash.com/photo-1555215695-3004980adade?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                     
                     $image = $vehicle->image ? asset('storage/' . $vehicle->image) : $randomImage;
                @endphp
                <img src="{{ $image }}" class="card-img-top" alt="{{ $vehicle->name }}" style="height: 220px; object-fit: cover;">
                
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light text-dark border">{{ $vehicle->brand }}</span>
                        <div class="text-warning small">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <h5 class="card-title fw-bold text-primary-dark mb-3">{{ $vehicle->name }}</h5>
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Daily Rate</small>
                            <span class="fw-bold text-primary fs-5">${{ number_format($vehicle->daily_rent_price, 0) }}</span>
                        </div>
                        <a href="#" class="btn btn-primary-custom" onclick="alert('The Booking System is being built by Purushotam. Ideally this would go to /book/{{ $vehicle->id }}')">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="fas fa-car fa-4x text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted">No vehicles available right now.</h4>
            <p class="text-muted">Please check back later.</p>
        </div>
        @endforelse
    </div>
</x-app-layout>

<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RentalHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_see_only_completed_rentals()
    {
        // 1. Setup Data
        $customer = User::factory()->create(['role' => 'customer']);
        
        $vehicle = Vehicle::create([
            'name' => 'History Car',
            'brand' => 'Honda',
            'plate_number' => 'HIST-001',
            'daily_rent_price' => 50,
            'status' => 'available',
            'image' => 'default.jpg'
        ]);

        $completedBooking = Booking::create([
            'user_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->subDays(10),
            'end_date' => now()->subDays(5),
            'total_price' => 250,
            'status' => 'completed',
        ]);

        $activeBooking = Booking::create([
            'user_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(2),
            'total_price' => 150,
            'status' => 'active',
        ]);

        // 2. Act
        $response = $this->actingAs($customer)
                         ->get(route('customer.history'));

        // 3. Assert
        $response->assertStatus(200);
        $response->assertViewHas('history');
        
        // Assert that the view collection contains the completed booking
        $response->assertViewHas('history', function ($bookings) use ($completedBooking, $activeBooking) {
            return $bookings->contains($completedBooking) && 
                   !$bookings->contains($activeBooking);
        });
    }
}

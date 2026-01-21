<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReturnLogicTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_return_vehicle()
    {
        // 1. Setup Data
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);
        
        $vehicle = Vehicle::create([
            'name' => 'Test Car',
            'brand' => 'Toyota',
            'plate_number' => 'TEST-123',
            'daily_rent_price' => 100,
            'status' => 'rented', // Initially rented
            'image' => 'default.jpg'
        ]);

        $booking = Booking::create([
            'user_id' => $customer->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => now()->subDays(2),
            'end_date' => now()->addDays(2),
            'total_price' => 400,
            'status' => 'active', // Initially active
        ]);

        // 2. Act
        $response = $this->actingAs($admin)
                         ->post(route('admin.bookings.return', $booking->id));

        // 3. Assert Response
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // 4. Assert Database Changes
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'completed',
        ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'status' => 'available',
        ]);
    }
}

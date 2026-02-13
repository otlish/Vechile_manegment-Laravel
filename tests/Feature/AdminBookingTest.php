<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;
class AdminBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_pending_bookings()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $user = User::factory()->create(['role' => 'customer']);
        $vehicle = Vehicle::factory()->create();

        $booking = Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDay(),
            'total_price' => 2000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.rentals'));

        $response->assertStatus(200);
        $response->assertSee($booking->vehicle->name);
        $response->assertSee('Pending Requests');
        $response->assertSee('Approve');
    }

    public function test_admin_can_approve_booking()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();
        
        $booking = Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDay(),
            'total_price' => 2000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.bookings.approve', $booking->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'active',
        ]);
    }

    public function test_admin_can_reject_booking()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();
        
        $booking = Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDay(),
            'total_price' => 2000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.bookings.reject', $booking->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }
}

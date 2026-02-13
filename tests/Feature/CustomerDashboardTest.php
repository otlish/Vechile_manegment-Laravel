<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class CustomerDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_sees_pending_and_active_bookings()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $vehicle1 = Vehicle::factory()->create(['name' => 'Pending Car']);
        $vehicle2 = Vehicle::factory()->create(['name' => 'Active Car']);

        Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle1->id,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDay(),
            'total_price' => 1000,
            'status' => 'pending',
        ]);

        Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle2->id,
            'start_date' => Carbon::today()->addDays(5),
            'end_date' => Carbon::today()->addDays(6),
            'total_price' => 1500,
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Pending Car'); // Check vehicle name
        $response->assertSee('Active Car');
        $response->assertSee('Pending'); // Check status text
        $response->assertSee('Active');
    }
}

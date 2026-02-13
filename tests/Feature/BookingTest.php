<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();

        $response = $this->actingAs($user)->get(route('bookings.create', $vehicle));

        $response->assertStatus(200);
    }

    public function test_user_can_book_vehicle()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['daily_rent_price' => 1000]);

        $startDate = Carbon::tomorrow();
        $endDate = Carbon::tomorrow()->addDays(2);

        $response = $this->actingAs($user)->post(route('bookings.store', $vehicle), [
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
        ]);

        $response->assertRedirect(route('dashboard'));
        
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'status' => 'pending',
        ]);

        $booking = Booking::where('user_id', $user->id)->where('vehicle_id', $vehicle->id)->first();
        
        $this->assertEquals($startDate->format('Y-m-d'), $booking->start_date->format('Y-m-d'));
        $this->assertEquals($endDate->format('Y-m-d'), $booking->end_date->format('Y-m-d'));
        $this->assertEquals(2000.00, $booking->total_price);
    }

    public function test_booking_dates_cannot_overlap()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();

        // existing booking
        Booking::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDays(5),
            'total_price' => 5000,
            'status' => 'active',
        ]);

        // Try to book overlapping dates
        $response = $this->actingAs($user)->post(route('bookings.store', $vehicle), [
            'start_date' => Carbon::tomorrow()->addDay(),
            'end_date' => Carbon::tomorrow()->addDays(2),
        ]);

        $response->assertSessionHasErrors('start_date');
    }

    public function test_end_date_must_be_after_start_date()
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();

        $response = $this->actingAs($user)->post(route('bookings.store', $vehicle), [
            'start_date' => Carbon::tomorrow()->toDateString(),
            'end_date' => Carbon::today()->toDateString(), // before start
        ]);

        $response->assertSessionHasErrors('end_date');
    }
}

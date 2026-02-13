<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new booking.
     */
    public function create(Vehicle $vehicle)
    {
        return view('bookings.create', compact('vehicle'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($vehicle->status !== 'available') {
            return back()->withErrors(['vehicle' => 'This vehicle is currently unavailable for rent.']);
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Check for overlapping bookings
        // We want to avoid any booking that starts before our end date AND ends after our start date
        // (A < end) and (B > start)
        $overlap = Booking::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['active', 'pending']) // Check against active and pending bookings
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_date' => 'This vehicle is already booked for the selected dates.'])->withInput();
        }

        // Calculate total price
        $days = $startDate->diffInDays($endDate) + 1; // Inclusive of start day? Usually rentals are per 24h or calendar day. Let's assume calendar days for simplicity.
        // If start 10th, end 11th. diff is 1. If daily price is for "days", then 10th to 11th is 1 day or 2? 
        // Hotel style: nights. Car rental: usually 24h blocks or days. 
        // Let's assume standard "days" where specific pickup/dropoff times aren't managed yet.
        // Let's stick to simple diff for now, or diff + 1 if we charge per calendar day.
        // A common simple fallback is diffInDays. 
        // If I rent Jan 1 to Jan 2, that's 1 day.
        $totalPrice = $difference = $startDate->diffInDays($endDate) * $vehicle->daily_rent_price;
        
        // Handle same-day return edge case (optional, but 'after:start_date' validation prevents it unless we change to after_or_equal)
        // If we allow 1 day rental (morning to evening), logic might need adjustment.
        // The validation says 'after:start_date', so strictly >. Min 1 day.

        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking request submitted successfully! waiting for approval.');
    }
}

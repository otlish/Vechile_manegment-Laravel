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
        $vehicle->load(['reviews.user']); // Load reviews with user data
        
        return view('bookings.create', compact('vehicle'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        \Illuminate\Support\Facades\Log::info('Booking initiated for vehicle: ' . $vehicle->id);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($vehicle->status !== 'available') {
            return back()->withErrors(['vehicle' => 'This vehicle is currently unavailable for rent.']);
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Check for overlapping bookings
        $overlap = Booking::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['active', 'pending'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
            })
            ->exists();

        if ($overlap) {
            \Illuminate\Support\Facades\Log::info('Booking overlap detected.');
            return back()->withErrors(['start_date' => 'This vehicle is already booked for the selected dates.'])->withInput();
        }

        // Calculate total price
        $days = (int) $startDate->diffInDays($endDate) + 1;
        $totalPrice = $days * $vehicle->daily_rent_price;
        
        \Illuminate\Support\Facades\Log::info('Creating booking record...');

        // Create Booking with pending payment
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        \Illuminate\Support\Facades\Log::info('Booking created: ' . $booking->id . '. initiating eSewa...');

        // eSewa Configuration
        $amount = $totalPrice;
        $transaction_uuid = $booking->id . '-' . time(); // Unique ID
        $product_code = env('ESEWA_MERCHANT_ID', 'EPAYTEST');
        $secret_key = env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');
        
        // Generate Signature
        // Message format: "total_amount={amount},transaction_uuid={uuid},product_code={code}"
        $message = "total_amount=$amount,transaction_uuid=$transaction_uuid,product_code=$product_code";
        $signature = base64_encode(hash_hmac('sha256', $message, $secret_key, true));

        return view('esewa_payment', [
            'url' => env('ESEWA_API_URL', 'https://rc-epay.esewa.com.np/api/epay/main/v2/form'),
            'amount' => $amount,
            'total_amount' => $amount,
            'transaction_uuid' => $transaction_uuid,
            'product_code' => $product_code,
            'success_url' => route('esewa.success'),
            'failure_url' => route('esewa.failure'),
            'signature' => $signature,
        ]);
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user owns the booking and it is completed
        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($booking->status !== 'completed') {
            return back()->with('error', 'You can only review vehicles you have rented and returned.');
        }

        // Check if user already reviewed this booking
        $existingReview = Review::where('booking_id', $booking->id)->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this booking.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $booking->vehicle_id,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}

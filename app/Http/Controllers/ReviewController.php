<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user has a completed booking for this vehicle
        $hasCompletedBooking = Booking::where('user_id', Auth::id())
            ->where('vehicle_id', $vehicle->id)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedBooking) {
            return back()->with('error', 'You can only review vehicles you have rented and returned.');
        }

        // Check if user already reviewed
        $existingReview = Review::where('user_id', Auth::id())
            ->where('vehicle_id', $vehicle->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this vehicle.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $activeRentals = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['active', 'pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        $availableVehicles = \App\Models\Vehicle::with('reviews')->where('status', 'available')->latest()->take(6)->get();

        $pendingReviews = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->doesntHave('review')
            ->latest()
            ->get();

        return view('dashboard', compact('activeRentals', 'availableVehicles', 'pendingReviews'));
    }

    public function history()
    {
        $history = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('history'));
    }

    public function browse()
    {
        $vehicles = \App\Models\Vehicle::with('reviews')->where('status', 'available')->latest()->get();
        return view('customer.browse', compact('vehicles'));
    }

    public function activeRentals()
    {
        $activeRentals = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->get();

        return view('customer.active_rentals', compact('activeRentals'));
    }
}

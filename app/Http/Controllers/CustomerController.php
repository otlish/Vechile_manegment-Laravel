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
            ->where('status', 'active')
            ->get();

        $availableVehicles = \App\Models\Vehicle::where('status', 'available')->latest()->take(6)->get();

        return view('dashboard', compact('activeRentals', 'availableVehicles'));
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
        $vehicles = \App\Models\Vehicle::where('status', 'available')->latest()->get();
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

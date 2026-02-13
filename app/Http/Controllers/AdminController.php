<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'available')->count();
        $activeRentals = Booking::where('status', 'active')->count();
        $totalCustomers = User::where('role', 'customer')->count();

        return view('admin.dashboard', compact('totalVehicles', 'availableVehicles', 'activeRentals', 'totalCustomers'));
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers', compact('customers'));
    }

    public function rentals()
    {
        $activeRentals = Booking::with(['user', 'vehicle'])
                          ->where('status', 'active')
                          ->get();
        
        $pendingBookings = Booking::with(['user', 'vehicle'])
                          ->where('status', 'pending')
                          ->get();

        return view('admin.rentals', compact('activeRentals', 'pendingBookings'));
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'active']);
        $booking->vehicle->update(['status' => 'rented']);
        
        return redirect()->back()->with('success', 'Booking approved and vehicle marked as rented.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Booking rejected.');
    }

    public function returns()
    {
        $returns = Booking::with(['user', 'vehicle'])
                          ->where('status', 'completed')
                          ->latest()
                          ->get();
        return view('admin.returns', compact('returns'));
    }

    public function returnVehicle($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->update(['status' => 'completed']);

        $vehicle = $booking->vehicle;
        $vehicle->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Vehicle returned successfully.');
    }
}

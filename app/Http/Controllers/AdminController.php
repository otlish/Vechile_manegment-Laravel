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

    public function returnVehicle($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->update(['status' => 'completed']);

        $vehicle = $booking->vehicle;
        $vehicle->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Vehicle returned successfully.');
    }
}

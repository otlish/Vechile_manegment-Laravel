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
}

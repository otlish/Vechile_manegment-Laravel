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

        return view('dashboard', compact('activeRentals'));
    }
}

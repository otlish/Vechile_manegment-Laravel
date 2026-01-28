<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use illuminate\support\Facades\Auth;
class BookingController extends Controller
{
    // List all bookings
    public function index()
    {
        $bookings = Booking::with(['vehicle', 'user'])->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

}

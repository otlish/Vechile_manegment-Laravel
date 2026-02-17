<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
    public function success(Request $request)
    {
        // eSewa returns data in Base64 encoded 'data' parameter
        $dataEncoded = $request->query('data');
        
        if (!$dataEncoded) {
             return redirect()->route('dashboard')->with('error', 'Invalid payment response.');
        }

        $data = json_decode(base64_decode($dataEncoded), true);

        // Required fields: transaction_code, status, total_amount, transaction_uuid
        if (!isset($data['status']) || $data['status'] !== 'COMPLETE') {
            return redirect()->route('dashboard')->with('error', 'Payment failed or cancelled.');
        }

        $bookingId = explode('-', $data['transaction_uuid'])[0];
        $amount = $data['total_amount'];
        $refId = $data['transaction_code'];

        $booking = Booking::find($bookingId);

        if (!$booking) {
             return redirect()->route('dashboard')->with('error', 'Booking not found.');
        }
        
        // Optional: Verify signature/amount again here if needed for higher security
        // Ideally, check if $booking->total_price == $amount

        $booking->update([
            'payment_status' => 'completed',
            'esewa_status' => $refId, // Storing reference ID
            'status' => 'pending' // Still waiting for admin approval
        ]);

        return redirect()->route('customer.active-rentals')->with('success', 'Payment successful! Your booking is pending admin approval.');
    }

    public function failure(Request $request)
    {
        return redirect()->route('dashboard')->with('error', 'Payment failed. Please try again.');
    }
}

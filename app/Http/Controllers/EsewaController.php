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
        
        // 1. Verify Amount
        if ($booking->total_price != str_replace(',', '', $amount)) {
            return redirect()->route('dashboard')->with('error', 'Payment amount mismatch. Possible tampering detected.');
        }

        // 2. Verify Signature
        $transaction_uuid = $data['transaction_uuid'];
        $product_code = env('ESEWA_MERCHANT_ID', 'EPAYTEST');
        $secret_key = env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');
        
        $message = "transaction_code=$refId,status=COMPLETE,total_amount=$amount,transaction_uuid=$transaction_uuid,product_code=$product_code,signed_field_names=transaction_code,status,total_amount,transaction_uuid,product_code,signed_field_names";
        
        // eSewa v2 signature format is slightly different for the response. 
        // Based on Esewa v2 docs, the signed fields from response usually return `transaction_code,status,total_amount,transaction_uuid,product_code,signed_field_names`
        // Wait, the message to hash in success response from eSewa v2: 
        // string to hash = transaction_code=...,status=COMPLETE,total_amount=...,transaction_uuid=...,product_code=...,signed_field_names=...
        // Let's implement this carefully. It's better to just hash the fields provided in `signed_field_names` from the response.
        
        if (isset($data['signature']) && isset($data['signed_field_names'])) {
            $signed_fields = explode(',', $data['signed_field_names']);
            $messageParts = [];
            foreach ($signed_fields as $field) {
                // Handle cases where the field might not be in the data (though it should be)
                $val = $data[$field] ?? '';
                $messageParts[] = "$field=$val";
            }
            $message = implode(',', $messageParts);
            $expectedSignature = base64_encode(hash_hmac('sha256', $message, $secret_key, true));

            if ($data['signature'] !== $expectedSignature) {
                return redirect()->route('dashboard')->with('error', 'Payment signature verification failed. Possible tampering detected.');
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Invalid payment response structure.');
        }

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

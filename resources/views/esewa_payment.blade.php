<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to eSewa...</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding-top: 50px; }
        .loader { border: 5px solid #f3f3f3; border-top: 5px solid #4CAF50; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <h3>Redirecting to eSewa...</h3>
    <div class="loader"></div>
    <p>Please wait while we redirect you to the payment gateway.</p>

    <form action="{{ $url }}" method="POST" id="esewaForm">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="tax_amount" value="0">
        <input type="hidden" name="total_amount" value="{{ $total_amount }}">
        <input type="hidden" name="transaction_uuid" value="{{ $transaction_uuid }}">
        <input type="hidden" name="product_code" value="{{ $product_code }}">
        <input type="hidden" name="product_service_charge" value="0">
        <input type="hidden" name="product_delivery_charge" value="0">
        <input type="hidden" name="success_url" value="{{ $success_url }}">
        <input type="hidden" name="failure_url" value="{{ $failure_url }}">
        <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
        <input type="hidden" name="signature" value="{{ $signature }}">
        
        <button type="submit" style="display:none;">Pay with eSewa</button>
    </form>

    <script>
        document.getElementById('esewaForm').submit();
    </script>
</body>
</html>

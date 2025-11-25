<!DOCTYPE html>
<html>
<head>
    <title>Recharge Wallet</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .loader { text-align: center; padding: 50px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Complete Wallet Recharge</h4>
        </div>
        <div class="card-body text-center">
            <h5>Amount: ₹{{ $request->amount }}</h5>
            <p>Please complete the payment to add money to your wallet.</p>
            <button id="rzp-button" class="btn btn-success btn-lg">Pay ₹{{ $request->amount }}</button>
        </div>
    </div>
</div>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $razorpayOrder->amount }}",
    "currency": "INR",
    "name": "Wallet Recharge",
    "description": "Add money to wallet",
    "order_id": "{{ $razorpayOrder->id }}",
    "handler": function (response){
        // On success → send to callback route
        fetch("{{ route('wallet.razorpay.callback') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_order_id: response.razorpay_order_id,
                razorpay_signature: response.razorpay_signature,
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 200) {
                alert("Payment successful! Wallet updated.");
                window.location.href = "{{ url()->previous() }}"; // go back
            } else {
                alert("Payment failed: " + data.message);
            }
        })
        .catch(err => {
            alert("Something went wrong!");
        });
    },
    "prefill": {
        "name": "{{ $user->name }}",
        "email": "{{ $user->email }}",
        "contact": "{{ $user->number }}"
    },
    "theme": {
        "color": "#28a745"
    }
};

var rzp = new Razorpay(options);
document.getElementById('rzp-button').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
</body>
</html>
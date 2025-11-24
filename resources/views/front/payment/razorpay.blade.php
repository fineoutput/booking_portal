<!DOCTYPE html>
<html>
<head>
    <title>Processing Payment...</title>
</head>
<body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $amount * 100 }}",
    "currency": "INR",
    "name": "Agent Registration",
    "description": "Registration Fee",
    "order_id": "{{ $order_id }}",

    "handler": function (response){
        // Send Success Data to Laravel
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('razorpay.callback') }}";

        form.innerHTML = `
            @csrf
            <input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">
            <input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">
            <input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">
        `;

        document.body.appendChild(form);
        form.submit();
    },
    
    "prefill": {
        "name": "{{ $name }}",
        "email": "{{ $email }}",
        "contact": "{{ $number }}"
    },

    "theme": {
        "color": "#528FF0"
    }
};

var rzp = new Razorpay(options);

// Payment Failure
rzp.on("payment.failed", function(){
    window.location.href = "/?payment=failed";
});

// Auto Open Popup
rzp.open();
</script>
</body>
</html>

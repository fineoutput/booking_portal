@extends('front.common.app')
@section('title','home')
@section('content')

<section class="confirss_sect">
    <div class="container">
        <h2 class="text-center mb-4">Booking Summary</h2>
        <form id="downloadForm" class="needs-validation" novalidate>
            
            <div class="mb-3">
                <label for="fetchedPrice" class="form-label">Price Fetched from System</label>
                <input type="text" id="fetchedPrice" class="form-control" value="₹ 25,000" readonly>
            </div>

            
            <div class="mb-3">
                <label for="agentMargin" class="form-label">Add Agent Margin (₹)</label>
                <input type="number" id="agentMargin" class="form-control" placeholder="Enter margin amount" required>
            </div>

            
            <div class="mb-3">
                <label for="finalPrice" class="form-label">Final Price</label>
                <input type="text" id="finalPrice" class="form-control" value="₹ 25,000" readonly>
            </div>

            
            <div class="mb-3">
                <label for="salesmanName" class="form-label">Salesman Name</label>
                <input type="text" id="salesmanName" class="form-control" placeholder="Enter salesman name" required>
            </div>

           
            <div class="mb-3">
                <label for="salesmanMobile" class="form-label">Salesman Mobile No.</label>
                <input type="text" id="salesmanMobile" class="form-control" placeholder="Enter mobile no." required>
            </div>

            <button class="btn btn-primary w-100 mt-3">
            Confirm Booking
            </button>
            <button type="button" class="btn btn-primary w-50 mt-3" onclick="downloadDetails()">Download PDF</button>
        </form>
    </div>
</section>
<!-- <script>
    function downloadDetails() {
        const salesmanName = document.getElementById("salesmanName").value;
        const salesmanMobile = document.getElementById("salesmanMobile").value;
        const agentMargin = document.getElementById("agentMargin").value;
        const fetchedPrice = document.getElementById("fetchedPrice").value;
        const finalPrice = document.getElementById("finalPrice").value;

        // Perform validation or actions for downloading details
        alert(
            `Salesman Name: ${salesmanName}\nSalesman Mobile: ${salesmanMobile}\nAgent Margin: ₹${agentMargin}\nFetched Price: ${fetchedPrice}\nFinal Price: ${finalPrice}`
        );

        // Example of further implementation
        // Generate a PDF or trigger a download as needed.
    }
</script> -->
@endsection
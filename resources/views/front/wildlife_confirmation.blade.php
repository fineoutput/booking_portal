@extends('front.common.app')
@section('title','home')
@section('content')

<section class="confirss_sect">
    <div class="container">
        <h2 class="text-center mb-4">Booking Summary</h2>

        <form method="POST" action="{{ route('add_confirm_wildlife_booking', ['id' => $packagebookingtemp->id]) }}" id="downloadForm" class="needs-validation" novalidate>
            @csrf
        
            <div class="mb-3">
                <label for="fetchedPrice" class="form-label">Price Fetched from System</label>
                <input type="text" name="fetched_price" id="fetchedPrice" class="form-control"
                 value="{{$packagebookingtemp->cost ?? '0'}}" readonly>
            </div>

            @if($packagebookingtemp->jeep_count !== null && $packagebookingtemp->jeep_count > 0)
            <div class="mb-3">
                <label for="fetchedPrice" class="form-label">Jeep Count</label>
                <input type="text" name="fetched_price" id="fetchedPrice" class="form-control"
                 value="{{$packagebookingtemp->jeep_count ?? '0'}}" readonly>
            </div>
            @endif
        
            <div class="mb-3">
                <label for="agentMargin" class="form-label">Add Agent Margin (₹)</label>
                <input type="number" name="agent_margin" id="agentMargin" class="form-control" placeholder="Enter margin amount" required>
            </div>
        
            <div class="mb-3">
                <label for="finalPrice" class="form-label">Final Price</label>
                <input type="text" name="final_price" id="finalPrice" class="form-control"
                 value="" readonly>
            </div>
        
            <div class="mb-3">
                <label for="salesmanName" class="form-label">Salesman Name</label>
                <input type="text" id="salesmanName" name="salesman_name" class="form-control" placeholder="Enter salesman name" required>
            </div>
        
            <div class="mb-3">
                <label for="salesmanMobile" class="form-label">Salesman Mobile No.</label>
                <input type="number" id="salesmanMobile" name="salesman_mobile" class="form-control" placeholder="Enter mobile no." required>
            </div>
        
            <button type="submit" class="btn btn-primary w-100 mt-3">Confirm Booking</button>

        </form>


    </div>
</section>

<script>
    // Initialize values
    const fetchedPriceInput = document.getElementById('fetchedPrice');
    const agentMarginInput = document.getElementById('agentMargin');
    const finalPriceInput = document.getElementById('finalPrice');

    // Function to update the final price
    function updateFinalPrice() {
        const fetchedPrice = parseFloat(fetchedPriceInput.value.replace('₹', '').trim()) || 0;
        const agentMargin = parseFloat(agentMarginInput.value) || 0;
        const finalPrice = fetchedPrice + agentMargin;
        finalPriceInput.value = `${finalPrice.toFixed(2)}`;
    }

    // Add event listener to the agent margin input field
    agentMarginInput.addEventListener('input', updateFinalPrice);

    // Run the update when the page loads to initialize the value
    updateFinalPrice();
</script>


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
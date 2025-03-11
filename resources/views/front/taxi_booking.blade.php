@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .modal-header {
    background-color: #007bff;
    color: white;
  }

  .list-group-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
  }
</style>
<!-- /* //////////////Banner Starts///////////// */ -->
<picture>
  <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <img src="{{ asset('frontend/images/banner/car.png') }}" alt="Responsive Banner">
</picture>

<!-- /* //////////////Banner Ends///////////// */ -->



<!-- /* //////////////form starts///////////// */ -->
<div class="container py-5">
  <h1 class="text-center mb-4">Taxi Booking
  </h1>

  <!-- Tabs for booking types -->
  <ul class="nav nav-tabs mb-4 flex-nowrap " id="bookingTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" style=" color: #000; " id="airport-tab" data-bs-toggle="tab" data-bs-target="#airport" type="button" role="tab" aria-controls="airport" aria-selected="true">Airport/Railway Station</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="local-tab" style=" color: #000; " data-bs-toggle="tab" data-bs-target="#local" type="button" role="tab" aria-controls="local" aria-selected="false">Local Tour</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="outstation-tab" style=" color: #000; " data-bs-toggle="tab" data-bs-target="#outstation" type="button" role="tab" aria-controls="outstation" aria-selected="false">Outstation</button>
    </li>
  </ul>

  <!-- Tab content -->
  <div class="tab-content" id="bookingTabsContent">
    <!-- Airport/Railway Station -->

    <div class="tab-pane fade show active" id="airport" role="tabpanel" aria-labelledby="airport-tab">

      <form action="{{ route('book_airport_railway') }}" method="POST">
        @csrf
    
        <div class="mb-3">
          <div class="omh_air_rail">
            <div class="lo_ka">

              <div class="act_trans">
                <img style="width: 20px;" src="{{asset('frontend/images/destination.png')}}" alt="">
                <label for="trip-type" class="form-label whtts">Select Trip</label>
              </div>

              <select name="trip" class="form-select" id="trip-type" style="width: 50%; text-align: center;" onchange="updateInputs()" required>
                <option disabled selected>Select</option>
                <option value="pickup">Pickup from Airport/Railway station</option>
                <option value="drop">Drop to Airport/Railway station</option>
              </select>
            </div>
          </div>
        </div>

        <div>
          <div class="row">

            <div class="col-lg-6">
              <div class="mb-3 loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                  <label for="pickup-airport" class="form-label">Select City</label>
                </div>
                <select name="city_id" class="form-select no-form-select" id="city-dropdown" onchange="fetchAirports()">
                  <option value="">Select a City</option>
                  @foreach($admincity as $value)
                      <option value="{{$value->id ?? ''}}">{{$value->city_name ?? ''}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="mb-3 loc_stl">
                <div class="select_sect" id="pickup-inputs">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                  <label for="pickup-airport" class="form-label">Pickup from</label>
                </div>
                <select name="airport_id" class="form-select no-form-select" id="pickup-airport" onchange="updateVehicles()">
                  <option value="">Select an Airport</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <div class="select_sect" id="drop-inputs">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                  <label for="drop-address" class="form-label no-form">Drop off Address</label>
                </div>
                <input type="text" name="drop_pickup_address" class="form-control no-form" id="drop-address" placeholder="Enter drop address">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3 loc_stl">
            <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" 
                  style="width: 20px;">
                  <label for="vehicle2" class="form-label">Select Vehicle</label>
                </div>

                <select name="vehicle_id" class="form-select no-form-select" id="vehicle-select" onchange="updateEstimatedCost()">
                  <option value="">Select a Vehicle</option>
                  <!-- Options will be populated dynamically based on the selected airport -->
              </select>
                
              {{-- <input name="vehicle_id" type="text" id="car-input1" class="form-control car-input no-form" placeholder="Select a vehicle" readonly data-bs-toggle="modal" data-bs-target="#carmodal1"> --}}


            </div>
          </div>


          <div class="col-lg-6">
            <div class="mb-3">
              <div class="start_time">
              <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
              <label for="datetime" class="form-label">Choose Pickup Date</label>
                <input name="pickup_date" style="width: 30%;" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <div class="start_time">
              <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
              <label for="datetime" class="form-label">Choose Pickup Time</label>
                <input name="pickup_time" style="width: 30%;" type="time" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3 col-lg-12">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Estimated Cost</label>
              <div class="final_amy_see">
                <input type="text" name="cost" class="form-control no-form" id="local-cost" placeholder="Calculated automatically" readonly>
                <div class="site_price">
                  {{-- <span>2 days</span>
                  <span>₹300/km</span> --}}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3 col-lg-12">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Description</label>
              <div class="final_amy_see">
               <textarea name="" id="price-description" cols="30" rows="10" readonly></textarea>
                <div class="site_price">
                  {{-- <span>2 days</span>
                  <span>₹300/km</span> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
    
        
        @if(Auth::guard('agent')->check())
        <button type="submit" class="btn btn-primary">Send Request to Admin</button>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
        @endif

      </form>


    </div>

    <!-- Local Tour -->
    <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local-tab">

      <form action="{{route('book_local_tour')}}" method="POST">
        @csrf
        <div class="row">

         

          <div class="col-lg-3">
            <div class="mb-3 loc_stl">
              <div class="select_sect">
                <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                <label for="pickup-airport" class="form-label">Select City</label>
              </div>
              <select name="city_id" class="form-select no-form-select" id="city-dropdown-2" onchange="fetchvehicle()">
                <option value="">Select a City</option>
                @foreach($admincity as $value)
                  <option value="{{$value->id ?? ''}}">{{$value->city_name ?? ''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="mb-3">
              <div class="loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt=""
                   style="width: 20px;">
                  <label for="local-location" class="form-label">Select Location</label>
                </div>
                <input type="text" name="location" class="form-control no-form" id="local-location" placeholder="Enter location" required>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3">
            <div class="select_sect">
              <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
              <label for="vehicle2" class="form-label">Select Vehicle</label>
            </div>
            <select name="vehicle_id" class="form-select no-form-select" id="vehicle-selects" onchange="updateEstimatedCosts()" required>
              <option value="">Select a Vehicle</option>
            </select>
          </div>


          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Pickup Date </label>
                <input style="width: 100%;" name="pickup_date" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Pickup Time</label>
                <input style="width: 100%;" name="pickup_time" type="time" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl" style="border: none;">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Drop Date</label>
                <input style="width: 100%;" name="drop_date" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl" style="border: none;">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Drop Time</label>
                <input style="width: 100%;" name="drop_time" type="time" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
              </div>
            </div>
          </div>

        </div>


        <div class="mb-3 mt-3">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Estimated Cost</label>
              <div class="final_amy_see">
                <input type="text" name="cost" class="form-control no-form" id="local-costs" placeholder="Calculated automatically" readonly>
                <div class="site_price">
                  {{-- <span>2 days</span>
                  <span>₹300/km</span> --}}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3 mt-3">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Description</label>
              <div class="final_amy_see">
                <textarea name="" id="local-description" cols="30" rows="10" readonly></textarea>
              </div>
            </div>
          </div>
        </div>

        @if(Auth::guard('agent')->check())
        <button type="submit" class="btn btn-primary">Send Request to Admin</button>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
        @endif

      </form>


    </div>

    <!-- Outstation Booking -->
    <div class="tab-pane fade" id="outstation" role="tabpanel" aria-labelledby="outstation-tab">

      <form action="{{route('outstationbooked')}}" method="POST">
        @csrf
        <div class="mb-3">
        <div class="omh_air_rail">
            <div class="lo_ka">
              <div class="act_trans">
                <img style="width: 20px;" src="{{asset('frontend/images/destination.png')}}" alt="">
                <label for="trip-type" class="form-label whtts">Select Trip</label>
              </div>
          <label for="type" class="form-label">Trip Type</label>
          <select name="trip_type" class="form-select mormal" id="type" onchange="updateTypes()">
            <option disabled>Select type</option>
            <option value="one-way">One-Way</option>
            <option value="round-trip">Round Trip</option>
          </select>
          </div>
          </div>
        </div>

        <!-- One-Way Specific Inputs -->
        <div id="one-way-inputs" style="display: block;">
          <div class="row">

            <div class="col-lg-4">
              <div class="mb-3 loc_stl">
                  <div class="select_sect">
                      <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                      <label for="pickup-airport" class="form-label">Destination City</label>
                  </div>
                  <select name="destination_city" class="form-select no-form-select" id="destination-city" onchange="updateVehicleList()">
                      <option value="">Destination City</option>
                      @foreach($route as $value)
                          <option value="{{ $value->id ?? '' }}">
                              {{ $value->from_destination ?? ''}} - {{ $value->to_destination ?? '' }}
                          </option>
                      @endforeach
                  </select>
              </div>
          </div>
          
          <div class="col-lg-4">
              <div class="mb-3 loc_stl">
                  <div class="select_sect">
                      <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
                      <label for="vehicle3" class="form-label">Select Vehicle</label>
                  </div>
                  <select name="vehicle_id" class="form-select no-form-select" id="vehicle-selectss" onchange="updateEstimatedCostss()">
                      <option value="">Select a Vehicle</option>
                      <!-- Vehicle options will be dynamically populated based on the destination city -->
                  </select>
              </div>
          </div>
          
        
        <div class="col-lg-4">
          <div class="mb-3">
             <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt=""style="width: 20px;">
                  <label for="pickup-time" class="form-label">Pickup Date</label>
              </div>
            <input name="pickup_date" style="width: 50%;" type="date" class="form-control no-form" id="return-date">
          </div>
        </div>

        </div>

        <div class="row">
          <div class="col-lg-12">

            <div class="mb-3 mt-3">
              <div class="subbs">
                <div class="insidee">
                  <label for="local-cost" class="form-label">Estimated Cost</label>
                  <div class="final_amy_see">
                    <input type="text" name="cost" class="form-control no-form" id="local-costss" placeholder="Calculated automatically" readonly>
                    <div class="site_price">
                      <span>2 days</span>
                      <span>₹300/km</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

          </div>
        </div>
        </div>
        <!-- Round-Trip Specific Inputs -->
        <div id="round-trip-inputs" style="display: none;">
  <div class="row">
    <!-- Departure Location -->
    <div class="col-lg-4">
      <div class="mb-3 loc_stl">
        <div class="select_sect">
          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
          <label for="departure-location-round" class="form-label">Departure Location</label>
        </div>
        <input name="departure_location" type="text" class="form-control no-form" placeholder="Enter departure location">
      </div>
    </div>

    <!-- Destination Location -->
    <div class="col-lg-4">
      <div class="mb-3 loc_stl">
        <div class="select_sect">
          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
          <label for="destination-location-round" class="form-label">Destination Location</label>
        </div>
        <input name="destination_location" type="text" class="form-control modal-trigger no-form"
         placeholder="Enter destination location">
      </div>
    </div>

    <!-- Pickup Date -->
    <div class="col-lg-4">
      <div class="mb-3">
        <div class="select_sect">
          <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="" style="width: 20px;">
          <label for="pickup-date" class="form-label">Pickup Date</label>
        </div>
        <input name="pickup_date_1" type="date" class="form-control no-form" id="pickup-date" style="width: 50%;">
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Return Date -->
    <div class="col-lg-4">
      <div class="mb-3 loc_stl">
        <div class="select_sect">
          <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="" style="width: 20px;">
          <label for="return-date" class="form-label">Return Date</label>
        </div>
        <input name="drop_date" type="date" class="form-control no-form" id="return-date" 
        style="width: 50%;">
      </div>
    </div>

    <!-- Select Vehicle -->
    <div class="col-lg-4">
      <div class="mb-3 loc_stl">
        <div class="select_sect">
          <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
          <label for="vehicle-round" class="form-label">Select Vehicle</label>
        </div>
        <select name="vehicle_id_1" class="form-select no-form-select" id="car-input-round">
          <option value="">Select a Vehicle</option>
          @foreach($vehicle as $value)
            <option value="{{ $value->id ?? '' }}">
              {{ $value->vehicle_type ?? '' }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<!-- City Modal for Round Trip -->
<div class="modal fade" id="cityModalRound" tabindex="-1" aria-labelledby="cityModalRoundLabel" aria-hidden="true">
  <!-- Modal content similar to City Modal in One Way Module -->
</div>

      @if(Auth::guard('agent')->check())
      <button type="submit" class="btn btn-primary">Send Request to Admin</button>
      @else
      <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
      @endif

      </form>


    </div>
  </div>
</div>

<!-- /* //////////////form ends///////////// */ -->

<script>
  function fetchvehicle() {
    const cityId = document.getElementById('city-dropdown-2').value;
    
    if (cityId) {
        fetch(`/booking_portal/public/get-vehicle/${cityId}`)
            .then(response => response.json())
            .then(data => {
                const vehicleSelect = document.getElementById('vehicle-selects');
                vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>'; 

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.vehicle_type;
                    option.dataset.price = item.price ?? '';
                    option.dataset.description = item.description ?? '';
                    vehicleSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching vehicles:', error);
            });
    }
  }


  function updateEstimatedCosts() {
    const vehicleSelect = document.getElementById('vehicle-selects');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

    const vehicleId = selectedOption.value;

    if (vehicleId) {
        const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
        let vehicleDescription = selectedOption.getAttribute('data-description'); // Get the description from data-description

        // Remove HTML tags from the description
        vehicleDescription = removeHtmlTags(vehicleDescription);

        console.log("Price: ₹" + pricePerKm);
        console.log("Description: " + vehicleDescription);  // Log the description for debugging

        // Set price in the local-costs field
        if (!isNaN(pricePerKm)) {
            document.getElementById('local-costs').value = "₹" + pricePerKm.toFixed(2);
        } else {
            document.getElementById('local-costs').value = "Invalid price"; 
        }

        // Set the description in the local-description field
        if (vehicleDescription && vehicleDescription !== "") {
            document.getElementById('local-description').value = vehicleDescription;
        } else {
            document.getElementById('local-description').value = "No description available"; // Handle empty description
        }
    } else {
        // Reset if no vehicle is selected
        document.getElementById('local-costs').value = "Calculated automatically";
        document.getElementById('local-description').value = ""; // Clear description if no vehicle is selected
    }
}



</script>

<!-- /* //////////////Cards Starts///////////// */ -->




<script>

function fetchAirports() {
    const cityId = document.getElementById('city-dropdown').value;
    
    if (cityId) {
        // Make a request to the backend to fetch airports for the selected city
        fetch(`/booking_portal/public/get-airports/${cityId}`)
            .then(response => response.json())
            .then(data => {
                const airportSelect = document.getElementById('pickup-airport');
                airportSelect.innerHTML = '<option value="">Select an Airport</option>'; // Clear previous options
                // Populate the airport options dynamically
                data.airports.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.airport;  // or whatever property represents the airport name
                    airportSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching airports:', error);
            });
    }
}


function updateVehicles() {
    var airportId = document.getElementById("pickup-airport").value;

    // Clear previous vehicle options
    var vehicleSelect = document.getElementById("vehicle-select");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    // Check if airport is selected
    if (airportId) {
        // Send AJAX request to get vehicles for the selected airport
        fetch(`/booking_portal/public/get-vehicles-by-airport?airport_id=${airportId}`)
            .then(response => response.json())
            .then(data => {
                // Populate vehicle options
                data.forEach(vehicle => {
                    var option = document.createElement("option");
                    option.value = vehicle.id;
                    option.text = vehicle.vehicle_type;

                    // Set the price and description in data attributes
                    option.setAttribute("data-price", vehicle.price);
                    option.setAttribute("data-description", vehicle.description);
                    
                    // Append the option to the select element
                    vehicleSelect.appendChild(option);
                });

                // Optionally, if the first option should be selected and its price displayed:
                if (data.length > 0) {
                    displayVehiclePrice(data[0].price);  // Display the price of the first vehicle (if any)
                    // Set the description of the first vehicle in the textarea
                    document.getElementById("price-description").value = removeHtmlTags(data[0].description);
                }
            })
            .catch(error => console.error('Error fetching vehicle data:', error));
    }
}

// Add event listener for vehicle selection
document.getElementById("vehicle-select").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var description = selectedOption.getAttribute("data-description");

    // Remove HTML tags and set the description in the textarea
    document.getElementById("price-description").value = removeHtmlTags(description);
});

// Function to remove HTML tags from a string
function removeHtmlTags(str) {
    var doc = new DOMParser().parseFromString(str, 'text/html');
    return doc.body.textContent || "";
}


// function updateVehicles() {
//     var airportId = document.getElementById("pickup-airport").value;

//     // Clear previous vehicle options
//     var vehicleSelect = document.getElementById("vehicle-select");
//     vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

//     // Check if airport is selected
//     if (airportId) {
//         // Send AJAX request to get vehicles for the selected airport
//         fetch(`/get-vehicles-by-airport?airport_id=${airportId}`)
//             .then(response => response.json())
//             .then(data => {
//                 // Populate vehicle options
//                 data.forEach(vehicle => {
//                     var option = document.createElement("option");
//                     option.value = vehicle.id;
//                     option.text = vehicle.vehicle_type;

//                     // Set the price in the data-price attribute
//                     option.setAttribute("data-price", vehicle.price);
//                     option.setAttribute("price-description", vehicle.description);
//                     // console.log(vehicle.price,'akshduhgsauih');
                    
//                     // Append the option to the select element
//                     vehicleSelect.appendChild(option);
//                 });

//                 // Optionally, if the first option should be selected and its price displayed:
//                 if (data.length > 0) {
//                     displayVehiclePrice(data[0].price);  // Display the price of the first vehicle (if any)
//                 }
//             })
//             .catch(error => console.error('Error fetching vehicle data:', error));
//     }
// }

// Function to display the price of the selected vehicle
function displayVehiclePrice() {
    var vehicleSelect = document.getElementById("vehicle-select");
    var selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

    // Get the price from the data-price attribute
    var price = selectedOption.getAttribute("data-price");

    // Get the input field where the price should be displayed
    var costInputField = document.getElementById("local-cost");

    if (price) {
        // Set the price as the value of the input field
        costInputField.value = `₹${price}`; // Assuming the price is in INR, adjust accordingly
    } else {
        costInputField.value = 'Price not available';  // Display message if no price is available
    }
}


// Event listener for when the vehicle is selected
document.getElementById("vehicle-select").addEventListener("change", displayVehiclePrice)

</script>



<script>

// function updateVehicles() {
//     var airportId = document.getElementById("pickup-airport").value;

//     // Clear previous vehicle options
//     var vehicleSelect = document.getElementById("vehicle-select");
//     vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

//     // Check if airport is selected
//     if (airportId) {
//         // Send AJAX request to get vehicles for the selected airport
//         fetch(`/get-vehicles-by-airport?airport_id=${airportId}`)
//             .then(response => response.json())
//             .then(data => {
//                 // Populate vehicle options
//                 data.forEach(vehicle => {
//                     var option = document.createElement("option");
//                     option.value = vehicle.id;
//                     option.text = vehicle.vehicle_type;

//                     // Set the price in the data-price attribute
//                     option.setAttribute("data-price", vehicle.price); // Now we're getting the price from the AJAX response

//                     // Append the option to the select element
//                     vehicleSelect.appendChild(option);
//                 });
//             })
//             .catch(error => console.error('Error fetching vehicle data:', error));
//     }
// }

function updateVehicless() {
    var airportId = document.getElementById("drop-airport").value;

    // Clear previous vehicle options
    var vehicleSelect = document.getElementById("vehicle-select");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    // Check if airport is selected
    if (airportId) {
        // Send AJAX request to get vehicles for the selected airport
        fetch(`/booking_portal/public/get-vehicles-by-airport?airport_id=${airportId}`)
            .then(response => response.json())
            .then(data => {
                // Populate vehicle options
                data.forEach(vehicle => {
                    var option = document.createElement("option");
                    option.value = vehicle.id;
                    option.text = vehicle.vehicle_type;

                    // Set the price in the data-price attribute
                    option.setAttribute("data-price", vehicle.price); // Now we're getting the price from the AJAX response

                    // Append the option to the select element
                    vehicleSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching vehicle data:', error));
    }
}



// function updateEstimatedCostssss() {
//     const vehicleSelect = document.getElementById('vehicle-select');
    
//     if (!vehicleSelect) {
//         console.log('Vehicle select element not found');
//         return; // Exit if no vehicle select element exists
//     }

//     const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

//     if (!selectedOption) {
//         console.log('No option selected');
//         return; // Exit if no option is selected
//     }

//     const vehicleId = selectedOption.value;
//     const pricePerKm = selectedOption.getAttribute('data-price');

//     console.log('Selected Vehicle ID:', vehicleId);
//     console.log('Price per km:', pricePerKm);

//     if (vehicleId && pricePerKm && !isNaN(pricePerKm)) {
//         // Convert pricePerKm to a float and ensure it's valid
//         const price = parseFloat(pricePerKm);
//         console.log("Price per km: ₹" + price.toFixed(2));
//         document.getElementById('local-cost').value = "₹" + price.toFixed(2);
//     } else {
//         console.log('Invalid price or no vehicle selected');
//         document.getElementById('local-cost').value = "Calculated automatically";
//     }
// }




// function updateEstimatedCostssss() {
//     const vehicleSelect = document.getElementById('vehicle-select');
//     const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

//     const vehicleId = selectedOption.value;
//     const pricePerKm = selectedOption.getAttribute('data-price');

//     if (vehicleId && pricePerKm && !isNaN(pricePerKm)) {
//         // Convert pricePerKm to a float and ensure it's valid
//         const price = parseFloat(pricePerKm);
//         console.log("Price per km: ₹" + price.toFixed(2));
//         document.getElementById('local-cost').value = "₹" + price.toFixed(2);
//     } else {
//         document.getElementById('local-cost').value = "Calculated automatically";
//     }
// }



  function updateVehicleList() {
    var destinationCityId = document.getElementById("destination-city").value;
    
    // Clear previous vehicle options
    var vehicleSelect = document.getElementById("vehicle-selectss");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    // Check if a destination city is selected
    if (destinationCityId) {
        // Get matching vehicles for the selected destination city
        var matchingOutstation = @json($outstation).filter(function(outstation) {
            return outstation.trip_type == destinationCityId;
        });

        // Loop through matching outstation data
        matchingOutstation.forEach(function(outstation) {
            var matchingVehicle = @json($vehicle).find(function(vehicle) {
                return vehicle.id == outstation.vehicle_type;
            });

            if (matchingVehicle) {
                // Add the vehicle options dynamically
                var option = document.createElement("option");
                option.value = matchingVehicle.id;
                option.text = matchingVehicle.vehicle_type;
                option.setAttribute("data-price", outstation.cost); // Add cost to data attribute
                vehicleSelect.appendChild(option);
            }
        });
    }
}
</script>



<script>
  function updateEstimatedCost() {
    const vehicleSelect = document.getElementById('vehicle-select');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

    const vehicleId = selectedOption.value;
    if (vehicleId) {
      const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
      console.log("Price per km: ₹" + pricePerKm);
      document.getElementById('local-cost').value = "₹" + pricePerKm.toFixed(2);
    } else {
      document.getElementById('local-cost').value = "Calculated automatically";
    }
  }
</script>


<script>
  function updateEstimatedCostss() {
    const vehicleSelect = document.getElementById('vehicle-selectss');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

    const vehicleId = selectedOption.value;

    if (vehicleId) {
      const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
      
      console.log("Price per km: ₹" + pricePerKm);

      document.getElementById('local-costss').value = "₹" + pricePerKm.toFixed(2);

    } else {
      document.getElementById('local-costss').value = "Calculated automatically";
    }
  }
</script>



<script>
  const selectCar = (carType, inputId, modalId) => {
    const carInput = document.getElementById(inputId);
    if (carInput) {
      carInput.value = carType;
    } else {
      console.error(`Car input element with ID "${inputId}" not found!`);
    }

    const modal = document.getElementById(modalId);
    if (modal) {
      const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
      bootstrapModal.hide();
    } else {
      console.error(`Modal element with ID "${modalId}" not found!`);
    }
  };



  function updateInputs() {
    const tripType = document.getElementById("trip-type").value;
    const pickupInputs = document.getElementById("pickup-inputs");
    const dropInputs = document.getElementById("drop-inputs");
    
    // Make sure both input sections are visible
    pickupInputs.style.display = "block";
    dropInputs.style.display = "block";

    // Get the label elements inside each container
    const pickupLabel = pickupInputs.querySelector("label");
    const dropLabel = dropInputs.querySelector("label");

    if (tripType === "pickup") {
      pickupLabel.textContent = "Pickup from";
      dropLabel.textContent = "Drop to";
    } else if (tripType === "drop") {
      pickupLabel.textContent = "Drop to";
      dropLabel.textContent = "Pickup from";
    }
  }


  document.querySelectorAll('.city-item').forEach(item => {
  item.addEventListener('click', function () {
    // Get the corresponding input field ID from the modal trigger
    const targetInputId = document.querySelector('.modal-trigger[data-bs-target="#cityModal"]').getAttribute('data-target-input');
    const inputField = document.getElementById(targetInputId);

    // Set the selected city name to the input field
    const selectedCity = this.querySelector('p').textContent.trim();
    inputField.value = selectedCity;

    // Close the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('cityModal'));
    modal.hide();
  });
});


</script>


@endsection
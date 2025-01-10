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
  <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/desktop_.png') }}">
  <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
  <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
  <img src="{{ asset('frontend/images/banner/fallback_.png') }}" alt="Responsive Banner">
</picture>

<!-- /* //////////////Banner Ends///////////// */ -->



<!-- /* //////////////form starts///////////// */ -->
<div class="container py-5">
  <h1 class="text-center mb-4">Taxi Booking</h1>

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
      <form>
        <div class="mb-3">
          <div class="omh_air_rail">
            <div class="lo_ka">
              <div class="act_trans">
                <img style="width: 20px;" src="{{asset('frontend/images/destination.png')}}" alt="">
                <label for="trip-type" class="form-label whtts">Select Trip</label>

              </div>
              <select class="form-select" id="trip-type" style="width: 50%; text-align: center;" onchange="updateInputs()">
                <option disabled>Select</option>
                <option value="pickup">Pickup from Airport/Railway station</option>
                <option value="drop">Drop to Airport/Railway station</option>
              </select>
            </div>
          </div>
        </div>

        <div id="pickup-inputs" style="display: block;">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3 loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="
    width: 20px;
">
                  <label for="pickup-airport" class="form-label">Pickup from</label>
                </div>
                <select class="form-select no-form-select" id="pickup-airport">
                  <option value="">Select an Airport</option>
                  <option value="airport1">Airport 1</option>
                  <option value="airport2">Airport 2</option>
                  <option value="airport3">Airport 3</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="
    width: 20px;
">
                  <label for="drop-address" class="form-label no-form">Drop off Address</label>
                </div>
                <input type="text" class="form-control no-form" id="drop-address" placeholder="Enter drop address">
              </div>
            </div>
          </div>
        </div>

        <div id="drop-inputs" style="display: none;">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3 loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="
    width: 20px;
">
                  <label for="drop-airport" class="form-label">Drop to</label>
                </div>
                <select class="form-select no-form-select" id="drop-airport">
                  <option value="">Select an Airport</option>
                  <option value="airport1">Airport 1</option>
                  <option value="airport2">Airport 2</option>
                  <option value="airport3">Airport 3</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="
    width: 20px;
">
                  <label for="drop-address" class="form-label">Pickup Address</label>
                </div>
                <input type="text" class="form-control no-form" id="drop-address" placeholder="Enter drop address">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3 loc_stl">
            <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="
    width: 20px;
">

                  <label for="vehicle2" class="form-label">Select Vehicle</label>
                </div>
              <input type="text" id="car-input1" class="form-control car-input no-form" placeholder="Select a vehicle" readonly data-bs-toggle="modal" data-bs-target="#carmodal1">
            </div>
          </div>
          <div class="modal fade" id="carmodal1" tabindex="-1" aria-labelledby="carmodallabel1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="carmodallabel1">Select car type</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="car_model">
                    <div class="frst_mes" onclick="selectCar('SUV', 'car-input1', 'carmodal1')" style="cursor: pointer;">
                      <h6>SUV</h6>
                      <img style="width:50%;" src="{{asset('frontend/images/car_icons/suv.png')}}" alt="">
                    </div>
                    <div class="frst_mes" onclick="selectCar('Hatchback', 'car-input1', 'carmodal1')" style="cursor: pointer;">
                      <h6>Hatchback</h6>
                      <img style="width:50%;" src="{{asset('frontend/images/car_icons/hatchback.png')}}" alt="">
                    </div>
                    <div class="frst_mes" id="sed" onclick="selectCar('Sedan','car-input1', 'carmodal1')" style="cursor: pointer;">
                      <h6>Sedan</h6>
                      <img style="width:50%;" src="{{asset('frontend/images/car_icons/sedan.png')}}" alt="">
                    </div>
                    <div class="frst_mes" id="trav" onclick="selectCar('Traveller','car-input1', 'carmodal1')" style="cursor: pointer;">
                      <h6>Traveller</h6>
                      <img style="width:50%;" src="{{asset('frontend/images/car_icons/traveller.png')}}" alt="">
                    </div>
                    <!-- More options... -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <div class="start_time">
              <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
              <label for="datetime" class="form-label">Choose Pickup Date and Time</label>
                <input style="width: 30%;" type="datetime-local" class="form-control no-form" id="datetime" placeholder="Select date and time">
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Estimated Cost</label>
              <div class="final_amy_see">

                <input type="text" class="form-control no-form" id="local-cost" placeholder="Calculated automatically" readonly>
                <div class="site_price">
                  <span>
                    2 days
                  </span>
                  <span>
                    ₹300/km
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Send Request to Admin</button>
      </form>
    </div>

    <!-- Local Tour -->
    <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local-tab">
      <form>
        <div class="row">
          <div class="col-lg-3">
            <div class="mb-3">
              <div class="loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="
    width: 20px;
">
                  <label for="local-location" class="form-label">Select Location</label>
                </div>
                <input type="text" class="form-control no-form" id="local-location" placeholder="Enter location">
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="mb-3">
              <div class="loc_stl">
                <div class="select_sect">
                  <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="
    width: 20px;
">

                  <label for="vehicle2" class="form-label">Select Vehicle</label>
                </div>
                <input type="text" id="car-input2" class="form-control car-input no-form" placeholder="Select a vehicle" readonly data-bs-toggle="modal" data-bs-target="#carmodal2">
              </div>

              <div class="modal fade" id="carmodal2" tabindex="-1" aria-labelledby="carmodallabel2" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="carmodallabel2">Select car type</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="car_model">
                        <div class="frst_mes" onclick="selectCar('SUV', 'car-input2', 'carmodal2')" style="cursor: pointer;">
                          <h6>SUV</h6>
                          <img style="width:50%;" src="{{asset('frontend/images/car_icons/suv.png')}}" alt="">
                        </div>
                        <div class="frst_mes" onclick="selectCar('Hatchback', 'car-input2', 'carmodal2')" style="cursor: pointer;">
                          <h6>Hatchback</h6>
                          <img style="width:50%;" src="{{asset('frontend/images/car_icons/hatchback.png')}}" alt="">
                        </div>
                        <div class="frst_mes" id="sed" onclick="selectCar('Sedan','car-input2', 'carmodal2')" style="cursor: pointer;">
                          <h6>Sedan</h6>
                          <img style="width:50%;" src="{{asset('frontend/images/car_icons/sedan.png')}}" alt="">
                        </div>
                        <div class="frst_mes" id="trav" onclick="selectCar('Traveller','car-input2', 'carmodal2')" style="cursor: pointer;">
                          <h6>Traveller</h6>
                          <img style="width:50%;" src="{{asset('frontend/images/car_icons/traveller.png')}}" alt="">
                        </div>
                        <!-- More options... -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Pickup Date and Time</label>

                <input style="width: 100%;" type="datetime-local" class="form-control no-form" id="datetime" placeholder="Select date and time">
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="start_time">
              <div class="loc_stl" style="border: none;">
                <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                <label for="datetime" class="form-label">Choose Drop Date and Time</label>
                <input style="width: 100%;" type="datetime-local" class="form-control no-form" id="datetime" placeholder="Select date and time">
              </div>
            </div>
          </div>
        </div>


        <div class="mb-3">
          <div class="subbs">
            <div class="insidee">
              <label for="local-cost" class="form-label">Estimated Cost</label>
              <div class="final_amy_see">

                <input type="text" class="form-control no-form" id="local-cost" placeholder="Calculated automatically" readonly>
                <div class="site_price">
                  <span>
                    2 days
                  </span>
                  <span>
                    ₹300/km
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Send Request to Admin</button>
      </form>
    </div>

    <!-- Outstation Booking -->
    <div class="tab-pane fade" id="outstation" role="tabpanel" aria-labelledby="outstation-tab">
      <form>
        <div class="mb-3">
        <div class="omh_air_rail">
            <div class="lo_ka">
              <div class="act_trans">
                <img style="width: 20px;" src="{{asset('frontend/images/destination.png')}}" alt="">
                <label for="trip-type" class="form-label whtts">Select Trip</label>

              </div>
          <label for="type" class="form-label">Trip Type</label>
          <select class="form-select mormal" id="type" onchange="updateTypes()">
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
            <div class="mb-3">
  <label for="departure-location" class="form-label">Departure Location</label>
  <input
    type="text"
    class="form-control"
    id="departure-location"
    placeholder="Enter departure location"
    data-bs-toggle="modal"
    data-bs-target="#cityModal"
  >
</div>
<div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cityModalLabel">Select a City</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item">New York</li>
          <li class="list-group-item">Los Angeles</li>
          <li class="list-group-item">Chicago</li>
          <li class="list-group-item">Houston</li>
          <li class="list-group-item">Phoenix</li>
        </ul>
      </div>
    </div>
  </div>
</div>
            </div>
          
            <div class="col-lg-4">
          <div class="mb-3">
            <label for="pickup-date" class="form-label">Pickup Date</label>
            <input type="date" class="form-control" id="return-date">
          </div>
          </div>

          <div class="col-lg-4">
          <div class="mb-3 loc_stl">
    <div class="select_sect">
      <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
      <label for="vehicle3" class="form-label">Select Vehicle</label>
    </div>
    <input type="text" id="car-input4" class="form-control car-input no-form" placeholder="Select a vehicle" readonly data-bs-toggle="modal" data-bs-target="#carmodal4">
  </div>
  <div class="modal fade" id="carmodal4" tabindex="-1" aria-labelledby="carmodallabel4" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="carmodallabel4">Select car type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="car_model">
          <div class="frst_mes" onclick="selectCar('SUV', 'car-input4', 'carmodal4')" style="cursor: pointer;">
            <h6>SUV</h6>
            <img style="width:50%;" src="{{ asset('frontend/images/car_icons/suv.png') }}" alt="SUV">
          </div>
          <div class="frst_mes" onclick="selectCar('Hatchback', 'car-input4', 'carmodal4')" style="cursor: pointer;">
            <h6>Hatchback</h6>
            <img style="width:50%;" src="{{ asset('frontend/images/car_icons/hatchback.png') }}" alt="Hatchback">
          </div>
          <div class="frst_mes" onclick="selectCar('Sedan', 'car-input4', 'carmodal4')" style="cursor: pointer;">
            <h6>Sedan</h6>
            <img style="width:50%;" src="{{ asset('frontend/images/car_icons/sedan.png') }}" alt="Sedan">
          </div>
          <div class="frst_mes" onclick="selectCar('Traveller', 'car-input4', 'carmodal4')" style="cursor: pointer;">
            <h6>Traveller</h6>
            <img style="width:50%;" src="{{ asset('frontend/images/car_icons/traveller.png') }}" alt="Traveller">
          </div>
          <!-- Add more car options as needed -->
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
          <div class="mb-3">
            <label for="departure-location-round" class="form-label">Departure Location</label>
            <input type="text" class="form-control" id="departure-location-round" placeholder="Enter departure location">
          </div>
          <div class="mb-3">
            <label for="destination-location-round" class="form-label">Destination Location</label>
            <input type="text" class="form-control" id="destination-location-round" placeholder="Enter destination location">
          </div>
          <div class="mb-3">
            <label for="pickup-date" class="form-label">Pickup Date</label>
            <input type="date" class="form-control" id="return-date">
          </div>
          <div class="mb-3">
            <label for="return-date" class="form-label">Return Date</label>
            <input type="date" class="form-control" id="return-date">
          </div>
        </div>

        <div class="mb-3">
          <label for="outstation-vehicle" class="form-label">Select Vehicle</label>
          <select class="form-select" id="outstation-vehicle">
            <option value="">Select vehicle</option>
            <option value="sedan">Sedan</option>
            <option value="suv">SUV</option>
            <option value="hatchback">Hatchback</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="outstation-cost" class="form-label">Estimated Cost</label>
          <input type="text" class="form-control" id="outstation-cost" placeholder="Calculated automatically" disabled>
        </div>
        <button type="submit" class="btn btn-primary">Send Request to Admin</button>
      </form>
    </div>
  </div>
</div>

<!-- /* //////////////form ends///////////// */ -->


<!-- /* //////////////Cards Starts///////////// */ -->

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

    if (tripType === "pickup") {
      pickupInputs.style.display = "block";
      dropInputs.style.display = "none";
    } else if (tripType === "drop") {
      pickupInputs.style.display = "none";
      dropInputs.style.display = "block";
    } else {
      pickupInputs.style.display = "block";
      dropInputs.style.display = "none";
    }
  }

  document.querySelectorAll('.list-group-item').forEach(item => {
  item.addEventListener('click', function () {
    const inputField = document.getElementById('departure-location');
    inputField.value = this.textContent;
    const modal = bootstrap.Modal.getInstance(document.getElementById('cityModal'));
    modal.hide(); // Close the modal
  });
});

</script>


@endsection
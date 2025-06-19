@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .modal-header {
    background-color: #007bff;
    color: white;
  }
.vahiKaa{

    width: 100%;
    height: 100px;
    border-radius: 20px;
    border: none;

}
  .list-group-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
  }
.fimBtans {
    display: flex;
    align-items: center;
    justify-content: center;
}
  .home_search {
    margin-left: auto !important;
    float: revert;
    margin-right: 13px;
  }

  .peopleAndz {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: background-image 0.5s ease-in-out;
    min-height: 100vh;
    padding: 20px 0;
    position: relative;
    z-index: 1;
    background-color: #f0f0f0; /* Fallback color */
  }

  .peopleAndz.airport-bg {
    background-image: url('https://www.deepamtaxi.com//assets/images/airport/outstation-cab-services-banner.jpg');
    background-position:center;
    background-size: cover; 
  }

  .peopleAndz.local-bg {
    background-image: url('https://www.deepamtaxi.com/assets/images/airport/outstation-cab-services-banner.jpg');
        background-position:center;
    background-size: cover;
  }

  .peopleAndz.outstation-bg {
    background-image: url('https://www.deepamtaxi.com/admin/uploads/bg_images/1014-3.png'); /* Unique image for outstation */
        background-position:center;
    background-size: cover;
  }

  /* Ensure form content is readable over background */
  .home_search {
    background: rgb(255, 255, 255); /* Semi-transparent white for contrast */
    padding: 20px;
    border-radius: 8px;
  }

  @media (max-width: 768px) {
    .peopleAndz {
      background-size: contain; /* Adjust for smaller screens */
    }
  }
</style>

<!-- /* //////////////Banner Starts///////////// */ -->
{{-- <picture>
  <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/car.png') }}">
  <img src="{{ asset('frontend/images/banner/car.png') }}" alt="Responsive Banner">
</picture> --}}
<!-- /* //////////////Banner Ends///////////// */ -->

<!-- /* //////////////form starts///////////// */ -->
<div class="section peopleAndz airport-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 home_search">
        <div class="container genrta">
          <h2 class="text-center ">Taxi Booking</h2>

          <!-- Tabs for booking types -->
          <ul class="nav nav-tabs mb-4 flex-nowrap justify-content-center" id="bookingTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" style="color: #000;" id="airport-tab" data-bs-toggle="tab" data-bs-target="#airport" type="button" role="tab" aria-controls="airport" aria-selected="true">Airport/Railway Station</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" style="color: #000;" id="local-tab" data-bs-toggle="tab" data-bs-target="#local" type="button" role="tab" aria-controls="local" aria-selected="false">Local Tour</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" style="color: #000;" id="outstation-tab" data-bs-toggle="tab" data-bs-target="#outstation" type="button" role="tab" aria-controls="outstation" aria-selected="false">Outstation</button>
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
                  </div>  
                  <div class="row">
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <div class="select_sect" id="drop-inputs">
                          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                          <label for="drop-address" class="form-label no-form">Drop off Address</label>
                        </div>
                        <input type="text" name="drop_pickup_address" class="form-control no-form" id="drop-address" placeholder="Enter drop address">
                      </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="mb-3 loc_stl">
                      <div class="select_sect">
                        <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
                        <label for="vehicle2" class="form-label">Select Vehicle</label>
                      </div>
                      <select name="vehicle_id" class="form-select no-form-select" id="vehicle-select" onchange="updateEstimatedCost()">
                        <option value="">Select a Vehicle</option>
                      </select>
                    </div>
                  </div>
                  </div>
                </div>
           
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <div class="start_time">
                        <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                        <label for="datetime" class="form-label">Choose Pickup Date</label>
                        <input name="pickup_date" style="width: 100%;" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <div class="start_time">
                        <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                        <label for="datetime" class="form-label">Choose Pickup Time</label>
                        <input name="pickup_time" style="width: 100%;" type="time" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
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
                          <!-- <span>2 days</span>
                          <span>₹300/km</span> -->
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
                        <textarea name="" id="price-description" class="vahiKaa" cols="30" rows="10" readonly></textarea>
                        <div class="site_price">
                          <!-- <span>2 days</span>
                          <span>₹300/km</span> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="fimBtans">
                @if(Auth::guard('agent')->check())
                  <button type="submit" class="btn btn-primary">Send Request to Admin</button>
                @else
                  <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
                @endif
                </div>
              </form>
            </div>

            <!-- Local Tour -->
            <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local-tab">
              <form action="{{route('book_local_tour')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
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

                  <div class="col-lg-6">
                    <div class="mb-3">
                      <div class="loc_stl">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                          <label for="local-location" class="form-label">Select Location</label>
                        </div>
                        <input type="text" name="location" class="form-control no-form" id="local-location" placeholder="Enter location" required>
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-lg-6">
                    <div class="select_sect">
                      <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
                      <label for="vehicle2" class="form-label">Select Vehicle</label>
                    </div>
                    <select name="vehicle_id" class="form-select no-form-select" id="vehicle-selects" onchange="updateEstimatedCosts()" required>
                      <option value="">Select a Vehicle</option>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <div class="start_time">
                      <div class="loc_stl">
                        <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                        <label for="datetime" class="form-label">Choose Pickup Date </label>
                        <input style="width: 100%;" name="pickup_date" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-lg-6">
                    <div class="start_time">
                      <div class="loc_stl">
                        <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                        <label for="datetime" class="form-label">Choose Pickup Time</label>
                        <input style="width: 100%;" name="pickup_time" type="time" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="start_time">
                      <div class="loc_stl" style="border: none;">
                        <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                        <label for="datetime" class="form-label">Choose Drop Date</label>
                        <input style="width: 100%;" name="drop_date" type="date" class="form-control no-form" id="datetime" placeholder="Select date and time" required>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-lg-12">
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
                          <!-- <span>2 days</span>
                          <span>₹300/km</span> -->
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
                        <textarea name="" id="local-description" class="vahiKaa" cols="30" rows="10" readonly></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                 <div class="fimBtans">
                @if(Auth::guard('agent')->check())
                  <button type="submit" class="btn btn-primary">Send Request to Admin</button>
                @else
                  <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
                @endif
                 </div>
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
                    <div class="col-lg-6">
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

                    <div class="col-lg-6">
                      <div class="mb-3 loc_stl">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="" style="width: 20px;">
                          <label for="vehicle3" class="form-label">Select Vehicle</label>
                        </div>
                        <select name="vehicle_id" class="form-select no-form-select" id="vehicle-selectss" onchange="updateEstimatedCostss()">
                          <option value="">Select a Vehicle</option>
                        </select>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="mb-3">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="" style="width: 20px;">
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
                    <div class="col-lg-12">
                      <div class="mb-3 loc_stl">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                          <label for="departure-location-round" class="form-label">Departure Location</label>
                        </div>
                        <input name="departure_location" type="text" class="form-control no-form" placeholder="Enter departure location">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="mb-3 loc_stl">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/pin.png" alt="" style="width: 20px;">
                          <label for="destination-location-round" class="form-label">Destination Location</label>
                        </div>
                        <input name="destination_location" type="text" class="form-control modal-trigger no-form" placeholder="Enter destination location">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="" style="width: 20px;">
                          <label for="pickup-date" class="form-label">Pickup Date</label>
                        </div>
                        <input name="pickup_date_1" type="date" class="form-control no-form" id="pickup-date" style="width: 100%;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="mb-3 loc_stl">
                        <div class="select_sect">
                          <img src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="" style="width: 20px;">
                          <label for="return-date" class="form-label">Return Date</label>
                        </div>
                        <input name="drop_date" type="date" class="form-control no-form" id="return-date" style="width: 50%;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
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

                 <div class="fimBtans">
                @if(Auth::guard('agent')->check())
                  <button type="submit" class="btn btn-primary">Send Request to Admin</button>
                @else
                  <a href="{{ route('login') }}" class="btn btn-primary">Send Request to Admin</a>
                @endif
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="seprate_section">
<section class="steps-section">
  <div class="container">
    <h2 class="steps-title">Make 4 steps to rent a cab</h2>
    <div class="steps-container">
      <div class="step">
        <div class="step-badge">1</div>
        <div class="step-content shadow-bottom-shadow ">
          <img class="huME" src="https://www.cabme.in/svg/calendar.svg" alt=""> <!-- Icon for Date & Location -->
          <h3>Date & Location</h3>
          <p>Pick the location and the preferred date.</p>
        </div>
      </div>
      <div class="arrow">
        <img src="https://www.cabme.in/svg/arrow.svg" alt="">
      </div>
      <div class="step">
        <div class="step-badge">2</div>
        <div class="step-content">
          <img class="huME" src="https://www.cabme.in/svg/car-vector.svg" alt="">  <!-- Icon for Choose A Car -->
          <h3>Choose A Car</h3>
          <p>Select the vehicle using our catalogues.</p>
        </div>
      </div>
     <div class="arrow">
        <img src="https://www.cabme.in/svg/arrow.svg" alt="">
      </div>
      <div class="step">
        <div class="step-badge">3</div>
        <div class="step-content shadow-bottom-shadow">
          <img class="huME" src="https://www.cabme.in/svg/search.svg" alt="">  <!-- Icon for Make A Booking -->
          <h3>Make A Booking</h3>
          <p>Enter your name and booking details.</p>
        </div>
      </div>
      <div class="arrow">
        <img src="https://www.cabme.in/svg/arrow.svg" alt="">
      </div>
      <div class="step">
        <div class="step-badge">4</div>
        <div class="step-content">
          <img class="huME" src="https://www.cabme.in/svg/ride.svg" alt="">  <!-- Icon for Enjoy Your Ride -->
          <h3>Enjoy Your Ride!</h3>
          <p>Enjoy your trip and our good services!</p>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- /* //////////////form ends///////////// */ -->

<script>
  // Function to change background image based on active tab
  function updateBackgroundImage() {
    const peopleAndzSection = document.querySelector('.peopleAndz');
    const activeTab = document.querySelector('#bookingTabs .nav-link.active').getAttribute('id');
    console.log('Active tab:', activeTab); // Debug: Log active tab

    // Remove all background classes
    peopleAndzSection.classList.remove('airport-bg', 'local-bg', 'outstation-bg');

    // Add the appropriate background class
    if (activeTab === 'airport-tab') {
      peopleAndzSection.classList.add('airport-bg');
      console.log('Applied airport-bg');
    } else if (activeTab === 'local-tab') {
      peopleAndzSection.classList.add('local-bg');
      console.log('Applied local-bg');
    } else if (activeTab === 'outstation-tab') {
      peopleAndzSection.classList.add('outstation-bg');
      console.log('Applied outstation-bg');
    }
  }

  // Add event listeners to tab buttons using Bootstrap's shown.bs.tab event
  document.querySelectorAll('#bookingTabs .nav-link').forEach(tab => {
    tab.addEventListener('shown.bs.tab', updateBackgroundImage);
  });

  // Call initially to set the background for the default active tab
  updateBackgroundImage();

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
          console.error('Error fetching vehicle data:', error);
        });
    }
  }

  function updateEstimatedCosts() {
    const vehicleSelect = document.getElementById('vehicle-selects');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleId = selectedOption.value;

    if (vehicleId) {
      const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
      let vehicleDescription = selectedOption.getAttribute('data-description');
      vehicleDescription = removeHtmlTags(vehicleDescription);

      console.log("Price: ₹" + pricePerKm);
      console.log("Description: " + vehicleDescription);

      if (!isNaN(pricePerKm)) {
        document.getElementById('local-costs').value = "₹" + pricePerKm.toFixed(2);
      } else {
        document.getElementById('local-costs').value = "Invalid price";
      }

      if (vehicleDescription && vehicleDescription !== "") {
        document.getElementById('local-description').value = vehicleDescription;
      } else {
        document.getElementById('local-description').value = "No description available";
      }
    } else {
      document.getElementById('local-costs').value = "Calculated automatically";
      document.getElementById('local-description').value = "";
    }
  }

  function fetchAirports() {
    const cityId = document.getElementById('city-dropdown').value;
    if (cityId) {
      fetch(`/booking_portal/public/get-airports/${cityId}`)
        .then(response => response.json())
        .then(data => {
          const airportSelect = document.getElementById('pickup-airport');
          airportSelect.innerHTML = '<option value="">Select an Airport</option>';
          data.airports.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.airport;
            airportSelect.appendChild(option);
          });
        })
        .catch(error => {
          console.error('Error fetching airports:', error);
        });
    }
  }

  function updateVehicles() {
    const airportId = document.getElementById("pickup-airport").value;
    const vehicleSelect = document.getElementById("vehicle-select");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    if (airportId) {
      fetch(`/booking_portal/public/get-vehicles-by-airport?airport_id=${airportId}`)
        .then(response => response.json())
        .then(data => {
          data.forEach(vehicle => {
            const option = document.createElement("option");
            option.value = vehicle.id;
            option.text = vehicle.vehicle_type;
            option.setAttribute("data-price", vehicle.price);
            option.setAttribute("data-description", vehicle.description);
            vehicleSelect.appendChild(option);
          });

          if (data.length > 0) {
            displayVehiclePrice(data[0].price);
            document.getElementById("price-description").value = removeHtmlTags(data[0].description);
          }
        })
        .catch(error => console.error('Error fetching vehicle data:', error));
    }
  }

  function removeHtmlTags(str) {
    const doc = new DOMParser().parseFromString(str, 'text/html');
    return doc.body.textContent || "";
  }

  function displayVehiclePrice(price) {
    const costInputField = document.getElementById("local-cost");
    if (price) {
      costInputField.value = `₹${price}`;
    } else {
      costInputField.value = 'Price not available';
    }
  }

  document.getElementById("vehicle-select").addEventListener("change", function() {
    const selectedOption = this.options[this.selectedIndex];
    const price = selectedOption.getAttribute("data-price");
    const description = selectedOption.getAttribute("data-description");
    displayVehiclePrice(price);
    document.getElementById("price-description").value = removeHtmlTags(description);
  });

  function updateVehicless() {
    const airportId = document.getElementById("drop-airport")?.value;
    const vehicleSelect = document.getElementById("vehicle-select");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    if (airportId) {
      fetch(`/booking_portal/public/get-vehicles-by-airport?airport_id=${airportId}`)
        .then(response => response.json())
        .then(data => {
          data.forEach(vehicle => {
            const option = document.createElement("option");
            option.value = vehicle.id;
            option.text = vehicle.vehicle_type;
            option.setAttribute("data-price", vehicle.price);
            vehicleSelect.appendChild(option);
          });
        })
        .catch(error => console.error('Error fetching vehicle data:', error));
    }
  }

  function updateVehicleList() {
    const destinationCityId = document.getElementById("destination-city").value;
    const vehicleSelect = document.getElementById("vehicle-selectss");
    vehicleSelect.innerHTML = '<option value="">Select a Vehicle</option>';

    if (destinationCityId) {
      const outstationData = @json($outstation);
      const vehicleData = @json($vehicle);
      const matchingOutstation = outstationData.filter(outstation => outstation.id == destinationCityId);

      matchingOutstation.forEach(outstation => {
        const matchingVehicle = vehicleData.find(vehicle => vehicle.id == outstation.vehicle_type);
        if (matchingVehicle) {
          const option = document.createElement("option");
          option.value = matchingVehicle.id;
          option.text = matchingVehicle.vehicle_type;
          option.setAttribute("data-price", outstation.cost);
          vehicleSelect.appendChild(option);
        }
      });
    }
  }

  function updateEstimatedCost() {
    const vehicleSelect = document.getElementById('vehicle-select');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleId = selectedOption.value;

    if (vehicleId) {
      const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
      console.log("Price per km: ₹" + pricePerKm);
      document.getElementById('local-cost').value = isNaN(pricePerKm) ? "Invalid price" : "₹" + pricePerKm.toFixed(2);
    } else {
      document.getElementById('local-cost').value = "Calculated automatically";
    }
  }

  function updateEstimatedCostss() {
    const vehicleSelect = document.getElementById('vehicle-selectss');
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleId = selectedOption.value;

    if (vehicleId) {
      const pricePerKm = parseFloat(selectedOption.getAttribute('data-price'));
      console.log("Price per km: ₹" + pricePerKm);
      document.getElementById('local-costss').value = isNaN(pricePerKm) ? "Invalid price" : "₹" + pricePerKm.toFixed(2);
    } else {
      document.getElementById('local-costss').value = "Calculated automatically";
    }
  }

  function selectCar(carType, inputId, modalId) {
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
  }

  function updateInputs() {
    const tripType = document.getElementById("trip-type").value;
    const pickupInputs = document.getElementById("pickup-inputs");
    const dropInputs = document.getElementById("drop-inputs");
    
    pickupInputs.style.display = "block";
    dropInputs.style.display = "block";

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

  function updateTypes() {
    const tripType = document.getElementById("type").value;
    const oneWayInputs = document.getElementById("one-way-inputs");
    const roundTripInputs = document.getElementById("round-trip-inputs");

    if (tripType === "one-way") {
      oneWayInputs.style.display = "block";
      roundTripInputs.style.display = "none";
    } else if (tripType === "round-trip") {
      oneWayInputs.style.display = "none";
      roundTripInputs.style.display = "block";
    }
  }

  document.querySelectorAll('.city-item').forEach(item => {
    item.addEventListener('click', function () {
      const modalTrigger = document.querySelector('.modal-trigger[data-bs-target="#cityModal"]');
      if (!modalTrigger) {
        console.error('Modal trigger with data-bs-target="#cityModal" not found!');
        return;
      }
      const targetInputId = modalTrigger.getAttribute('data-target-input');
      const inputField = document.getElementById(targetInputId);

      if (inputField) {
        const selectedCity = this.querySelector('p')?.textContent.trim();
        inputField.value = selectedCity || '';
      } else {
        console.error(`Input field with ID "${targetInputId}" not found!`);
      }

      const modal = document.getElementById('cityModal');
      if (modal) {
        const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
        bootstrapModal.hide();
      } else {
        console.error('City modal with ID "cityModal" not found!');
      }
    });
  });
</script>

@endsection
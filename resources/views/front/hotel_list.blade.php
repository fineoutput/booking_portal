@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .price-filter-container {
    padding: 20px;
    font-family: Arial, sans-serif;
  }

  .slider-container {
    position: relative;
    height: 50px;
  }

  .slider-track {
    position: absolute;
    top: 0%;
    left: 0;
    right: 0;
    height: 4px;
    background-color: #ddd;
    transform: translateY(-50%);
    border-radius: 2px;
  }

  .slider-range {
    position: absolute;
    height: 4px;
    background-color: #007bff;
    border-radius: 2px;
  }

  .slider-thumb {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 2px solid #007bff;
    border-radius: 50%;
    top: 0%;
    transform: translate(-50%, -50%);
    cursor: pointer;
    z-index: 2;
  }

  .price-inputs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .price-input {
    width: 100px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  .price-label {
    text-align: center;
    margin-top: 10px;
    color: #666;
  }


  .filter-box {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    max-width: 100%;
    font-family: Arial, sans-serif;
  }

  .filter-box h4 {
    margin-bottom: 10px;
    font-size: 18px;
  }

  .filter-group {
    margin-bottom: 15px;
  }

  .filter-group h5 {
    margin: 8px 0;
    font-size: 16px;
  }

  .filter-group label {
    font-size: 14px;
    cursor: pointer;
  }

  input[type="checkbox"] {
    /* margin-right: 6px; */
  }
  @media (max-width: 991px) {
  .collapsible-content {
    display: none;
  }
  .collapsible-content.active {
    display: block;
  }

  .filter-toggle-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 14px;
  }
}
</style>



<div class="header-container_hotels">

    <div class="search-header_hotels msfm">
    <!-- Destination Dropdown -->
    <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
      <div class="filter-label_hotels">Destination</div>


      <form action="" method="POST" id="filter-form">
        @csrf
        <div class="filter-value_hotels" id="destination-value"> <input type="text" id="city-search"
            onkeyup="filterCities()" placeholder="Search cities..." class="search-input" readonly></div>
        <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">
          <!-- Search input added here -->
          <div class="search-container">
            {{-- <input type="text" id="city-search" onkeyup="filterCities()" placeholder="Search cities..."
              class="search-input"> --}}
          </div>

          @foreach($cities as $value)
          <label class="d-flex " for="city_{{ $value->id }}" class="city-label orSamar" style="
              border-bottom: 1px solid #00000033;  cursor: pointer;   padding: 10px;">
            <div class="city_list_htotle city-item mb-2">
              <div class="desMund d-flex align-items-center gap-2">
                <div class="sizemaze">
                  <!-- Image representing the city -->
                  <img src="https://cdn-icons-png.flaticon.com/128/535/535239.png" alt="City Image" />
                </div>
                <p class="text-bold text-dark" href="#"><b>{{ $value->city_name ?? 'City name not available' }}</b></p>

                <div class="hotel_place">
                  <!-- Input field for the city selection -->
                  <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}"
                    class="destination-option_hotels opacity-0" onclick="selectDestination('{{ $value->city_name }}')">

                  <span class="hotels_spn"></span>
                </div>
              </div>
            </div>
            <p id="no_city"></p>
          </label>
          @endforeach

        </div>
    </div>
    {{-- <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
      <div class="filter-label_hotels">Destination</div>
      <div class="filter-value_hotels" id="destination-value">Where are you going?</div>
      <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">

        <form action="" method="POST" id="filter-form">
          @csrf

          @foreach($cities as $value)
          <div class="city_list_htotle">
            <div class="sizemaze">
              <!-- Image representing the city -->
              <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}" alt="City Image" />
            </div>
            <div class="hotel_place">
              <!-- Input field for the city selection -->
              <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}"
                class="destination-option_hotels" onclick="selectDestination('{{ $value->id }}')">
              <label for="city_{{ $value->id }}" class="city-label">{{ $value->city_name ?? 'City name not available'
                }}</label>
              <span class="hotels_spn"></span>
            </div>
          </div>
          @endforeach

      </div>
    </div> --}}


    <!-- Check-in Date -->
    <div class="filter-item_hotels sachi">
      <div class="filter-label_hotels">Select Dates</div>
      <input type="text" id="date-range" class="filter-value_hotels" placeholder="Choose date range" readonly>
      <input type="hidden" name="start_date" id="start_date">
      <input type="hidden" name="end_date" id="end_date">
    </div>

    <!-- Guests Dropdown -->
    <div class="filter-item_hotels sachi" onclick="toggleDropdown('guests')">
      <div class="filter-label_hotels">Guests</div>

      <div class="filter-value_hotels" id="guests-value">1 guest</div>

      <div class="dropdown_hotels guests-dropdown_hotels" id="guests-dropdown">
        <div class="guest-option_hotels">
          <label>No. of Rooms</label>
          <div class="counter_hotels">
            <button type="button" onclick="updateGuests('infants', -1)">-</button>
            <input type="number" id="infants-count" value="1" min="1">
            <button type="button" onclick="updateGuests('infants', 1)">+</button>
          </div>
        </div>
        <div class="guest-option_hotels">
          <label>Adults</label>
          <div class="counter_hotels">
            <button type="button" onclick="updateGuests('adults', -1)">-</button>
            <input type="number" id="adults-count" value="1" min="1">
            <button type="button" onclick="updateGuests('adults', 1)">+</button>
          </div>
        </div>
        <div class="guest-option_hotels">
          <label>Children</label>
          <div class="counter_hotels">
            <button type="button" onclick="updateChildren(-1)">-</button>
            <input type="number" id="children-count" value="0" min="0">
            <button type="button" onclick="updateChildren(1)">+</button>
          </div>

          <!-- Dynamic child age dropdowns appear here -->

        </div>
        <hr id="what">
        <div id="children-age-label" style="margin-top:10px; display:none; font-weight:600;">
          Children age
        </div>

        <!-- Dynamic child age dropdowns appear here -->
        <div id="children-ages"> </div>

      </div>
    </div>
    <button type="submit" class="cutPiece" style="border: none; background: none;">
      <div class="search_sba">
        <div class="sba_center_Sarch">

          search
          {{-- <img src="{{ asset('frontend/images/searchblue.png') }}" alt="" style="width: 80%;"> --}}

        </div>
      </div>
    </button>
    </form>

  </div>



</div>


<hr>
<section class="navigation_sect mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-12 col-md-12 param">
        <div class="left_navi_det">
          <h6><b>Get the perfect package</b></h6>
          <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterSidebar" aria-expanded="false" aria-controls="filterSidebar">
      Show Filters
    </button>
        </div>
         
          <div class="collapse d-lg-block" id="filterSidebar">
        <div class="navi_full_list">
          <form id="filter-form" action="{{ url('filter-hotels') }}" method="GET">
          <div class="d-flex justify-content-center ">
              <button class="mt-2 _btn" type="submit">Apply Filter</button>
                  <a href="{{ url('filter-hotels') }}" class="mt-2 ms-2 _btn btn-danger">Clear Filters</a>
            </div>  
            <input type="hidden" name="city_id" value="{{ request('city_id') }}">
<input type="hidden" name="start_date" value="{{ request('start_date') }}">
<input type="hidden" name="end_date" value="{{ request('end_date') }}">

            <!-- 1. Star Category -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Star Category</h5>
                @php $stars = request()->input('star', []); @endphp
                <label><input type="checkbox" name="star[]" value="5 Star" {{ in_array('5 Star', $stars) ? 'checked' : '' }}> 5 Star</label><br>
                <label><input type="checkbox" name="star[]" value="4 Star" {{ in_array('4 Star', $stars) ? 'checked' : '' }}> 4 Star</label><br>
                <label><input type="checkbox" name="star[]" value="3 Star" {{ in_array('3 Star', $stars) ? 'checked' : '' }}> 3 Star</label><br>
                <label><input type="checkbox" name="star[]" value="2 Star" {{ in_array('2 Star', $stars) ? 'checked' : '' }}> 2 Star</label><br>
                <label><input type="checkbox" name="star[]" value="Dormetry" {{ in_array('Dormetry', $stars) ? 'checked' : '' }}> Dormetry</label><br>
                <label><input type="checkbox" name="star[]" value="Villas / Homestay" {{ in_array('Villas / Homestay', $stars) ? 'checked' : '' }}> Villas / Homestay</label><br>
                <label><input type="checkbox" name="star[]" value="Hostels" {{ in_array('Hostels', $stars) ? 'checked' : '' }}> Hostels</label><br>
              </div>
            </div>

            <!-- 2. MEAL PLAN -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>MEAL PLAN</h5>
                @php $meals = request()->input('meal_plan', []); @endphp
                <label><input type="checkbox" name="meal_plan[]" value="meal_plan_breakfast_lunch_dinner" {{ in_array('meal_plan_breakfast_lunch_dinner', $meals) ? 'checked' : '' }}> Breakfast + Lunch/Dinner Included</label><br>
                <label><input type="checkbox" name="meal_plan[]" value="meal_plan_all_meals" {{ in_array('meal_plan_all_meals', $meals) ? 'checked' : '' }}> All Meals Included</label><br>
                <label><input type="checkbox" name="meal_plan[]" value="meal_plan_only_room" {{ in_array('meal_plan_only_room', $meals) ? 'checked' : '' }}> Only rooms</label><br>
                <label><input type="checkbox" name="meal_plan[]" value="meal_plan_breakfast" {{ in_array('meal_plan_breakfast', $meals) ? 'checked' : '' }}> Breakfast Included</label><br>
              </div>
            </div>

            <!-- 3. Nearby -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Nearby within Walking Distance</h5>
                @php $nearby = request()->input('nearby', []); @endphp
                <label><input type="checkbox" name="nearby[]" value="Public transport within 1 km" {{ in_array('Public transport within 1 km', $nearby) ? 'checked' : '' }}> Public transport within 1 km</label><br>
                <label><input type="checkbox" name="nearby[]" value="Shopping centers within 1 km" {{ in_array('Shopping centers within 1 km', $nearby) ? 'checked' : '' }}> Shopping centers within 1 km</label><br>
              </div>
            </div>

            <!-- 4. Locality -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Locality</h5>
                @php $localities = request()->input('locality', []); @endphp
                <label><input type="checkbox" name="locality[]" value="Other Popular Areas" {{ in_array('Other Popular Areas', $localities) ? 'checked' : '' }}> Other Popular Areas</label><br>
                <label><input type="checkbox" name="locality[]" value="Near Popular Attractions" {{ in_array('Near Popular Attractions', $localities) ? 'checked' : '' }}> Near Popular Attractions</label><br>
                <label><input type="checkbox" name="locality[]" value="Near Transit Hub(s)" {{ in_array('Near Transit Hub(s)', $localities) ? 'checked' : '' }}> Near Transit Hub(s)</label><br>
              </div>
            </div>

            <!-- 5. Price -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Total Price With Tax</h5>
                @php
                    $min = request()->input('min_price');
                    $max = request()->input('max_price');
                @endphp
                <label><input type="radio" name="min_price" value="0" {{ $min == 0 && $max == 2500 ? 'checked' : '' }}><input type="radio" name="max_price" value="2500" style="display:none;"> ₹ 0 - ₹ 2500</label><br>
                <label><input type="radio" name="min_price" value="2500" {{ $min == 2500 && $max == 4500 ? 'checked' : '' }}><input type="radio" name="max_price" value="4500" style="display:none;"> ₹ 2500 - ₹ 4500</label><br>
                <label><input type="radio" name="min_price" value="4500" {{ $min == 4500 && $max == 7000 ? 'checked' : '' }}><input type="radio" name="max_price" value="7000" style="display:none;"> ₹ 4500 - ₹ 7000</label><br>
                <label><input type="radio" name="min_price" value="9500" {{ $min == 9500 && $max == 11000 ? 'checked' : '' }}><input type="radio" name="max_price" value="11000" style="display:none;"> ₹ 9500 - ₹ 11000</label><br>
                <label><input type="radio" name="min_price" value="11000" {{ $min == 11000 && $max == 49000 ? 'checked' : '' }}><input type="radio" name="max_price" value="49000" style="display:none;"> ₹ 11000 - ₹ 49000</label><br>
                <label><input type="radio" name="min_price" value="49000" {{ $min == 49000 && $max == 1000000 ? 'checked' : '' }}><input type="radio" name="max_price" value="1000000" style="display:none;"> ₹ 49000+</label><br>
              </div>
            </div>

            <!-- 6. Chains -->
            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Chains</h5>
                @php $chains = request()->input('chains', []); @endphp
                <label><input type="checkbox" name="chains[]" value="Marriott" {{ in_array('Marriott', $chains) ? 'checked' : '' }}> Marriott, Westin & Le Meridien</label><br>
                <label><input type="checkbox" name="chains[]" value="Moustache" {{ in_array('Moustache', $chains) ? 'checked' : '' }}> Moustache</label><br>
                <label><input type="checkbox" name="chains[]" value="Oyo Hotels" {{ in_array('Oyo Hotels', $chains) ? 'checked' : '' }}> Oyo Hotels</label><br>
                <label><input type="checkbox" name="chains[]" value="Sarovar" {{ in_array('Sarovar', $chains) ? 'checked' : '' }}> Sarovar</label><br>
                <label><input type="checkbox" name="chains[]" value="StayVista" {{ in_array('StayVista', $chains) ? 'checked' : '' }}> StayVista</label><br>
                <label><input type="checkbox" name="chains[]" value="Sterling Holiday resorts" {{ in_array('Sterling Holiday resorts', $chains) ? 'checked' : '' }}> Sterling Holiday resorts</label><br>
                <label><input type="checkbox" name="chains[]" value="Taj" {{ in_array('Taj', $chains) ? 'checked' : '' }}> Taj</label><br>
                <label><input type="checkbox" name="chains[]" value="Treebo Hotels" {{ in_array('Treebo Hotels', $chains) ? 'checked' : '' }}> Treebo Hotels</label><br>
                <label><input type="checkbox" name="chains[]" value="Zostel" {{ in_array('Zostel', $chains) ? 'checked' : '' }}> Zostel</label><br>
              </div>
            </div>

            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Hotel Amenities</h5>
                @php $hotel_amenities = request()->input('hotel_amenities', []); @endphp
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Room Service" {{ in_array('Room Service', $hotel_amenities) ? 'checked' : '' }}> Room Service</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Balcony/Terrace" {{ in_array('Balcony/Terrace', $hotel_amenities) ? 'checked' : '' }}> Balcony/Terrace</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Barbeque" {{ in_array('Barbeque', $hotel_amenities) ? 'checked' : '' }}> Barbeque</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Cafe" {{ in_array('Cafe', $hotel_amenities) ? 'checked' : '' }}> Cafe</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="EV Charging Station" {{ in_array('EV Charging Station', $hotel_amenities) ? 'checked' : '' }}> EV Charging Station</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Restaurant" {{ in_array('Restaurant', $hotel_amenities) ? 'checked' : '' }}> Restaurant</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Bar" {{ in_array('Bar', $hotel_amenities) ? 'checked' : '' }}> Bar</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Parking" {{ in_array('Parking', $hotel_amenities) ? 'checked' : '' }}> Parking</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Bonfire" {{ in_array('Bonfire', $hotel_amenities) ? 'checked' : '' }}> Bonfire</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Kitchenette" {{ in_array('Kitchenette', $hotel_amenities) ? 'checked' : '' }}> Kitchenette</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Elevator/Lift" {{ in_array('Elevator/Lift', $hotel_amenities) ? 'checked' : '' }}> Elevator/Lift</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Indoor Games" {{ in_array('Indoor Games', $hotel_amenities) ? 'checked' : '' }}> Indoor Games</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Living Room" {{ in_array('Living Room', $hotel_amenities) ? 'checked' : '' }}> Living Room</label>
                  <br>
                <label>
                  <input type="checkbox" name="hotel_amenities[]" value="Caretaker" {{ in_array('Caretaker', $hotel_amenities) ? 'checked' : '' }}> Caretaker</label>
                  <br>
              </div>
            </div>

            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>Room Amenities</h5>
                @php $room_amenities = request()->input('room_amenities', []); @endphp
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Fireplace" {{ in_array('Fireplace', $room_amenities) ? 'checked' : '' }}> Fireplace</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Interconnected Room" {{ in_array('Interconnected Room', $room_amenities) ? 'checked' : '' }}> Interconnected Room</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Bathtub" {{ in_array('Bathtub', $room_amenities) ? 'checked' : '' }}> Bathtub</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Kitchenette" {{ in_array('Kitchenette', $room_amenities) ? 'checked' : '' }}> Kitchenette</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Smoking Room" {{ in_array('Smoking Room', $room_amenities) ? 'checked' : '' }}> Smoking Room</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Private Pool" {{ in_array('Private Pool', $room_amenities) ? 'checked' : '' }}> Private Pool</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Balcony" {{ in_array('Balcony', $room_amenities) ? 'checked' : '' }}> Balcony</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Cook & Butler Service" {{ in_array('Cook & Butler Service', $room_amenities) ? 'checked' : '' }}> Cook & Butler Service</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Heater" {{ in_array('Heater', $room_amenities) ? 'checked' : '' }}> Heater</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Jacuzzi" {{ in_array('Jacuzzi', $room_amenities) ? 'checked' : '' }}> Jacuzzi</label>
                  <br>
                <label>
                  <input type="checkbox" name="room_amenities[]" value="Living Area" {{ in_array('Living Area', $room_amenities) ? 'checked' : '' }}> Living Area</label>
                  <br>
              </div>
            </div>


            <div class="filter-box mt-2">
              <div class="filter-group">
                <h5>House Rules</h5>
                @php $house_rules = request()->input('house_rules', []); @endphp
                <label>
                  <input type="checkbox" name="house_rules[]" value="Smoking Allowed" {{ in_array('Smoking Allowed', $house_rules) ? 'checked' : '' }}> Smoking Allowed</label>
                  <br>
                <label>
                  <input type="checkbox" name="house_rules[]" value="Unmarried Couples Allowed" {{ in_array('Unmarried Couples Allowed', $house_rules) ? 'checked' : '' }}> Unmarried Couples Allowed</label>
                  <br>
                <label>
                  <input type="checkbox" name="house_rules[]" value="Pets Allowed" {{ in_array('Pets Allowed', $house_rules) ? 'checked' : '' }}> Pets Allowed</label>
                  <br>
                <label>
                  <input type="checkbox" name="house_rules[]" value="Alcohol Allowed" {{ in_array('Alcohol Allowed', $house_rules) ? 'checked' : '' }}> Alcohol Allowed</label>
                  <br>
                <label>
                  <input type="checkbox" name="house_rules[]" value="Non Veg Allowed" {{ in_array('Non Veg Allowed', $house_rules) ? 'checked' : '' }}> Non Veg Allowed</label>
                  <br>
              
              </div>
            </div>

            <!-- Submit -->
            <div class="d-flex justify-content-center ">
              <button class="mt-2 _btn" type="submit">Apply Filter</button>
              <a href="{{ url('filter-hotels') }}" class="mt-2 ms-2 _btn btn-danger">Clear Filters</a>
            </div>

          </form>
        </div>
        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">

          {{-- @if($hotels)
          @foreach ($hotels as $key => $value)
          <div class="col-lg-4 mb-3">
            @php
            $images = json_decode($value->images);
            $imagePath = ($images && is_array($images) && count($images) > 0) ? asset(reset($images)) :
            asset('frontend/images/hotel_main.avif');
            @endphp

            <a style="color: #fff" href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">
              <div class="cardashEs"
                style="background: url('{{ $imagePath }}') no-repeat center / cover; position: relative;">

                <div class="price-tagashEs">
                  @php
                  $hotelPrice = $hotel_prices[$value->id] ?? null;
                  @endphp
                
                </div>

                <div class="gradient-overlayashEs"></div>
                <div class="contentashEs">

                  <h3>{{ \Illuminate\Support\Str::limit($value->name ?? '', 30) }}</h3>
                  <div class="detailsashEs">
                    <div class="durationashEs">
                     
                   <span>📍 {{ $value->cities->city_name ?? '' }}</span>
                    </div>
                    <div class="locationashEs">
                      <span>₹ {{ number_format($value->display_price ?? 0, 2) }} per night</span>
                    </div>
                  </div>
                  <div class="options_btns d-flex justify-content-center mt-2">
                    <a class="_btn" href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">Book
                      Now</a>
                  </div>

                </div>
              </div>
            </a>
          </div>

          @endforeach
          @else
          <div class="col-lg-6">
            <h1>No Package Found</h1>
          </div>
          @endif --}}

@if($hotels)
    @foreach ($hotels as $key => $value)
    <div class="col-lg-4 mb-3">

        @php
        $images = json_decode($value->images);
        $imagePath = ($images && is_array($images) && count($images) > 0)
            ? asset(reset($images))
            : asset('frontend/images/hotel_main.avif');
        @endphp

        <a style="color: #fff" 
           href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">

            <div class="cardashEs hotel-card"
                data-price="{{ $value->display_price ?? 0 }}"
                style="background: url('{{ $imagePath }}') no-repeat center / cover; position: relative;">

                <div class="price-tagashEs"></div>

                <div class="gradient-overlayashEs"></div>

                <div class="contentashEs">

                    <h3>{{ \Illuminate\Support\Str::limit($value->name ?? '', 30) }}</h3>

                    <div class="detailsashEs">
                        <div class="durationashEs">
                            <span>📍 {{ $value->cities->city_name ?? '' }}</span>
                        </div>

                        <div class="locationashEs">
                            {{-- OLD PRICE --}}
                            {{-- <span>₹ {{ number_format($value->display_price ?? 0, 2) }} per night</span> --}}

                            {{-- NEW FINAL PRICE (JS will replace this dynamically) --}}
                            <span class="final-price">
                                ₹ {{ number_format($value->display_price ?? 0, 2) }} 
                            </span>
                        </div>
                    </div>

                    <div class="options_btns d-flex justify-content-center mt-2">
                        <a class="_btn" 
                           href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">
                           Book Now
                        </a>
                    </div>

                </div>
            </div>
        </a>
    </div>
    @endforeach
@else
    <div class="col-lg-6">
        <h1>No Package Found</h1>
    </div>
@endif


        </div>
      </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let formData = localStorage.getItem("hotelFormData");
    if (!formData) return;

    formData = JSON.parse(formData);

    let startDate = new Date(formData.start_date);
    let endDate = new Date(formData.end_date);

    let nightCount = (endDate - startDate) / (1000 * 60 * 60 * 24);
    if (nightCount <= 0) nightCount = 1;

    let infants = parseInt(formData.infants ?? 1);
    if (infants <= 0) infants = 1;

    document.querySelectorAll(".hotel-card").forEach(card => {

        let basePrice = parseFloat(card.dataset.price);
        if (isNaN(basePrice)) basePrice = 0;

        let finalPrice = basePrice * nightCount * infants;

        let finalPriceElement = card.querySelector(".final-price");

        if (finalPriceElement) {
            finalPriceElement.innerText = 
                "₹ " + finalPrice.toFixed(2) + " total";
        }

    });
});
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#responsive-slider', {
      type: 'loop', // Makes the slider loop
      perPage: 1,      // One slide per view
      autoplay: true,   // Auto-slide
      interval: 3000,   // Interval for autoplay
      breakpoints: {
        768: {
          perPage: 1,
        },
      },
    }).mount();
  });

</script>



<script>
  const minPriceInput = document.getElementById('minPrice');
  const maxPriceInput = document.getElementById('maxPrice');
  const minThumb = document.getElementById('minThumb');
  const maxThumb = document.getElementById('maxThumb');
  const sliderTrack = document.querySelector('.slider-track');
  const sliderRange = document.querySelector('.slider-range');
  const minValue = document.getElementById('minValue');
  const maxValue = document.getElementById('maxValue');

  const minPrice = 0;
  const maxPrice = 100000;
  let isDragging = false;
  let currentThumb = null;

  function updateValues() {
    const minPercent = parseFloat(minThumb.style.left) || 0;
    const maxPercent = parseFloat(maxThumb.style.left) || 100;

    const minValuePrice = Math.round((minPercent / 100) * (maxPrice - minPrice) + minPrice);
    const maxValuePrice = Math.round((maxPercent / 100) * (maxPrice - minPrice) + minPrice);

    minPriceInput.value = minValuePrice;
    maxPriceInput.value = maxValuePrice;
    minValue.textContent = minValuePrice.toLocaleString();
    maxValue.textContent = maxValuePrice.toLocaleString();

    sliderRange.style.left = minPercent + '%';
    sliderRange.style.right = (100 - maxPercent) + '%';
  }

  function handleDragStart(e) {
    isDragging = true;
    currentThumb = e.target;
    document.body.style.userSelect = 'none';
  }

  function handleDragging(e) {
    if (!isDragging) return;

    const rect = sliderTrack.getBoundingClientRect();
    let newX = (e.clientX - rect.left) / rect.width * 100;
    newX = Math.max(0, Math.min(100, newX));

    if (currentThumb === minThumb) {
      if (newX >= parseFloat(maxThumb.style.left || 100)) return;
      minThumb.style.left = newX + '%';
    } else {
      if (newX <= parseFloat(minThumb.style.left || 0)) return;
      maxThumb.style.left = newX + '%';
    }

    updateValues();
  }

  function handleDragEnd() {
    isDragging = false;
    currentThumb = null;
    document.body.style.userSelect = '';
  }

  function handleInputChange(e) {
    let value = parseInt(e.target.value);
    if (isNaN(value)) return;

    value = Math.max(minPrice, Math.min(maxPrice, value));
    const percent = ((value - minPrice) / (maxPrice - minPrice)) * 100;

    if (e.target === minPriceInput) {
      if (value > parseInt(maxPriceInput.value)) {
        maxPriceInput.value = value;
        maxThumb.style.left = percent + '%';
      }
      minThumb.style.left = percent + '%';
    } else {
      if (value < parseInt(minPriceInput.value)) {
        minPriceInput.value = value;
        minThumb.style.left = percent + '%';
      }
      maxThumb.style.left = percent + '%';
    }

    updateValues();
  }

  // Event Listeners
  minThumb.addEventListener('mousedown', handleDragStart);
  maxThumb.addEventListener('mousedown', handleDragStart);
  document.addEventListener('mousemove', handleDragging);
  document.addEventListener('mouseup', handleDragEnd);
  minPriceInput.addEventListener('input', handleInputChange);
  maxPriceInput.addEventListener('input', handleInputChange);

  // Initialize values
  minThumb.style.left = '0%';
  minThumb.style.top = '0%';
  maxThumb.style.left = '100%';
  maxThumb.style.top = '0%';
  updateValues();
</script>

<script>
  document.getElementById('filter-form').onsubmit = function (event) {
    event.preventDefault(); // Prevent default form submission

    // Get all form values including city_id, start_date, end_date, min_price, and max_price
    const city_id = '{{ request()->input('city_id') }}';  // City ID
    const start_date = '{{ request()->input('start_date') }}';  // Start date
    const end_date = '{{ request()->input('end_date') }}';  // End date
    const min_price = document.getElementById('minPrice').value;  // Min price from form
    const max_price = document.getElementById('maxPrice').value;  // Max price from form

    // Construct the new URL with all parameters
    let url = new URL(window.location.href);

    // Add the query parameters dynamically
    url.searchParams.set('city_id', city_id);
    url.searchParams.set('start_date', start_date);
    url.searchParams.set('end_date', end_date);
    url.searchParams.set('min_price', min_price);
    url.searchParams.set('max_price', max_price);

    // Set the updated URL as the form action and submit the form
    window.location.href = url; // Redirect to the updated URL
  };
</script>

<script>
  document.getElementById('filter-form').onsubmit = function (event) {
    event.preventDefault();

    // Get the selected city_id
    const city_id = document.querySelector('input[name="city_id"]:checked'); // Get selected radio button

    if (city_id) {
      // If a city is selected, get the value
      const cityValue = city_id.value;
      const start_date = document.getElementById('start_date').value;
      const end_date = document.getElementById('end_date').value;

      // Construct the URL with parameters
      const actionUrl = '{{ route("filterHotels") }}'; // Using GET method
      const finalUrl = `${actionUrl}?city_id=${cityValue}&start_date=${start_date}&end_date=${end_date}`;

      // Redirect to the new URL with parameters (trigger a GET request)
      window.location.href = finalUrl;
    } else {
      // If no city is selected, you might want to show an error or prompt the user to select a city
      alert("Please select a city.");
    }
  };

</script>
<script>
  function updateChildren(change) {
    let input = document.getElementById("children-count");
    let currentValue = parseInt(input.value) || 0;
    let newValue = currentValue + change;

    if (newValue < 0) newValue = 0; // prevent negatives
    input.value = newValue;

    updateChildrenAges(newValue);
  }

  function updateChildrenAges(count) {
    const container = document.getElementById("children-ages");
    const label = document.getElementById("children-age-label");

    container.innerHTML = ""; // Clear old dropdowns

    if (count > 0) {
      label.style.display = "block"; // show label when children exist
      container.style.display = "grid";
      container.style.gridTemplateColumns = "1fr 1fr"; // 2 columns
      container.style.gap = "10px";
      container.style.marginTop = "10px";
    } else {
      label.style.display = "none"; // hide label when no children
      container.style.display = "none";
    }

    for (let i = 1; i <= count; i++) {
      let wrapper = document.createElement("div");
      wrapper.style.display = "flex";
      wrapper.style.alignItems = "center";

      let childLabel = document.createElement("span");
      childLabel.innerText = `Child ${i}`;
      childLabel.style.marginRight = "8px";
      childLabel.style.fontSize = "14px";
      childLabel.style.fontWeight = "bold";

      let select = document.createElement("select");
      select.name = `child_age_${i}`;
      select.classList.add("child-age-select");

      for (let age = 0; age <= 17; age++) {
        let option = document.createElement("option");
        option.value = age;
        option.text = `${age} years`;
        select.appendChild(option);
      }

      wrapper.appendChild(childLabel);
      wrapper.appendChild(select);
      container.appendChild(wrapper);
    }
  }

</script>
<script>
  function filterCities() {
    const searchQuery = document.getElementById('city-search').value.toLowerCase();
    const cityItems = document.querySelectorAll('.city-item');

    let matchFound = false;

    cityItems.forEach(function (item) {
      const cityName = item.textContent.trim().toLowerCase();
      if (cityName.includes(searchQuery)) {
        item.style.display = 'flex'; // show if match
        // noCity.style.display='none';
        matchFound = true;
      } else {
        item.style.display = 'none';
        // noCity.style.display='block ' // hide if no match
      }
    });

    // Show or hide "no city found" message
    const noCity = document.getElementById('no_city');
    if (matchFound) {
      noCity.style.display = 'none';
    } else {
      noCity.style.display = 'block';
    }
  }

</script>





<script>
  function filterCities() {
    const searchQuery = document.getElementById('city-search').value.toLowerCase();
    const cityItems = document.querySelectorAll('.city-item');

    let matchFound = false;

    cityItems.forEach(function (item) {
      const cityName = item.textContent.trim().toLowerCase();
      if (cityName.includes(searchQuery)) {
        item.style.display = 'flex'; // show if match
        // noCity.style.display='none';
        matchFound = true;
      } else {
        item.style.display = 'none';
        // noCity.style.display='block ' // hide if no match
      }
    });

    // Show or hide "no city found" message
    const noCity = document.getElementById('no_city');
    if (matchFound) {
      noCity.style.display = 'none';
    } else {
      noCity.style.display = 'block';
    }
  }

</script>




<script>
      document.addEventListener('DOMContentLoaded', function () {
          const form = document.getElementById('filter-form');
          const formKey = 'hotelFormData'; // Unique key for LocalStorage

          // Restore data if exists
          const savedData = JSON.parse(localStorage.getItem(formKey));
          if (savedData) {
              // Restore city radio
              const savedData = JSON.parse(localStorage.getItem('hotelFormData'));
      if (savedData && savedData.city_id) {
        const radio = document.querySelector(`input[name="city_id"][value="${savedData.city_id}"]`);
        if (radio) radio.checked = true;

        const citySearch = document.getElementById('city-search');
        if (citySearch && savedData.city_name) {
          citySearch.value = savedData.city_name;
        }

        // Optional: Update visible placeholder or label too
        const destinationValue = document.getElementById('destination-value');
        if (destinationValue && savedData.city_name) {
          destinationValue.textContent = savedData.city_name;
        }
      }

          // Restore dates
          if (savedData.start_date) document.getElementById('start_date').value = savedData.start_date;
          if (savedData.end_date) document.getElementById('end_date').value = savedData.end_date;
          if (savedData.date_range) document.getElementById('date-range').value = savedData.date_range;

          // Restore guest counts
          if (savedData.infants !== undefined) document.getElementById('infants-count').value = savedData.infants;
          if (savedData.adults !== undefined) document.getElementById('adults-count').value = savedData.adults;
          if (savedData.children !== undefined) document.getElementById('children-count').value = savedData.children;

          // Restore children ages if any
          if (savedData.childrenAges && Array.isArray(savedData.childrenAges)) {
              setTimeout(() => {
                  updateChildAgeDropdown(savedData.children); // Ensure age dropdowns rendered first
                  savedData.childrenAges.forEach((age, index) => {
                      const select = document.getElementById(`child-age-${index}`);
                      if (select) select.value = age;
                  });
              }, 100);
          }
      }

      // Save on form submit
      form.addEventListener('submit', function (e) {
          // You can optionally prevent default for testing without server
          // e.preventDefault();

          const data = {
              city_id: form.city_id?.value,
              start_date: document.getElementById('start_date').value,
              end_date: document.getElementById('end_date').value,
              date_range: document.getElementById('date-range').value,
              infants: document.getElementById('infants-count').value,
              adults: document.getElementById('adults-count').value,
              children: document.getElementById('children-count').value,
              childrenAges: []
          };

          // Collect child age dropdowns
          const ageDropdowns = document.querySelectorAll('#children-ages select');
          ageDropdowns.forEach((dropdown) => {
              data.childrenAges.push(dropdown.value);
          });

          localStorage.setItem(formKey, JSON.stringify(data));
      });
  });

  // Optional: Update children age dropdowns on count change
  function updateChildren(delta) {
      const countInput = document.getElementById('children-count');
      let count = parseInt(countInput.value) || 0;
      count = Math.max(0, count + delta);
      countInput.value = count;

      updateChildAgeDropdown(count);
  }

  function updateChildAgeDropdown(count) {
      const container = document.getElementById('children-ages');
      const label = document.getElementById('children-age-label');

      // Preserve existing selected values
      const previousValues = [];
      container.querySelectorAll('select').forEach((sel) => previousValues.push(sel.value));

      container.innerHTML = ''; // Clear old

      if (count > 0) {
        label.style.display = 'block';
        for (let i = 0; i < count; i++) {
          const select = document.createElement('select');
          select.id = `child-age-${i}`;
          select.name = `child_age_${i}`;
          select.classList.add('child-age-select');
          for (let age = 0; age <= 17; age++) {
            const option = document.createElement('option');
            option.value = age;
            option.textContent = `${age} years`;
            select.appendChild(option);
          }

          if (previousValues[i] !== undefined) {
            const prev = previousValues[i];
            const opt = Array.from(select.options).find(o => o.value == prev);
            if (opt) select.value = prev;
          }

          container.appendChild(select);
        }
      } else {
        label.style.display = 'none';
      }
  }
</script>





<script>
 document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('filter-form');
  const formKey = 'hotelFormData';

  function updateCityDisplay(cityId) {
  const selectedCityInput = document.querySelector(`input[name="city_id"][value="${cityId}"]`);
  const destinationValueEl = document.getElementById('destination-value');
  if (selectedCityInput && destinationValueEl) {
    const label = selectedCityInput.closest('label'); // assumes city name is in label
    const cityName = label ? label.textContent.trim() : selectedCityInput.dataset.cityName || 'Unknown';
    destinationValueEl.textContent = cityName;
  }
}

  const savedData = JSON.parse(localStorage.getItem(formKey));
  if (savedData) {

    if (savedData.city_id) {
      const selectedCity = document.querySelector(`input[name="city_id"][value="${savedData.city_id}"]`);
      if (selectedCity) {
        selectedCity.checked = true;
        updateCityDisplay(savedData.city_id); // update city name on load
      }
    }

    if (savedData.start_date) document.getElementById('start_date').value = savedData.start_date;
    if (savedData.end_date) document.getElementById('end_date').value = savedData.end_date;
    if (savedData.date_range) document.getElementById('date-range').value = savedData.date_range;

    if (savedData.infants !== undefined) document.getElementById('infants-count').value = savedData.infants;
    if (savedData.adults !== undefined) document.getElementById('adults-count').value = savedData.adults;
    if (savedData.children !== undefined) document.getElementById('children-count').value = savedData.children;

    if (savedData.childrenAges && Array.isArray(savedData.childrenAges)) {
      setTimeout(() => {
        updateChildAgeDropdown(savedData.children);
        savedData.childrenAges.forEach((age, index) => {
          const select = document.getElementById(`child-age-${index}`);
          if (select) select.value = age;
        });
      }, 100);
    }

    // 🧠 Update guest display after restoring data
    updateGuestDisplay();
  }

  // Save on submit
  form.addEventListener('submit', function (e) {
    const data = {
      city_id: form.city_id?.value,
      start_date: document.getElementById('start_date').value,
      end_date: document.getElementById('end_date').value,
      date_range: document.getElementById('date-range').value,
      infants: document.getElementById('infants-count').value,
      adults: document.getElementById('adults-count').value,
      children: document.getElementById('children-count').value,
      childrenAges: []
    };

    const ageDropdowns = document.querySelectorAll('#children-ages select');
    ageDropdowns.forEach((dropdown) => {
      data.childrenAges.push(dropdown.value);
    });

    localStorage.setItem(formKey, JSON.stringify(data));

    // 🧠 Also update guest count before submitting
    updateGuestDisplay();
  });

  // Optional: Live update guest count if user interacts with inputs
  document.getElementById('adults-count').addEventListener('input', updateGuestDisplay);
  document.getElementById('children-count').addEventListener('input', () => {
    updateGuestDisplay();
    updateChildAgeDropdown(parseInt(document.getElementById('children-count').value) || 0);
  });
});
document.querySelectorAll('input[name="city_id"]').forEach(input => {
  input.addEventListener('change', () => {
    updateCityDisplay(input.value);
  });
});
  // Optional: Update children age dropdowns on count change
  function updateChildren(delta) {
    const countInput = document.getElementById('children-count');
    let count = parseInt(countInput.value) || 0;
    count = Math.max(0, count + delta);
    countInput.value = count;

    updateChildAgeDropdown(count);
  }

  function updateChildAgeDropdown(count) {
    const container = document.getElementById('children-ages');
    const label = document.getElementById('children-age-label');
    container.innerHTML = ''; // Clear old

    if (count > 0) {
      label.style.display = 'block';
      for (let i = 0; i < count; i++) {
        const select = document.createElement('select');
        select.id = `child-age-${i}`;
        select.name = `child_age_${i}`;
        for (let age = 0; age <= 17; age++) {
          const option = document.createElement('option');
          option.value = age;
          option.textContent = `${age} years`;
          select.appendChild(option);
        }
        container.appendChild(select);
      }
    } else {
      label.style.display = 'none';
    }
  }

  function updateGuestDisplay() {
  const adults = parseInt(document.getElementById('adults-count')?.value) || 0;
  const children = parseInt(document.getElementById('children-count')?.value) || 0;
  const totalGuests = adults + children;

  const guestValueEl = document.getElementById('guests-value');
  if (guestValueEl) {
    guestValueEl.textContent = `${totalGuests} Guest${totalGuests !== 1 ? 's' : ''}`;
  }
}
</script>


@endsection
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
    margin-right: 6px;
  }
</style>



<div class="header-container_hotels">

  <div class="search-header_hotels">
    <!-- Destination Dropdown -->
    <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
      <div class="filter-label_hotels">Destination</div>
      <div class="filter-value_hotels" id="destination-value"> <input type="text" id="city-search"
          onkeyup="filterCities()" placeholder="Search cities..." class="search-input"></div>
      <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">

        <form action="" method="POST" id="filter-form">
          @csrf

          <!-- Search input added here -->
          <div class="search-container">
            {{-- <input type="text" id="city-search" onkeyup="filterCities()" placeholder="Search cities..."
              class="search-input"> --}}
          </div>


          {{-- <label class="d-flex " class="city-label orSamar" style="
    border-bottom: 1px solid #00000033;     padding: 10px;
">
            <div class="city_list_htotle city-item mb-2">
              <div class="desMund d-flex align-items-center gap-2">
                <div class="sizemaze">
                  <!-- Image representing the city -->
                  <img src="https://cdn-icons-png.flaticon.com/128/535/535239.png" alt="City Image" />
                </div>
                <p class="text-bold text-dark" href="#"><b>{{ $value->city_name ?? 'City name not available' }}</b></p>

                <div class="hotel_place">
                  <!-- Input field for the city selection -->
                  <input type="radio" name="city_id" class="destination-option_hotels opacity-0" onclick>

                  <span class="hotels_spn"></span>
                </div>
              </div>
            </div>
            <p id="no_city">no city found</p>
          </label> --}}

           @foreach($cities as $value)
            <label class="d-flex " for="city_{{ $value->id }}" class="city-label orSamar" style="
    border-bottom: 1px solid #00000033;     padding: 10px;
">
            <div class="city_list_htotle city-item mb-2">
              <div class="desMund d-flex align-items-center gap-2">
              <div class="sizemaze">
                <!-- Image representing the city -->
                <img src="https://cdn-icons-png.flaticon.com/128/535/535239.png" alt="City Image" />
              </div>
              <p class="text-bold text-dark" href="#"><b>{{ $value->city_name ?? 'City name not available' }}</b></p>
              
                <div class="hotel_place">
                    <!-- Input field for the city selection -->
                    <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}" class="destination-option_hotels opacity-0" onclick="selectDestination('{{ $value->city_name }}')">
                    
                    <span class="hotels_spn"></span>
                </div>
                </div>
            </div>
            <p id="no_city">no city found</p>
            </label>
            @endforeach


      </div>
    </div>



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
          <h6>18 Manali Holiday Packages</h6>
          <p>Showing 1-10 packages from 18 packages</p>

        </div>
        <div class="navi_full_list">
<form id="filter-form" action="{{ url('filter-hotels') }}" method="GET">

  <!-- 1. Star Category -->
  <div class="filter-box">
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
  <div class="filter-box">
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
  <div class="filter-box">
    <div class="filter-group">
      <h5>Nearby within Walking Distance</h5>
      @php $nearby = request()->input('nearby', []); @endphp
      <label><input type="checkbox" name="nearby[]" value="Public transport within 1 km" {{ in_array('Public transport within 1 km', $nearby) ? 'checked' : '' }}> Public transport within 1 km</label><br>
      <label><input type="checkbox" name="nearby[]" value="Shopping centers within 1 km" {{ in_array('Shopping centers within 1 km', $nearby) ? 'checked' : '' }}> Shopping centers within 1 km</label><br>
    </div>
  </div>

  <!-- 4. Locality -->
  <div class="filter-box">
    <div class="filter-group">
      <h5>Locality</h5>
      @php $localities = request()->input('locality', []); @endphp
      <label><input type="checkbox" name="locality[]" value="Other Popular Areas" {{ in_array('Other Popular Areas', $localities) ? 'checked' : '' }}> Other Popular Areas</label><br>
      <label><input type="checkbox" name="locality[]" value="Near Popular Attractions" {{ in_array('Near Popular Attractions', $localities) ? 'checked' : '' }}> Near Popular Attractions</label><br>
      <label><input type="checkbox" name="locality[]" value="Near Transit Hub(s)" {{ in_array('Near Transit Hub(s)', $localities) ? 'checked' : '' }}> Near Transit Hub(s)</label><br>
    </div>
  </div>

  <!-- 5. Price -->
  <div class="filter-box">
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
  <div class="filter-box">
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

  <!-- Submit -->
  <div class="d-flex justify-content-center ">
    <button class="mt-2 _btn" type="submit">Apply Filter</button>
     <a href="{{ url('filter-hotels') }}" class="mt-2 ms-2 _btn btn-danger">Clear Filters</a>
  </div>

</form>





        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">

          @if($hotels)
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
                  @if($hotelPrice)
                  ₹{{ number_format($hotelPrice->night_cost ?? 0, 2) }} onwards
                  @else
                  Price Not Available
                  @endif
                </div>

                <div class="gradient-overlayashEs"></div>
                <div class="contentashEs">

                  <h3>{{ \Illuminate\Support\Str::limit($value->name ?? '', 30) }}</h3>

                  <div class="itineraryashEs">
                    <span>{{ $value->cities->city_name ?? '' }}</span>
                    <span>⭐️⭐️⭐️⭐️⭐️ (2 reviews)</span>
                  </div>

                  <div class="detailsashEs">
                    <div class="durationashEs">
                      <span>All Inclusive</span>
                    </div>
                    <div class="locationashEs">
                      <span>📍 {{ $value->name ?? '' }}</span>
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
          @endif

        </div>
      </div>
    </div>
</section>


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
  document.addEventListener('DOMContentLoaded', function () {
    const picker = new Litepicker({
      element: document.getElementById('date-range'),
      singleMode: false,
      numberOfMonths: 2,
      numberOfColumns: 2,
      format: 'MM-DD-YYYY',
      autoApply: true,
      showTooltip: true,
      tooltipText: {
        one: 'day',
        other: 'days'
      },
      setup: (picker) => {
        picker.on('selected', (date1, date2) => {
          document.getElementById('start_date').value = date1.format('MM-DD-YYYY');
          document.getElementById('end_date').value = date2.format('MM-DD-YYYY');
        });

        // Add labels after calendar is rendered
        picker.on('render', () => {
          const months = picker.ui.querySelectorAll('.container__months > .month-item');
          if (months.length === 2) {
            months[0].insertAdjacentHTML('afterbegin', '<div class="month-label" style="text-align:center; font-weight:bold; padding:5px;">Start Date</div>');
            months[1].insertAdjacentHTML('afterbegin', '<div class="month-label" style="text-align:center; font-weight:bold; padding:5px;">End Date</div>');
          }
        });
      }
    });
  });
</script>

@endsection
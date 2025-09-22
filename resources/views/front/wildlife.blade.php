@extends('front.common.app')
@section('title', 'home')
@section('content')


  <style>
    .alocate_hotel{
      background-color: #fff;
    }
    .search-container {
    margin-bottom: 10px;
    padding: 5px;
    }

    .search-input {
    opacity: 1 !important;
    width: 100%;
    /* padding: 8px; */
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    }

    .city_list_htotle {
    display: block;
    }

     .search-container {
    margin-bottom: 10px;
    padding: 5px;
  }

  .search-input {
    opacity: 1 !important;
    width: 100%;
    /* padding: 8px; */
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .city-item {
    display: block;
  }
  #no_city{
    display: none;
  }
  .orSamar{
    
  }

  /* Wildlife Section Styles */
.itachi-wildlife {
  display: flex;
  justify-content: space-between;
  gap: 30px;
  padding: 40px 0;
}

.itachi-item {
  display: flex;
  align-items: center;
  gap: 15px;
  flex: 1;
}

.itachi-icon {
  width: 50px;
  height: 50px;
  object-fit: contain;
}

.itachi-text h3 {
  font-size: 16px;
  font-weight: bold;
  margin: 0 0 8px 0;
}

.itachi-text p {
  font-size: 14px;
  line-height: 1.5;
  margin: 0;
  color: #555;
}
.itachi-text {
    text-align: left;
}

  </style>

  <section class="wildlife_tallimala jets">
    <div class="header-container_hotels">
    <div class="search-header_hotels">
      <!-- Destination Dropdown -->

      <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
        <div class="filter-label_hotels">Destination</div>
        <div class="filter-value_hotels" id="destination-value"> <input type="text" id="city-search" onkeyup="filterCities()" placeholder="Search cities..." class="search-input"></div>
        <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">
          
          <form action="" method="POST" id="filter-form">
            @csrf
            
            <!-- Search input added here -->
            <div class="search-container">
              {{-- <input type="text" id="city-search" onkeyup="filterCities()" placeholder="Search cities..." class="search-input"> --}}
            </div>
            
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
              <p class="text-bold text-dark" href="#"><b>{{ $value->state_name ?? 'City name not available' }}</b></p>
              
                <div class="hotel_place">
                    <!-- Input field for the city selection -->
                    <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}" class="destination-option_hotels opacity-0" onclick="selectDestination('{{ $value->state_name }}')">
                    
                    <span class="hotels_spn"></span>
                </div>
                </div>
            </div>
            <p id="no_city">no city found</p>
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

        <!-- Add search input -->


        <!-- Container for city list -->
        <div id="city-list-container">
          @foreach($cities as $value)
          <div class="city_list_htotle" data-city-name="{{ strtolower($value->city_name ?? '') }}">
          <div class="sizemaze">
            <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}" alt="City Image" />
          </div>
          <div class="hotel_place">
            <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}"
            class="destination-option_hotels" onclick="selectDestination('{{ $value->id }}')">
            <label for="city_{{ $value->id }}" class="city-label">{{ $value->city_name ?? 'City name not
            available' }}</label>
            <span class="hotels_spn"></span>
          </div>
          </div>
          @endforeach
        </div>

      </div>
      </div> --}}

      <!-- Check-in Date -->
      {{-- <div class="filter-item_hotels sachi">
      <div class="filter-label_hotels">Date</div>
      <input type="date" class="filter-value_hotels">
      </div> --}}

      <!-- Check-out Date -->

      <!-- Timing Dropdown -->
      <div class="filter-item_hotels sachi" onclick="toggleDropdown('timing')">
      <div class="filter-label_hotels">Time</div>
      <div class="filter-value_hotels" id="timing-value">Select Time</div>
      <div class="dropdown_hotels timing-dropdown_hotels w-100" id="timing-dropdown">
        <div class="time_list_hotels">
        <div class="brit_life" onclick="selectTimingss('morning')">
          <div class="ujale">
          <img src="{{ asset('frontend/images/sunrise.png') }}" alt="" style="width: 40px;">
          </div>
          <div class="time-option_hotels" >Morning</div>
        </div>
        <div class="brit_life mt-3" onclick="selectTimingss('evening')">
          <div class="ujale">
          <img src="{{ asset('frontend/images/moon.png') }}" alt="" style="width: 30px;">
          </div>
          <div class="time-option_hotels" >Evening</div>
        </div>
        <div class="brit_life mt-3" onclick="selectTimingss('afternoon')">
          <div class="ujale">
          <img src="{{ asset('frontend/images/sunrise.png') }}" alt="" style="width: 30px;">
          </div>
          <div class="time-option_hotels" >After-noon</div>
        </div>
        </div>
      </div>
      <!-- Hidden input field to store the selected time -->
      <input type="hidden" name="time" id="time-input">
      </div>


      <!-- Guests Dropdown -->
      <div class="filter-item_hotels sachi" onclick="toggleDropdown('guests')">
      <div class="filter-label_hotels">Guests</div>

      <div class="filter-value_hotels" id="guests-value">1 guest</div>

      <div class="dropdown_hotels guests-dropdown_hotels" id="guests-dropdown">
        <div class="guest-option_hotels">
        <label>Adults</label>
        <div class="counter_hotels">
          <button type="button" onclick="updateGuests('adults', -1)">-</button>
          <input type="number" id="adults-count" value="1" min="1">
          <button type="button" onclick="updateGuests('adults', 1)">+</button>
        </div>
        </div>
        {{-- <div class="guest-option_hotels">
        <label>Children</label>
        <div class="counter_hotels">
          <button type="button" onclick="updateGuests('children', -1)">-</button>
          <input type="number" id="children-count" value="1" min="1">
          <button type="button" onclick="updateGuests('children', 1)">+</button>
        </div>
        </div> --}}
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
          Search
        {{-- <a href="#"> --}}
          {{-- <img src="{{ asset('frontend/images/searchblue.png') }}" alt="" style="width: 80%;"> --}}
          {{-- </a> --}}
        </div>
      </div>
      </button>

      </form>

    </div>
    </div>
  </section>


  @if($slider)
    <div id="responsive-slider" class="splide" style="background: #ffd600">
    <div class="layie">
    
    </div>
    <div class="splide__track">

    <ul class="splide__list">
      @foreach ($slider as $value)
      <li class="splide__slide">
      <picture>
      <source media="(min-width: 1200px)" srcset="{{ asset($value->image) }}">
      <source media="(min-width: 768px)" srcset="{{ asset($value->image) }}">
      <source media="(max-width: 767px)" srcset="{{ asset($value->image) }}">
      <img class="chats" style="border-radius: 0;" src="{{ asset($value->image) }}" alt="Responsive Banner">
      </picture>
      </li>
    @endforeach


      {{-- <li class="splide__slide">
      <picture>
      <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/banne.png') }}">
      <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/banne.png') }}">
      <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
      <img style="border-radius: 0;" src="{{ asset('frontend/images/banner/fallback_.png') }}"
      alt="Responsive Banner 2">
      </picture>
      </li> --}}
      <!-- Add more slides as needed -->
    </ul>
    </div>
    </div>
  @endif

  <section class="_hotels_filters ">
    <div class="container">


    <div class="row" id="hotel-cards-container">


      @foreach ($wildlife as $key => $value)
      <div class="col-lg-3 mt-3 mb-4">
      <div class="alocate_hotel">
      <!-- Splide Slider -->
      <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
        @php
      // Assuming the 'image' field is stored as a JSON string
      $images = json_decode($value->image); // Decode JSON to array
      @endphp

        @if($images && is_array($images)) <!-- Check if images is not null and is an array -->
        @foreach($images as $image)
      <li class="splide__slide new_lave">
      <img src="{{ asset($image) }}" alt="Image">
      </li>
      @endforeach
      @else
      <p>No images available.</p>
      @endif
        </ul>
      </div>
      </div>
      <a href="{{ route('wildlife_detail', ['id' => base64_encode($value->id)]) }}">
      <div class="alocate_title_data">
        <div class="ttiel_head">
        <h4 class="size">{{ $value->national_park ?? '' }}</h4>
        <h4 class="key">{{ $value->timings ?? '' }}</h4>
        <h4 class="path key">{{ $value->date ?? '' }}</h4>
        <h4 class="seeve size">₹{{ $value->cost ?? '0' }}</h4>
        </div>
      </div>
      </a>
      </div>
      </div>
    @endforeach

    </div>


    </div>
  </section>


<div class="seprate_section">
<section class="steps-section">
  <div class="container">
    {{-- <h2 class="steps-title">Make 4 steps to rent a cab</h2> --}}
    
    <!-- Wildlife Section -->
<section class="itachi-wildlife">
  <div class="row">
    <div class="col-lg-4"> <div class="itachi-item">
    <img src="https://bookwildlifesafari.com/assets/icons/EXTRAORDINARY-ADVENTURES.png" alt="Wildlife Adventure Icon" class="itachi-icon">
    <div class="itachi-text">
      <h3>EXTRAORDINARY ADVENTURES</h3>
      <p>Trip Dekho, is your gateway to extraordinary adventures, and exquisite safari experiences.</p>
    </div>
  </div></div>
    <div class="col-lg-4"> <div class="itachi-item">
    <img src="https://bookwildlifesafari.com/assets/icons/travel-with-a-purpose.png" alt="Travel Purpose Icon" class="itachi-icon">
    <div class="itachi-text">
      <h3>TRAVEL WITH A PURPOSE</h3>
      <p>At Trip Dekho, we are committed toward conserving nature & empowering local communities.</p>
    </div>
  </div></div>
    <div class="col-lg-4"> <div class="itachi-item">
    <img src="https://bookwildlifesafari.com/assets/icons/24-7-support.png" alt="Support Icon" class="itachi-icon">
    <div class="itachi-text">
      <h3>24 x 7 SUPPORT</h3>
      <p>Round-the-clock local assistance over Phone, WhatsApp, Email to address any travel needs or emergencies.</p>
    </div>
  </div></div>
  </div>
 

 

 
</section>

  </div>  
</section>
</div>

<section class="last_fest">
  
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
    function selectTimingss(time) {
    // Update the timing value in the div
    document.getElementById('timing-value').innerText = time;

    // Update the value in the hidden input field
    document.getElementById('time-input').value = time;

    // Optionally, close the dropdown after selection
    toggleDropdown('timing');  // Uncomment if you want to close the dropdown after selection
    }

    document.getElementById('filter-form').onsubmit = function (event) {
    event.preventDefault(); // Prevents the form from submitting the default way

    // Get the selected city_id (radio button)
    const city_id = document.querySelector('input[name="city_id"]:checked'); // Get selected radio button

    if (city_id) {
      // If a city is selected, get the value
      const cityValue = city_id.value;

      // Get the selected time value from the hidden input
      const timing_value = document.getElementById('time-input').value;

      if (timing_value) {
      // Construct the URL with the selected city and time parameters
      const actionUrl = '{{ route("filtersafari") }}'; // The URL where you want to send the request (using GET method)
      const finalUrl = `${actionUrl}?city_id=${cityValue}&time=${timing_value}`; // Final URL with parameters

      // Redirect to the new URL with parameters
      window.location.href = finalUrl;
      } else {
      // If no time is selected, show a prompt
      alert("Please select a time.");
      }
    } else {
      // If no city is selected, show a prompt or error message
      alert("Please select a city.");
    }
    };

  </script>


<script>
function filterCities() {
  const searchQuery = document.getElementById('city-search').value.toLowerCase();
  const cityItems = document.querySelectorAll('.city-item');
  
    let matchFound = false;

  cityItems.forEach(function(item) {
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


@endsection
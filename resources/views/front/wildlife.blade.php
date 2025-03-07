@extends('front.common.app')
@section('title','home')
@section('content')

<section class="wildlife_tallimala">
<div class="header-container_hotels">
    <div class="search-header_hotels">
      <!-- Destination Dropdown -->
      <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
        <div class="filter-label_hotels">State</div>
        <div class="filter-value_hotels" id="destination-value">Choose the state?</div>
        <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">
          <div class="city_list_htotle">
              <div class="sizemaze">
                <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}" alt="">
              </div>
              <div class="hotel_place">

                <div class="destination-option_hotels" onclick="selectDestination('Rajasthan')">Rajasthan</div>
                <span class="hotels_spn">Paradise in Rajasthan</span>
              </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/sdds.webp') }}" alt="">
          </div>
          <div class="hotel_place">
            
            <div class="destination-option_hotels" onclick="selectDestination('Gujrat')">Gujrat</div>
            <span class="hotels_spn">Great Infrastructure</span>
          </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/amem.webp') }}" alt="">
          </div>
          <div class="hotel_place">
            <div class="destination-option_hotels" onclick="selectDestination('Delhi')">Delhi</div>
            <span class="hotels_spn">The most Beautifull</span>
          </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/dd61b8e6-7fa1-46d7-9284-7f3977e5da31.webp') }}" alt="">
          </div>
          <div class="hotel_place">
          <div class="destination-option_hotels" onclick="selectDestination('U.P')">U.P</div>
            <span class="hotels_spn">Heaven in Desert</span>
          </div>
          </div>

          
          
        </div>
      </div>

      <!-- Check-in Date -->
      <div class="filter-item_hotels sachi">
        <div class="filter-label_hotels">Date</div>
        <input type="date" class="filter-value_hotels">
      </div>

      <!-- Check-out Date -->
      
      <!-- Timing Dropdown -->
<div class="filter-item_hotels sachi" onclick="toggleDropdown('timing')">
    <div class="filter-label_hotels">Time</div>
    <div class="filter-value_hotels" id="timing-value">Select Time</div>
    <div class="dropdown_hotels timing-dropdown_hotels w-100" id="timing-dropdown">
        <div class="time_list_hotels">
          <div class="brit_life">
            <div class="ujale">
              <img src="{{ asset('frontend/images/sunrise.png') }}" alt="" style="width: 40px;">
            </div>
            <div class="time-option_hotels" onclick="selectTiming('Morning')">Morning</div>
          </div>
          <div class="brit_life mt-3">
            <div class="ujale">
              <img src="{{ asset('frontend/images/moon.png') }}" alt="" style="width: 30px;">
            </div>
            <div class="time-option_hotels" onclick="selectTiming('Evening')">Evening</div>
          </div>
          </div>
    </div>
</div>

      <!-- Guests Dropdown -->
      <div class="filter-item_hotels sachi" onclick="toggleDropdown('guests')">
        <div class="filter-label_hotels">Guests</div>
        
          <div class="filter-value_hotels" id="guests-value">1 guest</div>
        
        <div class="dropdown_hotels guests-dropdown_hotels" id="guests-dropdown">
          <div class="guest-option_hotels">
            <label>Adults</label>
            <div class="counter_hotels">
              <button onclick="updateGuests('adults', -1)">-</button>
              <input type="number" id="adults-count" value="1" min="1">
              <button onclick="updateGuests('adults', 1)">+</button>
            </div>
          </div>
          <div class="guest-option_hotels">
            <label>Children</label>
            <div class="counter_hotels">
              <button onclick="updateGuests('children', -1)">-</button>
              <input type="number" id="children-count" value="1" min="1">
              <button onclick="updateGuests('children', 1)">+</button>
            </div>
          </div>
          <div class="guest-option_hotels">
            <label>Infants</label>
            <div class="counter_hotels">
              <button onclick="updateGuests('infants', -1)">-</button>
              <input type="number" id="infants-count" value="1" min="1">
              <button onclick="updateGuests('infants', 1)">+</button>
            </div>
          </div>
        </div>
      </div>

      <div class="search_sba">
        <div class="sba_center_Sarch">
        <a href="#">  
        <img src="http://127.0.0.1:8000/frontend/images/searchblue.png" alt="" style="
    width: 80%;
">
        </a>  
      </div>
      </div>
    </div>
  </div>
</section>


@if($slider)
<div id="responsive-slider" class="splide" style="background: #ffd600">
  <div class="layie">
    {{-- <h1>Plan Your Travel Now!</h1>
                      <p>650+ Travel Agents serving 65+ Destinations worldwide</p> --}}
                    </div>  
<div class="splide__track">
    
      <ul class="splide__list">
        @foreach ($slider as $value)
        <li class="splide__slide">
          <picture>
              <source media="(min-width: 1200px)" srcset="{{ asset($value->image) }}">
              <source media="(min-width: 768px)" srcset="{{ asset($value->image) }}">
              <source media="(max-width: 767px)" srcset="{{ asset($value->image) }}">
              <img style="border-radius: 0;" src="{{ asset($value->image) }}" alt="Responsive Banner">
          </picture>
      </li>
        @endforeach
       
          
          {{-- <li class="splide__slide"> 
              <picture>
                  <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/banne.png') }}">
                  <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/banne.png') }}">
                  <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
                  <img style="border-radius: 0;" src="{{ asset('frontend/images/banner/fallback_.png') }}" alt="Responsive Banner 2">
              </picture>
          </li> --}}
          <!-- Add more slides as needed -->
      </ul>
  </div>
</div>
@endif

<section class="_hotels_filters">
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
      
                          @if($images && is_array($images))  <!-- Check if images is not null and is an array -->
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
                          <h4 class="size">{{ $value->national_park	 ?? '' }}</h4>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#responsive-slider', {
        type      : 'loop', // Makes the slider loop
        perPage   : 1,      // One slide per view
        autoplay  : true,   // Auto-slide
        interval  : 3000,   // Interval for autoplay
        breakpoints: {
            768: {
                perPage: 1,
            },
        },
    }).mount();
});

</script>

@endsection
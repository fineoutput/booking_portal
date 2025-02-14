@extends('front.common.app')
@section('title','home')
@section('content')


  <div class="header-container_hotels">
    <div class="search-header_hotels">
      <!-- Destination Dropdown -->
      <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
        <div class="filter-label_hotels">Destination</div>
        <div class="filter-value_hotels" id="destination-value">Where are you going?</div>
        <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">
          <div class="city_list_htotle">
              <div class="sizemaze">
                <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}" alt="">
              </div>
              <div class="hotel_place">

                <div class="destination-option_hotels" onclick="selectDestination('Jaipur')">Jaipur</div>
                <span class="hotels_spn">Paradise in Rajasthan</span>
              </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/sdds.webp') }}" alt="">
          </div>
          <div class="hotel_place">
            
            <div class="destination-option_hotels" onclick="selectDestination('Jodhpur')">Jodhpur</div>
            <span class="hotels_spn">Great Infrastructure</span>
          </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/amem.webp') }}" alt="">
          </div>
          <div class="hotel_place">
            <div class="destination-option_hotels" onclick="selectDestination('Udaipur')">Udaipur</div>
            <span class="hotels_spn">The most Beautifull</span>
          </div>
          </div>
          <div class="city_list_htotle">
          <div class="sizemaze">
                <img src="{{ asset('frontend/images/dd61b8e6-7fa1-46d7-9284-7f3977e5da31.webp') }}" alt="">
          </div>
          <div class="hotel_place">
          <div class="destination-option_hotels" onclick="selectDestination('Jaisalmer')">Jaisalmer</div>
            <span class="hotels_spn">Heaven in Desert</span>
          </div>
          </div>

          
          
        </div>
      </div>

      <!-- Check-in Date -->
      <div class="filter-item_hotels sachi">
        <div class="filter-label_hotels">Check in</div>
        <input type="date" class="filter-value_hotels">
      </div>

      <!-- Check-out Date -->
      <div class="filter-item_hotels sachi">
        <div class="filter-label_hotels">Check out</div>
        <input type="date" class="filter-value_hotels">
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
              <span id="adults-count">1</span>
              <button onclick="updateGuests('adults', 1)">+</button>
            </div>
          </div>
          <div class="guest-option_hotels">
            <label>Children</label>
            <div class="counter_hotels">
              <button onclick="updateGuests('children', -1)">-</button>
              <span id="children-count">0</span>
              <button onclick="updateGuests('children', 1)">+</button>
            </div>
          </div>
          <div class="guest-option_hotels">
            <label>Infants</label>
            <div class="counter_hotels">
              <button onclick="updateGuests('infants', -1)">-</button>
              <span id="infants-count">0</span>
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


  <section class="_hotels_filters">
    <div class="container">
      <div class="row">
      <div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/first.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>

<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
   <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a> 
  </div>
</div>
<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fifth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>
<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/sixth.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/first.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>

      </div>
  <hr>
      <div class="row">
      <div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>
<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>
<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>
<div class="col-lg-3">
  <div class="alocate_hotel">
    <!-- Splide Slider -->
    <div class="splide alocate_slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide new_lave">
            <img src="frontend/images/third.avif" alt="Image 1">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/secound.avif" alt="Image 2">
          </li>
          <li class="splide__slide new_lave">
            <img src="frontend/images/fourth.avif" alt="Image 3">
          </li>
        </ul>
      </div>
    </div>
    <a href="{{ route('hotel_details') }}">
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
    </a>
  </div>
</div>
      </div>
    </div>
  </section>


@endsection
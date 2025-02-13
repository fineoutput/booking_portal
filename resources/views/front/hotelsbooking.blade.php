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
          
          <div class="destination-option_hotels" onclick="selectDestination('New York')">New York</div>
          <div class="destination-option_hotels" onclick="selectDestination('Paris')">Paris</div>
          <div class="destination-option_hotels" onclick="selectDestination('Tokyo')">Tokyo</div>
          <div class="destination-option_hotels" onclick="selectDestination('London')">London</div>
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
        <img src="http://127.0.0.1:8000/frontend/images/search.png" alt="" style="
    width: 80%;
">
        </a>  
      </div>
      </div>
    </div>
  </div>


  <section class="_hotels_filters">
    <div class="container-fluid">
      <div class="row">
      <div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-2">
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
    <div class="alocate_title_data">
      <div class="ttiel_head">
        <h4 class="size">Mashroop, India</h4>
        <h4 class="key">Mountain Views</h4>
        <h4 class="path key">13-18 Feb</h4>
        <h4 class="seeve size">₹18,806 night</h4>
      </div>
    </div>
  </div>
</div>
      </div>
    </div>
  </section>
<script>
     // Toggle dropdowns
     function toggleDropdown(type) {
      const dropdowns = document.querySelectorAll('.dropdown_hotels');
      dropdowns.forEach(dropdown => dropdown.classList.remove('active'));

      const dropdown = document.querySelector(`.${type}-dropdown_hotels`);
      if (dropdown) {
        dropdown.classList.toggle('active');
      }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
      const dropdowns = document.querySelectorAll('.dropdown_hotels');
      dropdowns.forEach(dropdown => {
        if (!dropdown.contains(event.target) && !event.target.closest('.filter-item_hotels')) {
          dropdown.classList.remove('active');
        }
      });
    });

    // Update destination value when a city is selected
    function selectDestination(city) {
      document.getElementById('destination-value').textContent = city;
      console.log(city, 'this is the selected');
      
      // Close the destination dropdown
      document.getElementById('destination-dropdown').classList.remove('active');
    }

    // Update guests value
    let guests = {
      adults: 1,
      children: 0,
      infants: 0
    };

    function updateGuests(type, delta) {
      guests[type] = Math.max(0, guests[type] + delta);
      document.getElementById(`${type}-count`).textContent = guests[type];

      const totalGuests = guests.adults + guests.children;
      document.getElementById('guests-value').textContent =
        `${totalGuests} guest${totalGuests !== 1 ? 's' : ''}`;
    }



  document.addEventListener('DOMContentLoaded', function () {
    var sliders = document.querySelectorAll('.alocate_slider');
    
    sliders.forEach(function (slider) {
      new Splide(slider, {
        type: 'fade', // or 'loop' for infinite scroll
        perPage: 1,
        autoplay: true,
        interval: 3000, // 3 seconds delay
        arrows: false, 
        pagination: true,
      }).mount();
    });
  });

</script>

@endsection
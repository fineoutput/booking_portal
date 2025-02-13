@extends('front.common.app')
@section('title','home')
@section('content')


  <div class="header-container_hotels">
    <div class="search-header_hotels">
      <!-- Destination Dropdown -->
      <div class="filter-item_hotels" onclick="toggleDropdown('destination')">
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
      <div class="filter-item_hotels">
        <div class="filter-label_hotels">Check in</div>
        <input type="date" class="filter-value_hotels">
      </div>

      <!-- Check-out Date -->
      <div class="filter-item_hotels">
        <div class="filter-label_hotels">Check out</div>
        <input type="date" class="filter-value_hotels">
      </div>

      <!-- Guests Dropdown -->
      <div class="filter-item_hotels" onclick="toggleDropdown('guests')">
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
    </div>
  </div>

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
</script>

@endsection
@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .search-container {
    margin-bottom: 10px;
    padding: 5px;
  }

  .search-input {
    opacity: 1 !important;
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .city-item {
    display: block;
  }
</style>


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
            <div class="city_list_htotle city-item d-flex mb-2">
                <div class="sizemaze">
                    <!-- Image representing the city -->
                    <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}" alt="City Image" />
                </div>
                <div class="hotel_place">
                    <!-- Input field for the city selection -->
                    <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}" class="destination-option_hotels" onclick="selectDestination('{{ $value->city_name }}')">
                    <label for="city_{{ $value->id }}" class="city-label">{{ $value->city_name ?? 'City name not available' }}</label>
                    <span class="hotels_spn"></span>
                </div>
            </div>
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
                    <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}" class="destination-option_hotels" onclick="selectDestination('{{ $value->id }}')">
                    <label for="city_{{ $value->id }}" class="city-label">{{ $value->city_name ?? 'City name not available' }}</label>
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
              <button type="button" onclick="updateGuests('children', -1)">-</button>
              <input type="number" id="children-count" value="1" min="1">
              <button type="button" onclick="updateGuests('children', 1)">+</button>
            </div>
          </div>
          <div class="guest-option_hotels">
            <label>No. of Rooms</label>
            <div class="counter_hotels">
              <button type="button" onclick="updateGuests('infants', -1)">-</button>
              <input type="number" id="infants-count" value="1" min="1">
              <button type="button" onclick="updateGuests('infants', 1)">+</button>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" style="border: none; background: none;">
      <div class="search_sba">
        <div class="sba_center_Sarch">
        <a href="#">  
        <img src="{{ asset('frontend/images/searchblue.png') }}" alt="" style="width: 80%;">
        </a>  
      </div>
      </div>
    </button>

    </form>

    </div>
  </div>

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
                <img class="chats" style="border-radius: 0;" src="{{ asset($value->image) }}" alt="Responsive Banner">
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
    <div class="row" >
      
      @foreach ($hotel as $key => $value)     
      <div class="col-lg-3 mt-3 mb-4">
          <div class="alocate_hotel">
              <!-- Splide Slider -->
              <div class="splide alocate_slider">
                  <div class="splide__track">
                      <ul class="splide__list">
                          @php
                              $images = json_decode($value->images); 
                          @endphp
      
                          @if($images && is_array($images))  
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
              <a href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">
                  <div class="alocate_title_data">
                      <div class="ttiel_head">
                        <h4 class="path key">{{ $value->name ?? '' }}</h4>
                          <h4 class="size">{{ $value->hotel_category	 ?? '' }}</h4>
                          <h4 class="key">{{ $value->location ?? '' }}</h4>
                          @php
                          // Fetch price for the current hotel
                          $hotelPrice = $hotel_prices[$value->id] ?? null;
                      @endphp

                      <h4 class="key">
                          @if($hotelPrice)
                              ₹{{ $hotelPrice->night_cost ?? '0' }}
                          @else
                              Price Not Available
                          @endif
                      </h4>
                          {{-- <h4 class="seeve size">₹{{ $value->cost ?? '0' }}</h4> --}}
                      </div>
                  </div>
              </a>
          </div>
      </div>
      @endforeach

    </div>
    <hr>
    
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const picker = new Litepicker({
      element: document.getElementById('date-range'),
      singleMode: false,
      numberOfMonths: 2,
      numberOfColumns: 2,
      format: 'YYYY-MM-DD',
      autoApply: true,
      showTooltip: true,
      tooltipText: {
        one: 'day',
        other: 'days'
      },
      setup: (picker) => {
        picker.on('selected', (date1, date2) => {
          document.getElementById('start_date').value = date1.format('YYYY-MM-DD');
          document.getElementById('end_date').value = date2.format('YYYY-MM-DD');
        });
      }
    });
  });
</script>

<script>
 
  const hotels = [
    {
      images: [
        "https://i.pinimg.com/736x/9a/e7/e1/9ae7e14bc932239dbebb83de85dc989b.jpg",
        "https://i.pinimg.com/736x/9a/e7/e1/9ae7e14bc932239dbebb83de85dc989b.jpg",
        "https://i.pinimg.com/736x/9a/e7/e1/9ae7e14bc932239dbebb83de85dc989b.jpg"
      ],
      title: "Mashroop, India",
      subtitle: "Mountain Views",
      date: "13-18 Feb",
      price: "₹18,806 night",

    },
    {
      images: [
        "frontend/images/third.avif",
        "frontend/images/secound.avif",
        "frontend/images/fourth.avif"
      ],
      title: "Mashroop, India",
      subtitle: "Mountain Views",
      date: "13-18 Feb",
      price: "₹18,806 night",

    },
    {
      images: [
        "frontend/images/fourth.avif",
        "frontend/images/secound.avif",
        "frontend/images/fifth.avif"
      ],
      title: "Mashroop, India",
      subtitle: "Mountain Views",
      date: "13-18 Feb",
      price: "₹18,806 night",

    },
    {
      images: [
        "frontend/images/sixth.avif",
        "frontend/images/secound.avif",
        "frontend/images/first.avif"
      ],
      title: "Mashroop, India",
      subtitle: "Mountain Views",
      date: "13-18 Feb",
      price: "₹18,806 night",

    }
    
  ];


  function createHotelCard(hotel) {
    return `
      <div class="col-lg-3">
        <div class="alocate_hotel">
          <!-- Splide Slider -->
          <div class="splide alocate_slider">
            <div class="splide__track">
              <ul class="splide__list">
                ${hotel.images
                  .map(
                    (image, idx) => `
                  <li class="splide__slide new_lave">
                    <img src="${image}" alt="Image ${idx + 1}">
                  </li>
                `
                  )
                  .join("")}
              </ul>
            </div>
          </div>
          <a href="${hotel.route}">
            <div class="alocate_title_data">
              <div class="ttiel_head">
                <h4 class="size">${hotel.title}</h4>
                <h4 class="key">${hotel.subtitle}</h4>
                <h4 class="path key">${hotel.date}</h4>
                <h4 class="seeve size">${hotel.price}</h4>
              </div>
            </div>
          </a>
        </div>
      </div>
    `;
  }


  const container = document.getElementById("hotel-cards-container");
  container.innerHTML = hotels.map(createHotelCard).join("");
</script>

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

{{-- <script>
  // Update form action when form is submitted with dynamic parameters
  document.getElementById('filter-form').onsubmit = function(event) {
      event.preventDefault();
      
      // Get form values
      const city_id = document.getElementById('city_id').value;
      const start_date = document.getElementById('start_date').value;
      const end_date = document.getElementById('end_date').value;

      // Set form action with parameters
      const actionUrl = '{{ route("filterHotels", ["city_id" => "__city_id__", "start_date" => "__start_date__", "end_date" => "__end_date__"]) }}';
      const finalUrl = actionUrl
          .replace('__city_id__', city_id)
          .replace('__start_date__', start_date)
          .replace('__end_date__', end_date);

      // Set the new form action and submit
      document.getElementById('filter-form').action = finalUrl;
      document.getElementById('filter-form').submit();
  };
</script> --}}

<script>
document.getElementById('filter-form').onsubmit = function(event) {
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
  function filterCities() {
    // Get the search query and convert to lowercase
    var searchQuery = document.getElementById('city-search').value.toLowerCase();
    
    // Get all the city items
    var cityItems = document.querySelectorAll('.city-item');
    
    // Loop through the city items and hide those that don't match the search query
    cityItems.forEach(function(item) {
      var cityName = item.querySelector('.city-label').textContent.toLowerCase();
      if (cityName.includes(searchQuery)) {
        item.style.display = 'block'; // Show the city
      } else {
        item.style.display = 'none'; // Hide the city
      }
    });
  }
</script>


@endsection
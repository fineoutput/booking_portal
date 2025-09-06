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




  .app-download-section {
  background: #f9f9f9;
  padding: 40px 20px;
}

.app-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1100px;
  margin: auto;
  gap: 50px;
  flex-wrap: wrap;
}

.app-left img {
  max-width: 300px;
  border-radius: 20px;
}

.app-right h4 {
  color: #888;
  font-size: 16px;
  margin-bottom: 10px;
}

.app-right h2 {
  font-size: 48px;
  line-height: 1.4;
  margin-bottom: 20px;
  font-weight: bold;
}

.app-buttons {
  display: flex;
  align-items: center;
  gap: 20px;
}

.qr-code {
  width: 100px;
  height: 100px;
}

.store-buttons img {
  height: 50px;
  margin-bottom: 10px;
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
         
            

        </ul>
    </div>
</div>
@endif

  <section class="_hotels_filters">
  <div class="container">
    <div class="row" >
      
   {{-- DESKTOP ONLY --}}
<div class="row d-none d-lg-flex">
    @foreach ($hotel as $key => $value)     
        @php
            $images = json_decode($value->images); 
            $hotelPrice = $hotel_prices[$value->id] ?? null;
        @endphp

        <div class="col-lg-3 mt-3 mb-4">
            <div class="alocate_hotel">
                <!-- Splide Slider (still usable inside desktop if needed) -->
                <div class="splide alocate_slider">
                    <div class="splide__track">
                        <ul class="splide__list">
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
                        <h4 class="path key">{{ $value->name ?? '' }}</h4>
                        <h4 class="size">{{ $value->hotel_category ?? '' }}</h4>
                        <div class="ttiel_head">
                            <h4 class="key">{{ $value->location ?? '' }}</h4>
                            <h4 class="key">
                                @if($hotelPrice)
                                    ₹{{ $hotelPrice->night_cost ?? '0' }}
                                @else
                                    Price Not Available
                                @endif
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>


 {{-- MOBILE ONLY --}}
<div class="d-block d-lg-none">
    <div id="mobileHotelSlider" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($hotel as $key => $value)
                    @php
                        $images = json_decode($value->images); 
                        $hotelPrice = $hotel_prices[$value->id] ?? null;
                    @endphp

                    <li class="splide__slide">
                        <div class="alocate_hotel">
                            <div class="splide inner_hotel_slider">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @if($images && is_array($images))  
                                            @foreach($images as $image)
                                                <li class="splide__slide new_lave">
                                                    <img src="{{ asset($image) }}" alt="Image">
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="splide__slide">No images available.</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <a href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">
                                <div class="alocate_title_data">
                                    <h4 class="path key">{{ $value->name ?? '' }}</h4>
                                    <h4 class="size">{{ $value->hotel_category ?? '' }}</h4>
                                    <div class="ttiel_head">
                                        <h4 class="key">{{ $value->location ?? '' }}</h4>
                                        <h4 class="key">
                                             @if($hotelPrice)
                                               ₹{{ $hotelPrice->night_cost ?? '0' }}
                                            @else
                                                Price Not Available
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


    </div>
    <hr>
    
  </div>
</section>
<div class="container">
<section class="app-download-section">
  <div class="app-container">
    <div class="app-left">
      <img src="{{asset('frontend/images/firstaas.png')}}" alt="Mobile App Preview">
    </div>

    <div class="app-right">
      <h4>TRY ON MOBILE</h4>
      <h2>Download our app for<br>unbeatable perks!</h2>

      <div class="app-buttons">
        <img src="{{asset('frontend/images/frame(1).png')}}" alt="QR Code" class="qr-code">
        <div class="store-buttons">
          <a href="#"><img src="{{asset('frontend/images/App_Store_135e41d560.svg')}}" alt="Google Play"></a>
          <a href="#"><img src="{{asset('frontend/images/Google_Play_Store_badge_EN_47acf10f1d.webp')}}" alt="App Store"></a>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
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
  document.addEventListener('DOMContentLoaded', function () {
    // Only for mobile
    if (window.innerWidth < 992) {
      // Main slider with each hotel card as a slide
      new Splide('#mobileHotelSlider', {
        perPage: 1,
        gap: '1rem',
        pagination: true,
        arrows: true,
      }).mount();

      // Inner sliders for images inside each hotel card
      document.querySelectorAll('.inner_hotel_slider').forEach((el) => {
        new Splide(el, {
          type: 'loop',
          perPage: 1,
          pagination: false,
          arrows: false,
        }).mount();
      });
    }
  });
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
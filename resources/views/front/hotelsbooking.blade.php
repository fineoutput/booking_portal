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
                              $images = json_decode($value->image); 
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


@endsection
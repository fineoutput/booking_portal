@extends('front.common.app')
@section('title', 'home')
@section('content')
<style>


    .booking-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
    }

    .booking-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-bottom: 1px solid #e0e0e0;
      padding-bottom: 15px;
      margin-bottom: 15px;
    }

    .booking-header h2 {
      margin: 0;
    }

    .booking-header img {
      width: 120px;
      height: 80px;
      object-fit: cover;
      border-radius: 5px;
    }

    .star-rating {
      color: #f2b01e;
      margin: 5px 0;
    }

    .address {
      font-size: 0.9rem;
      color: #777;
    }

    .booking-dates {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #e0e0e0;
      padding-bottom: 15px;
      margin-bottom: 15px;
    }

    .booking-dates div {
      flex: 1;
    }

    .booking-dates h3 {
      margin: 5px 0;
      font-size: 1.1rem;
    }

    .room-info {
      border-bottom: 1px solid #e0e0e0;
      padding-bottom: 15px;
      margin-bottom: 15px;
    }

    .room-info h3 {
      margin-top: 0;
    }

    .room-info ul {
      list-style-type: disc;
      padding-left: 20px;
      margin: 5px 0;
    }

    .room-info a {
      color: #007bff;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .important-info h4 {
      margin-top: 0;
    }

    .important-info ul {
      list-style-type: disc;
      padding-left: 20px;
      margin: 5px 0;
    }

    .view-more {
      color: #007bff;
      cursor: pointer;
      font-size: 0.9rem;
    }
  </style>
<section class="finalBooking">
    <div class="comp-container">
          <div class="booking-card">
    <div class="booking-header">
      <div>
        <h2>{{$hotel->name ?? ''}}</h2>
        {{-- <div class="star-rating">★★★☆☆</div> --}}
        <div class="address">{{$hotel->location ?? ''}} {{$hotel->state->state_name ?? ''}}, {{$hotel->cities->city_name ?? ''}}</div>
      </div>
      @php
    $images = json_decode($hotel_room_1->images ?? '[]', true);
@endphp

@if (!empty($images) && isset($images[0]))
    <img src="{{ asset($images[0]) }}" alt="Hotel Image" style="max-width:100%; border-radius:8px;">
@else
    <p><em>No image available</em></p>
@endif
    </div>

    <div class="booking-dates" id="bookingDates">
      <div>
        <strong>CHECK IN</strong>
        <h3 id="checkInDate">--</h3>
        {{-- <small>2 PM</small> --}}
      </div>
      <div>
        <strong>CHECK OUT</strong>
        <h3 id="checkOutDate">--</h3>
        {{-- <small>11 AM</small> --}}
      </div>
      <div>
        <strong>Stay Info</strong>
        <h3 id="stayInfo">--</h3>
      </div>
    </div>


  <form action="{{ route('add_hotel_booking',['id'=>$hotel_room_1->id]) }}" method="POST">
        @csrf
        <div class="sharan_side_box">
            <div class="stand_it">
                <div class="outer_box">
                    <div class="inner_box">

                        <siv class="room_check d-flex justify-content-between align-items-center">
                            <div class="inner_price">
                                <span style="color: rgb(106, 106, 106);"><del></del></span>
                                <span id="dynamic-price">₹</span>
                                <span></span>
                            </div>

                        </siv>

                        <div class="checks d-flex">
                            <div class="row" style="width: 100%;">
                                <div class="col-lg-6">
                                    <div class="bors">
                                                    <div class="caranke">
                                                        <label for="">Check In</label>
                                                        <input name="check_in_date" id="check_in_date" type="date"
                                                            class="filter-value_hotels" placeholder="Check In"
                                                            onchange="updateNightCount()" required>
                                                    </div>
                                                    <div class="caranke">
                                                        <label for="">Check Out</label>
                                                        <input name="check_out_date" id="check_out_date" type="date"
                                                            class="filter-value_hotels" placeholder="Check out"
                                                            onchange="updateNightCount()" required>
                                                    </div>
                                                </div>
                          </div>
                                <div class="col-lg-6">
                                    <div class="rivvsa">
                                <div class="filter-item_hotels sachi trnas" onclick="toggleDropdown('guests')">
                                    <div class="filter-label_hotels">Guests</div>
                                    <div class="arrow">
                                        <div class="filter-value_hotels" id="guests-value">1 guest</div>
                                        <img src="{{ asset('frontend/images/down.png') }}" style="width: 20px;" alt="">
                                    </div>
                                    <div class="dropdown_hotels guests-dropdown_hotels" id="guests-dropdown">
                                        <div class="guest-option_hotels">
                                            <label>No. of Rooms</label>
                                            <div class="counter_hotels">
                                                <button type="button" onclick="updateGuestss('infants', -1)">-</button>
                                                <input name="room_count" type="number" id="infants-count" value="0" min="0"
                                                    onchange="updateGuestss()">
                                                <button type="button" onclick="updateGuestss('infants', 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="guest-option_hotels">
                                            <label>Adults</label>
                                            <div class="counter_hotels">
                                                <button type="button" onclick="updateGuestss('adults', -1)">-</button>
                                                <input type="number" id="adults-count" value="1" min="1"
                                                    onchange="updateGuestss()">
                                                <button type="button" onclick="updateGuestss('adults', 1)">+</button>
                                            </div>
                                        </div>



                                        <div class="guest-option_hotels">
                                            <label>Children</label>
                                            <div class="counter_hotels">
                                                <button type="button" onclick="updateGuestss('children', -1)">-</button>
                                                <input type="number" id="children-count" value="0" min="0"
                                                    onchange="updateGuestss()">
                                                <button type="button" onclick="updateGuestss('children', 1)">+</button>
                                            </div>


                                        </div>
                                        <div id="children-age-label"
                                            style="margin-top:10px; display:none; font-weight:600;">
                                            Children age
                                        </div>
                                        <div id="children-ages">
                                            <input type="hidden" name="children_ages_array" id="children-ages-array">

                                        </div>
                                        <div id="premium-fields" class="wast" style=" margin-top:15px;">
                                    <div class="form-group samule">
                                        <label class="filter-label_hotels" for="meals">Meals</label>
                                        <select class="need hato" name="meals" id="meals" class="filter-value_hotels">
                                            <option value="">-- Select --</option>
                                            <option value="breakfast">Breakfast</option>
                                            <option value="breakfast_dinner">Breakfast + Lunch/Dinner
                                            </option>
                                            <option value="all_meals">All Meals</option>
                                            <option value="no_meal">No Meals</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-2 samule">
                                        <label class="filter-label_hotels" for="extra_bed">Extra
                                            Bed</label>
                                        <select class="need hato" name="beds" id="beds" class="filter-value_hotels">
                                            <option value="">-- 0 --</option>

                                            @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}">{{ $i
                                                }}</option>
                                                @endfor
                                        </select>
                                    </div>

                                    <div class="form-group mt-2 samule">
                                        <label class="filter-label_hotels" for="child_no_bed">Child With
                                            No Bed</label>
                                        <select class="need hato" name="nobed" id="nobed" class="filter-value_hotels">
                                            <option value="">-- 0 --</option>

                                            @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}">{{ $i
                                                }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                    </div>
                                </div>

                                
                            </div>
                                </div>
                            </div>
                             
                         

                            <input type="hidden" name="night_count" id="night_count">
                            <input type="hidden" name="total_cost" id="total-cost-input">

                            <input type="hidden" name="guest_count" id="guest_count">
                            <input type="hidden" name="child_count" id="child_count">
                            {{-- <input type="hidden" name="room_count" id="room_count"> --}}
                        </div>


                        <div class="live_set mt-3">
                            @if(Auth::guard('agent')->check())
                            <button type="submit" class="btn btn-info gggsd">
                                Reserve
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
       
  </form> 
  
    <div class="room-info">
      <h3>{{$hotel_room_1->title ?? ''}}</h3>
      {{-- <p>2 Adults</p> --}}
      <ul>
         @foreach(explode(',', $hotel_room_1->meal_plan) as $amenity)
                                    @if(trim($amenity) !== '')
                                    
                                     @if($amenity == 'meal_plan_only_room')
                                      <li> Meal Plan (Only Room)</li>
                                  @elseif($amenity == 'meal_plan_breakfast')
                                     <li> Meal Plan (Breakfast)</li>
                                  @elseif($amenity == 'meal_plan_all_meals')
                                     <li> Meal Plan (All Meals)</li>
                                  @elseif($amenity == 'meal_plan_breakfast_lunch_dinner')
                                      <li> Meal Plan (Breakfast + Lunch/Dinner)</li>
                                  @else
                                      No Meals Selected
                                  @endif

                                        {{-- <li>✔ {{ trim($amenity) }}</li> --}}
                                    @endif
                                @endforeach
                                </ul>
                                <p><strong>Non-Refundable</strong><br>Refund is not applicable for this booking</p>
                                <a href="#">Cancellation policy details</a>
                                <a href="#" style="float:right;">See Inclusions</a>
                              </div>

                              <div class="important-info">
                                <h4>Important information</h4>
                                <ul>
                                   @foreach(explode(',', $hotel_room_1->nearby) as $amenity)
                                    @if(trim($amenity) !== '')
                                        <li>{{ trim($amenity) }}</li>
                                    @endif
                                @endforeach
                                  {{-- <li>Local ids not allowed</li>
                                  <li>Primary Guest should be at least 18 years of age.</li>
                                  <li>Passport, Aadhaar, Driving License and Govt. ID are accepted as ID proof(s)</li> --}}
                                </ul>
                                <span class="view-more" onclick="toggleInfo(this)">View More</span>
                              </div>
                            </div>
                              </div>
                          </section>

<div class="comp-container">
   
</div>
  <script>
    function toggleInfo(element) {
      const infoList = element.previousElementSibling;
      if(infoList.style.display === 'none' || infoList.style.display === '') {
        infoList.style.display = 'block';
        element.innerText = 'View Less';
      } else {
        infoList.style.display = 'none';
        element.innerText = 'View More';
      }
    }
  </script>

  <script>
     function updateChildrenAges(count) {
            const container = document.getElementById("children-ages");
            const label = document.getElementById("children-age-label");

            container.innerHTML = ""; // Clear old dropdowns

            if (count > 0) {
                label.style.display = "block";
                container.style.display = "grid";
                container.style.gridTemplateColumns = "1fr 1fr"; // 2-column layout
                container.style.gap = "10px";
                container.style.marginTop = "10px";
            } else {
                label.style.display = "none";
                container.style.display = "none";
            }

            // Create or get the hidden input to store selected ages as an array
            let hiddenInput = document.getElementById("children-ages-array");
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "children_ages_array";
                hiddenInput.id = "children-ages-array";
                container.appendChild(hiddenInput);
            }

            // Function to update hidden input with selected age values
            function updateHiddenInput() {
                const selectedAges = Array.from(container.querySelectorAll(".child-age-select"))
                    .map(select => Number(select.value));
                hiddenInput.value = JSON.stringify(selectedAges);
            }

            for (let i = 1; i <= count; i++) {
                let wrapper = document.createElement("div");
                wrapper.style.display = "flex";
                wrapper.style.alignItems = "center";

                let childLabel = document.createElement("span");
                childLabel.innerText = `Child ${i}`;
                childLabel.style.marginRight = "8px";
                childLabel.style.fontSize = "14px";

                let select = document.createElement("select");
                select.name = `child_age_${i}`;
                select.classList.add("child-age-select");

                for (let age = 0; age <= 17; age++) {
                    let option = document.createElement("option");
                    option.value = age;
                    option.text = `${age} years`;
                    select.appendChild(option);
                }

                // Listen to change event to update hidden input
                select.addEventListener("change", updateHiddenInput);

                wrapper.appendChild(childLabel);
                wrapper.appendChild(select);
                container.appendChild(wrapper);
            }

            // Initial call to set default values
            updateHiddenInput();
        }
  </script>
<script>
   function updatePrice(nightCount, checkInDate, checkOutDate) {
            const checkIn = new Date(checkInDate);
            const checkOut = new Date(checkOutDate);

            const hotelPriceStart = new Date(hotelPriceStartDate);
            const hotelPriceEnd = new Date(hotelPriceEndDate);

            // Get current infants count
            const infantsCount = parseInt(document.getElementById('infants-count').value) || 0;

            // Check if date range is within allowed range
            if (checkIn >= hotelPriceStart && checkOut <= hotelPriceEnd) {
                // Base price calculation
                let totalPrice = nightCost * nightCount;

                // Add infants cost (same as nightCost * count * nights)
                const infantExtra = infantsCount * nightCost * nightCount;
                totalPrice = nightCost * nightCount;

                // Update display
                document.getElementById('dynamic-price').innerText = '₹' + totalPrice;
                document.getElementById('total-cost-input').value = totalPrice;
            } else {
                document.getElementById('dynamic-price').innerText = 'Price not available for selected dates';
                document.getElementById('total-cost-input').value = null;
            }
        }

        function updateGuestss(type, delta) {
            const countElement = document.getElementById(type + '-count');
            let count = parseInt(countElement.value);
            count += delta;

            if (count >= 0) {
                countElement.value = count;
                updateGuestCounts();
                if (type === 'children') {
                    updateChildrenAges(count);
                }
                updateNightCount(); // Ensure price updates when guest counts change
            }
        }

        function updateGuestCounts() {
            const adultsCount = parseInt(document.getElementById('adults-count').value) || 0;
            const childrenCount = parseInt(document.getElementById('children-count').value) || 0;
            const infantsCount = parseInt(document.getElementById('infants-count').value) || 0;

            const totalGuests = adultsCount;
            const child_count = childrenCount;

            document.getElementById('guests-value').innerText = totalGuests + (totalGuests === 1 ? ' guest' : ' guests');
            document.getElementById('guest_count').value = totalGuests;
            document.getElementById('child_count').value = child_count;
        }
    </script>
    <script>
        function updateChildrenAges(count) {
            const container = document.getElementById("children-ages");
            const label = document.getElementById("children-age-label");

            container.innerHTML = ""; // Clear old dropdowns

            if (count > 0) {
                label.style.display = "block";
                container.style.display = "grid";
                container.style.gridTemplateColumns = "1fr 1fr"; // 2-column layout
                container.style.gap = "10px";
                container.style.marginTop = "10px";
            } else {
                label.style.display = "none";
                container.style.display = "none";
            }

            // Create or get the hidden input to store selected ages as an array
            let hiddenInput = document.getElementById("children-ages-array");
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "children_ages_array";
                hiddenInput.id = "children-ages-array";
                container.appendChild(hiddenInput);
            }

            // Function to update hidden input with selected age values
            function updateHiddenInput() {
                const selectedAges = Array.from(container.querySelectorAll(".child-age-select"))
                    .map(select => Number(select.value));
                hiddenInput.value = JSON.stringify(selectedAges);
            }

            for (let i = 1; i <= count; i++) {
                let wrapper = document.createElement("div");
                wrapper.style.display = "flex";
                wrapper.style.alignItems = "center";

                let childLabel = document.createElement("span");
                childLabel.innerText = `Child ${i}`;
                childLabel.style.marginRight = "8px";
                childLabel.style.fontSize = "14px";

                let select = document.createElement("select");
                select.name = `child_age_${i}`;
                select.classList.add("child-age-select");

                for (let age = 0; age <= 17; age++) {
                    let option = document.createElement("option");
                    option.value = age;
                    option.text = `${age} years`;
                    select.appendChild(option);
                }

                // Listen to change event to update hidden input
                select.addEventListener("change", updateHiddenInput);

                wrapper.appendChild(childLabel);
                wrapper.appendChild(select);
                container.appendChild(wrapper);
            }

            // Initial call to set default values
            updateHiddenInput();
        }
    </script>



<script>
  function formatDate(dateStr) {
    // Input: "09-01-2025" => Output: "Tue 1 Sep 2025"
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    const parts = dateStr.split("-");
    if (parts.length !== 3) return "--";

    const [month, day, year] = parts;
    const date = new Date(`${year}-${month}-${day}`);
    if (isNaN(date)) return "--";

    const dayName = days[date.getDay()];
    const monthName = months[date.getMonth()];

    return `${dayName} <b>${parseInt(day)}</b> ${monthName} ${year}`;
  }

  function populateBookingDates() {
    const data = localStorage.getItem("hotelFormData");
    if (!data) return;

    try {
      const formData = JSON.parse(data);

      const checkInFormatted = formatDate(formData.start_date);
      const checkOutFormatted = formatDate(formData.end_date);

      const nights = (() => {
        const inDate = new Date(formData.start_date);
        const outDate = new Date(formData.end_date);
        const diff = (outDate - inDate) / (1000 * 60 * 60 * 24);
        return diff > 0 ? diff : 1;
      })();

      const adults = formData.adults || 1;
      const rooms = 1; // Static or pull from another field if available

      document.getElementById("checkInDate").innerHTML = checkInFormatted;
      document.getElementById("checkOutDate").innerHTML = checkOutFormatted;
      document.getElementById("stayInfo").textContent = `${nights} Night${nights > 1 ? 's' : ''} | ${adults} Adult${adults > 1 ? 's' : ''} | ${rooms} Room`;
    } catch (e) {
      console.error("Invalid hotelFormData:", e);
    }
  }

  populateBookingDates();
</script>

@endsection
@extends('front.common.app')
@section('title', 'home')
@section('content')
<style>
    .guests-dropdown_hotels {
        width: 100%;
    }

    .wast {
        border-top: 1px solid #b0b0b0;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
        font-size: 15px;
    }
    .btn-primary {
        width: 100%;
    }
    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .need {
        width: 120px;
    }

    .hato {
        padding: 5px;
        border: 1px solid #b0b0b0;
        border-radius: 5px;
    }

    .tarati {
        margin-bottom: 5rem !important;
    }

    .namesef {
        position: relative;
    }

    .let_me {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .her_back {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 5px;
    }



 .center2 {
    display: flex;
    /* flex-direction: column; */
    justify-content: space-between;
    height: 120px;
    align-items: start;
    border-top: 1px solid #80808054;
    padding: 10px;
}

    .right2 {
    height: 120px;  
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: end;
    /* width: 50%; */
}




    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        padding-top: 40px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgb(0 0 0 / 24%);
    }

    .modal img {
        width: auto;
        max-height: 80vh;
        margin: auto;
        display: block;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 999;
    }

    .splide__arrow {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        font-size: 24px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .splide__track {
        height: 100%;
    }

    .room-right .main-price {
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
        height: 100%;
        align-items: end;
    }

    .room_Center .skoot {
        height: auto;
    }

    @media(max-width: 768px) {
        .select-btn {
        width: 90%;
    }
.main-price {
    width: 70%;
}
.center2 {
    border-top:0;
    padding: 0px 10px;
}
.right2 {
    justify-content: start;
    align-items: start;
    /* width: 60%; */
}
.room-right {
    min-width: 0;
}
    }
</style>
<div class="header-container_hotels">

    <div class="search-header_hotels msfm">
        <!-- Destination Dropdown -->
        <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
            <div class="filter-label_hotels">Destination</div>


            <form action="" method="POST" id="filter-form">
                @csrf
                <div class="filter-value_hotels" id="destination-value"> <input type="text" id="city-search"
                        onkeyup="filterCities()" placeholder="Search cities..." class="search-input" readonly></div>
                <div class="dropdown_hotels destination-dropdown_hotels" id="destination-dropdown">
                    <!-- Search input added here -->
                    <div class="search-container">
                        {{-- <input type="text" id="city-search" onkeyup="filterCities()" placeholder="Search cities..."
                            class="search-input"> --}}
                    </div>

                    @foreach($cities as $value)
                    <label class="d-flex " for="city_{{ $value->id }}" class="city-label orSamar" style="
              border-bottom: 1px solid #00000033;  cursor: pointer;   padding: 10px;">
                        <div class="city_list_htotle city-item mb-2">
                            <div class="desMund d-flex align-items-center gap-2">
                                <div class="sizemaze">
                                    <!-- Image representing the city -->
                                    <img src="https://cdn-icons-png.flaticon.com/128/535/535239.png" alt="City Image" />
                                </div>
                                <p class="text-bold text-dark" href="#"><b>{{ $value->city_name ?? 'City name not
                                        available' }}</b></p>

                                <div class="hotel_place">
                                    <!-- Input field for the city selection -->
                                    <input type="radio" id="city_{{ $value->id }}" name="city_id"
                                        value="{{ $value->id }}" class="destination-option_hotels opacity-0"
                                        onclick="selectDestination('{{ $value->city_name }}')">

                                    <span class="hotels_spn"></span>
                                </div>
                            </div>
                        </div>
                        <p id="no_city"></p>
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
                            <img src="{{ asset('frontend/images/75e4a98d-2598-4693-ae1b-d8c9d98c3bfc.png') }}"
                                alt="City Image" />
                        </div>
                        <div class="hotel_place">
                            <!-- Input field for the city selection -->
                            <input type="radio" id="city_{{ $value->id }}" name="city_id" value="{{ $value->id }}"
                                class="destination-option_hotels" onclick="selectDestination('{{ $value->id }}')">
                            <label for="city_{{ $value->id }}" class="city-label">{{ $value->city_name ?? 'City name not
                                available'
                                }}</label>
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

{{-- <form action="{{ route('add_hotel_booking',['id'=>$hotel->id]) }}" method="POST">
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

                    <div class="checks">
                        <div class="bors">
                            <div class="caranke">
                                <label for="">Check In</label>
                                <input name="check_in_date" id="check_in_date" type="date" class="filter-value_hotels"
                                    placeholder="Check In" onchange="updateNightCount()" required>
                            </div>
                            <div class="caranke">
                                <label for="">Check Out</label>
                                <input name="check_out_date" id="check_out_date" type="date" class="filter-value_hotels"
                                    placeholder="Check out" onchange="updateNightCount()" required>
                            </div>
                        </div>
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
                                            <input type="number" id="infants-count" value="0" min="0"
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
                                </div>
                            </div>

                            <div id="premium-fields" class="trnas wast" style="display:none; margin-top:15px;">
                                <div class="form-group">
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

                                <div class="form-group mt-2">
                                    <label class="filter-label_hotels" for="extra_bed">Extra
                                        Bed</label>
                                    <select class="need hato" name="beds" id="beds" class="filter-value_hotels">
                                        <option value="">-- 0 --</option>

                                        @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}">{{ $i
                                            }}</option>
                                            @endfor
                                    </select>
                                </div>

                                <div class="form-group mt-2">
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

                        <input type="hidden" name="night_count" id="night_count">
                        <input type="hidden" name="total_cost" id="total-cost-input">

                        <input type="hidden" name="guest_count" id="guest_count">
                        <input type="hidden" name="child_count" id="child_count">
                        <input type="hidden" name="room_count" id="room_count">
                    </div>


                    <div class="live_set mt-3">
                        @if(Auth::guard('agent')->check())
                        <button type="submit" class="btn btn-info gggsd">
                            Reserve
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Fetch Price</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</form> --}}
@php
$amenityIcons = [
    'room service'        => '<i class="fa-solid fa-bell"></i>',
    'balcony/terrace'     => '<i class="fa-solid fa-building"></i>',
    'barbeque'            => '<i class="fa-solid fa-fire"></i>',
    'cafe'                => '<i class="fa-solid fa-mug-saucer"></i>',
    'ev charging station' => '<i class="fa-solid fa-bolt"></i>',
    'restaurant'          => '<i class="fa-solid fa-utensils"></i>',
    'bar'                 => '<i class="fa-solid fa-wine-glass"></i>',
    'parking'             => '<i class="fa-solid fa-square-parking"></i>',
    'caretaker'           => '<i class="fa-solid fa-user"></i>',
    'bonfire'             => '<i class="fa-solid fa-fire"></i>',
    'kitchenette'         => '<i class="fa-solid fa-kitchen-set"></i>',
    'elevator/lift'       => '<i class="fa-solid fa-arrow-up-long"></i>',
    'indoor games'        => '<i class="fa-solid fa-chess-board"></i>',
    'living room'         => '<i class="fa-solid fa-couch"></i>',

    // existing free icons
    'wifi'                => '<i class="fa-solid fa-wifi"></i>',
    'swimming pool'       => '<i class="fa-solid fa-person-swimming"></i>',
    'ac'                  => '<i class="fa-solid fa-snowflake"></i>',
    'air conditioning'    => '<i class="fa-solid fa-snowflake"></i>',
    'tv'                  => '<i class="fa-solid fa-tv"></i>',
    'spa'                 => '<i class="fa-solid fa-spa"></i>',
    'gym'                 => '<i class="fa-solid fa-dumbbell"></i>',
    'breakfast'           => '<i class="fa-solid fa-mug-hot"></i>',

    'fireplace'              => '<i class="fa-solid fa-fire"></i>',
    'interconnected room'    => '<i class="fa-solid fa-door-open"></i>',
    'bathtub'                => '<i class="fa-solid fa-bath"></i>',
    'kitchenette'            => '<i class="fa-solid fa-kitchen-set"></i>',
    'smoking room'           => '<i class="fa-solid fa-smoking"></i>',
    'private pool'           => '<i class="fa-solid fa-person-swimming"></i>',
    'balcony'                => '<i class="fa-solid fa-building"></i>',
    'cook & butler service'  => '<i class="fa-solid fa-user-tie"></i>',
    'heater'                 => '<i class="fa-solid fa-temperature-three-quarters"></i>',
    'jacuzzi'                => '<i class="fa-solid fa-water-ladder"></i>',
    'living area'            => '<i class="fa-solid fa-couch"></i>',
];

$houseRuleIcons = [
    'smoking allowed'            => '<i class="fa-solid fa-smoking"></i>',
    'unmarried couples allowed'  => '<i class="fa-solid fa-user-group"></i>',
    'pets allowed'               => '<i class="fa-solid fa-paw"></i>',
    'alcohol allowed'            => '<i class="fa-solid fa-wine-bottle"></i>',
    'non veg allowed'            => '<i class="fa-solid fa-drumstick-bite"></i>',
];

@endphp

<section class="detail_htels mt-5">
    <div class="comp-container">
        <div class="upper_site_dets">
            <div class="site_det_head">
                <h4 class="raj_hotel">{{$hotel->name ?? ''}}</h4>
            </div>
        </div>
        <div class="air_maze">
            <div class="row">
                <div class="col-lg-8 nive d-none d-lg-block">
                    <a href="{{ route('all_images', ['id' => base64_encode($hotel->id)]) }}">
                        <div class="let_me">


                            <div class="mirror_maxe">
                                <a class="kaaas" href="{{ route('all_images', ['id' => base64_encode($hotel->id)]) }}">View All Images</a>
                                @php
                                // Assuming 'image' contains a JSON array of images
                                $images = json_decode($hotel->images); // Decode the JSON to an array
                                @endphp

                                @if($images && is_array($images) && count($images) > 0)
                                <!-- Display the first image on top -->
                                <img src="{{ asset($images[0]) }}" alt="">
                                @else
                                <p>No image available.</p>
                                @endif
                            </div>
                            <div class="her_back">
                                @if($images && is_array($images) && count($images) > 1)
                                <!-- Show only 2 images after the first one -->
                                @foreach(array_slice($images, 1, 2) as $key => $image)
                                <div class="nerve" style="
                                                                                    width: 100%;
                                                                                    height: 160px;
                                                                                ">
                                    <div class="side_masic">
                                        <img src="{{ asset($image) }}" alt="">
                                    </div>
                                </div>

                                <!-- Add <hr> after the 2nd displayed image -->
                                @if($key == 1)
                                <hr>
                                @endif
                                @endforeach
                                @else
                                <p>No additional images available.</p>
                                @endif


                            </div>
                        </div>
                    </a>
                    

                    
                    <div class="bottom_description">
                        <h2 class="htlAmenities__title">About Property</h2>
                        {!! $hotel->text_description ?? '' !!}
                    </div>
                    <div class="hotel_yosef">
                        <div class="name_wick">
                            <div class="amin">
                                <h2 class="htlAmenities__title">Aminities</h2>    
                            </div>    
                        </div>

                        <div class="icnons_tem_head">
                            <ul class="htlAmenities" style="list-style: none; padding: 0;">
                                                @if($hotel_room_1 && $hotel_room_1->hotel_amenities)
                                                    @foreach(explode(',', $hotel_room_1->hotel_amenities) as $amenity)
                                                        @php
                                                            $cleanAmenity = strtolower(trim($amenity));
                                                            $icon = $amenityIcons[$cleanAmenity] ?? '<i class="fa fa-check"></i>'; // default icon
                                                        @endphp

                                                        @if($cleanAmenity !== '')
                                                            <li class="htlAmenities__item">
                                                                <span style="color: #8f8f8f; margin-right:6px;">{!! $icon !!}</span>
                                                                <span style="color: #1a7971;">{{ ucfirst($cleanAmenity) }}</span>
                                                            </li>
                                                        @endif

                                                    @endforeach
                                                @endif
                                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sharan_side_box">
                        <div class="stand_it">
                            <div class="outer_box">
                                <div class="inner_box">
                                    <div class="aasna_keeo">
                                        <p>Luxourious
                                            {{$hotel->hotel_category ?? 'First '}} Hotel
                                        </p>
                                    </div>
                                    <div class="other_setss">
                                        <p> {{$hotel->location ?? 'First '}}</p>
                                    </div>
                                    <div class="shawshank">
                                        <div class="shaw_list">
                                            <ul style="list-style: none; padding: 0;">
                                                @if($hotel_room_1 && $hotel_room_1->hotel_amenities)
                                                    @foreach(explode(',', $hotel_room_1->hotel_amenities) as $amenity)
                                                        @php
                                                            $cleanAmenity = strtolower(trim($amenity));
                                                            $icon = $amenityIcons[$cleanAmenity] ?? '<i class="fa fa-check"></i>'; // default icon
                                                        @endphp

                                                        @if($cleanAmenity !== '')
                                                            <li>
                                                                <span style="color: #8f8f8f; margin-right:6px;">{!! $icon !!}</span>
                                                                <span style="color: #1a7971;">{{ ucfirst($cleanAmenity) }}</span>
                                                            </li>
                                                        @endif

                                                        @if($loop->iteration == 4)
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="site_pricwe">
                                        <delt class="pii">
                                            <del class="dis_price" id="price_{{ $value->id }}">₹
                                                @if($hotel_room_1 && $hotel_room_1->price)
                                                {{ $hotel_room_1->price->mrp }}
                                                @else
                                                Price not available
                                                @endif</del> <span></span>
                                        </delt>
                                        <div class="andy_time d-flex">
                                            <p class="dis_price" id=""
                                                style="color: #000;font-size: 28px; font-weight: 900;line-height: 22px;">
                                                ₹ @if ($hotel_room_1 && $hotel_room_1->price)
                                                {{ $hotel_room_1->price->night_cost }} Per Night
                                                @else
                                                Price not available
                                                @endif
                                        </div>
                                    </div>

                                    <div class="pulp_fiction">
                                        <div class="last_ride">
                                            <div class="live_set mt-3">
                                               @if($hotel_room_1->id ?? '')
    <a href="#room-card-{{$hotel_room_1->id}}" 
       class="btn btn-primary smooth-scroll">
       Book Now
    </a>
@else
    Room Not Found
@endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <form action="{{ route('add_hotel_booking',['id'=>$hotel->id]) }}" method="POST">
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

                                        <div class="checks">
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
                                            <div class="rivvsa">
                                                <div class="filter-item_hotels sachi trnas"
                                                    onclick="toggleDropdown('guests')">
                                                    <div class="filter-label_hotels">Guests</div>
                                                    <div class="arrow">
                                                        <div class="filter-value_hotels" id="guests-value">1 guest</div>
                                                        <img src="{{ asset('frontend/images/down.png') }}"
                                                            style="width: 20px;" alt="">
                                                    </div>
                                                    <div class="dropdown_hotels guests-dropdown_hotels"
                                                        id="guests-dropdown">
                                                        <div class="guest-option_hotels">
                                                            <label>No. of Rooms</label>
                                                            <div class="counter_hotels">
                                                                <button type="button"
                                                                    onclick="updateGuestss('infants', -1)">-</button>
                                                                <input type="number" id="infants-count" value="0"
                                                                    min="0" onchange="updateGuestss()">
                                                                <button type="button"
                                                                    onclick="updateGuestss('infants', 1)">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="guest-option_hotels">
                                                            <label>Adults</label>
                                                            <div class="counter_hotels">
                                                                <button type="button"
                                                                    onclick="updateGuestss('adults', -1)">-</button>
                                                                <input type="number" id="adults-count" value="1" min="1"
                                                                    onchange="updateGuestss()">
                                                                <button type="button"
                                                                    onclick="updateGuestss('adults', 1)">+</button>
                                                            </div>
                                                        </div>



                                                        <div class="guest-option_hotels">
                                                            <label>Children</label>
                                                            <div class="counter_hotels">
                                                                <button type="button"
                                                                    onclick="updateGuestss('children', -1)">-</button>
                                                                <input type="number" id="children-count" value="0"
                                                                    min="0" onchange="updateGuestss()">
                                                                <button type="button"
                                                                    onclick="updateGuestss('children', 1)">+</button>
                                                            </div>


                                                        </div>
                                                        <div id="children-age-label"
                                                            style="margin-top:10px; display:none; font-weight:600;">
                                                            Children age
                                                        </div>
                                                        <div id="children-ages">
                                                            <input type="hidden" name="children_ages_array"
                                                                id="children-ages-array">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="premium-fields" class="trnas wast"
                                                    style="display:none; margin-top:15px;">
                                                    <div class="form-group">
                                                        <label class="filter-label_hotels" for="meals">Meals</label>
                                                        <select class="need hato" name="meals" id="meals"
                                                            class="filter-value_hotels">
                                                            <option value="">-- Select --</option>
                                                            <option value="breakfast">Breakfast</option>
                                                            <option value="breakfast_dinner">Breakfast + Lunch/Dinner
                                                            </option>
                                                            <option value="all_meals">All Meals</option>
                                                            <option value="no_meal">No Meals</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label class="filter-label_hotels" for="extra_bed">Extra
                                                            Bed</label>
                                                        <select class="need hato" name="beds" id="beds"
                                                            class="filter-value_hotels">
                                                            <option value="">-- 0 --</option>

                                                            @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}">{{ $i
                                                                }}</option>
                                                                @endfor
                                                        </select>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <label class="filter-label_hotels" for="child_no_bed">Child With
                                                            No Bed</label>
                                                        <select class="need hato" name="nobed" id="nobed"
                                                            class="filter-value_hotels">
                                                            <option value="">-- 0 --</option>

                                                            @for ($i = 0; $i <= 20; $i++) <option value="{{ $i }}">{{ $i
                                                                }}</option>
                                                                @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="night_count" id="night_count">
                                            <input type="hidden" name="total_cost" id="total-cost-input">

                                            <input type="hidden" name="guest_count" id="guest_count">
                                            <input type="hidden" name="child_count" id="child_count">
                                            <input type="hidden" name="room_count" id="room_count">
                                        </div>


                                        <div class="live_set mt-3">
                                            @if(Auth::guard('agent')->check())
                                            <button type="submit" class="btn btn-info gggsd">
                                                Reserve
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="btn btn-primary">Fetch Price</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>

            <div id="phlGlb" class="splide">
                <div class="splide__track d-lg-none">
                    <ul class="splide__list">
                        @php
                        $images = json_decode($hotel->images);
                        @endphp

                        @if($images && is_array($images))
                        @foreach($images as $image)
                        <li class="splide__slide">
                            <img src="{{ asset($image) }}" alt="">
                        </li>
                        @endforeach
                        @else
                        <p>No images available.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>


        <div class="other_dets">
            <div class="row namesef">
                <div class="col-lg-8">

                    <div class="sides_maxe">
                        <div class="aaeheads">
                            <p class="hoses tarati">
                            </p>
                            <span class="sabke">
                                <ol class="lgx66tx atm_gi_idpfg4 atm_l8_idpfg4 dir dir-ltr" style="
                                            padding-left: 0 !important;">
                                    <div class="nizam_abt mt-5">
                                        <h4 class="naxo">Room Types</h4>

                                        {{-- <div class="ho_bhe">
                                            <span>
                                                State :- {{$hotel->state->state_name ?? ''}}
                                            </span>
                                            <span>· ·</span>
                                            <span>
                                                City :- {{$hotel->cities->city_name ?? ''}}
                                            </span>
                                        </div> --}}
                                    </div>
                                    {{-- <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr">2 bedrooms<span
                                            class="axjq0r atm_9s_glywfm dir dir-ltr"><span
                                                class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr"
                                                aria-hidden="true"> · </span></span></li>
                                    <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr"><span
                                            class="pen26si dir dir-ltr"><span
                                                class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr"
                                                aria-hidden="true"> · </span></span>2 king beds<span
                                            class="axjq0r atm_9s_glywfm dir dir-ltr"><span
                                                class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr"
                                                aria-hidden="true"> · </span></span></li>
                                    <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr"><span
                                            class="pen26si dir dir-ltr"><span
                                                class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr"
                                                aria-hidden="true"> · </span></span>Private attached bathroom</li> --}}
                                </ol>
                            </span>
                        </div>
                    </div>

                    {{-- <div class="htt_facili">
                        <div class="sangeetam">
                            <h4 class="hoses">Amenities</h4>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                            aria-hidden="true" role="presentation" focusable="false"
                                            style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path
                                                d="M17 6a2 2 0 0 1 2 1.85v8.91l.24.24H24v-3h-3a1 1 0 0 1-.98-1.2l.03-.12 2-6a1 1 0 0 1 .83-.67L23 6h4a1 1 0 0 1 .9.58l.05.1 2 6a1 1 0 0 1-.83 1.31L29 14h-3v3h5a1 1 0 0 1 1 .88V30h-2v-3H20v3h-2v-3H2v3H0V19a3 3 0 0 1 1-2.24V8a2 2 0 0 1 1.85-2H3zm13 13H20v6h10zm-13-1H3a1 1 0 0 0-1 .88V25h16v-6a1 1 0 0 0-.77-.97l-.11-.02zm8 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM17 8H3v8h2v-3a2 2 0 0 1 1.85-2H13a2 2 0 0 1 2 1.85V16h2zm-4 5H7v3h6zm13.28-5h-2.56l-1.33 4h5.22z">
                                            </path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1"
                                                class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr"
                                                elementtiming="LCP-target">Room in a home</h3>
                                        </div>
                                        <div class="_1hwkgn6">Your own room in a home, plus access to shared spaces.
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                            aria-hidden="true" role="presentation" focusable="false"
                                            style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path
                                                d="M9 1a5 5 0 0 0 4.78 5H14v2a6.98 6.98 0 0 1-5-2.1V7a5 5 0 0 0 4.78 5H14v2a6.98 6.98 0 0 1-5-2.1v6.22c.54.14 1.05.39 1.49.73l.18.16c.35.31.83.49 1.33.49.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 16 18c.99 0 1.95.35 2.67 1 .35.32.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 24 18c.99 0 1.94.35 2.67 1 .35.33.83.5 1.33.5a2 2 0 0 0 1.2-.38l.13-.11c.2-.19.43-.35.67-.49V26a5 5 0 0 1-4.78 5H7a5 5 0 0 1-5-4.78v-7.7c.24.14.47.3.67.49.3.27.71.44 1.14.48l.19.01h.19c.37-.04.72-.17 1-.38l.14-.11A3.9 3.9 0 0 1 7 18.12V11.9A6.98 6.98 0 0 1 2.24 14H2v-2a5 5 0 0 0 5-4.78V5.9A6.98 6.98 0 0 1 2.24 8H2V6a5 5 0 0 0 5-4.78V1h2zm15 24c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 25c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 25c-.5 0-.98.17-1.33.5a3.94 3.94 0 0 1-2.22.97l-.2.02h-.2A3 3 0 0 0 6.81 29L7 29h18a3 3 0 0 0 2.96-2.5H28a3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 24 25zm0-5c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 20c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 20c-.5 0-.98.17-1.33.5a3.94 3.94 0 0 1-2.22.97l-.2.02H4v3.01h.19c.37-.04.72-.17 1-.38l.14-.11A3.98 3.98 0 0 1 8 23c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 16 23c.99 0 1.95.35 2.67 1 .35.32.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 24 23c.99 0 1.94.35 2.67 1 .35.33.83.5 1.33.5v-3a3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 24 20zm0-14a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z">
                                            </path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1"
                                                class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr"
                                                elementtiming="LCP-target">19-min walk to the lake</h3>
                                        </div>
                                        <div class="_1hwkgn6">This home is by Lake Pichola.</div>
                                    </div>
                                </div>

                            </div>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                            aria-hidden="true" role="presentation" focusable="false"
                                            style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path
                                                d="M16 1a15 15 0 1 1 0 30 15 15 0 0 1 0-30zm0 2a13 13 0 1 0 0 26 13 13 0 0 0 0-26zm2 5a5 5 0 0 1 .22 10H13v6h-2V8zm0 2h-5v6h5a3 3 0 0 0 .18-6z">
                                            </path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1"
                                                class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr"
                                                elementtiming="LCP-target">Park for free</h3>
                                        </div>
                                        <div class="_1hwkgn6">This is one of the few places in the area with free
                                            parking.</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> --}}

                </div>

            </div>
        </div>
@foreach ($hotel_room as $value)
    @php $images = json_decode($value->images, true) ?: []; @endphp

    <div class="room-card mb-2" id="room-card-{{ $value->id }}">
        <!-- Upgrade Banner -->
        <div class="upgrade-banner"></div>

        <div class="room-content">
            <div class="room-left">
                <div class="jules">
                    <!-- Room Slider -->
                    <div id="room-slider-{{ $value->id }}" class="splide room-slider" style="height: 100%; width: 100%;">
                        <div class="splide__track" style="height: 100%; width: 100%;">
                            <ul class="splide__list">
                                @if (count($images))
                                    @foreach ($images as $image)
                                    <li class="splide__slide">
                                        <img src="{{ asset($image) }}" alt="" class="open-modal"
                                            style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                    </li>
                                    @endforeach
                                @else
                                    <li class="splide__slide">
                                        <img src="{{ asset('images/no-image.jpg') }}" alt="No image available"
                                            style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="splide__arrows">
                            <button class="splide__arrow splide__arrow--prev">‹</button>
                            <button class="splide__arrow splide__arrow--next">›</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="imageModal-{{ $value->id }}" class="modal" style="display:none; align-items:center; justify-content:center;">
                        <div style="background:#fff; border-radius:16px; max-width:900px; width:95vw; max-height:90vh; overflow-y:auto; position:relative; box-shadow:0 8px 32px rgba(0,0,0,0.25);">
                            <span class="close" style="position:absolute; top:15px; right:35px; color:#333; font-size:40px; font-weight:bold; cursor:pointer; z-index:999;">×</span>
                            <div style="padding:32px 32px 16px 32px;">
                                <h2 style="font-size:2rem; font-weight:700; margin-bottom:16px;">{{ $value->title ?? '' }}</h2>
                                <div id="modal-slider-{{ $value->id }}" class="splide modal-slider" style="margin-bottom:24px;">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @if (count($images))
                                                @foreach ($images as $image)
                                                <li class="splide__slide">
                                                    <img src="{{ asset($image) }}" alt=""
                                                        style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                </li>
                                                @endforeach
                                            @else
                                                <li class="splide__slide">
                                                    <img src="{{ asset('images/no-image.jpg') }}" alt="No image available"
                                                        style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="splide__arrows">
                                        <button class="splide__arrow splide__arrow--prev">‹</button>
                                        <button class="splide__arrow splide__arrow--next">›</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        
                    </div>
                </div>

                <h3>{{ $value->title ?? '' }}</h3>
                <div class="features">
                    <!-- Nearby, Rules, Locality - same -->
                     @if (!empty($value->room_amenities) && trim($value->room_amenities) !== '')
                        <div class="samrt">
                            <p><b>Room facilities</b></p>
                            <ul class="offers">
                                @foreach (explode(',', $value->room_amenities) as $amenity)
                                    @php 
                                        $key = strtolower(trim($amenity));
                                        $icon = $amenityIcons[$key] ?? '<i class="fa-solid fa-circle-check"></i>';
                                    @endphp

                                    <li>{!! $icon !!} {{ trim($amenity) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- <label for=""><b>Nearby within Walking Distance</b></label>
                    <ul class="rmTypeList vertical appendTop10">
                        @foreach (explode(',', $value->nearby) as $amenity)
                            @if (trim($amenity) !== '')
                            <li class="rmTypeList__item">
                                <span class="rmTypeList__item--icon appendRight10"><i class="fa-solid fa-person-walking"></i></span>
                                <span class="makeFlex column column-text"><span class="rmTypeList__item--text">{{ trim($amenity) }}</span></span>
                            </li>
                            @endif
                        @endforeach
                    </ul> --}}
                    <label for=""><b>Rules</b></label>
                    <ul class="rmTypeList vertical appendTop10">

                        @foreach (explode(',', $value->house_rules) as $amenity)
                            @if (trim($amenity) !== '')
                                @php 
                                    $key = strtolower(trim($amenity));
                                    $icon = $houseRuleIcons[$key] ?? '<i class="fa-solid fa-circle-check"></i>';
                                @endphp

                                <li class="rmTypeList__item">
                                    <span class="rmTypeList__item--icon appendRight10">
                                        {!! $icon !!}
                                    </span>
                                    <span class="makeFlex column column-text">
                                        <span class="rmTypeList__item--text">{{ trim($amenity) }}</span>
                                    </span>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                    
                </div>
                <a href="#" class="more-link" id="open-modal-details-{{ $value->id }}">More Details</a>
            </div>

            <div class="room_Center">
                <div class="avatar p-2">
                    <div class="baghi">

                        <h4 class="naxo">Room Only</h4>
                    </div>
                    <div class="main-price">
                    <div class="price" style="flex-direction: column">
                        <div class="old-price">
                            @if ($value->price)
                            <p 
                             data-room-id="{{ $value->id }}"
                           data-base-price-mrp="{{ $value->price->mrp }}"
                            style="margin: 0;" class="hotel-mrp" id="mrp-{{ $value->id }}">₹{{ $value->price->mrp }}</p>
                            @endif
                        </div>

                        @if ($value->price)
                        <p class="hotel-price"
                           id="base-price-{{ $value->id }}"
                           data-room-id="{{ $value->id }}"
                           data-base-price-night="{{ $value->price->night_cost }}"
                           data-label="no_meal">
                           ₹{{ $value->price->night_cost }}
                        </p>
                        @else
                        <p><em>Price not available for selected dates.</em></p>
                        @endif

                        <button class="select-btn">
                            <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                        </button>
                    </div>
                </div>
                </div>
                <div class="skoot mb-5">
                    <!-- All amenities same -->
                   

                    {{-- @if (!empty($value->meal_plan) && trim($value->meal_plan) !== '')
                    <div class="tape_over"><p><b>Room Meal</b></p><ul class="offers">
                        @foreach (explode(',', $value->meal_plan) as $amenity)
                            @if (trim($amenity) !== '')
                            <li>
                                @switch(trim($amenity))
                                    @case('meal_plan_only_room') <i class="fa-solid fa-utensils"></i> Only room @break
                                    @case('meal_plan_breakfast') <i class="fa-solid fa-utensils"></i> Breakfast @break
                                    @case('meal_plan_all_meals') <i class="fa-solid fa-utensils"></i> All meals @break
                                    @case('meal_plan_breakfast_lunch_dinner') <i class="fa-solid fa-utensils"></i> Breakfast + Lunch/Dinner @break
                                    @default <i class="fa-solid fa-utensils"></i> {{ trim($amenity) }}
                                @endswitch
                            </li>
                            @endif
                        @endforeach
                    </ul></div>
                    @endif --}}

                    {{-- @if (!empty($value->hotel_amenities) && trim($value->hotel_amenities) !== '')
                    <div class="tape_over"><p><b>Hotel Amenities</b></p><ul class="offers">
                        @foreach (explode(',', $value->hotel_amenities) as $amenity)
                            @if (trim($amenity) !== '') <li><i class="fa-solid fa-dice"></i> {{ trim($amenity) }}</li> @endif
                        @endforeach
                    </ul></div>
                    @endif --}}

                    {{-- @if (!empty($value->chains) && trim($value->chains) !== '')
                    <div class="tape_over p-2"><p><b>Chains</b></p><ul class="offers">
                        @foreach (explode(',', $value->chains) as $amenity)
                            @if (trim($amenity) !== '') <li><i class="fa-solid fa-snowflake"></i> {{ trim($amenity) }}</li> @endif
                        @endforeach
                    </ul></div>
                    @endif --}}

                    @if (!empty($value->description))
                    <div class="tape_over p-2"><p><b>Description</b></p><div class="desc_hotl"><p>{!! $value->description !!}</p></div></div>
                    @endif
                </div>

                <div class="small_go d-none d-lg-block">
                    @if(!empty($value->price->meal_plan_breakfast_cost) && $value->price->meal_plan_breakfast_cost > 0)
                    <div class="center2">
                        <div class="triangle">
                            <p><b>Room With(Breakfast)</b></p>
                        </div>
                         @if(!empty($value->price->meal_plan_breakfast_cost) && $value->price->meal_plan_breakfast_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="bf-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_breakfast_cost }}"
                               data-label="breakfast">
                               ₹{{ $value->price->meal_plan_breakfast_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    </div>
                    @endif
                    @endif
                    <div class="center2">
                        <div class="triangle">
                            <p><b>Room with(Breakfast + lunch/dinner)</b></p>
                        </div>
                        @if(!empty($value->price->meal_plan_breakfast_lunch_dinner_cost) && $value->price->meal_plan_breakfast_lunch_dinner_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="bd-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}"
                               data-label="breakfast_dinner">
                               ₹{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    @endif
                    </div>
                    <div class="center2">
                        <div class="triangle">
                            <p><b>Room with(All meals)</b></p>
                        </div>
                         @if(!empty($value->price->meal_plan_all_meals_cost) && $value->price->meal_plan_all_meals_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="all-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_all_meals_cost }}"
                               data-label="all_meals">
                               ₹{{ $value->price->meal_plan_all_meals_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>

            {{-- <div class="room-right">
                <div class="main-price mb-5">
                    <div class="price" style="flex-direction: column">
                        <div class="old-price">
                            @if ($value->price)
                            <p 
                             data-room-id="{{ $value->id }}"
                           data-base-price-mrp="{{ $value->price->mrp }}"
                            style="margin: 0;" class="hotel-mrp" id="mrp-{{ $value->id }}">₹{{ $value->price->mrp }}</p>
                            @endif
                        </div>

                        @if ($value->price)
                        <p class="hotel-price"
                           id="base-price-{{ $value->id }}"
                           data-room-id="{{ $value->id }}"
                           data-base-price-night="{{ $value->price->night_cost }}"
                           data-label="no_meal">
                           ₹{{ $value->price->night_cost }}
                        </p>
                        @else
                        <p><em>Price not available for selected dates.</em></p>
                        @endif

                        <button class="select-btn">
                            <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                        </button>
                    </div>
                </div>

                <!-- Desktop Meal Plans -->
                <div class="small_go d-none d-lg-block">
                    @if(!empty($value->price->meal_plan_breakfast_cost) && $value->price->meal_plan_breakfast_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="bf-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_breakfast_cost }}"
                               data-label="breakfast">
                               ₹{{ $value->price->meal_plan_breakfast_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if(!empty($value->price->meal_plan_breakfast_lunch_dinner_cost) && $value->price->meal_plan_breakfast_lunch_dinner_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="bd-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}"
                               data-label="breakfast_dinner">
                               ₹{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if(!empty($value->price->meal_plan_all_meals_cost) && $value->price->meal_plan_all_meals_cost > 0)
                    <div class="right2 room-right">
                        <div class="price">
                            <p class="dynamic-price"
                               id="all-price-{{ $value->id }}"
                               data-room-id="{{ $value->id }}"
                               data-base-price-meal="{{ $value->price->meal_plan_all_meals_cost }}"
                               data-label="all_meals">
                               ₹{{ $value->price->meal_plan_all_meals_cost }}
                            </p>
                            <button class="select-btn">
                                <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div> --}}
        </div>

        

        <!-- Mobile View -->
        <div class="secound_t d-lg-none">
            @if(!empty($value->price->meal_plan_breakfast_cost) && $value->price->meal_plan_breakfast_cost > 0)
            <div class="d-flex space">
                <div class="center2 room_Center"><div class="triangle"><p><b>Room With(Breakfast)</b></p></div></div>
                <div class="right2 room-right">
                    <div class="price">
                        <p class="dynamic-price"
                           id="mobile-bf-{{ $value->id }}"
                           data-room-id="{{ $value->id }}"
                           data-base-price-meal="{{ $value->price->meal_plan_breakfast_cost }}">
                           ₹{{ $value->price->meal_plan_breakfast_cost }}
                        </p>
                    </div>
                    <button class="select-btn">
                        <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                    </button>
                </div>
            </div><hr>
            @endif

            @if(!empty($value->price->meal_plan_breakfast_lunch_dinner_cost) && $value->price->meal_plan_breakfast_lunch_dinner_cost > 0)
            <div class="d-flex space">
                <div class="center2 room_Center"><div class="triangle"><p><b>Room with(Breakfast + lunch/dinner)</b></p></div></div>
                <div class="right2 room-right">
                    <div class="price">
                        <p class="dynamic-price"
                           id="mobile-bd-{{ $value->id }}"
                           data-room-id="{{ $value->id }}"
                           data-base-price-meal="{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}">
                           ₹{{ $value->price->meal_plan_breakfast_lunch_dinner_cost }}
                        </p>
                    </div>
                    <button class="select-btn">
                        <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                    </button>
                </div>
            </div><hr>
            @endif

            @if(!empty($value->price->meal_plan_all_meals_cost) && $value->price->meal_plan_all_meals_cost > 0)
            <div class="d-flex space">
                <div class="center2 room_Center"><div class="triangle"><p><b>Room with(All meals)</b></p></div></div>
                <div class="right2 room-right">
                    <div class="price">
                        <p class="dynamic-price"
                           id="mobile-all-{{ $value->id }}"
                           data-room-id="{{ $value->id }}"
                           data-base-price-meal="{{ $value->price->meal_plan_all_meals_cost }}">
                           ₹{{ $value->price->meal_plan_all_meals_cost }}
                        </p>
                    </div>
                    <button class="select-btn">
                        <a href="{{ route('final_booking', $value->id) }}" class="text-light">SELECT ROOM</a>
                    </button>
                </div>
            </div><hr>
            @endif
        </div>
    </div>
@endforeach

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".room-right .select-btn a").forEach(function (anchor) {
            anchor.addEventListener("click", function () {

                let priceEl = this.closest(".room-right").querySelector(".dynamic-price");

                if (priceEl) {
                    let mealType = priceEl.getAttribute("data-label"); // breakfast/no_meal/etc.

                    // GET PRINTED VALUE (example: "₹1500")
                    let printedPrice = priceEl.textContent.trim();

                    // Save in localStorage
                    localStorage.setItem("selectedMealPlan", mealType);
                    localStorage.setItem("selectedPrintedPrice", printedPrice);
                }
            });
        });

    });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".main-price .select-btn a").forEach(function (anchor) {
            anchor.addEventListener("click", function () {

                let priceEl = this.closest(".main-price").querySelector(".hotel-price");

                if (priceEl) {
                    let mealType = priceEl.getAttribute("data-label"); // breakfast/no_meal/etc.

                    // GET PRINTED VALUE (example: "₹1500")
                    let printedPrice = priceEl.textContent.trim();

                    // Save in localStorage
                    localStorage.setItem("selectedMealPlan", mealType);
                    localStorage.setItem("selectedPrintedPrice", printedPrice);
                }
            });
        });

    });

</script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.room-card').forEach((card) => {
            const skoot = card.querySelector('.skoot');
            const mainPrice = card.querySelector('.main-price');

            if (!skoot || !mainPrice) return;

            const updateHeight = () => {
                mainPrice.style.height = skoot.offsetHeight + 'px';
            };

            // Initial sync + respond to content changes
            updateHeight();
            new ResizeObserver(updateHeight).observe(skoot);
        });
    });
</script> --}}

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get saved form data
    let data = localStorage.getItem("hotelFormData");
    if (!data) return;

    data = JSON.parse(data);

    // Infants count
    let infants = parseInt(data.infants ?? 0);
    if (isNaN(infants) || infants < 1) infants = 1;

    // Nights calculation
    let nights = 1;
    if (data.date_range) {
        const [start, end] = data.date_range.split(" - ");
        nights = Math.round((new Date(end) - new Date(start)) / (1000 * 60 * 60 * 24));
        if (nights < 1) nights = 1;
    }

    // Calculate hotel-price first and store in map
    const hotelPriceMap = {};
    document.querySelectorAll('.hotel-price').forEach(function(el) {
        const roomId = el.dataset.roomId;
        const basePriceNight = parseFloat(el.dataset.basePriceNight) || 0;
        const basePriceMeal  = parseFloat(el.dataset.basePriceMeal) || 0;

        let total = 0;
        if (basePriceMeal > 0) {
            total = (basePriceMeal * nights * infants) + (basePriceNight * nights);
        } else if (basePriceNight > 0) {
            total = basePriceNight * nights * infants;
        } else {
            el.textContent = 'Price not available';
            return;
        }

        hotelPriceMap[roomId] = total;

        el.textContent = `₹${Math.round(total)}`;
    });

    // Update dynamic-price elements by adding corresponding hotel-price
    document.querySelectorAll('.dynamic-price').forEach(function(el) {
        const roomId = el.dataset.roomId;
        const basePriceNight = parseFloat(el.dataset.basePriceNight) || 0;
        const basePriceMeal  = parseFloat(el.dataset.basePriceMeal) || 0;

        let dynamicTotal = 0;
        if (basePriceMeal > 0) {
            dynamicTotal = (basePriceMeal * nights * infants) + (basePriceNight * nights);
        } else if (basePriceNight > 0) {
            dynamicTotal = basePriceNight * nights * infants;
        } else {
            el.textContent = 'Price not available';
            return;
        }

        // Add hotel-price if exists
        if (hotelPriceMap[roomId]) {
            dynamicTotal += hotelPriceMap[roomId];
        }

        el.textContent = `₹${Math.round(dynamicTotal)}`;
    });

    // MRP prices
    document.querySelectorAll('.hotel-mrp').forEach(function(el) {
        const basePriceMRP = parseFloat(el.dataset.basePriceMrp) || 0;
        if (basePriceMRP > 0) {
            let total = basePriceMRP * nights;
            el.textContent = `₹${Math.round(total)}`;
        } else {
            el.textContent = 'Price not available';
        }
    });
});
</script>



{{-- finel js  --}}
{{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    let data = localStorage.getItem("hotelFormData");
    if (!data) return;

    data = JSON.parse(data);
    let infants = parseInt(data.infants ?? 0) || 0;
    let dateRange = data.date_range;

    let nights = 1;
    if (dateRange) {
        const [start, end] = dateRange.split(" - ");
        nights = Math.round((new Date(end) - new Date(start)) / (1000 * 60 * 60 * 24));
    }

    // Target dono classes
    document.querySelectorAll('.dynamic-price, .hotel-price').forEach(function(el) {
        // data-base-price attribute se price lo
        let basePrice = parseFloat(el.dataset.basePrice);

        // Agar data-base-price nahi hai to text se extract kar lo
        if (isNaN(basePrice) || basePrice <= 0) {
            const text = el.textContent || el.innerText;
            basePrice = parseFloat(text.replace(/[^\d.-]/g, '')); // ₹, commas, spaces hata de
        }

        if (isNaN(basePrice) || basePrice <= 0) {
            el.textContent = 'Price not available';
            return;
        }

        // Calculation
        let total = basePrice * nights;
        if (infants > 0) {
            total = basePrice * nights * infants;
        }

        // Final display text
        if (el.classList.contains('hotel-price')) {
            el.textContent = `₹${Math.round(total)} Starting from`;
        } else {
            el.textContent = `₹${Math.round(total)}`;
        }
    });
});
</script> --}}

{{-- 
<script>
    document.addEventListener("DOMContentLoaded", function () {

        let data = localStorage.getItem("hotelFormData");
        if (!data) return;

        data = JSON.parse(data);

        let infants = parseInt(data.infants ?? 0);
        let children = parseInt(data.children ?? 0);

        // Date difference
        let dateRange = data.date_range;
        let nights = 1;
        if (dateRange) {
            const [start, end] = dateRange.split(" - ");
            nights = Math.round((new Date(end) - new Date(start)) / (1000 * 60 * 60 * 24));
        }

        // ------------------------------------------
        // 1️⃣ CALCULATE TOTAL HOTEL PRICE FIRST
        // ------------------------------------------

        let hotelBaseNightCost = 0;
        let hotelTotalPrice = 0;

        document.querySelectorAll(".hotel-price").forEach(function (priceElement) {

            let nightCost = parseFloat(
                priceElement.textContent.replace("₹", "").replace("/ night", "").trim()
            );

            hotelBaseNightCost = nightCost;

            let calculated = nightCost * nights;

            if (infants > 0) {
                calculated = nightCost * nights * infants;
            }

            hotelTotalPrice = calculated;   // store for reuse

            priceElement.textContent = infants > 0
                ? `₹${calculated} starting from`
                : `₹${calculated}`;
        });

        // ------------------------------------------
        // 2️⃣ APPLY TO dynamic-price USING hotelTotalPrice
        // ------------------------------------------

        document.querySelectorAll(".dynamic-price").forEach(function (el) {

            let basePrice = parseFloat(el.dataset.basePrice || 0);

            let price;

            if (infants > 0) {
                // 🔥 FIX: NOW hotelTotalPrice IS AVAILABLE
                price = basePrice * nights * infants + hotelTotalPrice;
            } else {
                price = basePrice * nights;
            }

            el.textContent = `₹${price}`;
        });

    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.room-card').forEach((roomCard) => {
            // Extract room ID from the slider ID (assumes “room-slider-<id>”)
            let sliderDiv = roomCard.querySelector('.room-slider');
            if (!sliderDiv) {
                return; // no slider found
            }
            let sliderIdParts = sliderDiv.id.split('-');
            let roomId = sliderIdParts[sliderIdParts.length - 1];

            const roomSliderSelector = `#room-slider-${roomId}`;
            const modalSliderSelector = `#modal-slider-${roomId}`;
            const modalSelector = `#imageModal-${roomId}`;

            // Initialize main room slider
            new Splide(roomSliderSelector, {
                type: 'loop',
                perPage: 1,
                arrows: true,
                pagination: false,
            }).mount();

            const modal = document.querySelector(modalSelector);
            const closeBtn = modal.querySelector('.close');
            const openImages = roomCard.querySelectorAll('.open-modal');
            const moreDetailsBtn = roomCard.querySelector(`#open-modal-details-${roomId}`);

            let modalSlider = null;

            // Open modal via image click
            openImages.forEach((imgEl, index) => {
                imgEl.addEventListener('click', () => {
                    modal.style.display = 'flex';

                    if (!modalSlider) {
                        modalSlider = new Splide(modalSliderSelector, {
                            type: 'loop',
                            perPage: 1,
                            arrows: true,
                            pagination: false,
                        }).mount();
                    }

                    modalSlider.go(index);
                });
            });

            // Open modal via “More Details” link
            if (moreDetailsBtn) {
                moreDetailsBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    modal.style.display = 'flex';

                    if (!modalSlider) {
                        modalSlider = new Splide(modalSliderSelector, {
                            type: 'loop',
                            perPage: 1,
                            arrows: true,
                            pagination: false,
                        }).mount();
                    }

                    modalSlider.go(0);
                });
            }

            // Close modal
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Click outside modal to close
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });
</script>


<script>
    // Assuming this is sent via PHP:
    const hotelPriceStartDate = "{{ $hotel_price->start_date ?? '' }}";
    const hotelPriceEndDate = "{{ $hotel_price->end_date ?? '' }}";
    const nightCost = {{ $hotel_price-> night_cost ?? 0 }}; // Default to 0 if null

    function updateNightCount() {
        const checkInDate = document.getElementById('check_in_date').value;
        const checkOutDate = document.getElementById('check_out_date').value;

        if (checkInDate && checkOutDate) {
            const checkIn = new Date(checkInDate);
            const checkOut = new Date(checkOutDate);

            // Calculate the number of nights
            const timeDiff = checkOut - checkIn;
            const nightCount = timeDiff / (1000 * 3600 * 24); // Convert milliseconds to days

            if (nightCount > 0) {
                // Set night count
                document.getElementById('night_count').value = nightCount;

                // 🔹 Get infants count
                const infantsCount = parseInt(document.getElementById('infants-count').value) || 0;

                // 🔹 Set room_count = infantsCount (or append logic if needed)
                document.getElementById('room_count').value = infantsCount;

                // Update price
                updatePrice(nightCount, checkInDate, checkOutDate);
            } else {
                alert("Check-out date must be later than check-in date.");
            }
        }
    }

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

        document.getElementById('guests-value').innerText = totalGuests + (totalGuests === 1 ? 'guest' : 'guests');

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
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#phlGlb', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            arrows: false,
            gap: '1rem',
            autoplay: true,
            interval: 3000,
            pauseOnHover: true,
            breakpoints: {
                768: { perPage: 2 },
                480: { perPage: 1 }
            }
        }).mount();
    });
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('filter-form');
        const formKey = 'hotelFormData';

        function updateCityDisplay(cityId) {
            const selectedCityInput = document.querySelector(`input[name="city_id"][value="${cityId}"]`);
            const destinationValueEl = document.getElementById('destination-value');
            if (selectedCityInput && destinationValueEl) {
                const label = selectedCityInput.closest('label'); // assumes city name is in label
                const cityName = label ? label.textContent.trim() : selectedCityInput.dataset.cityName || 'Unknown';
                destinationValueEl.textContent = cityName;
            }
        }

        const savedData = JSON.parse(localStorage.getItem(formKey));
        if (savedData) {

            if (savedData.city_id) {
                const selectedCity = document.querySelector(`input[name="city_id"][value="${savedData.city_id}"]`);
                if (selectedCity) {
                    selectedCity.checked = true;
                    updateCityDisplay(savedData.city_id); // update city name on load
                }
            }

            if (savedData.start_date) document.getElementById('start_date').value = savedData.start_date;
            if (savedData.end_date) document.getElementById('end_date').value = savedData.end_date;
            if (savedData.date_range) document.getElementById('date-range').value = savedData.date_range;

            if (savedData.infants !== undefined) document.getElementById('infants-count').value = savedData.infants;
            if (savedData.adults !== undefined) document.getElementById('adults-count').value = savedData.adults;
            if (savedData.children !== undefined) document.getElementById('children-count').value = savedData.children;

            if (savedData.childrenAges && Array.isArray(savedData.childrenAges)) {
                setTimeout(() => {
                    updateChildAgeDropdown(savedData.children);
                    savedData.childrenAges.forEach((age, index) => {
                        const select = document.getElementById(`child-age-${index}`);
                        if (select) select.value = age;
                    });
                }, 100);
            }

            // 🧠 Update guest display after restoring data
            updateGuestDisplay();
        }

        // Save on submit
        form.addEventListener('submit', function (e) {
            const data = {
                city_id: form.city_id?.value,
                start_date: document.getElementById('start_date').value,
                end_date: document.getElementById('end_date').value,
                date_range: document.getElementById('date-range').value,
                infants: document.getElementById('infants-count').value,
                adults: document.getElementById('adults-count').value,
                children: document.getElementById('children-count').value,
                childrenAges: []
            };

            const ageDropdowns = document.querySelectorAll('#children-ages select');
            ageDropdowns.forEach((dropdown) => {
                data.childrenAges.push(dropdown.value);
            });

            localStorage.setItem(formKey, JSON.stringify(data));

            // 🧠 Also update guest count before submitting
            updateGuestDisplay();
        });

        // Optional: Live update guest count if user interacts with inputs
        document.getElementById('adults-count').addEventListener('input', updateGuestDisplay);
        document.getElementById('children-count').addEventListener('input', () => {
            updateGuestDisplay();
            updateChildAgeDropdown(parseInt(document.getElementById('children-count').value) || 0);
        });
    });
    document.querySelectorAll('input[name="city_id"]').forEach(input => {
        input.addEventListener('change', () => {
            updateCityDisplay(input.value);
        });
    });
    // Optional: Update children age dropdowns on count change
    function updateChildren(delta) {
        const countInput = document.getElementById('children-count');
        let count = parseInt(countInput.value) || 0;
        count = Math.max(0, count + delta);
        countInput.value = count;

        updateChildAgeDropdown(count);
    }

    function updateChildAgeDropdown(count) {
        const container = document.getElementById('children-ages');
        const label = document.getElementById('children-age-label');

        // Preserve existing selected values
        const previousValues = [];
        container.querySelectorAll('select').forEach((sel) => previousValues.push(sel.value));

        container.innerHTML = ''; // Clear old

        if (count > 0) {
            label.style.display = 'block';
            for (let i = 0; i < count; i++) {
                const select = document.createElement('select');
                select.id = `child-age-${i}`;
                select.name = `child_age_${i}`;
                select.classList.add('child-age-select');
                for (let age = 0; age <= 17; age++) {
                    const option = document.createElement('option');
                    option.value = age;
                    option.textContent = `${age} years`;
                    select.appendChild(option);
                }

                if (previousValues[i] !== undefined) {
                    const prev = previousValues[i];
                    const opt = Array.from(select.options).find(o => o.value == prev);
                    if (opt) select.value = prev;
                }

                container.appendChild(select);
            }
        } else {
            label.style.display = 'none';
        }
    }

    function updateGuestDisplay() {
        const adults = parseInt(document.getElementById('adults-count')?.value) || 0;
        const children = parseInt(document.getElementById('children-count')?.value) || 0;
        const totalGuests = adults + children;

        const guestValueEl = document.getElementById('guests-value');
        if (guestValueEl) {
            guestValueEl.textContent = `${totalGuests} Guest${totalGuests !== 1 ? 's' : ''}`;
        }
    }
</script>

<script>
function smoothScrollTo(target, duration = 800) {
    const start = window.pageYOffset;
    const end = target.offsetTop - 20;
    const distance = end - start;
    let startTime = null;

    function animation(currentTime) {
        if (!startTime) startTime = currentTime;
        const timeElapsed = currentTime - startTime;

        // Ease-out cubic transition
        const progress = Math.min(timeElapsed / duration, 1);
        const easeOut = 1 - Math.pow(1 - progress, 3);

        window.scrollTo(0, start + distance * easeOut);

        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        } else {
            highlightTarget(target);
        }
    }

    requestAnimationFrame(animation);
}

function highlightTarget(element) {
    element.style.transition = "background-color 0.5s ease";
    element.style.backgroundColor = "#a5e3ff36"; // Light blue highlight

    // Remove highlight smoothly
    setTimeout(() => {
        element.style.backgroundColor = "transparent";
    }, 1500);
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.smooth-scroll').forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            if (target) {
                smoothScrollTo(target, 1000); // 1s smooth scroll
            }
        });
    });
});
</script>



@endsection
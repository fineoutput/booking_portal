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
    </style>
    <div class="header-container_hotels">

        <div class="search-header_hotels">
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

                        {{-- @foreach($cities as $value) --}}
                        <label class="d-flex " for="city_" class="city-label orSamar" style="
                  border-bottom: 1px solid #00000033;     padding: 10px;">
                            <div class="city_list_htotle city-item mb-2">
                                <div class="desMund d-flex align-items-center gap-2">
                                    <div class="sizemaze">
                                        <!-- Image representing the city -->
                                        <img src="https://cdn-icons-png.flaticon.com/128/535/535239.png" alt="City Image" />
                                    </div>
                                    <p class="text-bold text-dark" href="#"><b></b></p>

                                    <div class="hotel_place">
                                        <!-- Input field for the city selection -->
                                        <input type="radio" id="city_" name="city_id" value=""
                                            class="destination-option_hotels opacity-0" onclick="selectDestination('')">

                                        <span class="hotels_spn"></span>
                                    </div>
                                </div>
                            </div>
                            <p id="no_city">no city found</p>
                        </label>
                        {{-- @endforeach --}}

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
                    <div id="children-ages" class="vincent"> </div>

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

                        <a href="{{ route('all_images', ['id' => base64_encode($hotel->id)]) }}">View All Images</a>

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
                                                <ul> @if($hotel_room_1 && $hotel_room_1->hotel_amenities)
                                                    @foreach(explode(',', $hotel_room_1->hotel_amenities) as $amenity)
                                                        @if(trim($amenity) !== '')
                                                            <li>{{ trim($amenity) }}</li>
                                                        @endif
                                                    @endforeach
                                                @endif

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="site_pricwe">
                                            <delt class="pii">
                                                <del>₹
                                                    @if($hotel_room_1 && $hotel_room_1->price)
                                                {{ $hotel_room_1->price->night_cost + 613 }}
                                            @else
                                                Price not available
                                            @endif</del> <span> Per night</span>
                                            </delt>
                                            <div class="andy_time d-flex">
                                                <p style="color: #000;font-size: 28px; font-weight: 900;line-height: 22px;">₹ @if ($hotel_room_1 && $hotel_room_1->price)
                                                {{ $hotel_room_1->price->night_cost }}
                                            @else
                                                Price not available
                                            @endif
                                            </div>
                                        </div>

                                        <div class="pulp_fiction">
                                            <div class="last_ride">
                                                <div class="live_set mt-3">
                                                    @if($hotel_room_1->id ?? '')
                                                    <a href="{{ route('final_booking',$hotel_room_1->id) }}" class="btn btn-primary">Book
                                                        Now</a>
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
                                <p class="hoses tarati">{{$hotel->text_description ?? ''}}
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
            <div class="room-card">
                <!-- Upgrade Banner -->
                <div class="upgrade-banner">
                    Upgrade to a room with larger size for ₹287
                </div>

                <div class="room-content">
                    <!-- Left Side -->
                    <div class="room-left">
                        <div class="jules">


                            <div id="room-slider" class="splide" style="height: 100%; width: 100%">
                                <div class="splide__track" style="height: 100% !important; width: 100%">
                                    <ul class="splide__list">
                                                @php
                                                    $images = json_decode($value->images, true);
                                                @endphp

                                                @if (is_array($images))
                                                    @foreach ($images as $image)
                                                        <li class="splide__slide">
                                                            <img src="{{ asset($image) }}" alt=""
                                                                style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;" 
                                                                class="open-modal">
                                                        </li>
                                                    @endforeach
                                                @else
                                                    {{-- Optional: Fallback message or default image --}}
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


                            <!-- Redesigned Modal -->
                            <div id="imageModal" class="modal"
                                style="display:none; align-items:center; justify-content:center; justify-items:center; ">
                                <div
                                    style="background:#fff; border-radius:16px; max-width:900px; width:95vw; max-height:90vh; overflow-y:auto; position:relative; box-shadow:0 8px 32px rgba(0,0,0,0.25);">
                                    <span class="close"
                                        style="position:absolute; top:15px; right:35px; color:#333; font-size:40px; font-weight:bold; cursor:pointer; z-index:999;">&times;</span>
                                    <div style="padding:32px 32px 16px 32px;">
                                        <h2 style="font-size:2rem; font-weight:700; margin-bottom:16px;">{{$value->title ?? ''}}</h2>
                                        <div id="modal-slider" class="splide" style="margin-bottom:24px;">
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                   @php
                                                        $images = json_decode($value->images, true);
                                                    @endphp
                                                    @if (is_array($images))
                                                        @foreach ($images as $image)
                                                            <li class="splide__slide">
                                                                <img src="{{ asset($image) }}" alt=""
                                                                    style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;" 
                                                                    class="open-modal">
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        {{-- Optional: Fallback message or default image --}}
                                                        <li class="splide__slide">
                                                            <img src="{{ asset('images/no-image.jpg') }}" alt="No image available"
                                                                style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                        </li>
                                                    @endif
                                                    {{-- <li class="splide__slide">
                                                        <img src="https://fineoutput.co.in/booking_portal/public/hotels/images/1757499045_30.webp"
                                                            alt=""
                                                            style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img src="https://fineoutput.co.in/booking_portal/public/hotels/images/1757499045_30.webp"
                                                            alt=""
                                                            style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                    </li>
                                                    <li class="splide__slide">
                                                        <img src="https://fineoutput.co.in/booking_portal/public/hotels/images/1757499045_30.webp"
                                                            alt=""
                                                            style="max-width:100%; max-height:400px; object-fit:cover; border-radius:8px; margin:auto; display:block;">
                                                    </li> --}}
                                                </ul>
                                            </div>
                                            <div class="splide__arrows">
                                                <button class="splide__arrow splide__arrow--prev">‹</button>
                                                <button class="splide__arrow splide__arrow--next">›</button>
                                            </div>
                                        </div>
                                        {{-- <div style="display:flex; flex-wrap:wrap; gap:24px; align-items:flex-start;">
                                            <div style="flex:2; min-width:260px;">
                                                <div
                                                    style="display:flex; gap:16px; align-items:center; margin-bottom:12px;">
                                                    <span>📐 220 sq.ft (20 sq.mt)</span>
                                                    <span>🌆 City View</span>
                                                </div>
                                                <div
                                                    style="display:flex; gap:16px; align-items:center; margin-bottom:12px;">
                                                    <span>🛏 1 King Bed</span>
                                                    <span>🛁 1 Bathroom</span>
                                                </div>
                                                <div style="margin-bottom:16px;">
                                                    <h4 style="font-size:1.1rem; font-weight:600; margin-bottom:8px;">Room
                                                        Amenities</h4>
                                                    <ul
                                                        style="display:grid; grid-template-columns:repeat(2,1fr); gap:8px 24px; padding-left:18px;">
                                                        <li>❄ Air Conditioning</li>
                                                        <li>📶 Wi-Fi</li>
                                                        <li>🚬 Smoking Room</li>
                                                        <li>✔ Mineral Water - additional charge</li>
                                                        <li>🧹 Daily Housekeeping</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                style="flex:1; min-width:200px; background:#f7f7f7; border-radius:8px; padding:16px;">
                                                <div
                                                    style="font-size:1.2rem; font-weight:700; color:#222; margin-bottom:8px;">
                                                    ₹ 1,663</div>
                                                <div style="color:#888; font-size:1rem; margin-bottom:8px;">+ ₹ 427 Taxes &
                                                    Fees per night</div>
                                                <button class="select-btn"
                                                    style="width:100%; background:#007bff; color:#fff; border:none; border-radius:6px; padding:10px 0; font-size:1rem; font-weight:600; margin-bottom:8px;">SELECT
                                                    ROOM</button>
                                                <div class="exclusive-offer" style="color:#0a66c2; font-size:0.95rem;">
                                                    Exclusive Offer - DBS Credit Card, Get 693 Off</div>
                                            </div>
                                        </div>
                                        <div style="margin-top:24px;">
                                            <h4 style="font-size:1.1rem; font-weight:600; margin-bottom:8px;">Room Only</h4>
                                            <ul class="offers" style="padding-left:18px;">
                                                <li>✔ Enjoy 20% off on drinks.</li>
                                                <li>✔ Non-Refundable</li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>{{$value->title ?? ''}}</h3>
                        <div class="features">

                            <ul class="rmTypeList vertical appendTop10 ">
                                 @foreach(explode(',', $value->nearby) as $amenity)
                                    @if(trim($amenity) !== '')
                                        {{-- <li>✔ {{ trim($amenity) }}</li> --}}
                                        <li class="rmTypeList__item"><span class="rmTypeList__item--icon appendRight10"><img
                                            src="https://promos.makemytrip.com/Hotels_product/Hotel_SR/Android/drawable-hdpi/size.png"
                                            alt="220 sq.ft (20 sq.mt)"></span><span
                                        class="makeFlex column column-text"><span class="rmTypeList__item--text">{{ trim($amenity) }}</span></span></li>
                                    @endif
                                @endforeach
                                
                                {{-- <li class="rmTypeList__item"><span class="rmTypeList__item--icon appendRight10"><img
                                            src="https://promos.makemytrip.com/Hotels_product/Hotel_SR/Android/drawable-hdpi/view.png"
                                            alt="City View"></span><span class="makeFlex column column-text"><span
                                            class="rmTypeList__item--text">City View</span></span></li>
                                <li class="rmTypeList__item"><span class="rmTypeList__item--icon appendRight10"><img
                                            src="https://promos.makemytrip.com/Hotels_product/Hotel_SR/Android/drawable-hdpi/bed.png"
                                            alt="1 King Bed"></span><span class="makeFlex column column-text"><span
                                            class="rmTypeList__item--text">1 King Bed</span></span></li>
                                <li class="rmTypeList__item"><span class="rmTypeList__item--icon appendRight10"><img
                                            src="https://promos.makemytrip.com/hotelfacilities/bathroom.png"
                                            alt="1 Bathroom"></span><span class="makeFlex column column-text"><span
                                            class="rmTypeList__item--text">1 Bathroom</span></span></li> --}}
                            </ul>
                        </div>
                        <a href="#" class="more-link" id="open-modal-details">More Details</a>
                    </div>
                    <div class="room_Center">
                        <h4 class="naxo">Room Only</h4>
                        <ul class="offers">
                              @foreach(explode(',', $value->room_amenities) as $amenity)
                                    @if(trim($amenity) !== '')
                                        <li>✔ {{ trim($amenity) }}</li>
                                    @endif
                                @endforeach
                        </ul>
                    </div>
                    <!-- Right Side -->
                    <div class="room-right">

                        <div class="old-price">@if ($value->price)
                                ₹{{ $value->price->night_cost + 613 }} 
                            @else
                                0
                            @endif
                        </div>
                        <div class="price">
                           @if ($value->price)
                                <p>₹{{ $value->price->night_cost }} / night</p>
                            @else
                                <p><em>Price not available for selected dates.</em></p>
                            @endif
                         </div>
                        {{-- <div class="tax">+ ₹ 427 Taxes & Fees per night</div> --}}
                        <button class="select-btn">
                            <a href="{{ route('final_booking',$value->id) }}" class="text-light">SELECT ROOM</a>
                        </button>
                        <div class="exclusive-offer">
                            Exclusive Offer - DBS Credit Card, Get 693 Off
                        </div>
                    </div>
                </div>
            </div>
              @endforeach
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Main slider
            new Splide('#room-slider', {
                type: 'loop',
                arrows: true,
                pagination: false,
                drag: false,
            }).mount();

            // Modal slider
            var modalSlider = new Splide('#modal-slider', {
                type: 'loop',
                arrows: true,
                pagination: false,
                drag: false,
            });

            // Modal
            var modal = document.getElementById("imageModal");
            var closeBtn = document.querySelector(".close");


            // Open modal when any image clicked
            document.querySelectorAll('.open-modal').forEach((img, index) => {
                img.addEventListener('click', () => {
                    modal.style.display = "block";
                    modalSlider.mount();
                    modalSlider.go(index); // start from clicked image
                });
            });

            // Open modal when 'More Details' link is clicked
            var moreDetailsBtn = document.getElementById('open-modal-details');
            if (moreDetailsBtn) {
                moreDetailsBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    modal.style.display = "block";
                    modalSlider.mount();
                    modalSlider.go(0); // start from first image
                });
            }

            // Close modal
            closeBtn.onclick = function () {
                modal.style.display = "none";
            }
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
    {{--
    <script>
        // Assuming this is sent via PHP:
        const hotelPriceStartDate = "{{ $hotel_price->start_date ?? '' }}";
        const hotelPriceEndDate = "{{ $hotel_price->end_date ?? '' }}";
        const nightCost = {{ $hotel_price-> night_cost ?? '' }};

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
                    document.getElementById('night_count').value = nightCount;
                    updatePrice(nightCount, checkInDate, checkOutDate);
                } else {
                    alert("Check-out date must be later than check-in date.");
                }
            }
        }
        function updatePrice(nightCount, checkInDate, checkOutDate) {
            // Extract month and year from check-in and check-out dates
            const checkInMonth = new Date(checkInDate).getMonth() + 1; // Get month (1-12)
            const checkInYear = new Date(checkInDate).getFullYear(); // Get year

            // Extract month and year from hotel price availability
            const hotelPriceStartMonth = new Date(hotelPriceStartDate).getMonth() + 1;
            const hotelPriceStartYear = new Date(hotelPriceStartDate).getFullYear();

            const hotelPriceEndMonth = new Date(hotelPriceEndDate).getMonth() + 1;
            const hotelPriceEndYear = new Date(hotelPriceEndDate).getFullYear();

            // Check if the selected date range is within the available range
            if (
                (checkInYear > hotelPriceStartYear || (checkInYear === hotelPriceStartYear && checkInMonth >= hotelPriceStartMonth)) &&
                (checkInYear < hotelPriceEndYear || (checkInYear === hotelPriceEndYear && checkInMonth <= hotelPriceEndMonth))
            ) {
                // Calculate total price
                const totalPrice = nightCost * nightCount;

                // Update the price dynamically in the HTML (for display purposes)
                document.getElementById('dynamic-price').innerText = '₹' + totalPrice;

                // Set the hidden total cost input value
                document.getElementById('total-cost-input').value = totalPrice; // This is the correct hidden input
            } else {
                document.getElementById('dynamic-price').innerText = 'Price not available for selected dates';

                // Set the hidden total cost input to null or a message
                document.getElementById('total-cost-input').value = null;
            }
        }


        function updateGuestss(type, delta) {
            const countElement = document.getElementById(type + '-count');
            let count = parseInt(countElement.value);
            count += delta;

            // Ensure the count doesn't go below 0 for children or infants
            if (count >= 0) {
                countElement.value = count;
                updateGuestCounts();
            }
        }

        function updateGuestCounts() {
            console.log("Update guest count triggered");
            const adultsCount = parseInt(document.getElementById('adults-count').value) || 0;
            const childrenCount = parseInt(document.getElementById('children-count').value) || 0;
            const infantsCount = parseInt(document.getElementById('infants-count').value) || 0;

            const totalGuests = adultsCount + childrenCount + infantsCount;
            console.log("Total Guests: ", totalGuests);

            document.getElementById('guests-value').innerText = totalGuests + (totalGuests === 1 ? ' guest' : ' guests');
            document.getElementById('guest_count').value = totalGuests;
        }




    </script> --}}

    <script>

    </script>

    <script>
        // Assuming this is sent via PHP:
        const hotelPriceStartDate = "{{ $hotel_price->start_date ?? '' }}";
        const hotelPriceEndDate = "{{ $hotel_price->end_date ?? '' }}";
        const nightCost = {{ $hotel_price->night_cost ?? 0 }}; // Default to 0 if null

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

@endsection
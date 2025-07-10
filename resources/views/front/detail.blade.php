@extends('front.common.app')
@section('title','home')
@section('content')
<style>
/* The Modal */
.zoom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.8);
}

/* Modal Content */
.zoom-modal-content {
    margin: auto;
    display: block;
    width: 100%;
    max-width: 1000px;
    transition: 0.3s ease-in-out;
    height: 90%;
}

.zoom-modal-content:hover {
    transform: scale(1.05);
}

/* Close Button */
.zoom-close {
    position: absolute;
    top: 30px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}
</style>
<section class="dett_sect" style="background: #f3f3f3;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mt-5">
               
                <div class="head_txxt">
                    <h4>{{$packages->package_name ?? ''}},{{$packages->state->state_name ?? ''}},{{$packages->cities->city_name ?? ''}}</h4>
                    
                    <div class="hum_str">
                        <div class="plan_type_date">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <p style="margin: 0;">350+ guests rated 5*</p>
                            <p style="margin: 0;color: #0a66c2;font-weight: bold;">
                                10 Reviews</p>
                        </div>
                    </div>
                    <div class="hum_str">
                        <div class="plan_type_date gap-2">
                            <p>
                                <i class="fa-solid fa-calendar-days"></i>
                                <b>8</b> Days
                            </p>
                            <p>
                                <i class="fa-solid fa-location-dot"></i>
                                <b>7</b> Cities
                            </p>
                        </div>
                    </div>
                </div>
                <div class="head_mage">
                    <div class="mage_vin">
                        @php
                          $images = json_decode($packages->image, true); 
                        @endphp
                    
                        @if($images && count($images) > 0) 
                            <img src="{{ asset($images[array_key_first($images)]) }}" alt="Package Image">
                        @else
                            <p>No image available.</p>
                        @endif
                    
                    
                    </div>
                </div>

                <div class="head_incldes mt-5 d-flex gap-5 flex-wrap">
                    <div class="sonnn">
                        <div class="head_incldes_left">
                            <h4>About Package</h4>
                        </div>
                        <div class="inc_icn d-flex gap-4">
                            {{-- <p>
                                {!! $packages->text_description !!}
                            </p>
                            <p>
                                {!! $packages->text_description_2 !!}
                            </p> --}}
                        </div>
                        <div class="tab-container mt-5">
                            <div class="button-container">
                                <button class="tab-button" id="tab1-btn">Overview</button>
                                <button class="tab-button" id="tab2-btn"> Itinerary 
 
                                </button>
                            </div>
                
                            <div class="content-container">
                    <div class="tab-content" id="tab1-content">
                        <p>
                            {!! $packages->text_description !!}
                        </p>
                    </div>
                
                    <div class="tab-content" id="tab2-content" style="display: none;">
                        <p>
                            {!! $packages->text_description_2 !!}
                        </p>
                    </div>
                </div>
                
                            </div>
                    </div>

                    <div class="sonn_rght d-flex align-items-baseline justify-content-between">
                        {{-- <div class="aage">
                            <h4>Key Highlights</h4>
                            <div class="ras_radio_btbs">Mehtab Bagh</div>
                            <div class="ras_radio_btbs">Agra Fort</div>
                            <div class="ras_radio_btbs">Taj Mahal</div>
                            <div class="ras_radio_btbs">Fatehpur Sikhri</div>
                            <div class="ras_radio_btbs">Mathura and Vrindavan</div>
                            <div class="ras_radio_btbs">Ganga Aarti at Har Ki Pauri</div>
                        </div> --}}

                        <!-- Button to trigger modal -->
                        {{-- <a type="button" class=" mt-3" data-bs-toggle="modal" data-bs-target="#cityModal">
                            View More Cities
                        </a> --}}
                    </div>

                    <!-- Modal Structure -->
                    <div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cityModalLabel">More Cities</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        @foreach(explode(',', $packages->city_id) as $city_id)
                                        @php
                                            $city = \App\Models\City::find($city_id);  // Fetch the city by its ID
                                        @endphp
                                    
                                        @if($city)
                                            <li class="list-group-item">{{ $city->city_name }}</li>
                                        @endif
                                    @endforeach
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="ttils">
                    <div class="hotel_tags">
                        <h4>
                            Select departure city, dates & add guest to book your tour
                        </h4>
                        <p>As seats fill, prices increase! So book today!</p>
                    </div>
                </div>
                <div class="hazars">
                    {{-- <form method="POST" action="{{route('add_package_booking', ['id' => $packages->id])}}" class="needs-validation" novalidate>
                        @csrf
                    
                     
                     <div class="row g-3 mb-3">
                        <div class="col-md-6 loc_stl">
                            <div class="rj_vk">
                                <img style="width: 20px;" src="{{ asset('frontend/images/schedule.png') }}" alt="">
                                <label for="startDate" class="form-label">Start Date</label>
                            </div>
                            <input name="start_date" type="date" id="startDate" class="form-control no-form" required>
                        </div>
                        <div class="col-md-6">
                            <div class="rj_vk">
                                <img style="width: 20px;" src="{{ asset('frontend/images/schedule.png') }}" alt="">
                                <label for="endDate" class="form-label">End Date</label>
                            </div>
                            <input name="end_date" type="date" id="endDate" class="form-control no-form" required>
                        </div>
                    </div>
                        <!-- Everything else in a single column -->
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/couple.png')}}" alt="">
                                    <label for="adults" class="form-label">No. of Adults</label>
                                </div>
                                <input name="adults_count" type="number" id="adults" class="form-control no-form" min="1" required placeholder="Adults">
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/cot.png')}}" alt="">
                                    <label for="kidsWithBed" class="form-label">Kids with Bed</label>
                                </div>
                                <input name="child_with_bed_count" type="number" id="kidsWithBed" class="form-control no-form" min="0" required placeholder="Kids with bed">
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/children.png')}}" alt="">
                                    <label for="kidsWithoutBed" class="form-label">Kids without Bed</label>
                                </div>
                                <input name="child_no_bed_child_count" type="number" id="kidsWithoutBed" class="form-control no-form" min="0" required placeholder="Kids without bed">
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/extra-bed.png')}}" alt="">
                                    <label for="extraBed" class="form-label">Extra Bed</label>
                                </div>
                                <select id="extraBed" name="extra_bed" class="form-select no-form-select" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/breakfast.png')}}" alt="">
                                    <label for="mealPlan" class="form-label">Meal Plan</label>
                                </div>
                                <select id="mealPlan" name="meal" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select meal plan</option>
                                    <option value="only_room">Only Room</option>
                                    <option value="breakfast">Breakfast</option>
                                    <option value="breakfast_lunch">Breakfast + lunch</option>
                                    <option value="breakfast_dinner">Breakfast + dinner</option>
                                    <option value="all_meals">All meals</option>
                                </select>
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/hotel.png')}}" alt="">
                                    <label for="hotelPreference" class="form-label">Hotel Preference</label>
                                </div>
                                <select id="hotelPreference" name="hotel_preference" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select preference</option>
                                    <option value="standard_cost">Standard (1 star)</option>
                                            <option value="deluxe_cost">Deluxe (3 star)</option>
                                            <option value="super_deluxe_cost">Deluxe (4 star)</option>
                                            <option value="luxury_cost">Deluxe  (5 star)</option>
                                            <option value="premium_3_cost">Premium (3 star)</option>
                                            <option value="premium_cost">Premium (4 star)</option>
                                            <option value="premium_5_cost">Premium (5 star)</option>
                                            <option value="hostels">Hostels</option>
                                </select>
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/sport-car.png')}}" alt="">
                                    <label for="vehicleOptions" class="form-label">Vehicle Options</label>
                                </div>
                                <select id="vehicleOptions" name="vehicle_options" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select vehicle</option>
                                    <option value="hatchback_cost">Hatchback</option>
                                    <option value="sedan_cost">Sedan</option>
                                    <option value="luxury_sedan_cost">Luxury Sedan</option>
                                    <option value="economy_suv_cost">Compact SUV</option>
                                    <option value="suv_cost">SUV</option>
                                    <option value="muv_cost">MUV</option>
                                    <option value="luxury_suv_cost">Luxury SUV</option>
                                    <option value="traveller_mini_cost">Traveller (7-12 pass)</option>
                                    <option value="traveller_big_cost">Traveller (12-21 pass)</option>
                                    <option value="premium_traveller_cost">Premium traveller (10-16 pass)</option>
                                    <option value="ac_coach_cost">Bus (AC) </option>
                                    <option value="bus_nonac_cost">Bus ( Non AC ) </option>
                                </select>
                            </div>
                    
                            <div class="col-12">
                                <div class="rj_vk">
                                    <img style="width: 20px;" src="{{asset('frontend/images/booking.png')}}" alt="">
                                    <label for="bookingSource" class="form-label">Booking Source</label>
                                </div>
                                <select id="bookingSource" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select source</option>
                                    <option value="direct">Direct Booking</option>
                                    <option value="reference">Reference</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                    
                            <div class="col-12 form-check">
                                <input class="form-check-input" name="travelinsurance" type="checkbox" id="travelInsurance">
                                <label class="form-check-label" for="travelInsurance">Add Travel Insurance</label>
                            </div>
                    
                            <div class="col-12 mb-3">
                                <label for="specialRemarks" class="form-label">Special Remarks</label>
                                <textarea name="specialremarks" id="specialRemarks" class="form-control" rows="3"></textarea>
                            </div>
                    
                            <!-- Submit Button -->
                            <div class="col-12">
                                @if(Auth::guard('agent')->check())
                                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                                @else
                                    <a class="btn btn-primary w-100" href="{{ route('login') }}">Submit</a>
                                @endif
                            </div>
                        </div>
                    </form> --}}


                    <form method="POST" action="{{ route('add_package_booking', ['id' => $packages->id]) }}" class="needs-validation" novalidate>
    @csrf

    {{-- Start & End Dates --}}
    <div class="row g-3 mb-3">
        <div class="col-md-6 loc_stl">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/schedule.png') }}" alt="">
                <label for="startDate" class="form-label">Start Date</label>
            </div>
            <input name="start_date" type="date" id="startDate" class="form-control no-form" required
                value="{{ old('start_date', session('booking_form_data.start_date')) }}">
        </div>
        <div class="col-md-6">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/schedule.png') }}" alt="">
                <label for="endDate" class="form-label">End Date</label>
            </div>
            <input name="end_date" type="date" id="endDate" class="form-control no-form" required
                value="{{ old('end_date', session('booking_form_data.end_date')) }}">
        </div>
    </div>

    <div class="row g-3">
        {{-- Adults --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/couple.png') }}" alt="">
                <label for="adults" class="form-label">No. of Adults</label>
            </div>
            <input name="adults_count" type="number" id="adults" class="form-control no-form" min="1" required
                value="{{ old('adults_count', session('booking_form_data.adults_count')) }}" placeholder="Adults">
        </div>

        {{-- Kids with bed --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/cot.png') }}" alt="">
                <label for="kidsWithBed" class="form-label">Kids with Bed</label>
            </div>
            <input name="child_with_bed_count" type="number" id="kidsWithBed" class="form-control no-form" min="0" required
                value="{{ old('child_with_bed_count', session('booking_form_data.child_with_bed_count')) }}" placeholder="Kids with bed">
        </div>

        {{-- Kids without bed --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/children.png') }}" alt="">
                <label for="kidsWithoutBed" class="form-label">Kids without Bed</label>
            </div>
            <input name="child_no_bed_child_count" type="number" id="kidsWithoutBed" class="form-control no-form" min="0" required
                value="{{ old('child_no_bed_child_count', session('booking_form_data.child_no_bed_child_count')) }}" placeholder="Kids without bed">
        </div>

        {{-- Extra Bed --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/extra-bed.png') }}" alt="">
                <label for="extraBed" class="form-label">Extra Bed</label>
            </div>
            <select id="extraBed" name="extra_bed" class="form-select no-form-select" required>
                <option value="yes" {{ old('extra_bed', session('booking_form_data.extra_bed')) == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ old('extra_bed', session('booking_form_data.extra_bed')) == 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        {{-- Meal Plan --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/breakfast.png') }}" alt="">
                <label for="mealPlan" class="form-label">Meal Plan</label>
            </div>
            <select id="mealPlan" name="meal" class="form-select no-form-select" required>
                <option value="" disabled {{ !session('booking_form_data.meal') ? 'selected' : '' }}>Select meal plan</option>
                @foreach(['only_room', 'breakfast', 'breakfast_lunch', 'breakfast_dinner', 'all_meals'] as $meal)
                    <option value="{{ $meal }}" {{ old('meal', session('booking_form_data.meal')) == $meal ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $meal)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Hotel Preference --}}
        {{-- <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/hotel.png') }}" alt="">
                <label for="hotelPreference" class="form-label">Hotel Preference</label>
            </div>
            <select id="hotelPreference" name="hotel_preference" class="form-select no-form-select" required>
                <option value="" disabled {{ !session('booking_form_data.hotel_preference') ? 'selected' : '' }}>Select preference</option>
                @foreach(['standard_cost' => 'Standard (1 star)', 'deluxe_cost' => 'Deluxe (3 star)', 'super_deluxe_cost' => 'Deluxe (4 star)', 'luxury_cost' => 'Deluxe (5 star)', 'premium_3_cost' => 'Premium (3 star)', 'premium_cost' => 'Premium (4 star)', 'premium_5_cost' => 'Premium (5 star)', 'hostels' => 'Hostels'] as $key => $label)
                    <option value="{{ $key }}" {{ old('hotel_preference', session('booking_form_data.hotel_preference')) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/hotel.png') }}" alt="">
                <label for="hotelPreference" class="form-label">Hotel Preference</label>
            </div>
            <select id="hotelPreference" name="hotel_preference" class="form-select no-form-select" required>
                <option value="" disabled {{ !session('booking_form_data.hotel_preference') ? 'selected' : '' }}>Select preference</option>

                @foreach ($packagesprices as $value)
                    @php
                        $hotelCategory = $value->hotel_category ?? '';
                        $selectedPref = old('hotel_preference', session('booking_form_data.hotel_preference'));
                    @endphp
                    @if($hotelCategory)
                        <option value="{{ $hotelCategory }}" {{ $selectedPref == $hotelCategory ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $hotelCategory)) }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>


        {{-- Vehicle Options --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/sport-car.png') }}" alt="">
                <label for="vehicleOptions" class="form-label">Vehicle Options</label>
            </div>
            <select id="vehicleOptions" name="vehicle_options" class="form-select no-form-select" required>
                <option value="" disabled {{ !session('booking_form_data.vehicle_options') ? 'selected' : '' }}>Select vehicle</option>
                @foreach([
                    'hatchback_cost' => 'Hatchback',
                    'sedan_cost' => 'Sedan',
                    'luxury_sedan_cost' => 'Luxury Sedan',
                    'economy_suv_cost' => 'Compact SUV',
                    'suv_cost' => 'SUV',
                    'muv_cost' => 'MUV',
                    'luxury_suv_cost' => 'Luxury SUV',
                    'traveller_mini_cost' => 'Traveller (7-12 pass)',
                    'traveller_big_cost' => 'Traveller (12-21 pass)',
                    'premium_traveller_cost' => 'Premium traveller (10-16 pass)',
                    'ac_coach_cost' => 'Bus (AC)',
                    'bus_nonac_cost' => 'Bus ( Non AC )'
                ] as $value => $label)
                    <option value="{{ $value }}" {{ old('vehicle_options', session('booking_form_data.vehicle_options')) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Booking Source --}}
        <div class="col-12">
            <div class="rj_vk">
                <img style="width: 20px;" src="{{ asset('frontend/images/booking.png') }}" alt="">
                <label for="bookingSource" class="form-label">Booking Source</label>
            </div>
            <select id="bookingSource" name="booking_source" class="form-select no-form-select" required>
                <option value="" disabled {{ !session('booking_form_data.booking_source') ? 'selected' : '' }}>Select source</option>
                <option value="direct" {{ old('booking_source', session('booking_form_data.booking_source')) == 'direct' ? 'selected' : '' }}>Direct Booking</option>
                <option value="reference" {{ old('booking_source', session('booking_form_data.booking_source')) == 'reference' ? 'selected' : '' }}>Reference</option>
                <option value="online" {{ old('booking_source', session('booking_form_data.booking_source')) == 'online' ? 'selected' : '' }}>Online</option>
            </select>
        </div>

        {{-- Travel Insurance --}}
        <div class="col-12 form-check">
            <input class="form-check-input" name="travelinsurance" type="checkbox" id="travelInsurance"
                {{ old('travelinsurance', session('booking_form_data.travelinsurance')) ? 'checked' : '' }}>
            <label class="form-check-label" for="travelInsurance">Add Travel Insurance</label>
        </div>

        {{-- Special Remarks --}}
        <div class="col-12 mb-3">
            <label for="specialRemarks" class="form-label">Special Remarks</label>
            <textarea name="specialremarks" id="specialRemarks" class="form-control" rows="3">{{ old('specialremarks', session('booking_form_data.specialremarks')) }}</textarea>
        </div>

        {{-- Submit Button --}}
        <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Submit</button>

            {{-- @if(Auth::guard('agent')->check())
                <button class="btn btn-primary w-100" type="submit">Submit</button>
            @else
                <a class="btn btn-primary w-100" href="{{ route('login') }}">Submit</a>
            @endif --}}
        </div>
    </div>
</form>

@php
    // Clear session after use
    session()->forget('booking_form_data');
@endphp
                    
                </div>

            </div>
            <div class="col-lg-3 mt-5">
                <div class="price_tabs">
                    <div class="pr_lft">
                        {{-- <p>Starts from <span class="dus_ghd"><b>₹32,000</b></span></p> --}}
                        <span>Package Images</span>
                    </div>
                </div>

                @php
                // Decode the JSON string to an array
                $images = json_decode($packages->image, true);
            @endphp

<div class="galsant_set">
    <div class="reviews-img-wrapper justify-content-xl-between d-flex flex-wrap ng-star-inserted">


        @foreach (json_decode($packages->image) as $image)
   <div class="image-col mob-d-none ng-star-inserted">
    <td>
        <img class="display-image" src="{{ asset($image) }}" alt="First Image" onclick="openZoom(this)">
        <br>
    </td>
</div>

<!-- Zoom Modal -->
<div id="zoomModal" class="zoom-modal" onclick="closeZoom()">
    <span class="zoom-close">&times;</span>
    <img class="zoom-modal-content" id="zoomedImage">
</div>

    @endforeach


        <!-- Display the second image (if exists) -->
   

    </div>
</div>

<!-- Modal for Image -->
{{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Show the last image in the modal -->
                <img src="{{ asset($images[count($images) - 1]) }}" alt="Image Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div> --}}


                {{-- <div class="galsant_set">
                    <div class="reviews-img-wrapper justify-content-xl-between d-flex flex-wrap ng-star-inserted">
                        <div class="image-col mob-d-none ng-star-inserted">
                            <img class="background-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                            <img class="display-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                        </div>
                        <div class="image-col mob-d-none ng-star-inserted">
                            <img class="background-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                            <img class="display-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                        </div>
                        <div class="image-col mob-d-none ng-star-inserted">
                            <img class="background-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                            <img class="display-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                        </div>
                        <!-- Trigger element -->
                        <div class="image-col mob-d-none ng-star-inserted mod-sd" data-bs-toggle="modal" data-bs-target="#imageModal">
                            <img class="background-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                            <img class="display-image" src="{{asset('frontend/images/dsd.avif')}}" alt="">
                        </div>
                    </div>
                </div> --}}

                <!-- Modal Structure -->

                @php
                    $images = json_decode($packages->image);
                @endphp

                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center d-flex flex-wrap">
                                @if($images && is_array($images))
                                    @foreach($images as $image)
                                        <div class="modds_garr">
                                            <div class="modds_garr_img">
                                                <img src="{{ asset($image) }}" alt="Image" class="img-fluid">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No images available.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center d-flex flex-wrap">
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                                <div class="modds_garr">
                                    <div class="modds_garr_img">
                                        <img src="{{asset('frontend/images/dsd.avif')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</section>

<script>
function openZoom(img) {
    const modal = document.getElementById("zoomModal");
    const modalImg = document.getElementById("zoomedImage");
    modal.style.display = "block";
    modalImg.src = img.src;
}

function closeZoom() {
    document.getElementById("zoomModal").style.display = "none";
}
</script>



<script>
    const nightCount = {{ $packages->night_count }};

    document.getElementById('startDate').addEventListener('change', function () {
        const startDateValue = this.value;
        const startDate = new Date(startDateValue);

        if (!isNaN(startDate)) {
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + nightCount);

            const formattedEndDate = endDate.toISOString().split('T')[0];

            // Only set end date if user hasn’t manually changed it yet
            const endInput = document.getElementById('endDate');

            // Optional: if you want to reset it every time regardless, remove this condition
            if (!endInput.dataset.userEdited) {
                endInput.value = formattedEndDate;
            }
        }
    });

    // Track manual changes by user
    document.getElementById('endDate').addEventListener('input', function () {
        this.dataset.userEdited = true;
    });
</script>

@endsection
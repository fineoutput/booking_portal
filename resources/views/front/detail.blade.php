@extends('front.common.app')
@section('title','home')
@section('content')

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
                                <button class="tab-button" id="tab1-btn">About 1</button>
                                <button class="tab-button" id="tab2-btn">About 2</button>
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
                        <a type="button" class=" mt-3" data-bs-toggle="modal" data-bs-target="#cityModal">
                            View More Cities
                        </a>
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
                    <form method="POST" action="{{route('add_package_booking', ['id' => $packages->id])}}" class="needs-validation" novalidate>
                        @csrf
                        <!-- Location Selection -->

                        <!-- Date Range -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 loc_stl">
                                <div class="rj_vk">
                            <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                                <label for="startDate" class="form-label">Start Date</label>
                                </div>
                                <input name="start_date" type="date" id="startDate" class="form-control no-form" required>
                            </div>
                            <div class="col-md-6">
                                <div class="rj_vk">
                            <img style="width: 20px;" src="{{asset('frontend/images/schedule.png')}}" alt="">
                                <label for="startDate" class="form-label">End Date</label>
                                </div>
                                <input name="end_date" type="date" id="endDate" class="form-control no-form" required>
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3 chin_up">
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="{{asset('frontend/images/couple.png')}}" alt="">
                                <label for="adults" class="form-label">No. of Adults</label>
                            </div>
                                <input name="adults_count" type="number" id="adults" class="form-control no-form" min="1" required placeholder="Adults">
                            </div>
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="{{asset('frontend/images/cot.png')}}" alt="">
                                <label for="kidsWithBed" class="form-label">Kids with Bed</label>
                            </div>
                                <input name="child_with_bed_count" type="number" id="kidsWithBed" class="form-control no-form" min="0" required placeholder="Kids with bed">
                            </div>
                            <div class="col-md-4">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="{{asset('frontend/images/children.png')}}" alt="">
                                <label for="kidsWithoutBed" class="form-label">Kids without Bed</label>
                            </div>
                                <input name="child_no_bed_child_count" type="number" id="kidsWithoutBed" class="form-control no-form" min="0" required placeholder="kids without bed">
                            </div>
                        </div>

                        <!-- Extra Bed -->
                        <div class="mb-3 row chin_up">
                        <div class="col-md-4 loc_stl">
                        <div class="rj_vk">
                        <img style="width: 20px;" src="{{asset('frontend/images/extra-bed.png')}}" alt="">
                            <label for="extraBed" class="form-label">Extra Bed</label>
                        </div>
                            <select id="extraBed" name="extra_bed" class="form-select no-form-select" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 loc_stl">
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
                        <div class="col-md-4">
                        <div class="rj_vk">
                        <img style="width: 20px;" src="{{asset('frontend/images/hotel.png')}}" alt="">
                                <label for="hotelPreference" class="form-label">Hotel Preference</label>
                        </div>
                                <select id="hotelPreference" name="hotel_preference" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select preference</option>
                                    <option value="standard">Standard (1 Star)</option>
                                    <option value="deluxe">Deluxe (2 Star)</option>
                                    <option value="super_deluxe">Super Deluxe (3 Star)</option>
                                    <option value="luxury">Luxury (4 Star)</option>
                                    <option value="premium">Premium (5 Star)</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hotel & Room Preferences -->
                        <div class="mb-3 row chin_up">
                            
                            {{-- <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                        <img style="width: 20px;" src="{{asset('frontend/images/interior-design.png')}}" alt="">
                                <label for="roomPreference" class="form-label">Room Preference</label>
                            </div>
                                <select id="roomPreference" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select room</option>
                                    <option value="room1">Room 1</option>
                                    <option value="room2">Room 2</option>
                                </select>
                            </div> --}}
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                        <img style="width: 20px;" src="{{asset('frontend/images/sport-car.png')}}" alt="">
                                <label for="vehicleOptions" class="form-label">Vehicle Options</label>
                            </div>
                                <select id="vehicleOptions" name="vehicle_options" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select vehicle</option>
                                    <option value="hatchback_cost">Hatchback</option>
                                    <option value="sedan_cost">Sedan</option>
                                    <option value="economy_suv_cost">Economy SUV</option>
                                    <option value="luxury_suv_cost">Luxury SUV</option>
                                    <option value="	traveller_mini_cost">Traveller (7-12 pass)</option>
                                    <option value="traveller_big_cost">Traveller (12-21 pass)</option>
                                    <option value="premium_traveller_cost">Premium traveller (10-16 pass)</option>
                                    <option value="ac_coach_cost">AC Coach (18-30 pass)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
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
                        </div>

                        <!-- Meal Plan -->
                        


                        <!-- Booking Source -->

                        <div class="form-check mb-3">
                            <input class="form-check-input" name="travelinsurance" type="checkbox" id="travelInsurance">
                            <label class="form-check-label" for="travelInsurance">Add Travel Insurance</label>
                        </div>
                        <div class="mb-3">
                            <label for="specialRemarks" class="form-label">Special Remarks</label>
                            <textarea name="specialremarks" id="specialRemarks" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit Button -->
                        @if(Auth::guard('agent')->check())
                        <button style="text-decoration: none; color: #fff;" class="btn btn-primary w-80 d-flex justify-content-center" type="submit">Submit</button>
                        @else
                            <a class="btn btn-primary w-80 d-flex justify-content-center" style="text-decoration: none; color: #fff; " href="{{ route('login') }}">Submit</a> 
                        @endif
                       
                    </form>
                </div>

            </div>
            <div class="col-lg-3 mt-5">
                <div class="price_tabs">
                    <div class="pr_lft">
                        {{-- <p>Starts from <span class="dus_ghd"><b>₹32,000</b></span></p> --}}
                        <span>per person on twin sharing</span>
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
        {{-- <img class="background-image" src="{{ asset($image) }}" alt="First Image"> --}}
        <td><img class="display-image" src="{{ asset($image) }}" alt="First Image"><br></td>
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
@endsection
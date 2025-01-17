@extends('front.common.app')
@section('title','home')
@section('content')

<section class="dett_sect" style="background: #f3f3f3;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mt-5">
               
                <div class="head_txxt">
                    <h4>Delhi Agra Haridwar Rishikesh</h4>
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
                        <img src="https://img.veenaworld.com/group-tours/india/north-east/nems/nehl-i-bnn-1-nems-4102021.jpg" alt="">
                    </div>
                </div>

                <div class="head_incldes mt-5 d-flex gap-5 flex-wrap">
                    <div class="sonnn">
                        <div class="head_incldes_left">
                            <h4>Tour Includes</h4>
                        </div>
                        <div class="inc_icn d-flex gap-4">
                            <div class="iccn">
                                <i class="fa-solid fa-hotel" style="color: #FFD43B;"></i>
                                <p>Hotel</p>
                            </div>
                            <div class="iccn">
                                <i class="fa-solid fa-utensils" style="color: #FFD43B;"></i>
                                <p>
                                    Meals</p>
                            </div>
                            <div class="iccn">
                                <i class="fa-solid fa-van-shuttle" style="color: #FFD43B;"></i>
                                <p>Transport</p>
                            </div>
                            <div class="iccn">
                                <i class="fa-solid fa-camera" style="color: #FFD43B;"></i>
                                <p>Sightseeing</p>
                            </div>
                            <div class="iccn">
                                <i class="fa-solid fa-plane" style="color: #FFD43B;"></i>
                                <p>Flight</p>
                            </div>
                        </div>
                        <div class="sany_txt">
                            <p>*Except for Joining/Leaving, To & fro economy class airfare is included for all<br> departure cities.
                            </p>
                            <p>*Taxes Extra.</p>
                        </div>
                    </div>
                    <div class="sonn_rght d-flex align-items-baseline justify-content-between">
                        <div class="aage">
                            <h4>Key Highlights</h4>
                            <div class="ras_radio_btbs">Mehtab Bagh</div>
                            <div class="ras_radio_btbs">Agra Fort</div>
                            <div class="ras_radio_btbs">Taj Mahal</div>
                            <div class="ras_radio_btbs">Fatehpur Sikhri</div>
                            <div class="ras_radio_btbs">Mathura and Vrindavan</div>
                            <div class="ras_radio_btbs">Ganga Aarti at Har Ki Pauri</div>
                        </div>

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
                                        <li class="list-group-item">Delhi</li>
                                        <li class="list-group-item">Jaipur</li>
                                        <li class="list-group-item">Varanasi</li>
                                        <li class="list-group-item">Rishikesh</li>
                                        <li class="list-group-item">Amritsar</li>
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
                    <form class="needs-validation" novalidate>
                        <!-- Location Selection -->

                        <!-- Date Range -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 loc_stl">
                                <div class="rj_vk">
                            <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="">
                                <label for="startDate" class="form-label">Start Date</label>
                                </div>
                                <input type="date" id="startDate" class="form-control no-form" required>
                            </div>
                            <div class="col-md-6">
                                <div class="rj_vk">
                            <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/schedule.png" alt="">
                                <label for="startDate" class="form-label">End Date</label>
                                </div>
                                <input type="date" id="endDate" class="form-control no-form" required>
                            </div>
                        </div>

                        <!-- Package Selection -->

                        <!-- Adults and Kids -->
                        <div class="row g-3 mb-3 chin_up">
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/couple.png" alt="">
                                <label for="adults" class="form-label">No. of Adults</label>
                            </div>
                                <input type="number" id="adults" class="form-control no-form" min="1" required placeholder="Adults">
                            </div>
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/cot.png" alt="">
                                <label for="kidsWithBed" class="form-label">Kids with Bed</label>
                            </div>
                                <input type="number" id="kidsWithBed" class="form-control no-form" min="0" required placeholder="Kids with bed">
                            </div>
                            <div class="col-md-4">
                            <div class="rj_vk">
                            <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/children.png" alt="">
                                <label for="kidsWithoutBed" class="form-label">Kids without Bed</label>
                            </div>
                                <input type="number" id="kidsWithoutBed" class="form-control no-form" min="0" required placeholder="kids without bed">
                            </div>
                        </div>

                        <!-- Extra Bed -->
                        <div class="mb-3 row chin_up">
                        <div class="col-md-4 loc_stl">
                        <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/extra-bed.png" alt="">
                            <label for="extraBed" class="form-label">Extra Bed</label>
                        </div>
                            <select id="extraBed" class="form-select no-form-select" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="col-md-4 loc_stl">
                        <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/breakfast.png" alt="">
                            <label for="mealPlan" class="form-label">Meal Plan</label>
                        </div>
                            <select id="mealPlan" class="form-select no-form-select" required>
                                <option value="" disabled selected>Select meal plan</option>
                                <option value="plan1">Plan 1</option>
                                <option value="plan2">Plan 2</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                        <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/hotel.png" alt="">
                                <label for="hotelPreference" class="form-label">Hotel Preference</label>
                        </div>
                                <select id="hotelPreference" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select preference</option>
                                    <option value="hotel1">Hotel 1</option>
                                    <option value="hotel2">Hotel 2</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hotel & Room Preferences -->
                        <div class="mb-3 row chin_up">
                            
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/interior-design.png" alt="">
                                <label for="roomPreference" class="form-label">Room Preference</label>
                            </div>
                                <select id="roomPreference" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select room</option>
                                    <option value="room1">Room 1</option>
                                    <option value="room2">Room 2</option>
                                </select>
                            </div>
                            <div class="col-md-4 loc_stl">
                            <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/sport-car.png" alt="">
                                <label for="vehicleOptions" class="form-label">Vehicle Options</label>
                            </div>
                                <select id="vehicleOptions" class="form-select no-form-select" required>
                                    <option value="" disabled selected>Select vehicle</option>
                                    <option value="vehicle1">Vehicle 1</option>
                                    <option value="vehicle2">Vehicle 2</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            <div class="rj_vk">
                        <img style="width: 20px;" src="http://127.0.0.1:8000/frontend/images/booking.png" alt="">
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
                            <input class="form-check-input" type="checkbox" id="travelInsurance">
                            <label class="form-check-label" for="travelInsurance">Add Travel Insurance</label>
                        </div>
                        <div class="mb-3">
                            <label for="specialRemarks" class="form-label">Special Remarks</label>
                            <textarea id="specialRemarks" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <a style="text-decoration: none; color: #fff;" class="btn btn-primary w-80 d-flex justify-content-center" href="{{ route('confirmation') }}">Submit</a>
                        <!-- <a style="text-decoration: none; color: #fff; " href="{{ route('confirmation') }}"><button class="btn btn-primary w-100">Login</button></a> -->
                    </form>
                </div>

            </div>
            <div class="col-lg-3 mt-5">
                <div class="price_tabs">
                    <div class="pr_lft">
                        <p>Starts from <span class="dus_ghd"><b>₹32,000</b></span></p>
                        <span>per person on twin sharing</span>
                    </div>
                </div>

                <div class="galsant_set">
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
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
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
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
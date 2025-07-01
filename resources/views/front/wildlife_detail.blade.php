@extends('front.common.app')
@section('title','home')
@section('content')
<style>
    .splide__arrow {
        display: none;
    }

    .car_model {
        display: flex;
        justify-content: space-evenly;
        align-items: baseline;
    }
</style>
<section class="detail_htels mt-5">
    <div class="comp-container">
        <div class="upper_site_dets">
            <div class="site_det_head">
                <h4 class="raj_hotel">{{$wildlife->national_park ?? ''}}</h4>
            </div>
        </div>
        <div class="air_maze">

            <div class="row">
                <div class="col-lg-7 nive d-none d-lg-block">
                    <div class="mirror_maxe">
                        @php
                            // Assuming 'image' contains a JSON array of images
                            $images = json_decode($wildlife->image); // Decode the JSON to an array
                        @endphp
            
                        @if($images && is_array($images) && count($images) > 0)
                            <!-- Display the first image on top -->
                            <img src="{{ asset($images[0]) }}" alt="">
                        @else
                            <p>No image available.</p>
                        @endif
                    </div>
                </div>
            
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="row">
                        @if($images && is_array($images) && count($images) > 1)
                            <!-- Loop through the remaining images -->
                            @foreach(array_slice($images, 1) as $image)
                                <div class="col-lg-6">
                                    <div class="side_masic">
                                        <img src="{{ asset($image) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No additional images available.</p>
                        @endif
                    </div>
            
                    <hr>
            
                    <div class="row">
                        @if($images && is_array($images) && count($images) > 2)
                            <!-- Loop through the remaining images (after the first two) -->
                            @foreach(array_slice($images, 2) as $image)
                                <div class="col-lg-6">
                                    <div class="side_masic">
                                        <img src="{{ asset($image) }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No additional images available.</p>
                        @endif
                    </div>
                </div>
            </div>
            

            {{-- <div class="row">
                <div class="col-lg-7 nive d-none d-lg-block">
                    <div class="mirror_maxe">
                        <img src="https://i.pinimg.com/736x/41/a8/8e/41a88e0bcc032c9d378169ebd48b21c7.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/65/e7/64/65e7642bd46b656057929c17c4d002bd.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/dd/1a/5f/dd1a5f87662b3a58221f42e7e6cfc95d.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/0c/3a/f5/0c3af5949f5053c5285e00bfeb1ef446.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/5e/96/82/5e9682f42856edf6bc9f882ed5e9f03e.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div id="phlGlb" class="splide">
                <div class="splide__track d-lg-none">
                    <ul class="splide__list">
                        {{-- <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
                        <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
                        <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li> --}}
                        @php
                            $images = json_decode($wildlife->image);
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

        <div class="other_dets mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="sides_maxe">
                        <div class="aaeheads">
                            <h4 class="hoses">{{$wildlife->national_park ?? ''}},       {{$wildlife->cities->city_name ?? ''}}
                            </h4>
                            <!-- <span class="sabke">
                                <ol class="lgx66tx atm_gi_idpfg4 atm_l8_idpfg4 dir dir-ltr" style="
    padding-left: 0 !important;
">
                                    <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr">2 bedrooms<span class="axjq0r atm_9s_glywfm dir dir-ltr"><span class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr" aria-hidden="true"> · </span></span></li>
                                    <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr"><span class="pen26si dir dir-ltr"><span class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr" aria-hidden="true"> · </span></span>2 king beds<span class="axjq0r atm_9s_glywfm dir dir-ltr"><span class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr" aria-hidden="true"> · </span></span></li>
                                    <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr"><span class="pen26si dir dir-ltr"><span class="s1b4clln atm_mj_glywfm atm_vb_glywfm atm_vv_1jtmq4 atm_lk_idpfg4 atm_ll_idpfg4 dir dir-ltr" aria-hidden="true"> · </span></span>Private attached bathroom</li>
                                </ol>
                            </span> -->
                        </div>
                    </div>

                    <!-- <div class="htt_facili">
                        <div class="sangeetam">
                            <h4 class="hoses">Amenities</h4>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path d="M17 6a2 2 0 0 1 2 1.85v8.91l.24.24H24v-3h-3a1 1 0 0 1-.98-1.2l.03-.12 2-6a1 1 0 0 1 .83-.67L23 6h4a1 1 0 0 1 .9.58l.05.1 2 6a1 1 0 0 1-.83 1.31L29 14h-3v3h5a1 1 0 0 1 1 .88V30h-2v-3H20v3h-2v-3H2v3H0V19a3 3 0 0 1 1-2.24V8a2 2 0 0 1 1.85-2H3zm13 13H20v6h10zm-13-1H3a1 1 0 0 0-1 .88V25h16v-6a1 1 0 0 0-.77-.97l-.11-.02zm8 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM17 8H3v8h2v-3a2 2 0 0 1 1.85-2H13a2 2 0 0 1 2 1.85V16h2zm-4 5H7v3h6zm13.28-5h-2.56l-1.33 4h5.22z"></path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1" class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr" elementtiming="LCP-target">Room in a home</h3>
                                        </div>
                                        <div class="_1hwkgn6">Your own room in a home, plus access to shared spaces.</div>
                                    </div>
                                </div>

                            </div>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path d="M9 1a5 5 0 0 0 4.78 5H14v2a6.98 6.98 0 0 1-5-2.1V7a5 5 0 0 0 4.78 5H14v2a6.98 6.98 0 0 1-5-2.1v6.22c.54.14 1.05.39 1.49.73l.18.16c.35.31.83.49 1.33.49.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 16 18c.99 0 1.95.35 2.67 1 .35.32.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 24 18c.99 0 1.94.35 2.67 1 .35.33.83.5 1.33.5a2 2 0 0 0 1.2-.38l.13-.11c.2-.19.43-.35.67-.49V26a5 5 0 0 1-4.78 5H7a5 5 0 0 1-5-4.78v-7.7c.24.14.47.3.67.49.3.27.71.44 1.14.48l.19.01h.19c.37-.04.72-.17 1-.38l.14-.11A3.9 3.9 0 0 1 7 18.12V11.9A6.98 6.98 0 0 1 2.24 14H2v-2a5 5 0 0 0 5-4.78V5.9A6.98 6.98 0 0 1 2.24 8H2V6a5 5 0 0 0 5-4.78V1h2zm15 24c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 25c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 25c-.5 0-.98.17-1.33.5a3.94 3.94 0 0 1-2.22.97l-.2.02h-.2A3 3 0 0 0 6.81 29L7 29h18a3 3 0 0 0 2.96-2.5H28a3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 24 25zm0-5c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 16 20c-.5 0-.98.17-1.33.5a3.98 3.98 0 0 1-2.67 1 3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 8 20c-.5 0-.98.17-1.33.5a3.94 3.94 0 0 1-2.22.97l-.2.02H4v3.01h.19c.37-.04.72-.17 1-.38l.14-.11A3.98 3.98 0 0 1 8 23c.99 0 1.95.35 2.67 1 .35.33.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.98 3.98 0 0 1 16 23c.99 0 1.95.35 2.67 1 .35.32.83.5 1.33.5.5 0 .98-.17 1.33-.5A3.97 3.97 0 0 1 24 23c.99 0 1.94.35 2.67 1 .35.33.83.5 1.33.5v-3a3.98 3.98 0 0 1-2.67-1A1.98 1.98 0 0 0 24 20zm0-14a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1" class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr" elementtiming="LCP-target">19-min walk to the lake</h3>
                                        </div>
                                        <div class="_1hwkgn6">This home is by Lake Pichola.</div>
                                    </div>
                                </div>

                            </div>
                            <div class="final_kalyan">
                                <div class="_wlu9uw">
                                    <div class="_1wiczqm"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;">
                                            <path d="M16 1a15 15 0 1 1 0 30 15 15 0 0 1 0-30zm0 2a13 13 0 1 0 0 26 13 13 0 0 0 0-26zm2 5a5 5 0 0 1 .22 10H13v6h-2V8zm0 2h-5v6h5a3 3 0 0 0 .18-6z"></path>
                                        </svg></div>
                                    <div>
                                        <div class="_llvyuq">
                                            <h3 tabindex="-1" class="hpipapi atm_7l_1kw7nm4 atm_c8_1x4eueo atm_cs_1kw7nm4 atm_g3_1kw7nm4 atm_gi_idpfg4 atm_l8_idpfg4 atm_kd_idpfg4_pfnrn2 dir dir-ltr" elementtiming="LCP-target">Park for free</h3>
                                        </div>
                                        <div class="_1hwkgn6">This is one of the few places in the area with free parking.</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> -->

                    <div class="nizam_abt mt-5">
                        <h4 class="naxo">About this Safari</h4>

                        <div class="ho_bhe">
                            <span>
                                State :-  {{$wildlife->state->state_name ?? ''}}
                            </span>
                            <span>· ·</span>
                            <span>
                                City :-  {{$wildlife->cities->city_name ?? ''}}
                            </span>
                            <span>· ·</span>
                            <span>
                                Timing :-  {{$wildlife->timings ?? ''}}
                            </span>
                            <span>· ·</span>
                            <span>
                                Date :-  {{$wildlife->date ?? ''}}
                            </span>
                            <br>
                            <span>
                                Vehicle :-  {{$wildlife->vehicle ?? ''}}
                            </span>
                            <span>· ·</span>
                            <span>
                                Cost :-  ₹{{$wildlife->cost ?? '0'}}
                            </span>
                        </div>
                    </div>

                    <div class="nizam_abt mt-5">
                        <h4 class="naxo">About this place</h4>

                        <div class="ho_bhe">
                            {{-- <span>
                                State :-  {{$wildlife->state->state_name ?? ''}}
                            </span>
                            <br>
                            <span>
                                City :-  {{$wildlife->cities->city_name ?? ''}}
                            </span>
                            <br>
                            <span>
                                Timing :-  {{$wildlife->timings ?? ''}}
                            </span>
                            <br>
                            <span>
                                Date :-  {{$wildlife->date ?? ''}}
                            </span>
                            <br>
                            <span>
                                Vehicle :-  {{$wildlife->vehicle ?? ''}}
                            </span>
                            <br>
                            <span>
                                Cost :-  ₹{{$wildlife->cost ?? '0'}}
                            </span> --}}
                            <span>
                                {!! $wildlife->description !!}
                            </span>
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-4">
                    <div class="sharan_side_box">
                        <div class="stand_it">
                            <div class="outer_box">
                            

                                <div class="inner_box">
                                    <div class="inner_price">
                                        {{-- <span style="color: rgb(106, 106, 106);">
                                            <del>₹<span id="original-price"></span>0</del>
                                        </span> --}}
                                        <span>₹<span id="final-price"></span></span>
                                    </div>
                                    <form action="{{ route('add_wildlife_booking',['id'=>$wildlife->id]) }}" method="POST">
                                        @csrf
                                        <div class="checks">


                                            <div class="bors">
                                                <div class="caranke">
                                                    <label for=""><b>Date</b></label>
                                                    <input type="date" name="date" class="filter-value_hotels" placeholder="Check In">
                                                </div>
                                                <div class="caranke">
                                                    <div class="filter-item_hotels sachi" onclick="toggleDropdown('timing')">
                                                        <div class="filter-label_hotels">Time</div>
                                                        <div class="filter-value_hotels" id="timing-value">Select Time</div>
                                                        <div class="dropdown_hotels timing-dropdown_hotels w-100" id="timing-dropdown">
                                                            <div class="time_list_hotels">
                                                                <div class="brit_life">
                                                                    <div class="ujale">
                                                                        <img src="{{ asset('frontend/images/sunrise.png') }}" alt="" style="width: 40px;">
                                                                    </div>
                                                                    <div class="time-option_hotels" onclick="selectTimings('morning')">Morning</div>
                                                                </div>
                                                                <div class="brit_life mt-3">
                                                                    <div class="ujale">
                                                                        <img src="{{ asset('frontend/images/moon.png') }}" alt="" style="width: 30px;">
                                                                    </div>
                                                                    <div class="time-option_hotels" onclick="selectTimings('evening')">Evening</div>
                                                                </div>
                                                                <div class="brit_life mt-3">
                                                                    <div class="ujale">
                                                                        <img src="{{ asset('frontend/images/moon.png') }}" alt="" style="width: 30px;">
                                                                    </div>
                                                                    <div class="time-option_hotels" onclick="selectTimings('afternoon')">After-noon</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            <label>Adults</label>
                                                            <div class="counter_hotels">
                                                                <button type="button" onclick="updateGuests('adults', -1)">-</button>
                                                                <input type="number" id="adults-count" value="1" min="1" name="no_adults" onchange="updateTotal()">
                                                                <button type="button" onclick="updateGuests('adults', 1)">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="guest-option_hotels">
                                                            <label>Children</label>
                                                            <div class="counter_hotels">
                                                                <button type="button" onclick="updateGuests('children', -1)">-</button>
                                                                <input name="no_persons" type="number" id="children-count" value="0" min="0" onchange="updateTotal()">
                                                                <button type="button" onclick="updateGuests('children', 1)">+</button>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="guest-option_hotels">
                                                            <label>No. of Rooms</label>
                                                            <div class="counter_hotels">
                                                                <button type="button" onclick="updateGuests('infants', -1)">-</button>
                                                                <input name="no_kids" type="number" id="infants-count" value="0" min="0" onchange="updateTotal()">
                                                                <button type="button" onclick="updateGuests('infants', 1)">+</button>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div class="rivvsa">
                                                <div class="select_sect trnas">
                                                    <label for="vehicle-round" class="form-label">Select Vehicle</label>
                                                </div>
                                                <input
                                                    type="text"
                                                    id="car-input-round"
                                                    class="form-control car-input no-form"
                                                    placeholder="Select a vehicle"
                                                    readonly
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#carModalRound">
                                                
                                                <!-- Modal for vehicle selection -->
                                                <div class="modal fade" id="carModalRound" tabindex="-1" aria-labelledby="carModalRoundLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="carModalRoundLabel">Select Vehicle Type</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="car_model">
                                                                    <div class="frst_mes" onclick="selectCar('Canter', 'car-input-round', 'carModalRound')" style="cursor: pointer;">
                                                                        <h6>Canter</h6>
                                                                        <img style="width:50%;" src="{{ asset('frontend/images/car_icons/suv.png') }}" alt="Canter">
                                                                    </div>
                                                                    <div class="frst_mes" id="trav" onclick="selectCar('Jeep','car-input-round', 'carModalRound')" style="cursor: pointer;">
                                                                        <h6>Jeep</h6>
                                                                        <img style="width:50%;" src="{{ asset('frontend/images/car_icons/traveller.png') }}" alt="Jeep">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                
                                        <!-- Hidden input fields to store total price, vehicle, and guest counts -->
                                        <input type="hidden" name="total_price" id="total-price" value="{{ $wildlife->cost ?? '0' }}">
                                        <input type="hidden" name="vehicle" id="selected-vehicle" value="">
                                        <input type="hidden" name="guest_count" id="guest-count" value="1">
                                        <input type="hidden" name="selected_time" id="selected_time">
                                        {{-- <input type="hidden" name="user_id" value="{{Auth::guard('agent')->user()}}"> --}}

                                        @if(Auth::guard('agent')->check())
                                        <div class="live_set mt-3">
                                            <button class="btn btn-info gggsd" type="submit">
                                                Reserve
                                            </button>
                                        </div>
                                        @else
                                        <div class="live_set mt-3">
                                            <a class="btn btn-info gggsd" href="{{route('login')}}">
                                            {{-- <button > --}}
                                                Reserve
                                            {{-- </button> --}}
                                        </a>
                                        </div>
                                        @endif
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    let wildlifeCost = {{ $wildlife->cost ?? 0 }};
    let jeepPrice = {{ $wildlife->jeep_price ?? 0 }};
    let canterPrice = {{ $wildlife->canter_price ?? 0 }};
    let totalPrice = wildlifeCost;

    // Update total price when guests are changed
    function updateGuests(type, value) {
        let count = document.getElementById(`${type}-count`).value;
        count = parseInt(count) + value;
        if (count < 1) count = 1;  // Ensure minimum 1 guest
        document.getElementById(`${type}-count`).value = count;
        updateTotal();
    }

    // Update total price on guest count or vehicle selection change
    function updateTotal() {
        let adults = parseInt(document.getElementById('adults-count').value);
        let children = parseInt(document.getElementById('children-count').value);
        // let infants = parseInt(document.getElementById('infants-count').value);

        // Calculate total price based on guests
        totalPrice = wildlifeCost * (adults + children );

        // Add vehicle price if selected
        let vehicleType = document.getElementById('car-input-round').value;
        if (vehicleType === 'Jeep') {
            totalPrice += jeepPrice;
        } else if (vehicleType === 'Canter') {
            totalPrice += canterPrice;
        }

        // Update the final price displayed
        document.getElementById('final-price').innerText = totalPrice;

        // Update hidden input fields for submission
        document.getElementById('total-price').value = totalPrice;
        document.getElementById('selected-vehicle').value = vehicleType;
        document.getElementById('guest-count').value = adults + children;
    }

    // Handle vehicle selection
    function selectCar(vehicle, inputId, modalId) {
        document.getElementById(inputId).value = vehicle;
        updateTotal();  // Update price when vehicle is selected
        document.getElementById(modalId).modal('hide');
    }



    function selectTimings(time) {

    console.log("selectTimings called with:", time); 

    document.getElementById('timing-value').innerText = time;

    
    let hiddenInput = document.querySelector('input[name="selected_time"]');
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'selected_time');
        document.querySelector('form').appendChild(hiddenInput);
    }

    hiddenInput.setAttribute('value', time);
    console.log("Hidden input value:", hiddenInput.value);  

    document.getElementById('timing-dropdown').style.display = 'none';
}



</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#phlGlb', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            gap: '1rem',
            autoplay: true,
            interval: 3000,
            pauseOnHover: true,
            breakpoints: {
                768: {
                    perPage: 2
                },
                480: {
                    perPage: 1
                }
            }
        }).mount();
    });

    const selectCar = (carType, inputId, modalId) => {
        const carInput = document.getElementById(inputId);
        if (carInput) {
            carInput.value = carType;
        } else {
            console.error(`Car input element with ID "${inputId}" not found!`);
        }

        const modal = document.getElementById(modalId);
        if (modal) {
            const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
            bootstrapModal.hide();
        } else {
            console.error(`Modal element with ID "${modalId}" not found!`);
        }
    };
</script>

@endsection
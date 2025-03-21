@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .splide__slide picture {
    display: block;
    width: 100%;
    height: auto;
}

.splide {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}
</style>
 <!-- /* //////////////Banner Starts///////////// */ -->
 <div id="responsive-slider" class="splide" style="background: #ffd600;" >
    <div class="layie">
      <h1>Plan Your Travel Now</h1>
                        <p>650+ Travel Agents serving 65+ Destinations worldwide</p></div>  
  <div class="splide__track">
      
        <ul class="splide__list">
          @foreach ($banner as $value)
          <li class="splide__slide">
            <picture style="  height: 50vh">
                <source media="(min-width: 1200px)" srcset="{{ asset($value->image) }}">
                {{-- <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/banne.png') }}">
                <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}"> --}}
                <img style="border-radius: 0;" src="{{ asset($value->image) }}" alt="Responsive Banner" >
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


  <!-- /* //////////////Banner Ends///////////// */ -->



  <!-- /* //////////////form starts///////////// */ -->
 
  

<!-- /* //////////////form ends///////////// */ -->


  <!-- /* //////////////Cards Starts///////////// */ -->
  <!-- <section class="cards_Section mt-5">
  <div class="container">
    <div class="scrollable-slider">
      <div class="row flex-nowrap">
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <div class="outer_loc">
          <div class="inner_car_ig">
            <img src="{{ asset('frontend/images/cards/klhl-thb.webp') }}" alt="">
          </div>
          <div class="inner_car_txt">
            <div class="type_price">
              <h6 class="type_xtxt">₹ 30000</h6>
            </div>
            <div class="type_date">
              <p>6 days | 17 Dept.</p>
            </div>
          </div>
          <div class="outer_car_txt justify-content-center">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 mt-2">
        <button class="crd_btn">View More</button>
      </div>
    </div>
  </div>
</section> -->

  <!-- /* //////////////Cards Ends///////////// */ -->


  <!-- /* //////////////Europe Starts///////////// */ -->
  <section class="euro_sect mt-5">
  <!-- Picture outside container for smaller screens -->
  <div class="responsive-image-wrapper">
    <picture >
      <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/sd.webp') }}">
      <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/sd.webp') }}">
      <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/sd.webp') }}">
      <img style="border-radius: 20px" src="{{ asset('frontend/images/sd.webp') }}" alt="Responsive Banner" class="responsive-image">
    </picture>
  </div>

  <!-- Content inside the container -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-md-12">
        <div class="world_upper">
          <div class="world_upper_txt">
            <h2>Europe & America</h2>
            <p>Always the right choice! Proven & trusted by thousands!</p>
          </div>
          <div class="world_upper_txt_btns">
            <a class="sarj_anch" href="#">Europe Tours</a>
            <a class="sarj_anch" href="#">America Tours</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- /* //////////////Europe Ends///////////// */ -->


  <!-- /* //////////////Gallery starts///////////// */ -->
    <section class="gallery_sect mt-5">
        <div class="container">
        <div class="row">
            <!-- Slider Section -->
            <div class="col-lg-4">
            <div class="side_slide">
                <section id="image-slider" class="splide" aria-label="Image Slider">
                <div class="splide__track">
                    <ul class="splide__list">
                    <li class="splide__slide long_slide">
                        <img src=
                        {{ asset('frontend/images/gallery/flat.avif') }} alt="Image 1">
                    </li>
                    <li class="splide__slide long_slide">
                        <img src="{{ asset('frontend/images/gallery/traveler-infographics-with-basic-travel-elements_23-2147647525.avif') }}" alt="Image 2">
                    </li>
                    </ul>
                </div>
                </section>
            </div>
            </div>

            <!-- /////large screeen tab///// -->
            <div class="col-lg-8 setts d-lg-block d-none">
    <div class="row">
      @foreach($popularCities as $value)
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                  @if($value['image'])
                  <img src="{{ asset($value['image']) }}" alt="">
                  @else
                    <img src="{{ asset('frontend/images/gallery/jkec-i-ftr.avif') }}" alt="">
                    @endif
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>{{ $value['bookings_count'] }}</b> tours |</p>
                        <p><b>{{ $value['adults_count'] }}</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>{{ $value['city_name'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>


            <!-- /////smaller screeen tab///// -->
            <div class="tab-container d-lg-none mt-5">
            <div class="button-container">
                {{-- <button class="tab-button" id="tab1-btn">India</button>
                <button class="tab-button" id="tab2-btn">Europe</button> --}}
            </div>

            <div class="content-container">
    <div class="tab-content" id="tab1-content">
        <div class="scrollable-slider">
            <div class="row flex-nowrap">
              @foreach($popularCities as $value)
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                      @if($value['image'])
                        <img src="{{ asset($value['image']) }}" alt="">
                        @else
                        <img src="{{ asset('frontend/images/gallery/rjwm-rjwp-1522023.avif') }}" alt="">
                        @endif
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>{{ $value['bookings_count'] }} tours |
                          {{ $value['adults_count'] }} guest Travelled</p>
                        <h2>{{ $value['city_name'] }}</h2>
                    </div>
                </div>
                @endforeach
                <!-- Repeat more cards -->
                {{-- <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/rjwm-rjwp-1522023.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Rajasthan</h2>
                    </div>
                </div>
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/tbh-GTSD-382021.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Gujrat</h2>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- <div class="tab-content" id="tab2-content" style="display: none;">
        <div class="scrollable-slider">
            <div class="row flex-nowrap">
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/amep-thb.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>America</h2>
                    </div>
                </div>
                <!-- Repeat more cards -->
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/rjwm-rjwp-1522023.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Rajasthan</h2>
                    </div>
                </div>
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/tbh-GTSD-382021.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt justify-content-center">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Gujrat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

            </div>
        </div>

        </div>
        </div>
        </div>
    </section>
  <!-- /* //////////////Gallery Ends///////////// */ -->


  <!-- /* //////////////Custom starts///////////// */ -->
  <section class="custom_sect mt-5">
    <div class="container">
        <div class="row" style="flex-wrap: wrap;">
            <div class="col-lg-6 d-lg-block d-none" style="position: relative;overflow: hidden;">
                <div id="slider">
                    <div class="slider-wrap">
                        <div id="intro-slider">
                            <div class="intro-slide" data-class="1" data-position="1">
                                <div class="slide-overlay"></div>
                                <div class="poster-box" style="background:url({{ asset('frontend/images/custom/1.jpg') }}) center center / cover no-repeat;">
                                </div>
                            </div>
                            <div class="intro-slide" data-class="2" data-position="2">
                                <div class="slide-overlay"></div>
                                <div class="poster-box" style="background:url({{ asset('frontend/images/custom/2.jpg') }}) center center / cover no-repeat;">
                                </div>
                            </div>
                            <div class="intro-slide" data-class="3" data-position="3">
                                <div class="slide-overlay"></div>
                                <div class="poster-box" style="background:url({{ asset('frontend/images/custom/3.jpg') }}) center center / cover no-repeat;">
                                </div>
                            </div>
                            <div class="intro-slide" data-class="4" data-position="4">
                                <div class="slide-overlay"></div>
                                <div class="poster-box" style="background:url({{ asset('frontend/images/custom/4.jpg') }}) center center / cover no-repeat;">
                                </div>
                            </div>
                            <div class="intro-slide" data-class="5" data-position="5">
                                <div class="slide-overlay"></div>
                                <div class="poster-box" style="background:url({{ asset('frontend/images/custom/5.jpg') }}) center center / cover no-repeat;">
                                </div>
                            </div>
                        </div>
                        <span id="slider-next">
                            <img src="https://yudiz.com/codepen/stack-slider/arrow.png" alt="arrow-image">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="custom_txt">
                    <div class="custom_head">
                        <h3 class="custom_title">Discover the World, <br>
                            specially curated for you!</h3>
                        <p class="custom_para">
                            Our exclusive customized holidays division can cater to every travel need: hotel, air tickets, VISA,
                            sightseeings, transfer or the entire package, all designed keeping in mind your interests!
                        </p>
                        <p class="custom_tell">
                            <strong>
                                Tell us what you want and we will design it for you.
                            </strong>
                        </p>
                    </div>
                    <div class="custom_bot">
                        <a class="_btn" href="#">Enquire now</a>
                        <p>or</p>
                        <div class="namems">
                            <i class="fa-solid fa-phone"></i>
                            <span class="custom_spn">1234567895</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- /* //////////////Custom Ends///////////// */ -->


  <!-- /* //////////////Travel starts///////////// */ -->
  <section class="euro_sect mt-5" id="name">
    <div class="container">
        <div class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Slide 1 -->
                    <li class="splide__slide">
                        <div class="responsive-image-wrapper">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                                <source media="(min-width: 768px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                                <source media="(max-width: 767px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                                <img src="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg" alt="Europe Banner" class="responsive-image">
                            </picture>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="travel_upper">
                                        <div class="travel_upper_txt">
                                            <p class="abb">Dubai Egypt Israel</p>
                                            <h2>Best of Dubai Abu Dhabi</h2>
                                        </div>
                                        <div class="world_upper_txt_btns">
                                            <p class="abb">Dubai . Abu Dhabi</p>
                                            <h4 class="abb">7 Days | 12 Jan | from <span style="color: #ffd801; font-weight: bold;">₹1,37,000</span></h4>
                                        </div>
                                        <div class="world_upper_txt_btns travel_btn">
                                            <a class="_btn" href="">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Slide 2 -->
                    <li class="splide__slide">
                        <div class="responsive-image-wrapper">
                          <picture>
                            <source media="(min-width: 1200px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                            <source media="(min-width: 768px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                            <source media="(max-width: 767px)" srcset="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg">
                            <img src="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg" alt="Europe Banner" class="responsive-image">
                        </picture>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="travel_upper">
                                        <div class="travel_upper_txt">
                                            <p class="abb">Dubai Egypt Israel</p>
                                            <h2>Best of Dubai Abu Dhabi</h2>
                                        </div>
                                        <div class="world_upper_txt_btns">
                                            <p class="abb">Dubai . Abu Dhabi</p>
                                            <h4 class="abb">7 Days | 12 Jan | from <span style="color: #ffd801; font-weight: bold;">₹1,37,000</span></h4>
                                        </div>
                                        <div class="world_upper_txt_btns travel_btn">
                                            <a class="_btn" href="">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

  <!-- /* //////////////Travel Ends///////////// */ -->



  <!-- /* //////////////plans starts///////////// */ -->
  <section class="cards_Section mt-5">
    <div class="container">
      <div class="scrollable-slider">
        <div class="row flex-nowrap">
          @if($packages)
          @foreach ($packages as $key => $value)
          <div class="col-lg-3">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  @php
                  // Assuming 'image' contains a JSON array of images
                  $images = json_decode($value->image, true); // Decode the JSON to an array (true for associative array)
              @endphp
              
              @if($images && is_array($images) && count($images) > 0)
                  <!-- Display the first image on top (use reset() to get the first image if keys are non-zero-based) -->
                  <img src="{{ asset(reset($images)) }}" alt="First Image">
              @else
                  <p>No image available.</p>
              @endif
              
                </div>
                <div class="inner_outer_txt">
                  
                  <div class="outer_type_price">
                    <h6 class="type_xtxt"> {{$value->cities->city_name ?? ''}} </h6>
                  </div>
                  <div class="plan_type_date">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p style="margin: 0;">2 reviews</p>
                  </div>
                  <div class="inclusive">
                    <i class="fa-solid fa-infinity"></i>
                    <p class="m-0">All Inclusive</p>
                  </div>
                </div>
              </div>
              <div class="">
                
                <div class="destination">
                  <p style="margin: 0;">{{$value->package_name ?? ''}}</p>
                  
                  @foreach($value->hotels as $hotel)
                    <span>{{ $hotel->name }}</span>,
                  @endforeach
                </div>
                
              </div>
              <div class="options_tav night">
                <div class="outer_car_txt justify-content-center justify-content-center">
                  <div class="night_ski skit">
                    
                    <span><a href="#"></a></span>
                  </div>
                  <div class="destination skit">
                    <div class="manags">
                      <p>Starts from
                        <b style="color: #000;">
                          @if($value->prices)
                          @php
                            $total = $value->prices->standard_cost + $value->prices->premium_cost + $value->prices->deluxe_cost + $value->prices->super_deluxe_cost +
            $value->prices->luxury_cost + $value->prices->nights_cost + $value->prices->adults_cost + $value->prices->child_with_bed_cost +
            $value->prices->child_no_bed_infant_cost + $value->prices->child_no_bed_child_cost + $value->prices->meal_plan_only_room_cost +
            $value->prices->meal_plan_breakfast_cost + $value->prices->meal_plan_breakfast_lunch_dinner_cost + $value->prices->meal_plan_all_meals_cost +
            $value->prices->hatchback_cost + $value->prices->sedan_cost + $value->prices->economy_suv_cost + $value->prices->luxury_suv_cost +
            $value->prices->traveller_mini_cost + $value->prices->traveller_big_cost + $value->prices->premium_traveller_cost + $value->prices->ac_coach_cost + $value->prices->extra_bed_cost; 
                          @endphp
                          <p>Price: ₹{{ number_format($value->prices->display_cost, 2) }}</p>
                      @else
                          <p>No price available.</p>
                      @endif
                        </b>
                      </p>
                      <span style="font-size: 10px;">per person on twin sharing</span>
                    </div>
                  </div>
                </div>
                <div class="options_btns d-flex justify-content-center">
                  <a class="_btn" href="{{route('detail',['id' => base64_encode($value->id)])}}">Book Now</a>
                </div>
                
              </div>
            </div>
            </div>
          @endforeach
          @else
            <div class="col-lg-6">
              <h1>No Package Found</h1>
            </div>
          @endif
          {{-- <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="https://cabme.in/_next/image?url=https%3A%2F%2Fapi.cabme.in%2Fcity-image%2FJaipur_2.png&w=128&q=75" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> Jaipur </h6>
                </div>
                <div class="plan_type_date">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <p style="margin: 0;">2 reviews</p>
                </div>
                <div class="inclusive">
                  <i class="fa-solid fa-infinity"></i>
                  <p class="m-0">All Inclusive</p>
                </div>
              </div>
            </div>
            <div class="">
              
              <div class="destination">
                <p style="margin: 0;">Home Stay.Trip Dekho</p>
                <span>Vrindavan launge and hotels</span>
              </div>
              
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt justify-content-center justify-content-center">
                <div class="destination skit">
                  <div class="manags">
                    <p>Starts from
                      <b style="color: #000;">₹4,20,000</b>
                    </p>
                    <span style="font-size: 10px;">per person on twin sharing</span>
                  </div>
                </div>
              </div>
              <div class="options_btns d-flex justify-content-center">
                <a class="_btn" href="">Book Now</a>
              </div>
              
            </div>
          </div> --}}

          {{-- <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="https://cabme.in/_next/image?url=https%3A%2F%2Fapi.cabme.in%2Fcity-image%2FUdaipur_1.png&w=128&q=75" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> Jodhpur </h6>
                </div>
                <div class="plan_type_date">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <p style="margin: 0;">2 reviews</p>
                </div>
                <div class="inclusive">
                  <i class="fa-solid fa-infinity"></i>
                  <p class="m-0">All Inclusive</p>
                </div>
              </div>
            </div>
            <div class="">
              
              <div class="destination">
                <p style="margin: 0;">Home Stay.Trip Dekho</p>
                <span>Vrindavan launge and hotels</span>
              </div>
              
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt justify-content-center justify-content-center">
                <div class="night_ski skit">
                  
                  <span><a href="#"></a></span>
                </div>
                <div class="destination skit">
                  <div class="manags">
                    <p>Starts from
                      <b style="color: #000;">₹4,20,000</b>
                    </p>
                    <span style="font-size: 10px;">per person on twin sharing</span>
                  </div>
                </div>
              </div>
              <div class="options_btns d-flex justify-content-center">
                <a class="_btn" href="">Book Now</a>
              </div>
              
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="https://cabme.in/_next/image?url=https%3A%2F%2Fapi.cabme.in%2Fcity-image%2FJodhpur_1.png&w=128&q=75" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> Jodhpur </h6>
                </div>
                <div class="plan_type_date">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <p style="margin: 0;">2 reviews</p>
                </div>
                <div class="inclusive">
                  <i class="fa-solid fa-infinity"></i>
                  <p class="m-0">All Inclusive</p>
                </div>
              </div>
            </div>
            <div class="">
              
              <div class="destination">
                <p style="margin: 0;">Home Stay.Trip Dekho</p>
                <span>Vrindavan launge and hotels</span>
              </div>
              
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt justify-content-center ">
                <div class="night_ski skit">
                  
                  <span><a href="#"></a></span>
                </div>
                <div class="destination skit">
                  <div class="manags">
                    <p>Starts from
                      <b style="color: #000;">₹4,20,000</b>
                    </p>
                    <span style="font-size: 10px;">per person on twin sharing</span>
                  </div>
                </div>
              </div>
              <div class="options_btns d-flex justify-content-center">
                <a class="_btn" href="">Book Now</a>
              </div>
              
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="https://cabme.in/_next/image?url=https%3A%2F%2Fapi.cabme.in%2Fcity-image%2FDelhi.png&w=128&q=75" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> Delhi NCR </h6>
                </div>
                <div class="plan_type_date">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <p style="margin: 0;">2 reviews</p>
                </div>
                <div class="inclusive">
                  <i class="fa-solid fa-infinity"></i>
                  <p class="m-0">All Inclusive</p>
                </div>
              </div>
            </div>
            <div class="">
              
              <div class="destination">
                <p style="margin: 0;">Home Stay.Trip Dekho</p>
                <span>Vrindavan launge and hotels</span>
              </div>
              
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt justify-content-center ">
                <div class="night_ski skit">
                  
                  <span><a href="#"></a></span>
                </div>
                <div class="destination skit">
                  <div class="manags">
                    <p>Starts from
                      <b style="color: #000;">₹4,20,000</b>
                    </p>
                    <span style="font-size: 10px;">per person on twin sharing</span>
                  </div>
                </div>
              </div>
              <div class="options_btns d-flex justify-content-center">
                <a class="_btn" href="">Book Now</a>
              </div>
              
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="https://cabme.in/_next/image?url=https%3A%2F%2Fapi.cabme.in%2Fcity-image%2FBengaluru.png&w=128&q=75" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> Banglore </h6>
                </div>
                <div class="plan_type_date">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <p style="margin: 0;">2 reviews</p>
                </div>
                <div class="inclusive">
                  <i class="fa-solid fa-infinity"></i>
                  <p class="m-0">All Inclusive</p>
                </div>
              </div>
            </div>
            <div class="">
              
              <div class="destination">
                <p style="margin: 0;">Home Stay.Trip Dekho</p>
                <span>Vrindavan launge and hotels</span>
              </div>
              
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt justify-content-center ">
                <div class="night_ski skit">
                  
                  <span><a href="#"></a></span>
                </div>
                <div class="destination skit">
                  <div class="manags">
                    <p>Starts from
                      <b style="color: #000;">₹4,20,000</b>
                    </p>
                    <span style="font-size: 10px;">per person on twin sharing</span>
                  </div>
                </div>
              </div>
              <div class="options_btns d-flex justify-content-center">
                <a class="_btn" href="">Book Now</a>
              </div>
              
            </div>
          </div> --}}

          <!-- Repeat more cards -->

        </div>
      </div>
    </div>
  </section>
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
@endsection
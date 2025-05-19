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
  .cardashEs {
            width: 300px;
            height: 450px;
            /* background: url('https://fineoutput.co.in/booking_portal/public/packages/images/1747469828_1742301772_aerial-shot-pin-valley-seen-from-mudh-village_11zon.jpg') no-repeat center/cover; */
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .gradient-overlayashEs {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }
        .price-tagashEs {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ffd700;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        .signboardashEs {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #008080;
            color: white;
            width: 80%;
            text-align: center;
            padding: 10px;
            border: 2px solid #000;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        .signboardashEs h2 {
            margin: 0;
            font-size: 18px;
        }
        .signboardashEs p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .contentashEs {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            color: white;
        }
        .contentashEs h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .itineraryashEs {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin: 5px 0;
        }
        .itineraryashEs span {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
        }
        .detailsashEs {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }
        .detailsashEs .durationashEs {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .detailsashEs .locationashEs {
            display: flex;
            align-items: center;
            gap: 5px;
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
            <div class="col-lg-5">
            <div class="side_slide">
                <section id="image-slider" class="splide" aria-label="Image Slider">
                <div class="splide__track">
                    <ul class="splide__list">
                      @foreach ($offer as $value)
                      <li class="splide__slide long_slide">
                          <img src=
                          {{ asset($value->image) }} alt="Image 1">
                      </li>
                      @endforeach
                    </ul>
                </div>
                </section>
            </div>
            </div>

            <!-- /////large screeen tab///// -->
            <div class="col-lg-7 setts d-lg-block d-none">
      <div class="splide" id="popularCitiesSlider">
        <div class="splide__track">
          <h2 class="text-center">Holiday Packages</h2>
            <ul class="splide__list">
                @foreach($popularCities as $value)
                    <li class="splide__slide">
                      <div class="row">
                        <div class="col">
                            <div class="gallery_loc">
                                <div class="inner_gallery_loc">
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
                                <div class="inner_gallery_loc_txt">
                                    <div class="type_gallery">
                                        <p><b>{{ $value->package_name ?? '' }}</b></p>
                                    </div>
                                    <div class="gall_place">
                                        <h4>{{ $value->cities->city_name ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
      <div class="splide" id="popularCitiesSlider2">
        <div class="splide__track">
          <h2 class="text-center">Travel Places</h2>
            <ul class="splide__list">
                @foreach($popularhotels as $value)
                    <li class="splide__slide">
                      <div class="row">
                        <div class="col">
                            <div class="gallery_loc">
                                <div class="inner_gallery_loc">
                                  @php
                                  $images = json_decode($value->images); 
                              @endphp
                              
                              @if($images && is_array($images) && count($images) > 0)
                                  <img src="{{ asset(reset($images)) }}" alt="First Image">
                              @else
                                  <p>No images available.</p>
                              @endif
                              
                                </div>
                                <div class="inner_gallery_loc_txt">
                                    <div class="type_gallery">
                                        <p><b>{{ $value->name ?? '' }}</b>
                                    </div>
                                    <div class="gall_place">
                                        <h4>{{ $value->cities->city_name ?? '' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </li>
                @endforeach
            </ul>
        </div>
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
        <div class="splide" id="tourSlider" >
            <div class="splide__track">
                <ul class="splide__list" style="height: 50vh">
                    <!-- Slide 1 -->
                    @foreach ($bottom as $value)
                    <li class="splide__slide">
                        <div class="responsive-image-wrapper" style="height: 100%">
                            <img src="{{asset($value->image)}}" alt="Europe Banner" class="responsive-image">
                        </div>
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
                    </li>
                    @endforeach
                    <!-- Slide 2 -->
                    {{-- <li class="splide__slide">
                        <div class="responsive-image-wrapper">
                            <img src="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg" alt="Europe Banner" class="responsive-image">
                        </div>
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
                    </li>
                    <!-- Slide 3 -->
                    <li class="splide__slide">
                        <div class="responsive-image-wrapper">
                            <img src="https://img.veenaworld.com/group-tours/india/sikkim-darjeeling/sdgl/shsd5-bnn-1.jpg" alt="Europe Banner" class="responsive-image">
                        </div>
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
                    </li> --}}
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
         
          
            
          <!-- Repeat more cards -->


          @if($packages)
          @foreach ($packages as $key => $value)
      <div class="col-lg-3">
           @php
                  $images = json_decode($value->image, true);

              @endphp
              
              @if($images && is_array($images) && count($images) > 0)
                    @php
                         $add = asset(reset($images));
                    @endphp
              @else
                   @php
                  $add = "No image available";
                  @endphp
 
              @endif
        <a style="color: #fff" href="{{route('detail',['id' => base64_encode($value->id)])}}">
         <div class="cardashEs" style="background: url('{{ $add ?? asset('frontend/images/hotel_main.avif') }}') no-repeat center / cover;">
           @if($value->prices)
                          @php
                            $total = $value->prices->standard_cost + $value->prices->premium_cost + $value->prices->premium_3_cost + $value->prices->deluxe_cost + $value->prices->super_deluxe_cost +
            $value->prices->luxury_cost + $value->prices->nights_cost + $value->prices->adults_cost + $value->prices->child_with_bed_cost +
            $value->prices->child_no_bed_infant_cost + $value->prices->child_no_bed_child_cost + $value->prices->meal_plan_only_room_cost +
            $value->prices->meal_plan_breakfast_cost + $value->prices->meal_plan_breakfast_lunch_dinner_cost + $value->prices->meal_plan_all_meals_cost +
            $value->prices->hatchback_cost + $value->prices->sedan_cost + $value->prices->economy_suv_cost + $value->prices->luxury_suv_cost +
            $value->prices->traveller_mini_cost + $value->prices->traveller_big_cost + $value->prices->premium_traveller_cost + $value->prices->ac_coach_cost + $value->prices->extra_bed_cost; 
                          @endphp
                          {{-- <p>Price: ₹{{ number_format($value->prices->display_cost, 2) }}</p> --}}
                        
        <div class="price-tagashEs">₹{{ number_format($value->prices->display_cost, 2) }} onwards</div>
                          @else
                          <p>No price available.</p>
                      @endif
        
        <div class="gradient-overlayashEs"></div>
        <div class="contentashEs">
          
            <h3>{{\Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</h3>
            
            <div class="itineraryashEs">
                <span>Leh</span>
                <span>Nubra Valley</span>
                <span>Pangong Tso</span>
                <span>Marsimik La</span>
                <span>+1 More</span>
            </div>
            <div class="detailsashEs">
                <div class="durationashEs">
                    <span>🕒 5N/6D</span>
                    <span>Any date of your choice</span>
                </div>
                <div class="locationashEs">
                    <span>📍 Leh-Leh</span>
                </div>
            </div>
        </div>
    </div>
        </a>

      </div>
       @endforeach
          @else
            <div class="col-lg-6">
              <h1>No Package Found</h1>
            </div>
          @endif

        </div>
      </div>
    </div>
  </section>
 
  <div class="container">
    <div class="row">
       
    </div>
  </div>
@endsection
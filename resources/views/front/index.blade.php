@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .splide__slide picture {
    display: block;
    width: 100%;
    height: auto;
}

</style>
 <!-- /* //////////////Banner Starts///////////// */ -->
 <div id="responsive-slider" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide">
                <picture>
                    <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
                    <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
                    <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
                    <img style="border-radius: 0;" src="{{ asset('frontend/images/banner/fallback_.png') }}" alt="Responsive Banner">
                </picture>
            </li>
            <li class="splide__slide">
                <picture>
                    <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
                    <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
                    <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
                    <img style="border-radius: 0;" src="{{ asset('frontend/images/banner/fallback_.png') }}" alt="Responsive Banner 2">
                </picture>
            </li>
            <!-- Add more slides as needed -->
        </ul>
    </div>
</div>


  <!-- /* //////////////Banner Ends///////////// */ -->



  <!-- /* //////////////form starts///////////// */ -->
  <section class="frrm_sect">
  <!-- <div class="container namesec mt-5">
    <h2 class="text-center mb-4">Booking Form</h2>
    <form class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="location" class="form-label">Select Location</label>
            <select id="location" class="form-select" required>
                <option value="" disabled selected>Select location</option>
                <option value="location1">Location 1</option>
                <option value="location2">Location 2</option>
                <option value="location3">Location 3</option>
            </select>
        </div>
        
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" id="startDate" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" id="endDate" class="form-control" required>
            </div>
        </div>
        
        <div class="mb-3">
          <label for="package" class="form-label">Select Package</label>
          <div class="mb-3">
            <div id="selected-heading" style="font-weight: bold; margin-bottom: 10px;"></div>
            <div class="custom-dropdown">
              <div class="dropdown-header" id="selected-package">Select package</div>
              <div class="dropdown-body">
                <div class="dropdown-item" data-value="package1">
                  <div class="plan_outer w-100">
                    <div class="outer_plan_upper">
                      <div class="outer_plan_img">
                      <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
                      </div>
                      <div class="inner_outer_txt">
                        <div class="upper_type_date">
                          <p>Group Tour</p>
                          <p style="background: #fb7d03; color: #fff; padding: 2px;">EUEP</p>
                        </div>
                        <div class="outer_type_price">
                          <h6 class="type_xtxt">European Marvels</h6>
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
                    <div class="outer_car_txt">
                      <div class="days skit">
                        <p>Days</p>
                        <span style="color: #595959;">17 days</span>
                      </div>
                      <div class="destination skit">
                        <p>Destinations</p>
                        <span>12 countries 27 cities</span>
                      </div>
                      <div class="departures skit">
                        <p>Departures</p>
                        <span>3 Dates</span>
                      </div>
                    </div>
                    <div class="options_tav night">
                      <div class="outer_car_txt ">
                        <div class="night_ski skit">
                          <p>EMI from</p>
                          <span><a href="#">₹14,162/mo</a></span>
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
                        <a class="_btn" href="#">View More Options</a>
                      </div>
                      <div class="expert text-center">
                        <i class="fa-regular fa-comments"></i>
                        <a class="expert_link" href="#">Talk to a Travel Expert</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="dropdown-item" data-value="package2">Package 2</div>
                <div class="dropdown-item" data-value="package3">Package 3</div>
              </div>
            </div>
          </div>
      </div>
        
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="adults" class="form-label">No. of Adults</label>
                <input type="number" id="adults" class="form-control" min="1" required>
            </div>
            <div class="col-md-4">
                <label for="kidsWithBed" class="form-label">Kids with Bed</label>
                <input type="number" id="kidsWithBed" class="form-control" min="0" required>
            </div>
            <div class="col-md-4">
                <label for="kidsWithoutBed" class="form-label">Kids without Bed</label>
                <input type="number" id="kidsWithoutBed" class="form-control" min="0" required>
            </div>
        </div>
        
        <div class="mb-3">
          <label for="extraBed" class="form-label">Extra Bed</label>
          <select id="extraBed" class="form-select" required>
              <option value="yes">Yes</option>
              <option value="no">No</option>
          </select>
        </div>
        
        <div class="mb-3">
            <label for="hotelPreference" class="form-label">Hotel Preference</label>
            <select id="hotelPreference" class="form-select" required>
                <option value="" disabled selected>Select preference</option>
                <option value="hotel1">Hotel 1</option>
                <option value="hotel2">Hotel 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="roomPreference" class="form-label">Room Preference</label>
            <select id="roomPreference" class="form-select" required>
                <option value="" disabled selected>Select room</option>
                <option value="room1">Room 1</option>
                <option value="room2">Room 2</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="mealPlan" class="form-label">Meal Plan</label>
            <select id="mealPlan" class="form-select" required>
                <option value="" disabled selected>Select meal plan</option>
                <option value="plan1">Plan 1</option>
                <option value="plan2">Plan 2</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="vehicleOptions" class="form-label">Vehicle Options</label>
            <select id="vehicleOptions" class="form-select" required>
                <option value="" disabled selected>Select vehicle</option>
                <option value="vehicle1">Vehicle 1</option>
                <option value="vehicle2">Vehicle 2</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="bookingSource" class="form-label">Booking Source</label>
            <select id="bookingSource" class="form-select" required>
                <option value="" disabled selected>Select source</option>
                <option value="direct">Direct Booking</option>
                <option value="reference">Reference</option>
                <option value="online">Online</option>
            </select>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="travelInsurance">
          <label class="form-check-label" for="travelInsurance">Add Travel Insurance</label>
        </div>
        <div class="mb-3">
          <label for="specialRemarks" class="form-label">Special Remarks</label>
          <textarea id="specialRemarks" class="form-control" rows="3"></textarea>
        </div>
        
        <a style="text-decoration: none; color: #fff;" class="btn btn-primary w-80 d-flex justify-content-center" href="{{ route('confirmation') }}">Submit</a>
    </form>
  </div> -->
</section>

<!-- /* //////////////form ends///////////// */ -->


  <!-- /* //////////////Cards Starts///////////// */ -->
  <section class="cards_Section mt-5">
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
          <div class="outer_car_txt">
            <h2>Highlights of Kerala</h2>
          </div>
        </div>
        <!-- Repeat more cards -->
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
          <div class="outer_car_txt">
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
          <div class="outer_car_txt">
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
          <div class="outer_car_txt">
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
          <div class="outer_car_txt">
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
          <div class="outer_car_txt">
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
</section>

  <!-- /* //////////////Cards Ends///////////// */ -->


  <!-- /* //////////////Europe Starts///////////// */ -->
  <section class="euro_sect mt-5">
  <!-- Picture outside container for smaller screens -->
  <div class="responsive-image-wrapper">
    <picture>
      <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/world/europe-info.webp') }}">
      <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/world/europe-info-tab.webp') }}">
      <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/world/europe-info-mobile.avif') }}">
      <img src="{{ asset('frontend/images/world/europe-info.webp') }}" alt="Responsive Banner" class="responsive-image">
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
                        {{ asset('frontend/images/gallery/first.jpg') }} alt="Image 1">
                    </li>
                    <li class="splide__slide long_slide">
                        <img src="{{ asset('frontend/images/gallery/secound.jpg') }}" alt="Image 2">
                    </li>
                    <li class="splide__slide long_slide">
                        <img src="{{ asset('frontend/images/gallery/tjird.jpg') }}" alt="Image 3">
                    </li>
                    </ul>
                </div>
                </section>
            </div>
            </div>

            <!-- /////large screeen tab///// -->
            <div class="col-lg-8 setts d-lg-block d-none">
    <div class="row">
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/jkec-i-ftr.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Jammu</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/rjwm-rjwp-1522023.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Rajasthan</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/klwa-i-thb-klwl-672021.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Kerela</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/tbh-GTSD-382021.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Gujrat</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/thb-baku-eubq-20102023.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Europe</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/amep-thb.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>America</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/asja-thb.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h5>South east asia</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="gallery_loc">
                <div class="inner_gallery_loc">
                    <img src="{{ asset('frontend/images/gallery/auwg-thb.avif') }}" alt="">
                </div>
                <div class="inner_gallery_loc_txt">
                    <div class="type_gallery">
                        <p><b>33</b> tours | <b>72</b> Departures</p>
                        <p><b>61,838</b> guest Travelled</p>
                    </div>
                    <div class="gall_place">
                        <h4>Australia</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


            <!-- /////smaller screeen tab///// -->
            <div class="tab-container d-lg-none mt-5">
            <div class="button-container">
                <button class="tab-button" id="tab1-btn">India</button>
                <button class="tab-button" id="tab2-btn">Europe</button>
            </div>

            <div class="content-container">
    <div class="tab-content" id="tab1-content">
        <div class="scrollable-slider">
            <div class="row flex-nowrap">
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/jkec-i-ftr.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Jammu</h2>
                    </div>
                </div>
                <!-- Repeat more cards -->
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/rjwm-rjwp-1522023.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Rajasthan</h2>
                    </div>
                </div>
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/tbh-GTSD-382021.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Gujrat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="tab2-content" style="display: none;">
        <div class="scrollable-slider">
            <div class="row flex-nowrap">
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/amep-thb.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt">
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
                    <div class="outer_car_txt">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Rajasthan</h2>
                    </div>
                </div>
                <div class="outer_loc_dd">
                    <div class="inner_car_ig">
                        <img src="{{ asset('frontend/images/gallery/tbh-GTSD-382021.avif') }}" alt="">
                    </div>
                    <div class="outer_car_txt">
                        <p>33 tours | 72 Departures
                            61,838 guest Travelled</p>
                        <h2>Gujrat</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}">
                                <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}">
                                <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/world/shdz1-thb-mewa-2782022.avif') }}">
                                <img src="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}" alt="Europe Banner" class="responsive-image">
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
                                            <a class="_btn" href="#">Book Now</a>
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
                                <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}">
                                <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}">
                                <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/world/shdz1-thb-mewa-2782022.avif') }}">
                                <img src="{{ asset('frontend/images/world/mema-bnn-mema-2172022.avif') }}" alt="Europe Banner" class="responsive-image">
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
                                            <a class="_btn" href="#">Book Now</a>
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
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                <div class="upper_type_date">
                  <p>Group Tour</p>
                  <p style="
                        background: #fb7d03;
                        color: #fff;
                        padding: 2px;">
                    EUEP
                  </p>
                </div>
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> European Marvels </h6>
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
            <div class="outer_car_txt">
              <div class="days skit">
                <p>Days</p>
                <span style="color: #595959;">17 days</span>
              </div>
              <div class="destination skit">
                <p>Destinations</p>
                <span>12 countries 27 cities</span>
              </div>
              <div class="departures skit">
                <p>Departures</p>
                <span>3 Dates</span>
              </div>
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt ">
                <div class="night_ski skit">
                  <p>EMI from</p>
                  <span><a href="#">₹14,162/mo</a></span>
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
                <a class="_btn" href="#">View More Options</a>
              </div>
              <div class="expert text-center">
                <i class="fa-regular fa-comments"></i>
                <a class="expert_link" href="#">Talk to a Travel Expert</a>
              </div>
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                <div class="upper_type_date">
                  <p>Group Tour</p>
                  <p style="
                        background: #fb7d03;
                        color: #fff;
                        padding: 2px;">
                    EUEP
                  </p>
                </div>
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> European Marvels </h6>
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
            <div class="outer_car_txt">
              <div class="days skit">
                <p>Days</p>
                <span style="color: #595959;">17 days</span>
              </div>
              <div class="destination skit">
                <p>Destinations</p>
                <span>12 countries 27 cities</span>
              </div>
              <div class="departures skit">
                <p>Departures</p>
                <span>3 Dates</span>
              </div>
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt ">
                <div class="night_ski skit">
                  <p>EMI from</p>
                  <span><a href="#">₹14,162/mo</a></span>
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
                <a class="_btn" href="#">View More Options</a>
              </div>
              <div class="expert text-center">
                <i class="fa-regular fa-comments"></i>
                <a class="expert_link" href="#">Talk to a Travel Expert</a>
              </div>
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                <div class="upper_type_date">
                  <p>Group Tour</p>
                  <p style="
                        background: #fb7d03;
                        color: #fff;
                        padding: 2px;">
                    EUEP
                  </p>
                </div>
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> European Marvels </h6>
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
            <div class="outer_car_txt">
              <div class="days skit">
                <p>Days</p>
                <span style="color: #595959;">17 days</span>
              </div>
              <div class="destination skit">
                <p>Destinations</p>
                <span>12 countries 27 cities</span>
              </div>
              <div class="departures skit">
                <p>Departures</p>
                <span>3 Dates</span>
              </div>
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt ">
                <div class="night_ski skit">
                  <p>EMI from</p>
                  <span><a href="#">₹14,162/mo</a></span>
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
                <a class="_btn" href="#">View More Options</a>
              </div>
              <div class="expert text-center">
                <i class="fa-regular fa-comments"></i>
                <a class="expert_link" href="#">Talk to a Travel Expert</a>
              </div>
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                <div class="upper_type_date">
                  <p>Group Tour</p>
                  <p style="
                        background: #fb7d03;
                        color: #fff;
                        padding: 2px;">
                    EUEP
                  </p>
                </div>
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> European Marvels </h6>
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
            <div class="outer_car_txt">
              <div class="days skit">
                <p>Days</p>
                <span style="color: #595959;">17 days</span>
              </div>
              <div class="destination skit">
                <p>Destinations</p>
                <span>12 countries 27 cities</span>
              </div>
              <div class="departures skit">
                <p>Departures</p>
                <span>3 Dates</span>
              </div>
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt ">
                <div class="night_ski skit">
                  <p>EMI from</p>
                  <span><a href="#">₹14,162/mo</a></span>
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
                <a class="_btn" href="#">View More Options</a>
              </div>
              <div class="expert text-center">
                <i class="fa-regular fa-comments"></i>
                <a class="expert_link" href="#">Talk to a Travel Expert</a>
              </div>
            </div>
          </div>
          <div class="plan_outer">
            <div class="outer_plan_upper">
              <div class="outer_plan_img">
              <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="European Marvels">
              </div>
              <div class="inner_outer_txt">
                <div class="upper_type_date">
                  <p>Group Tour</p>
                  <p style="
                        background: #fb7d03;
                        color: #fff;
                        padding: 2px;">
                    EUEP
                  </p>
                </div>
                <div class="outer_type_price">
                  <h6 class="type_xtxt"> European Marvels </h6>
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
            <div class="outer_car_txt">
              <div class="days skit">
                <p>Days</p>
                <span style="color: #595959;">17 days</span>
              </div>
              <div class="destination skit">
                <p>Destinations</p>
                <span>12 countries 27 cities</span>
              </div>
              <div class="departures skit">
                <p>Departures</p>
                <span>3 Dates</span>
              </div>
            </div>
            <div class="options_tav night">
              <div class="outer_car_txt ">
                <div class="night_ski skit">
                  <p>EMI from</p>
                  <span><a href="#">₹14,162/mo</a></span>
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
                <a class="_btn" href="#">View More Options</a>
              </div>
              <div class="expert text-center">
                <i class="fa-regular fa-comments"></i>
                <a class="expert_link" href="#">Talk to a Travel Expert</a>
              </div>
            </div>
          </div>

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
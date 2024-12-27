@extends('front.common.app')
@section('title','home')
@section('content')


<section class="navigation_sect mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-12 col-md-12 param">
        <div class="left_navi_det">
          <h6>18 Manali Holiday Packages</h6>
          <p>Showing 1-10 packages from 18 packages</p>
        </div>
        <div class="navi_full_list">
          <div class="priice_range">
            <div class="reange_btns d-flex justify-content-between" onclick="toggleAccordion()">
              <h6 class="accordion-header"><b>Price Range</b></h6>
              <i id="accordion-icon" class="fa-solid fa-angle-down"></i>
            </div>
            <div class="filter_price d-flex flex-wrap accordion-content open" style="gap: 10px; display: none;">
              <button>₹30,000 - ₹40,000</button>
              <button>₹40,000 - ₹50,000</button>
              <button>₹50,000 - ₹60,000</button>
              <button>₹60,000 - ₹70,000</button>
            </div>
          </div>
          <hr>
          <div class="date_range">
            <div class="reange_btns d-flex justify-content-between">
              <h6 class="accordion-header"><b>Tour Duration</b></h6>
              <!-- <i id="accordion-icon" class="fa-solid fa-angle-down" ></i> -->
            </div>
            <div class="min_max d-flex justify-content-between align-items-center" style="font-size: 12px;">
              <p>Min. <b>8 days</b></p>
              <p>Max. <b>12 days</b></p>
            </div>
            <div class="filter_price d-flex flex-wrap accordion-content open" style="gap: 10px; display: none;">
              <button>5 - 8 days</button>
              <button>8 - 11 days</button>
              <button>11 - 14 days</button>
              <button>14 - 15 days</button>
            </div>
          </div>
          <hr>
          <div class="arriv_dept">
            <h6 class="accordion-header"><b>Depart Between</b></h6>
            <div class="calends">
              <div class="cal_size">
                <label for="start">Start Date</label>
                <input type="date" id="startDate" class="form-control w-80" style="
    width: 80%;" required>
              </div>

              <div class="cal_size">
                <label for="start">End Date</label>
                <input type="date" id="endDate" class="form-control w-80" style="
    width: 80%;" required>
              </div>
            </div>
          </div>
          <hr>
          <div class="departure_city">
            <h6 class="accordion-header"><b>Departure city</b></h6>
            <div class="city_box">
              <input type="checkbox">
              <p>Kolkata</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Delhi</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Amritsar</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Jaisalmer</p>
            </div>
            <div class="ravet">

              <h4>Joining & Leaving</h4>
              <p>Can’t find tours from your city? Check our Joining & leaving option. Book your own flights and join directly at the first destination of the tour.</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Kota</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Ajmer</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Udaipur</p>
            </div>
            <div class="city_box">
              <input type="checkbox">
              <p>Jaipur</p>
            </div>
          </div>



        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="">
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
                  <a class="_btn" href="{{ route('detail') }}">View More Options</a>
                </div>
                <div class="expert text-center">
                  <i class="fa-regular fa-comments"></i>
                  <a class="expert_link" href="#">Talk to a Travel Expert</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="">
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
          </div>
        </div>
        <hr>
        <hr>
        <div class="row">
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="">
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
          </div>
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  <img src="{{ asset('frontend/images/cards/eumv-thb.avif') }}" alt="">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
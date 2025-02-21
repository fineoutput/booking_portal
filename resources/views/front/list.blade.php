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
          <!-- <div class="arriv_dept">
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
          </div> -->



        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">

          @if($packages)
          @foreach ($packages as $key => $value)
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  @php
                  // Assuming 'image' contains a JSON array of images
                  $images = json_decode($value->image); // Decode the JSON to an array
              @endphp
  
              @if($images && is_array($images) && count($images) > 0)
                  <!-- Display the first image on top -->
                  <img src="{{ asset($images[0]) }}" alt="">
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
            $value->prices->traveller_mini_cost + $value->prices->traveller_big_cost + $value->prices->premium_traveller_cost + $value->prices->ac_coach_cost; 
                          @endphp
                          <p>Price: ₹{{ number_format($total, 2) }}</p>
                      @else
                          <p>No price available for this package.</p>
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

      </div>
    </div>
  </div>
</section>

@endsection
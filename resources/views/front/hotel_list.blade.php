@extends('front.common.app')
@section('title','home')
@section('content')



@if($slider)
    <div id="responsive-slider" class="splide mt-5" style="background: #ffd600">
      <div class="layie">
        {{-- <h1>Plan Your Travel Now!</h1>
                          <p>650+ Travel Agents serving 65+ Destinations worldwide</p> --}}
                        </div>  
    <div class="splide__track">
        
          <ul class="splide__list">
            @foreach ($slider as $value)
            <li class="splide__slide">
              <picture>
                  <source media="(min-width: 1200px)" srcset="{{ asset($value->image) }}">
                  <source media="(min-width: 768px)" srcset="{{ asset($value->image) }}">
                  <source media="(max-width: 767px)" srcset="{{ asset($value->image) }}">
                  <img class="chats" style="border-radius: 0;" src="{{ asset($value->image) }}" alt="Responsive Banner">
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
    @endif


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
          {{-- <div class="date_range">
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
          <hr> --}}

        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">

          @if($hotels)
          @foreach ($hotels as $key => $value)
          <div class="col-lg-6">
            <div class="plan_outer w-100">
              <div class="outer_plan_upper">
                <div class="outer_plan_img">
                  @php
                  $images = json_decode($value->images); 
              @endphp
              
              @if($images && is_array($images) && count($images) > 0)
                  <img src="{{ asset(reset($images)) }}" alt="First Image">
              @else
                  <p>No images available.</p>
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
                  <p style="margin: 0;">{{$value->name ?? ''}}</p>
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
                          @php
                          // Fetch price for the current hotel
                          $hotelPrice = $hotel_prices[$value->id] ?? null;
                      @endphp
                          <p>
                            @if($hotelPrice)
                            Price:  ₹{{ $hotelPrice->night_cost ?? '0' }}
                        @else
                            Price Not Available
                        @endif
                          </p>

                        </b>
                      </p>
                      <span style="font-size: 10px;">per person on twin sharing</span>
                    </div>
                  </div>
                </div>
                <div class="options_btns d-flex justify-content-center">
                  <a class="_btn" href="{{ route('hotel_details', ['id' => base64_encode($value->id)]) }}">Book Now</a>
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
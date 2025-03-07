@extends('front.common.app')
@section('title','home')
@section('content')
@php
$title = "Jaipur Tour Guide";
$mainImage = "https://cdn.getyourguide.com/img/tour/8db56f3e6e18aa5ba682ab79c170dd0079873ecf27f856447ecf12f84ec02a87.jpg/98.jpg";
$sideImages = [
"https://cdn.getyourguide.com/img/tour/fc77f6f2f0bcaad6ab81e24d4328a34979486f1a87dacd623a97a2e9f2059fcd.jpg/vertical_520_780.jpg",
"https://cdn.getyourguide.com/img/tour/b1ab823050eaa28b490313a70e9d38df5f81584fd87966acbf27e1e69a666520.jpg/97.jpg"
];
$bottomImages = [
"https://cdn.getyourguide.com/img/tour/713df89fb3d368a3b6bbecb247945f537d194fbdb5e63a456ec0af2d1626a52d.jpg/145.jpg",
"https://cdn.getyourguide.com/img/tour/3eb2e74603eba65ca2fcc0540fa3bfccc73f0103965f72c54a0d6eb95976cb8d.jpg/145.jpg"
];
$mobileImages = [
asset('frontend/images/hotel_main.avif'),
asset('frontend/images/hotel_main.avif'),
asset('frontend/images/hotel_main.avif')
];
@endphp

{{-- @include('front.common.slides', compact('title', 'mainImage', 'sideImages', 'bottomImages', 'mobileImages')) --}}


<div id="phlGlb" class="splide">
    <div class="splide__track d-lg-none">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
            <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
            <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
        </ul>
    </div>
</div>

@if($slider)
    <div id="responsive-slider" class="splide" style="background: #ffd600">
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

<div class="comp-container">

    <div class="row mt-5">
        <div class="col-lg-7 nive d-none d-lg-block">
            <div class="mirror_maxe">
                @php
                    $images = json_decode($tripguide->image);
                @endphp
                
                @if (!empty($images))
                    <img src="{{ asset($images[0]) }}" alt="Trip Image">
                @endif
            </div>
        </div>
        
        <div class="col-lg-5 d-none d-lg-block">
            <div class="row">
                @foreach ($images as $key => $image)
                    @if ($key > 0)  <!-- Skip the first image -->
                        <div class="col-lg-6 mb-2">
                            <div class="side_masic">
                                <img src="{{ asset($image) }}" alt="">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="other_dets mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="sides_maxe">
                    <div class="aaeheads">
                        <h4 class="hoses">Get Your Guide
                        </h4>
                        <span class="sabke">
                            <ol class="lgx66tx atm_gi_idpfg4 atm_l8_idpfg4 dir dir-ltr" style=" 
    padding-left: 0 !important;
">
                                <li class="l7n4lsf atm_9s_1o8liyq_keqd55 dir dir-ltr">{{$tripguide->guide_type ?? ''}}</li>
                           
                            </ol>
                        </span>
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
                    <h4 class="naxo">About the Guide</h4>

                    <div class="ho_bhe">
                        <span>
                         {!!$tripguide->description!!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sharan_side_box">
                    <div class="stand_it">
                        <div class="outer_box">
                            <form action="{{route('bookguide')}}" method="POST">
                                @csrf
                            <div class="inner_box">
                                <div class="inner_price">
                                    <span style="color: rgb(106, 106, 106);"><del>₹{{$tripguide->cost + 100}}</del></span>
                                    <span>₹{{$tripguide->cost}}
                                    </span>
                                    <span></span>
                                </div>
                                <input type="hidden" value="{{ $tripguide->id ?? '' }}" name="tour_guide_id">
                                <input type="hidden" value="{{ $tripguide->id ?? '' }}" name="tour_guide_id">
                                <input type="hidden" value="{{ $tripguide->cost ?? '' }}" name="cost">
                                <div class="checks">
                                    <div class="bors">
                                        <div class="caranke">
                                            <div class="filter-item_hotels sachi" onclick="toggleDropdown('destination')">
                                                <div class="filter-label_hotels">State</div>
                                                <select class="form-control" name="state_id" id="">
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="{{$state->id ?? ''}}">{{$state->state_name ?? ''}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="caranke">
                                            <div class="filter-item_hotels sachi" onclick="toggleDropdown('location')">
                                                <div class="filter-label_hotels">Location</div>
                                                <select class="form-control" name="location" id="">
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="{{$tripguide->location ?? ''}}">{{$tripguide->location ?? ''}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rivvsa">
                                    <div class="filter-item_hotels sachi" onclick="toggleDropdown('language')">
                                        <div class="filter-label_hotels">Language</div>
                                        <select class="form-control" name="languages_id" id="">
                                            <option value="" selected disabled>Select</option>
                                            <option value="{{$tripguide->languages_id ?? ''}}">{{$tripguide->languages->language_name ?? ''}}</option>
                                        </select>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="guide-selection">
                                        <label class="guide-option">
                                            <input name="guide_type" type="radio" value="local" checked>
                                            <span class="custom-radio"></span>
                                            Local Guide
                                        </label>
                                        <label class="guide-option">
                                            <input name="guide_type" type="radio" value="outstation">
                                            <span class="custom-radio"></span>
                                            Outstation Guide
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="live_set mt-3">
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
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
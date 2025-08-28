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
.anyeSirwe {
    width: 195px !important;
    height: 335.4px !important;
}
.vibhajan {
    height: 410px !important;
}
.chnaa p{
  margin: 0;
}
@media (max-width: 768px) {
    .dropdown_hotels {
        /* position: relative !important; */
    }
}
</style>
 <!-- /* //////////////Banner Starts///////////// */ -->


 
 <div id="responsive-slider" class="splide testing_tools mt-2" style="background: #fff;" >
    {{-- <div class="layie">
      <h1>Plan Your Travel Now</h1>
                        <p>650+ Travel Agents serving 65+ Destinations worldwide</p></div>   --}}
  <div class="splide__track">
      
        <ul class="splide__list">
       @foreach ($banner as $value)
    {{-- Image Slide --}}
          @if (!empty($value->image))
              <li class="splide__slide">
                  <picture class="seeMA" style="height: 50vh;">
                      <source media="(min-width: 1200px)" srcset="{{ asset($value->image) }}">
                      <img style="border-radius: 20px; width: 100%; height: 100%; object-fit: cover;" 
                          src="{{ asset($value->image) }}" 
                          alt="Responsive Banner">
                  </picture>
              </li>
          @endif

          {{-- Video Slide --}}
          @if (!empty($value->video))
              <li class="splide__slide">
                  <div class="seeMA" style="height: 50vh; border-radius: 20px; overflow: hidden;">
                      <video 
                          src="{{ asset($value->video) }}" 
                          autoplay 
                          muted 
                          loop 
                          playsinline 
                          style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                          Your browser does not support the video tag.
                      </video>
                  </div>
              </li>
          @endif
      @endforeach
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
  {{-- <section class="euro_sect mt-5">
  
  <div class="responsive-image-wrapper">
    <div class="row">

    <div class="col-lg-6">
    <picture>
      <img style="border-radius: 20px" src="{{ asset('frontend/images/2151022269.jpg') }}" alt="Responsive Banner" class="responsive-image">
    </picture>
    </div>  
    <div class="col-lg-6">
    <picture>
      <img style="border-radius: 20px" src="{{ asset('frontend/images/2151747381.jpg') }}" alt="Responsive Banner" class="responsive-image">
    </picture>
    </div>  
  </div>
  </div>

 
</section> --}}
<div class="container">
  <div class="col-lg-12 setts ">
      <div class="splide" id="popularCitiesSlider">
        <div class="splide__track">
          <h2 class="text-center">Holiday Packages</h2>
            <ul class="splide__list">
                @foreach($popularCities as $value)
                 {{-- @if($value->packagePrices && $value->packagePrices->isNotEmpty()) --}}
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
                                         <p>
                                      <a href="{{ route('detail', ['id' => base64_encode($value->id)]) }}">
                                        <b style="color: #000">{{ \Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</b>
                                      </a>
                                    </p>
                                    </div>
                                    {{-- <div class="gall_place">
                                        <h4>{{ \Illuminate\Support\Str::limit($value->cities->city_name ?? '', 20) }}</h4>

                                    </div> --}}
                                </div>
                            </div>
                        </div>
                      </div>
                    </li>
                    {{-- @endif --}}
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>
  <!-- /* //////////////Europe Ends///////////// */ -->
<div class="anotherSpiiled mt-5">
    <div class="row">
      <div class="side_slide">
        <section id="mohanJodharoSlider" class="splide" aria-label="Image Slider">
          <div class="splide__track">
            <ul class="splide__list">
              @foreach ($offer as $value)
              
              <li class="splide__slide long_slide">
              <div class="">
                
              
                <img class="vibhajan" src="{{ asset($value->image) }}" alt="Offer Image">
              </div>
              </li>
              @endforeach
            </ul>
          </div>
        </section>
      </div>
    </div>
</div>


  <!-- /* //////////////Gallery starts///////////// */ -->
    <section class="gallery_sect mt-5">
        <div class="container">
        <div class="row" style="align-items: center">
            <!-- Slider Section -->
            

            <!-- /////large screeen tab///// -->
<div class="col-lg-12 setts ">
   
    <hr>
      <div class="splide" id="popularCitiesSlider2">
        <div class="splide__track">
          <h2 class="text-center">Travel Places</h2>
            <ul class="splide__list">
                @foreach($popularhotels as $value)
                 {{-- @if($value->packagePrices && $value->packagePrices->isNotEmpty()) --}}
                    <li class="splide__slide">
                      <div class="row">
                        <div class="col">
                            <div class="gallery_loc">
                                <div class="inner_gallery_loc">
                                  @php
                                  $images = json_decode($value->image); 
                              @endphp
                              
                              @if($images && is_array($images) && count($images) > 0)
                                  <img src="{{ asset(reset($images)) }}" alt="First Image">
                              @else
                                  <p>No images available.</p>
                              @endif
                              
                                </div>
                                <div class="inner_gallery_loc_txt">
                                    <div class="type_gallery">
                                         <p>
  <a href="{{ route('detail', ['id' => base64_encode($value->id)]) }}">
    <b style="color: #000">{{ \Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</b>
  </a>
</p>
                                    </div>
                                    {{-- <div class="gall_place">
                                        <h4>{{ $value->cities->city_name ?? '' }}</h4>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                      </div>
                    </li>
                    {{-- @endif --}}
                @endforeach
            </ul>
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
                            <span class="custom_spn">9782324798</span>
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
                                <p class="abb">Kashmir to Kanyakumari</p>
                                <h2>Best Family Packages</h2>
                            </div>
                            <div class="world_upper_txt_btns">
                                <p class="abb">Himachal . Manali</p>
                                <h4 class="abb">7 Days | 12 Jan | from <span style="color: #ffd801; font-weight: bold;">₹15000</span></h4>
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
    <div class="row">
      <div class="col-lg-12">
        {{-- <h2 class="text-center ">Our Packages</h2> --}}
      </div>
    </div>
    {{-- <div id="common" class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          
          @if($packages)
            @foreach ($packages as $key => $value)
              <li class="splide__slide">
                <div class="card-container">
                  @php
                      $images = json_decode($value->image, true);
                      $add = ($images && is_array($images) && count($images) > 0) ? asset(reset($images)) : asset('frontend/images/hotel_main.avif');
                  @endphp

                  <a style="color: #fff" href="{{ route('detail', ['id' => base64_encode($value->id)]) }}">
                    <div class="cardashEs" style="background: url('{{ $add }}') no-repeat center / cover;">
                      @if($value->prices)
                        <div class="price-tagashEs">₹{{ number_format($value->prices->display_cost, 2) }} onwards</div>
                      @else
                        <p>No price available.</p>
                      @endif

                      <div class="gradient-overlayashEs"></div>
                      <div class="contentashEs">
                        <h3>{{ \Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</h3>
                        <div class="itineraryashEs">
                          <span>{!! \Illuminate\Support\Str::limit($value->text_description ?? '', 30) !!}</span>
                        </div>
                        <div class="detailsashEs">
                          <div class="durationashEs">
                            <span>🕒 {{ $value->night_count }} Nights</span>
                            <span class="chnaa">{!! \Illuminate\Support\Str::limit($value->text_description_2 ?? '', 5) !!}</span>
                          </div>
                          <div class="locationashEs">
                            <span>📍 Leh-Leh</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </li>
            @endforeach
          @else
            <li class="splide__slide">
              <div class="card-container">
                <h1>No Package Found</h1>
              </div>
            </li>
          @endif

        </ul>
      </div>
    </div> --}}


    <div class="couterMask">
      <h4 class="pb-2"><b>Our Packages</b></h4>
      
      <div id="splide-packages" class="splide">
  <div class="splide__track">
    <ul class="splide__list">
      @if($packages)
        @foreach ($packages as $key => $value)
        {{-- @if($value->packagePrices && $value->packagePrices->isNotEmpty()) --}}
          @php
            $images = json_decode($value->image, true);
            $add = ($images && is_array($images) && count($images) > 0) ? asset(reset($images)) : asset('frontend/images/hotel_main.avif');
          @endphp

          <li class="splide__slide">
              <div class="aus">
                <div class="boxAus">
                  <div class="AusMaze">
                    <img src="{{ $add }}" alt="{{ $value->package_name }}">
                  </div>
                  <div class=" BetSide">
                    <div class="ulHaq p-2">

                      <h6><b>{{ \Illuminate\Support\Str::limit($value->package_name ?? '', 40) }}</b></h6>
                    </div>
                    <div class="BEth">
                     <div class="UnRRoz">
                       <p>{{ \Carbon\Carbon::now()->format('D, d M') }}</p>
                      @if($value->prices)
                        <p>₹{{ number_format($value->prices->display_cost, 2) }} onwards</p>
                      @else
                        <p>No price available.</p>
                      @endif
                     </div>
                      <div class="oTjs">
                      <a href="{{ route('detail', ['id' => base64_encode($value->id)]) }}">
                        <button class="Despirate">View Package</button>
                      </a>
                    </div>
                    </div>
                   
                  </div>
                </div>
              </div>
          </li>
            {{-- @endif --}}
        @endforeach
      @else
        <li class="splide__slide">
            <div class="aus">
              <div class="boxAus">
                <div class="AusMaze">
                  <img src="{{ asset('frontend/images/hotel_main.avif') }}" alt="No package">
                </div>
                <div class="BEth">
                  <div class="BetSide">
                    <h4>No Package Found</h4>
                    <p>--</p>
                    <p>--</p>
                  </div>
                  <div class="oTjs">
                    <button disabled>Not Available</button>
                  </div>
                </div>
              </div>
            </div>
        </li>
      @endif 
    </ul>
  </div>
</div>
    </div>


  </div>
</section>

 <script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#splide-packages', {
      perPage: 4,
      gap: '1rem',
      loop:true,
      breakpoints: {
        1024: {
          perPage: 2,
        },
        640: {
          perPage: 1,
        },
      },
    }).mount();
  });
</script>

 <script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#common', {
      type       : 'slide',
      loop       :  true,
      perPage    : 4,
      perMove    : 1,
      gap        : '1rem',
      arrows     : true,
      pagination : false,
      breakpoints: {
        1200: { perPage: 3 },
        992 : { perPage: 2 },
        576 : { perPage: 1 }
      }
    }).mount();
  });
</script>
 
@endsection
@extends('front.common.app')
@section('title','home')
@section('content')

<style>
  .price-filter-container {
      padding: 20px;
      font-family: Arial, sans-serif;
  }

  .slider-container {
      position: relative;
      height: 50px;
  }

  .slider-track {
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 4px;
      background-color: #ddd;
      transform: translateY(-50%);
      border-radius: 2px;
  }

  .slider-range {
      position: absolute;
      height: 4px;
      background-color: #007bff;
      border-radius: 2px;
  }

  .slider-thumb {
      position: absolute;
      width: 20px;
      height: 20px;
      background-color: #fff;
      border: 2px solid #007bff;
      border-radius: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      cursor: pointer;
      z-index: 2;
  }

  .price-inputs {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
  }

  .price-input {
      width: 100px;
      padding: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
  }

  .price-label {
      text-align: center;
      margin-top: 10px;
      color: #666;
  }
</style>

@if($slider)
    {{-- <div id="responsive-slider" class="splide mt-5" style="background: #ffd600">
      <div class="layie">
       
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
           
     
          </ul>
      </div>
    </div> --}}
    @endif


<section class="navigation_sect mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-12 col-md-12 param">
        <div class="left_navi_det">
          {{-- <h6>18 Manali Holiday Packages</h6> --}}
          <p>
            Showing {{
              $packages->filter(function($package) {
                return $package->packagePrices->contains(function($price) {
                    return !is_null($price->display_cost) && $price->display_cost !== '';
                });
              })->count() ?? 0
            }} packages
          </p>
        </div>
        <div class="navi_full_list">

          <form action="{{ route('state_detail', ['state_id' => base64_encode($city)]) }}" method="GET">
            <!-- Price Filter Section -->
            <div class="price-filter-container">
                <div class="price-inputs">
                    <input name="min_price" type="number" class="price-input" id="minPrice" placeholder="Min price" value="{{ request()->input('min_price') }}">
                    <input name="max_price" type="number" class="price-input" id="maxPrice" placeholder="Max price" value="{{ request()->input('max_price') }}">
                </div>
                <div class="slider-container">
                    <div class="slider-track"></div>
                    <div class="slider-range"></div>
                    <div class="slider-thumb" id="minThumb"></div>
                    <div class="slider-thumb" id="maxThumb"></div>
                </div>
                <div class="price-label">
                    Selected price range: ₹<span id="minValue">{{ request()->input('min_price', 0) }}</span> - ₹<span id="maxValue">{{ request()->input('max_price', 100000000) }}</span>
                </div>
            </div>
            
            <hr>
        
            <!-- City Filter Section -->
            <div class="departure_city">
                <h6 class="accordion-header"><b>Select City</b></h6>
        
                @php
                    // Get unique cities by city_name
                    $uniqueCities = $city_data;
                @endphp
        
                @foreach($uniqueCities as $city)
                    <div class="city_box">
                        <input type="checkbox" name="cities[]" value="{{ $city }}" 
                            {{ in_array($city, request()->input('cities', [])) ? 'checked' : '' }}>
                        <p>{{ $city }}</p>
                    </div>
                @endforeach
        
                {{-- <div class="ravet">
                    <h4>Joining & Leaving</h4>
                    <p>Can’t find tours from your city? Check our Joining & leaving option. Book your own flights and join directly at the first destination of the tour.</p>
                </div> --}}
            </div>
            <div class="d-flex justify-content-center ">
            <button class="_btn" type="submit ">Apply Filter</button>
          </div>
        </form>
        
        



        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row">

          @if($packages)
          @foreach ($packages as $key => $value)
           {{-- @if($value->prices) --}}
          <div class="col-lg-6">
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
                    <h6 class="type_xtxt">
                       @php
                    // Get unique cities by city_name
                    $uniqueCities = $city_data;
                @endphp
        
                  @foreach($value->city_names as $city)
                    {{ $city ?? '' }}@if(!$loop->last), @endif
                  @endforeach

                  </div>
                  {{-- <div class="plan_type_date">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p style="margin: 0;">2 reviews</p>
                  </div> --}}
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
                          
                          <p>Price: ₹{{$value->prices->display_cost}}</p>
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
            {{-- @endif --}}
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

<script>
  const minPriceInput = document.getElementById('minPrice');
  const maxPriceInput = document.getElementById('maxPrice');
  const minThumb = document.getElementById('minThumb');
  const maxThumb = document.getElementById('maxThumb');
  const sliderTrack = document.querySelector('.slider-track');
  const sliderRange = document.querySelector('.slider-range');
  const minValue = document.getElementById('minValue');
  const maxValue = document.getElementById('maxValue');

  const minPrice = 0;
  const maxPrice = 100000000;
  let isDragging = false;
  let currentThumb = null;

  function updateValues() {
      const minPercent = parseFloat(minThumb.style.left) || 0;
      const maxPercent = parseFloat(maxThumb.style.left) || 100;
      
      const minValuePrice = Math.round((minPercent / 100) * (maxPrice - minPrice) + minPrice);
      const maxValuePrice = Math.round((maxPercent / 100) * (maxPrice - minPrice) + minPrice);
      
      minPriceInput.value = minValuePrice;
      maxPriceInput.value = maxValuePrice;
      minValue.textContent = minValuePrice.toLocaleString();
      maxValue.textContent = maxValuePrice.toLocaleString();
      
      sliderRange.style.left = minPercent + '%';
      sliderRange.style.right = (100 - maxPercent) + '%';
  }

  function handleDragStart(e) {
      isDragging = true;
      currentThumb = e.target;
      document.body.style.userSelect = 'none';
  }

  function handleDragging(e) {
      if (!isDragging) return;
      
      const rect = sliderTrack.getBoundingClientRect();
      let newX = (e.clientX - rect.left) / rect.width * 100;
      newX = Math.max(0, Math.min(100, newX));
      
      if (currentThumb === minThumb) {
          if (newX >= parseFloat(maxThumb.style.left || 100)) return;
          minThumb.style.left = newX + '%';
      } else {
          if (newX <= parseFloat(minThumb.style.left || 0)) return;
          maxThumb.style.left = newX + '%';
      }
      
      updateValues();
  }

  function handleDragEnd() {
      isDragging = false;
      currentThumb = null;
      document.body.style.userSelect = '';
  }

  function handleInputChange(e) {
      let value = parseInt(e.target.value);
      if (isNaN(value)) return;
      
      value = Math.max(minPrice, Math.min(maxPrice, value));
      const percent = ((value - minPrice) / (maxPrice - minPrice)) * 100;
      
      if (e.target === minPriceInput) {
          if (value > parseInt(maxPriceInput.value)) {
              maxPriceInput.value = value;
              maxThumb.style.left = percent + '%';
          }
          minThumb.style.left = percent + '%';
      } else {
          if (value < parseInt(minPriceInput.value)) {
              minPriceInput.value = value;
              minThumb.style.left = percent + '%';
          }
          maxThumb.style.left = percent + '%';
      }
      
      updateValues();
  }

  // Event Listeners
  minThumb.addEventListener('mousedown', handleDragStart);
  maxThumb.addEventListener('mousedown', handleDragStart);
  document.addEventListener('mousemove', handleDragging);
  document.addEventListener('mouseup', handleDragEnd);
  minPriceInput.addEventListener('input', handleInputChange);
  maxPriceInput.addEventListener('input', handleInputChange);

  // Initialize values
  minThumb.style.left = '0%';
  minThumb.style.top = '0%';
  maxThumb.style.left = '100%';
  maxThumb.style.top = '0%';
  updateValues();
</script>
@endsection
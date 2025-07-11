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
    <div id="responsive-slider" class="splide" style="background: #ffd600">
      <div class="layie">
        {{-- <h1>Plan Your Travel Now!</h1>
                          <p>650+ Travel Agents serving 65+ Destinations worldwide</p> --}}
                        </div>  
    {{-- <div class="splide__track">
        
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
      </div> --}}
    </div>
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

            {{-- <form id="filter-form" action="" method="GET">
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
                      Selected price range: ₹<span id="minValue">{{ request()->input('min_price', 0) }}</span> - ₹<span id="maxValue">{{ request()->input('max_price', 100000) }}</span>
                  </div>
              </div>
          
              <button class="_btn" type="submit">Apply Filter</button>
          </form> --}}


         <form action="{{ route('state_detail', ['state_id' => base64_encode($city->state->id)]) }}" method="GET">
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
        
                @foreach($uniqueCities as $citys)
                    <div class="city_box">
                        <!-- Add a checkbox for each unique city -->
                        <input type="checkbox" name="cities[]" value="{{ $citys }}" 
                            {{ in_array($citys, request()->input('cities', [])) ? 'checked' : '' }}>
                        <p>{{ $citys }}</p>
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

          <hr>
   


        </div>
      </div>
      <!-- <div class="col-lg-1"></div> -->
      <div class="col-lg-9 col-sm-12 col-md-12">
        <div class="row d-none d-lg-flex">

         @if($packages)
          @foreach ($packages as $key => $value)
          {{-- @if($value->prices->display_cost ?? '') --}}
      <div class="col-lg-4 mb-2">
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
        <div class="price-tagashEs">₹{{ number_format($value->prices->display_cost, 2) }} onwards</div>
                          @else
                          <p>No price available.</p>
                      @endif
        
        <div class="gradient-overlayashEs"></div>
        <div class="contentashEs">
          
            <h3>{{\Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</h3>
            
            <div class="itineraryashEs">
                {{-- <span>{!!\Illuminate\Support\Str::limit($value->text_description ?? '', 30) !!}</span> --}}
                {{-- <span>Nubra Valley</span>
                <span>Pangong Tso</span>
                <span>Marsimik La</span>
                <span>+1 More</span> --}}
            </div>
            <div class="detailsashEs">
                <div class="durationashEs">
                    <span>🕒 {{$value->night_count ?? 0}}N/{{$value->night_count+1 ?? 0}}D</span>
                    {{-- <span>{!!\Illuminate\Support\Str::limit($value->text_description_2 ?? '', 30) !!}</span> --}}
                </div>
                <div class="locationashEs">
                    <span>📍  {{$city->city_name ?? ''}}
                    </span>
                </div>
            </div>
        </div>
    </div>
        </a>

      </div>
       {{-- @endif --}}
       @endforeach
          @else

              <h1>No Package Found</h1>
           
          @endif

      </div>

      <div id="splide-mobile" class="splide d-block d-lg-none">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($packages as $key => $value)
                    @php
                        $images = json_decode($value->image, true);
                        $add = ($images && is_array($images) && count($images) > 0)
                            ? asset(reset($images))
                            : asset('frontend/images/hotel_main.avif');
                    @endphp
                    <li class="splide__slide">
                        <a style="color: #fff" href="{{ route('detail',['id' => base64_encode($value->id)]) }}">
                            <div class="cardashEs" style="background: url('{{ $add }}') no-repeat center / cover;">
                                @if($value->prices)
                                    <div class="price-tagashEs">₹{{ number_format($value->prices->display_cost, 2) }} onwards</div>
                                @else
                                    <p>No price available.</p>
                                @endif

                                <div class="gradient-overlayashEs"></div>
                                <div class="contentashEs">
                                    <h3>{{\Illuminate\Support\Str::limit($value->package_name ?? '', 30) }}</h3>
                                    <div class="itineraryashEs">
                                        <span>{!! \Illuminate\Support\Str::limit($value->text_description ?? '', 30) !!}</span>
                                    </div>
                                    <div class="detailsashEs">
                                        <div class="durationashEs">
                                            <span>🕒 5N/6D</span>
                                        </div>
                                        <div class="locationashEs">
                                            <span>📍 Leh-Leh</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (window.innerWidth < 992) {
      new Splide('#splide-mobile', {
        type: 'slide',
        perPage: 1,
        gap: '1rem',
        pagination: true,
        arrows: true,
      }).mount();
    }
  });
</script>
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
  const maxPrice = 100000;
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
  maxThumb.style.left = '100%';
  updateValues();
</script>


<script>
  document.getElementById('filter-form').onsubmit = function(event) {
      event.preventDefault(); 

      const city_id = '{{ request()->input('city_id') }}'; 
      const start_date = '{{ request()->input('start_date') }}';  // Start date
      const end_date = '{{ request()->input('end_date') }}';  // End date
      const min_price = document.getElementById('minPrice').value;  // Min price from form
      const max_price = document.getElementById('maxPrice').value;  // Max price from form

      // Construct the new URL with all parameters
      let url = new URL(window.location.href);

      // Add the query parameters dynamically
      url.searchParams.set('city_id', city_id);
      console.log(city_id);
      url.searchParams.set('start_date', start_date);
      url.searchParams.set('end_date', end_date);
      url.searchParams.set('min_price', min_price);
      url.searchParams.set('max_price', max_price);

      // Set the updated URL as the form action and submit the form
      window.location.href = url; // Redirect to the updated URL
  };
</script>

@endsection
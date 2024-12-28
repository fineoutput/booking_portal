@extends('front.common.app')
@section('title','home')
@section('content')

<style>
    .modal-header {
      background-color: #007bff;
      color: white;
    }

    .list-group-item:hover {
      background-color: #f8f9fa;
      cursor: pointer;
    }
  </style>
 <!-- /* //////////////Banner Starts///////////// */ -->
 <picture>
    <source media="(min-width: 1200px)" srcset="{{ asset('frontend/images/banner/desktop_.png') }}">
    <source media="(min-width: 768px)" srcset="{{ asset('frontend/images/banner/tablet_.png') }}">
    <source media="(max-width: 767px)" srcset="{{ asset('frontend/images/banner/mobile_.png') }}">
    <img src="{{ asset('frontend/images/banner/fallback_.png') }}" alt="Responsive Banner">
</picture>

  <!-- /* //////////////Banner Ends///////////// */ -->



  <!-- /* //////////////form starts///////////// */ -->
  <div class="container py-5">
    <h1 class="text-center mb-4">Taxi Booking</h1>

    <!-- Tabs for booking types -->
    <ul class="nav nav-tabs mb-4" id="bookingTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" style=" color: #000; " id="airport-tab" data-bs-toggle="tab" data-bs-target="#airport" type="button" role="tab" aria-controls="airport" aria-selected="true">Airport/Railway Station</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="local-tab" style=" color: #000; " data-bs-toggle="tab" data-bs-target="#local" type="button" role="tab" aria-controls="local" aria-selected="false">Local Tour</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="outstation-tab" style=" color: #000; " data-bs-toggle="tab" data-bs-target="#outstation" type="button" role="tab" aria-controls="outstation" aria-selected="false">Outstation</button>
      </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="bookingTabsContent">
      <!-- Airport/Railway Station -->
      <!-- <div class="tab-pane fade show active" id="airport" role="tabpanel" aria-labelledby="airport-tab">
      <form>
      <div class="mb-3">
            <label for="local-vehicle" class="form-label">Trip</label>
            <select class="form-select" id="local-vehicle">
              <option value="">Select vehicle</option>
              <option value="sedan">Sedan</option>
              <option value="suv">SUV</option>
              <option value="hatchback">Hatchback</option>
            </select>
          </div>   
      <div class="mb-3">
        <label for="location" class="form-label">Select Location</label>
        <input type="text" class="form-control" id="location" placeholder="Enter location" readonly data-bs-toggle="modal" data-bs-target="#stateModal">
      </div>
      <div class="modal fade" id="stateModal" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stateModalLabel">Select a State</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group" id="stateList">
           
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cityModalLabel">Select a City</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group" id="cityList">
          </ul>
        </div>
      </div>
    </div>
  </div>
          <div class="mb-3">
            <label for="vehicle" class="form-label">Select Vehicle</label>
           
            <input type="text" class="form-control" id="car" placeholder="Enter location" readonly data-bs-toggle="modal" data-bs-target="#carmodal">
          </div>
          <div class="modal fade" id="carmodal" tabindex="-1" aria-labelledby="carmodallabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="carmodallabel">Select car type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="car_model">
            <div class="frst_mes" id="suv"  onclick="selectCar('SUV')" style="cursor: pointer;">
              <h6>Suv</h6>
              <img style="width:50%;"  src="{{asset('frontend/images/car_icons/suv.png')}}" alt="">
            </div>
            <div class="frst_mes" id="hatch" onclick="selectCar('Hatchback')" style="cursor: pointer;">
              <h6>Hatchback</h6>
              <img style="width:50%;"  src="{{asset('frontend/images/car_icons/hatchback.png')}}" alt="">
            </div>
            <div class="frst_mes" id="sed" onclick="selectCar('Sedan')" style="cursor: pointer;">
              <h6>Sedan</h6>
              <img style="width:50%;"  src="{{asset('frontend/images/car_icons/sedan.png')}}" alt="">
            </div>
            <div class="frst_mes" id="trav" onclick="selectCar('Traveller')" style="cursor: pointer;">
              <h6>Traveller</h6>
              <img style="width:50%;"  src="{{asset('frontend/images/car_icons/traveller.png')}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="mb-3 col-md-6">
    <div class="start_time">
    <label for="datetime" class="form-label">Choose start Date and Time</label>
    <input
    width="50%"
      type="datetime-local" 
      class="form-control" 
      id="datetime" 
      placeholder="Select date and time"
    >
  </div>
    </div>
    <div class="mb-3 col-md-6">
    <div class="end_time">
    <label for="datetime" class="form-label">Choose End Date and Time</label>
    <input
    width="50%" 
      type="datetime-local" 
      class="form-control" 
      id="datetime" 
      placeholder="Select date and time"
    >
  </div>
    </div>
  </div>
          <div class="mb-3">
            <label for="cost" class="form-label">Estimated Cost</label>
            <input type="text" class="form-control" id="cost" placeholder="Calculated automatically" disabled>
          </div>
          <button type="submit" class="btn btn-primary">Send Request to Admin</button>
        </form>
      </div> -->

      <div class="tab-pane fade show active" id="airport" role="tabpanel" aria-labelledby="airport-tab">
  <form>
    <div class="mb-3">
      <label for="trip-type" class="form-label">Trip</label>
      <select class="form-select" id="trip-type" style="width: 50%;" onchange="updateInputs()">
        <option value="pickup">Pickup from Airport/Railway station</option>
        <option value="drop">Drop to Airport/Railway station</option>
      </select>
    </div>

    <div id="pickup-inputs" style="display: none;">
      <div class="mb-3">
        <label for="pickup-airport" class="form-label">Pickup from</label>
        <select class="form-select" id="pickup-airport">
          <option value="">Select an Airport</option>
          <option value="airport1">Airport 1</option>
          <option value="airport2">Airport 2</option>
          <option value="airport3">Airport 3</option>
        </select>
      </div>
    </div>

    <div id="drop-inputs" style="display: none;">
      <div class="mb-3">
        <label for="drop-airport" class="form-label">Drop to</label>
        <select class="form-select" id="drop-airport">
          <option value="">Select an Airport</option>
          <option value="airport1">Airport 1</option>
          <option value="airport2">Airport 2</option>
          <option value="airport3">Airport 3</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="drop-address" class="form-label">Drop Address</label>
        <input type="text" class="form-control" id="drop-address" placeholder="Enter drop address">
      </div>
    </div>

    <div class="mb-3">
      <label for="location" class="form-label">Select Location</label>
      <input type="text" class="form-control" id="location" placeholder="Enter location" readonly data-bs-toggle="modal" data-bs-target="#stateModal">
    </div>

    <div class="modal fade" id="stateModal" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="stateModalLabel">Select a State</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="stateList"></ul>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="vehicle" class="form-label">Select Vehicle</label>
      <input type="text" class="form-control" id="car" placeholder="Select a vehicle" readonly data-bs-toggle="modal" data-bs-target="#carmodal">
    </div>

    <div class="modal fade" id="carmodal" tabindex="-1" aria-labelledby="carmodallabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="carmodallabel">Select car type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="car_model">
              <div class="frst_mes" id="suv" onclick="selectCar('SUV')" style="cursor: pointer;">
                <h6>Suv</h6>
                <img style="width:50%;" src="{{asset('frontend/images/car_icons/suv.png')}}" alt="">
              </div>
              <div class="frst_mes" id="hatch" onclick="selectCar('Hatchback')" style="cursor: pointer;">
                <h6>Hatchback</h6>
                <img style="width:50%;" src="{{asset('frontend/images/car_icons/hatchback.png')}}" alt="">
              </div>
              <div class="frst_mes" id="sed" onclick="selectCar('Sedan')" style="cursor: pointer;">
                <h6>Sedan</h6>
                <img style="width:50%;" src="{{asset('frontend/images/car_icons/sedan.png')}}" alt="">
              </div>
              <div class="frst_mes" id="trav" onclick="selectCar('Traveller')" style="cursor: pointer;">
                <h6>Traveller</h6>
                <img style="width:50%;" src="{{asset('frontend/images/car_icons/traveller.png')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col-md-6">
        <div class="start_time">
          <label for="datetime" class="form-label">Choose start Date and Time</label>
          <input type="datetime-local" class="form-control" id="datetime" placeholder="Select date and time">
        </div>
      </div>
      <div class="mb-3 col-md-6">
        <div class="end_time">
          <label for="datetime" class="form-label">Choose End Date and Time</label>
          <input type="datetime-local" class="form-control" id="datetime" placeholder="Select date and time">
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="cost" class="form-label">Estimated Cost</label>
      <input type="text" class="form-control" id="cost" placeholder="Calculated automatically" disabled>
    </div>
    <button type="submit" class="btn btn-primary">Send Request to Admin</button>
  </form>
</div>

      <!-- Local Tour -->
      <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local-tab">
        <form>
          <div class="mb-3">
            <label for="local-location" class="form-label">Select Location</label>
            <input type="text" class="form-control" id="local-location" placeholder="Enter location">
          </div>
          <div class="mb-3">
            <label for="local-vehicle" class="form-label">Select Vehicle</label>
            <select class="form-select" id="local-vehicle">
              <option value="">Select vehicle</option>
              <option value="sedan">Sedan</option>
              <option value="suv">SUV</option>
              <option value="hatchback">Hatchback</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="local-cost" class="form-label">Estimated Cost</label>
            <input type="text" class="form-control" id="local-cost" placeholder="Calculated automatically" disabled>
          </div>
          <button type="submit" class="btn btn-primary">Send Request to Admin</button>
        </form>
      </div>

      <!-- Outstation Booking -->
      <div class="tab-pane fade" id="outstation" role="tabpanel" aria-labelledby="outstation-tab">
        <form>
          <div class="mb-3">
            <label for="type" class="form-label">Trip Type</label>
            <select class="form-select" id="type">
              <option value="">Select type</option>
              <option value="one-way">One-Way</option>
              <option value="round-trip">Round Trip</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="outstation-location" class="form-label">Enter Location</label>
            <input type="text" class="form-control" id="outstation-location" placeholder="Enter location">
          </div>
          <div class="mb-3">
            <label for="outstation-vehicle" class="form-label">Select Vehicle</label>
            <select class="form-select" id="outstation-vehicle">
              <option value="">Select vehicle</option>
              <option value="sedan">Sedan</option>
              <option value="suv">SUV</option>
              <option value="hatchback">Hatchback</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="outstation-cost" class="form-label">Estimated Cost</label>
            <input type="text" class="form-control" id="outstation-cost" placeholder="Calculated automatically" disabled>
          </div>
          <button type="submit" class="btn btn-primary">Send Request to Admin</button>
        </form>
      </div>
    </div>
  </div>
  
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
function updateInputs() {
  const tripType = document.getElementById("trip-type").value;
  const pickupInputs = document.getElementById("pickup-inputs");
  const dropInputs = document.getElementById("drop-inputs");

  if (tripType === "pickup") {
    pickupInputs.style.display = "block";
    dropInputs.style.display = "none";
  } else if (tripType === "drop") {
    pickupInputs.style.display = "none";
    dropInputs.style.display = "block";
  } else {
    pickupInputs.style.display = "none";
    dropInputs.style.display = "none";
  }
}

// Initialize the form with "Pickup" as the default option
document.addEventListener("DOMContentLoaded", updateInputs);

  </script>
@endsection
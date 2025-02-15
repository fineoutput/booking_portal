<div class="comp-container">
<div class="upper_site_dets">
    <div class="site_det_head">
        <h4 class="raj_hotel">{{ $title }}</h4>
    </div>
</div>

<div class="air_maze">
    <div class="row">
        <div class="col-lg-7 nive d-none d-lg-block">
            <div class="mirror_maxe">
                <img src="{{ $mainImage }}" alt="">
            </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
            <div class="row">
                @foreach ($sideImages as $index => $image)
                    <div class="col-lg-6">
                        <div class="side_masic">
                            <img src="{{ $image }}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                @foreach ($bottomImages as $index => $image)
                    <div class="col-lg-6">
                        <div class="side_masic">
                            <img src="{{ $image }}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="phlGlb" class="splide">
        <div class="splide__track d-lg-none">
            <ul class="splide__list">
                @foreach ($mobileImages as $image)
                    <li class="splide__slide"><img src="{{ $image }}" alt=""></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>



<!-- <div class="upper_site_dets">
            <div class="site_det_head">
                <h4 class="raj_hotel">Amagarh Leopard Reserve</h4>
            </div>
        </div>
        <div class="air_maze">
            <div class="row">
                <div class="col-lg-7 nive d-none d-lg-block">
                    <div class="mirror_maxe">
                        <img src="https://i.pinimg.com/736x/41/a8/8e/41a88e0bcc032c9d378169ebd48b21c7.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/65/e7/64/65e7642bd46b656057929c17c4d002bd.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/dd/1a/5f/dd1a5f87662b3a58221f42e7e6cfc95d.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/0c/3a/f5/0c3af5949f5053c5285e00bfeb1ef446.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="side_masic">
                                <img src="https://i.pinimg.com/236x/5e/96/82/5e9682f42856edf6bc9f882ed5e9f03e.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="phlGlb" class="splide">
                <div class="splide__track d-lg-none">
                    <ul class="splide__list">
                        <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
                        <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
                        <li class="splide__slide"><img src="{{ asset('frontend/images/hotel_main.avif') }}" alt=""></li>
                    </ul>
                </div>
            </div>
        </div> -->
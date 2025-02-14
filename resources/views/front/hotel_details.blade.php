@extends('front.common.app')
@section('title','home')
@section('content')

<section class="detail_htels mt-5">
    <div class="comp-container">
    <div class="upper_site_dets">
        <div class="site_det_head">
            <h4 class="raj_hotel">Raj Palace Hotel</h4>
        </div>
    </div>
    <div class="air_maze">
        <div class="row">
            <div class="col-lg-7 nive">
                <div class="mirror_maxe">
                    <img src="{{ asset('frontend/images/hotel_main.avif') }}" alt="">
                </div>
            </div>
            <div class="col-lg-5 nive">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="side_masic">
                            <img src="{{ asset('frontend/images/side_maze.avif') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="side_masic">
                            <img src="{{ asset('frontend/images/side_maze.avif') }}" alt="">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                    <div class="side_masic">
                            <img src="{{ asset('frontend/images/side_maze.avif') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="side_masic">
                            <img src="{{ asset('frontend/images/side_maze.avif') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="other_dets mt-5">
        <div class="row">
            <div class="col-lg-7">
                <div class="sides_maxe">
                    <div class="aaeheads">
                        <h4 class="hoses">Room in Udaipur, India
                        </h4>
                        <span class="sabke">
                        2 bedrooms2 king bedsPrivate attached bathroom
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
            <div class="sides_maxe">
                    <div class="aaeheads">
                        <h4 class="hoses">Room in Udaipur, India
                        </h4>
                        <span class="sabke">
                        2 bedrooms2 king bedsPrivate attached bathroom
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


@endsection
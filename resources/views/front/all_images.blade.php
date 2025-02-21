@extends('front.common.app')
@section('title','home')
@section('content')
<section class="all_images">
    <div class="comp-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="head_all_title">
                    <h4>goSTOPS Mumbai</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="all_images_slider">
                    <h6>Rooms</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="maze_trace">
                    <img src="{{asset('frontend/images/arja.avif')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="maze_trace">
                    <img src="{{asset('frontend/images/arja.avif')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="maze_trace">
                    <img src="{{asset('frontend/images/arja.avif')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
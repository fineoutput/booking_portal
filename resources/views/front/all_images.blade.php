@extends('front.common.app')
@section('title','home')
@section('content')
<section class="all_images">
    <div class="comp-container">
        <div class="row">
            <div class="col-lg-12 mt-5 ">
                <div class="head_all_title">
                    <h4>Hotel Images</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="all_images_slider">
                    {{-- <h6>Rooms</h6> --}}
                </div>
            </div>
        </div>

        <div class="row">
            @php
                        // Assuming 'image' contains a JSON array of images
                        $images = json_decode($hotels->images); // Decode the JSON to an array
                    @endphp
            @foreach($images as $image)
            <div class="col-lg-4">
                <div class="maze_trace">
                    <!-- Assuming $image stores the path or filename of the image -->
                    <img src="{{ asset($image) }}" alt="{{ $image->alt_text ?? 'Hotel Image' }}">
                </div>
            </div>
        @endforeach
        

            {{-- <div class="col-lg-4">
                <div class="maze_trace">
                    <img src="{{asset('frontend/images/arja.avif')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="maze_trace">
                    <img src="{{asset('frontend/images/arja.avif')}}" alt="">
                </div>
            </div> --}}
        </div>
    </div>
</section>


@endsection
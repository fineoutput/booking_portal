@extends('front.common.app')
@section('title','home')
@section('content')

<section class="options_sect">
    <div class="container">
        <div class="row center-div">
            <div class="col-lg-6">
                <div class="column_side d-flex justify-content-center align-items-center mt-5">
                    <a href="#">
                    <div class="colll">
                <img src="{{ asset('frontend/images/cards/protection.png') }}" alt="European Marvels">
                <h4>Property Booking</h4>
                </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="column_side d-flex justify-content-center align-items-center mt-5">
                    <a href="#">
                    <div class="saul">
                <img src="{{ asset('frontend/images/cards/transport (1).png') }}" alt="European Marvels">
                <h4>Cab Booking</h4>
                </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
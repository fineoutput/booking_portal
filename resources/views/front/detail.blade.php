@extends('front.common.app')
@section('title','home')
@section('content')

<section class="dett_sect"  style="background: #f3f3f3;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="upper_type_date">
                    <p>Group Tour</p>
                    <p style="
                                        background: #fb7d03;
                                        color: #fff;
                                        padding: 2px;">
                        EUEP
                    </p>
                </div>
                <div class="head_txxt">
                    <h4>Delhi Agra Haridwar Rishikesh</h4>
                    <div class="hum_str">
                    <div class="plan_type_date">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p style="margin: 0;">350+ guests rated 5*</p>
                    <p style="margin: 0;color: #0a66c2;font-weight: bold;">
                    10 Reviews</p>
                  </div>
                    </div>
                    <div class="hum_str">
                    <div class="plan_type_date gap-2">
                    <p>
                    <i class="fa-solid fa-calendar-days"></i>
                    <b>8</b> Days
                    </p>
                    <p>
                    <i class="fa-solid fa-location-dot"></i>
                    <b>7</b> Cities
                    </p>
                  </div>
                    </div>
                </div>
                <div class="head_mage">
                    <div class="mage_vin">
                        <img src="{{asset('frontend/images/banner/nihd-i-bnn-1-NIDR-352022.avif')}}" alt="">
                    </div>
                </div>

                <div class="head_incldes mt-5 d-flex gap-5">
                    <div class="sonnn">
                    <div class="head_incldes_left">
                        <h4>Tour Includes</h4>
                    </div>
                    <div class="inc_icn d-flex gap-4">
                        <div class="iccn">
                        <i class="fa-solid fa-hotel" style="color: #FFD43B;"></i>
                        <p>Hotel</p>
                        </div>
                        <div class="iccn">
                        <i class="fa-solid fa-utensils" style="color: #FFD43B;"></i>
                        <p>
                        Meals</p>
                        </div>
                        <div class="iccn">
                        <i class="fa-solid fa-van-shuttle" style="color: #FFD43B;"></i>
                        <p>Transport</p>
                        </div>
                        <div class="iccn">
                        <i class="fa-solid fa-camera" style="color: #FFD43B;"></i>  
                        <p>Sightseeing</p>
                        </div>
                        <div class="iccn">
                        <i class="fa-solid fa-plane" style="color: #FFD43B;"></i>
                        <p>Flight</p>
                        </div>
                    </div>
                    <div class="sany_txt">
                        <p>*Except for Joining/Leaving, To & fro economy class airfare is included for all<br> departure cities.
                        </p>
                        <p>*Taxes Extra.</p>
                    </div>
                    </div>
                    <div class="sonn_rght">
                        <h4>Key Highlights</h4>
                        <div class="ras_radio_btbs">
                        Mehtab bagh
                        </div>
                        <div class="ras_radio_btbs">
                        Agra Fort
                        </div>
                        <div class="ras_radio_btbs">
                        Taj Mahal
                        </div>
                        <div class="ras_radio_btbs">
                        Fatehpur Sikhri
                        </div>
                        <div class="ras_radio_btbs">
                        Mathura and Vrindavan
                        </div>
                        <div class="ras_radio_btbs">
                        Ganga Aarti at Har Ki Pauri 
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
@endsection
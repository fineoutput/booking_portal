@extends('front.common.app')
@section('title','home')
@section('content')
@php
    $title = "Jaipur Tour Guide";
    $mainImage = "https://cdn.getyourguide.com/img/tour/8db56f3e6e18aa5ba682ab79c170dd0079873ecf27f856447ecf12f84ec02a87.jpg/98.jpg";
    $sideImages = [
        "https://cdn.getyourguide.com/img/tour/fc77f6f2f0bcaad6ab81e24d4328a34979486f1a87dacd623a97a2e9f2059fcd.jpg/vertical_520_780.jpg",
        "https://cdn.getyourguide.com/img/tour/b1ab823050eaa28b490313a70e9d38df5f81584fd87966acbf27e1e69a666520.jpg/97.jpg"
    ];
    $bottomImages = [
        "https://cdn.getyourguide.com/img/tour/713df89fb3d368a3b6bbecb247945f537d194fbdb5e63a456ec0af2d1626a52d.jpg/145.jpg",
        "https://cdn.getyourguide.com/img/tour/3eb2e74603eba65ca2fcc0540fa3bfccc73f0103965f72c54a0d6eb95976cb8d.jpg/145.jpg"
    ];
    $mobileImages = [
        asset('frontend/images/hotel_main.avif'),
        asset('frontend/images/hotel_main.avif'),
        asset('frontend/images/hotel_main.avif')
    ];
@endphp

@include('front.common.slides', compact('title', 'mainImage', 'sideImages', 'bottomImages', 'mobileImages'))

@endsection
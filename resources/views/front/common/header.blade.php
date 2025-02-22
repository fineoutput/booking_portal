<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tours Dekho</title>
  <!-- Bootstrap CSS -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/css/tempus-dominus.min.css"
  >
  <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

  <!-- Add Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <style>

  </style>
</head>
<body>

 <div class="pop-bg"></div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

{{-- @if ($errors->any())
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "300000", // 5 minutes = 300000ms
        "extendedTimeOut": "1000" // additional time after hover (optional)
    };
    toastr.error('@foreach ($errors->all() as $error){{ $error }} @endforeach');
</script>
@endif

<!-- Display Success Message -->
@if (session('message'))
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "300000", // 5 minutes = 300000ms
        "extendedTimeOut": "1000" // additional time after hover (optional)
    };
    toastr.success('{{ session('message') }}');
</script>
@endif --}}

    @if ($errors->any())
						<script>
							toastr.error('@foreach ($errors->all() as $error){{ $error }} @endforeach');
						</script>
					@endif

				<!-- Display Success Message -->
				@if (session('message'))
					<script>
						toastr.success('{{ session('message') }}');
					</script>
				@endif

				{{-- @if (session('prop'))
					<script>
						toastr.error('{{ session('message') }}');
					</script>
				@endif --}}


    
<header class="header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-3">
          <div class="logo">
          <a style="text-decoration: none;" href="{{ route('index') }}"><img style="width: 220px;" src="{{asset('frontend/images/white_logo.png')}}" alt=""></a>
            
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="search-bar">
            <input type="text" placeholder="Search 'Eiffel Tower'" class="search-input">
            <button class="search-btn">🔍</button>
          </div>
        </div>
        <div class="col-12 col-md-3 d-flex justify-content-end press_header">
          <div class="contact me-3">
            📞 1800 22 7979
          </div>
          <div class="sign-in dropdown">
    👤 
    @if(Auth::guard('agent')->check())
        <a href="#" class="text-white dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::guard('agent')->user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end whatis" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('user_profile') }}">Profile</a>
            </li>
            <li>
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
            </li>
        </ul>
    @else
        <a href="{{ route('login') }}" class="text-white">Sign In</a>
    @endif
</div>

        </div>
      </div>
    </div>
  </header>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark nave_color">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('index') }}">Tours Dekho</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <!-- Mega Menu -->
        <li class="nav-item dropdown mega-menu">
          <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Package Booking
          </a>
          <div class="dropdown-menu mega-menu-content" aria-labelledby="megaMenu" style="width: 750px;">
            <div class="row">

              {{-- <div class="col-md-4">
                <h6>Rajasthan</h6>
                <ul class="list-unstyled">
                  <li><a class="dropdown-item" href="">Jaipur</a></li>
                  <li><a class="dropdown-item" href="">Udaipur</a></li>
                  <li><a class="dropdown-item" href="">Chittod</a></li>
                </ul>
              </div> --}}

              @foreach($states as $state)
        <div class="col-md-4">
            <h6>{{ $state->state_name }}</h6>
            <ul class="list-unstyled">
                @foreach($state->cities as $city)
                    <li><a class="dropdown-item" href="{{ route('list', ['city_id' => base64_encode($city->id)]) }}">{{ $city->city_name }}</a></li>
                @endforeach
            </ul>
        </div>
    @endforeach

            </div>

          </div>
          <div class="mega-menu-backdrop"></div>
        </li>
        <!-- Other Nav Items -->
        @if(Auth::guard('agent')->check())

        @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        @endif
        <li class="nav-item"><a class="nav-link" href="{{ route('user_profile') }}">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('taxi_booking') }}">Taxi Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('hotelsbooking') }}">Hotels</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('wildlife') }}">Safari</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('guide') }}">Guide</a></li>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function () {
  const megaMenu = document.querySelector(".mega-menu");
  const megaMenuContent = megaMenu.querySelector(".mega-menu-content");
  const backdrop = document.querySelector(".mega-menu-backdrop");


  
  megaMenu.addEventListener("mouseenter", () => {
    megaMenuContent.style.display = "block";
    // console.log(backdrop, "appeared");
    
    backdrop.style.display = "block";
  });

  megaMenu.addEventListener("mouseleave", () => {
    console.log("mouseleave", "leved");
    
    megaMenuContent.style.display = "none";
    backdrop.style.display = "none";
  });
  
  megaMenuContent.addEventListener("mouseleave", () =>{
    backdrop.style.display = "none";
  });

  backdrop.addEventListener("click", () => {
    backdrop.style.display = "none";
  });
});

</script>

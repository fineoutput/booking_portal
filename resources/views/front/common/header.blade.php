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
    <!-- Litepicker CSS -->
<link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/css/tempus-dominus.min.css"
  >
  <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

  <link rel="icon" href="{{ asset('frontend/images/black.png') }}" type="image/x-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

  <!-- Add Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <style>
/* Default navbar style */
.navbar {
  transition: all 0.4s ease-in-out;
  z-index: 999;
}
/* .noPE{
  display: none
}
.yePP{
  display: block
} */
/* Sticky style when scrolled */
.navbar.scrolled {
  position: sticky;
  top: 0;
  background-color: white ;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  animation: slideDown 0.4s ease-in-out;
}

/* Slide down animation */
@keyframes slideDown {
  from {
    transform: translateY(-100%);
  }
  to {
    transform: translateY(0);
  }
}

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


<div class=" stEEP">  
<header style="border-bottom:1px solid rgba(0, 0, 0, 0.306) " class="header ">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-3">
          <div class="logo">
          <a style="text-decoration: none;" href="{{ route('index') }}"><img style="width: 220px;" src="{{asset('frontend/images/black.png')}}" alt=""></a>
            
          </div>
        </div>
        <div class="col-12 col-md-6">
          

        </div>
        <div class="col-12 col-md-3 d-flex justify-content-end press_header" style="align-items: center">
            {{-- <div class="search-bar" id="searchBar">
  <input type="text" placeholder="Search 'Eiffel Tower'" class="search-input" id="searchInput">
  <button class="search-btn" id="searchBtn">🔍</button>
</div> --}}
          <div class="sign-in dropdown">
            <div class="else_prese">
              <img src="https://edge.ixigo.com/st/upahaar/_next/static/media/userFilled.12154510.svg" alt="">
            </div>
    @if(Auth::guard('agent')->check())
        <a href="#" class="dropdown-toggle dotts" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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

        <div class="musq">
         <a href="{{ route('login') }}"
            onclick="localStorage.setItem('redirect_after_login', window.location.href)"class="dotts"><b>Log in/Sign up</b>
          </a>
        </div>
        
    @endif
</div>

        </div>
      </div>
    </div>
  </header>
<!-- Navigation Bar -->

</div>
<nav class="navbar navbar-expand-lg navbar-dark nave_color ">
  <div class="container justify-content-center ">
    <a class="navbar-brand" href="{{ route('index') }}">Tours Dekho</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="lol_set">
    <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav mx-auto">
        <!-- Mega Menu --> 
        <a id="secLog" class="compIset" style="text-decoration: none; display: none" href="{{ route('index') }}"><img style="    width: 250px;
    position: absolute;
    height: 60px;
    left: 50px; " src="{{asset('frontend/images/black.png')}}" alt=""></a>
        <li class="nav-item dropdown mega-menu">
         
          <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img style="width: 50px; height: 50px;" src="https://cdn-icons-png.flaticon.com/128/13208/13208798.png" alt="">
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
            <h6> <a href="{{ route('state_detail', ['state_id' => base64_encode($state->id)]) }}">{{ $state->state_name }}</a></h6>
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
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> --}}
        @endif
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('user_profile') }}">Profile</a></li> --}}
        <li class="nav-item"><a class="nav-link" href="{{ route('taxi_booking') }}">
          <img style="width: 50px; height: 50px;" src="https://cdn-icons-png.flaticon.com/128/8633/8633703.png" alt="">
            
          Taxi Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('hotelsbooking') }}">
          <img style="width: 50px; height: 50px;" src="https://edge.ixigo.com/st/vimaan/_next/static/media/hotel.4b63222d.svg" alt="">
            
          Hotels</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('wildlife') }}">
          <img style="width: 50px; height: 50px;" src="https://cdn-icons-png.flaticon.com/128/4793/4793758.png" alt="">
            
          Safari</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('guide') }}">
          <img style="width: 50px; height: 50px;" src="https://cdn-icons-png.flaticon.com/128/2268/2268568.png" alt="">
            
          Guide</a></li>
      </ul>
      

      
      </div>
      
    </div>
 
  </div>
</nav>
<script>
document.addEventListener("DOMContentLoaded", () => {
    let url = localStorage.getItem("redirect_after_login");

    if (url) {
        fetch("{{ route('save.redirect.url') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ redirect_url: url })
        });

        // Clear only after saving
        localStorage.removeItem("redirect_after_login");
    }
});
</script>

<script>
  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    const secLog = document.getElementById('secLog')
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
      navbar.classList.add('seltitude');
      // secLog.classList.add('yePP');
     secLog.style.display = 'block';
    } else {
      navbar.classList.remove('scrolled');
      navbar.classList.remove('seltitude');
      // secLog.classList.add('noPE');
      
     secLog.style.display = 'none';
    }
  });
</script>
<script>
  const searchBtn = document.getElementById('searchBtn');
  const searchBar = document.getElementById('searchBar');
  const searchInput = document.getElementById('searchInput');

  searchBtn.addEventListener('click', function () {
    searchBar.classList.toggle('expanded');
    if (searchBar.classList.contains('expanded')) {
      searchInput.focus();
    }
  });

  // Optional: Collapse on outside click
  document.addEventListener('click', function (e) {
    if (!searchBar.contains(e.target)) {
      searchBar.classList.remove('expanded');
    }
  });
</script>

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

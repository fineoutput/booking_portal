<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tours Dekho</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
  <!-- Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
  <style>

  </style>
</head>
<body>
    
<header class="header">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-3">
          <div class="logo">
            <span class="logo-icon">T</span>
            <span class="logo-text"><a style="text-decoration: none;" href="{{ route('index') }}">Tours Dekho</a></span>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="search-bar">
            <input type="text" placeholder="Search 'Eiffel Tower'" class="search-input">
            <button class="search-btn">🔍</button>
          </div>
        </div>
        <div class="col-12 col-md-3 d-flex justify-content-end">
          <div class="contact me-3">
            📞 1800 22 7979
          </div>
          <div class="sign-in">
            👤 <a href="#" class="text-white">Sign In</a>
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
                <!-- Package Booking Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Package Booking
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="height: 500px; overflow-y: auto;">
                       <div class="d-flex nachel"> 
                       <li><a class="dropdown-item" href="#"><b>Rajasthan</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Jaipur</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Udaipur</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chittod</a></li>
                       </div>
                       <div class="d-flex nachel">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Himachal</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Manali</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Rohtang</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Sisu</a></li>
                       </div>
                       <div class="d-flex nachel">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>J&K</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kashmir</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Ooty</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Gangtok</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                       <div class="d-flex">
                       <li><a class="dropdown-item" href="{{ route('index') }}"><b>Home</b></a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Himachal Pradesh</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Chennai</a></li>
                        <li><a class="dropdown-item" href="{{ route('list') }}">Kolkata</a></li>
                       </div>
                        
                    </ul>
                    
                </li>
                <!-- Other Nav Items -->
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user_profile') }}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('taxi_booking') }}">Taxi Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="">List</a></li>
            </ul>
        </div>
    </div>
</nav>

@extends('front.common.app')
@section('title','home')
@section('content')
<style>
    .stEEP{
        display: none;
    }
    .form-container {
        max-width: 400px;
        margin: auto;
        margin-top: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
    }
.navbar {
    display: none;
}
    .form-container button {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .form-container .btn {
        width: 100%;
    }

    .hidden {
        display: none;
    }

    .btn-sm {
        font-size: 0.875rem;
        padding: 8px 15px;
    }

    .btn-outline-primary,
    .btn-outline-secondary {
        margin-bottom: 10px;
    }

    .small-buttons-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .modal-body {
        max-height: 75vh;
        overflow-y: auto;
    }

    /* LEFT CONTENT SECTION */
.content {
  padding: 60px;
  color: #000;
  /* background: linear-gradient(160deg, #1b3c4f, #274e63); */
  position: relative;
}

/* Top Badge */
.content .badge {
  display: inline-block;
  background: rgb(211 83 40);
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 20px;
}

/* Main Heading */
.content h1 {
  font-size: 33px;
  font-weight: 700;
  line-height: 1.3;
  margin-bottom: 20px;
}

/* Paragraph Text */
.content p {
  font-size: 16px;
  line-height: 1.7;
  opacity: 0.95;
  margin-bottom: 18px;
}

/* Feature List Container */
.content .features {
  margin-top: 30px;
}

/* Single Feature Row */
.content .feature {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  margin-bottom: 18px;
}

/* Feature Icon */
.content .feature i {
  font-size: 20px;
  color: #ffd369;
  margin-top: 4px;
}

/* Feature Text */
.content .feature p {
  margin: 0;
  font-size: 15px;
}

/* Highlight Offer Box */
.content .highlight {
  margin-top: 30px;
  background: rgba(255, 211, 105, 0.15);
  border-left: 4px solid #ffd369;
  padding: 14px 16px;
  border-radius: 6px;
  font-size: 15px;
  font-weight: 500;
}

/* Responsive Adjustments */
@media (max-width: 900px) {
  .content {
    padding: 40px 30px;
  }

  .content h1 {
    font-size: 30px;
  }
}
.glass-card {
  /* width: 240px;
  height: 360px; */
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.5),
    inset 0 -1px 0 rgba(255, 255, 255, 0.1),
    inset 0 0 20px 10px rgba(255, 255, 255, 1);
  position: relative;
  overflow: hidden;
}

.glass-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.8),
    transparent
  );
}

.glass-card::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 1px;
  height: 100%;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 0.8),
    transparent,
    rgba(255, 255, 255, 0.3)
  );
}

  /* SECTION WRAPPER */
.property-section{
    max-width:1200px;
    margin:60px auto;
    padding:0 20px;
}

/* HEADING */
.property-section h1{
    font-size:36px;
    margin-bottom:8px;
    color:#222;
}

.property-section p{
    font-size:18px;
    color:#555;
    margin-bottom:40px;
}

/* CARD ROW */
.property-row{
    display:flex;
    gap:30px;
    justify-content:space-between;
    flex-wrap:wrap;
}

/* CARD */
.property-card{
    width:200px;
    background:#f3f3f3;
    border-radius:18px;
    overflow:hidden;
    transition:0.3s ease;
    cursor:pointer;
}

.property-card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

/* IMAGE */
.property-card img{
    width:100%;
    height:220px;
    object-fit:cover;
    border-top-left-radius:18px;
    border-top-right-radius:18px;
}

/* LABEL */
.property-label{
    padding:18px 0;
    text-align:center;
    font-weight:600;
    letter-spacing:1px;
    font-size:16px;
    background:#eaeaea;
}

/* RESPONSIVE */
@media(max-width:1024px){
    .property-row{
        justify-content:center;
    }
}

@media(max-width:768px){
    .property-card{
        width:45%;
    }
}

@media(max-width:480px){
    .property-card{
        width:100%;
    }
}
.center-logo{
    display:flex;
    justify-content:center;   /* horizontal center */
    align-items:center;       /* vertical center */
    /* width: 200px; */
    widows: 100%;
}
.center-logo img{
    width: 150px;
    height: auto;
}


/* SECTION WRAPPER */
.adv-section{
    position:relative;
    padding:80px 10%;
    overflow:hidden;
}

/* Decorative Gradient Blob */
.adv-section::before{
    content:"";
    position:absolute;
    right:-200px;
    top:-100px;
    width:600px;
    height:600px;
    background:radial-gradient(circle, #dcd6ff 0%, #f5f6fa 70%);
    border-radius:50%;
    z-index:0;
}

/* GRID LAYOUT */
.adv-container{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:60px;
    position:relative;
    z-index:2;
}

/* LEFT SIDE */
.adv-left{
    flex:1;
}

.adv-left h2{
    font-size:38px;
    margin-bottom:10px;
    color:#222;
}

.adv-left p{
    font-size:18px;
    margin-bottom:40px;
    color:#666;
}

/* FEATURE CARDS */
.feature{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px 20px;
    margin-bottom:20px;
    background:rgba(255,255,255,0.6);
    backdrop-filter:blur(10px);
    border-radius:14px;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    transition:0.3s ease;
}

.feature:hover{
    transform:translateX(10px);
    box-shadow:0 12px 25px rgba(0,0,0,0.1);
}

.feature-icon{
    width:45px;
    height:45px;
    background:linear-gradient(135deg,#6c63ff,#8f88ff);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    font-size:20px;
}

.feature-text{
    font-size:16px;
    color:#333;
    font-weight:500;
}

/* RIGHT SIDE */
.adv-right{
    flex:1;
    position:relative;
    display:flex;
    justify-content:center;
}

.device{
    /* width:320px; */
    border-radius:20px;
    box-shadow:0 20px 50px rgba(0,0,0,0.2);
    /* transform:rotate(-3deg); */
    transition:0.4s;
}

.device:hover{
    transform:rotate(0deg) scale(1.03);
}

/* RESPONSIVE */
@media(max-width:1000px){
    .adv-container{
        flex-direction:column;
        text-align:center;
    }

    .feature{
        justify-content:center;
    }

    .device{
        margin-top:40px;
    }
}
</style>



<section class="login_regg fgRbqL">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row glass-card">
            <div class="center-logo">
    <img src="{{asset('frontend/images/black.png')}}" alt="">
</div>
            <div class="col-lg-6">
                <div class="content">
      <span class="badge">🚀 Your Gateway to Profitable Travel Partnerships</span>

      <h1>Grow Your Travel Business with Confidence</h1>

      <p>
        <strong>Trip Dekho</strong> is a PAN-India B2B Destination Management Company with
        <strong>10+ years of industry expertise</strong>.
        We don’t just provide tours — we build your brand through flawless execution
        and <strong>10% lower industry rates</strong>.
      </p>

      <div class="features">
        <div class="feature">
          <i class="fa-solid fa-map-location-dot"></i>
          <p>Nationwide coverage from <strong>Kashmir to Kerala</strong>, Ladakh to the Northeast</p>
        </div>

        <div class="feature">
          <i class="fa-solid fa-gears"></i>
          <p>End-to-end planning, operations & execution handled by experts</p>
        </div>

        <div class="feature">
          <i class="fa-solid fa-handshake"></i>
          <p>A decade of trust, reliability & profitable partnerships</p>
        </div>
      </div>

      <div class="highlight">
        🎁 <strong>Exclusive Partner Offer:</strong> Get an additional <strong>10% OFF</strong> on your first booking
      </div>
    </div>
            </div>
            <div class="col-lg-6">
                <div class="form-container" style="position: relative;">
                    <div class="heasdds d-flex justify-content-center">
                    <h2 class="text-center mb-4" id="loginFormTitle">Login</h2>
                    <button type="button" class="ashrsy" data-bs-toggle="modal" data-bs-target="#registerModal">Signup</button>
                    </div>
                   

                    <div id="loginWithEmail" class="showEmailForm">
                    <form method="POST" action="{{ route('agentLoginWithEmail') }}">
                        @csrf
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="mb-3">
                            <label for="emailLogin" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwordLogin" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Enter your password" required>
                        </div>
                    
                        <!-- Show flash messages -->
                     
                    
                        <div class="small-buttons-container">
                            <button style="width: 50%;" type="button" class="khadk" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</button>
                            <button style="width: 50%;" type="button" class="khadk" id="toggleLoginTypeBtn" onclick="toggleLoginForm()">Login with Phone</button>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>

                    <!-- Phone Login Form -->
                    <div id="loginWithPhone" class="hidden">

                  

                    <form id="agentLoginForm" method="POST" action="{{ route('agentLoginWithMobile') }}">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger" id="errorMessage">{{ session('error') }}</div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success" id="successMessage">{{ session('message') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" id="validationErrors">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <!-- Phone Number Field -->
                        <div id="phoneFormGroup" class="mb-3">
                            <label for="phoneLogin" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneLogin" name="mobile_number" placeholder="Enter your phone number" required>
                            <button type="button" class="btn btn-outline-primary mt-2" id="sendOtpBtn">Send OTP</button>
                            <button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="toggleLoginForm()">Back to Email Login</button>
                        </div>
                    </form>
                    

                    <form id="otpVerificationForm" method="POST">
                        @csrf
                    
                        <div id="otpFormGroup" class="mb-3" style="display: none;">
                            <label for="otpLogin" class="form-label">OTP</label>
                            <input type="text" class="form-control" id="otpLogin" name="otpLogin" placeholder="Enter OTP" required>
                            <button type="submit" class="btn btn-outline-primary mt-2" id="submitOtpBtn">Submit OTP</button>
                        </div>
                    </form>
                    
                    <!-- Error message container (Initially hidden) -->
                    <div id="otpErrorMessage" class="alert alert-danger" style="display:none;"></div>
                    
                    <!-- Success message container (Initially hidden) -->
                    <div id="otpSuccessMessage" class="alert alert-success" style="display:none;"></div>
                    
                    
                    
                    <!-- Toast for Success -->
                    <div id="otpSuccessToast" class="toast" style="position: fixed; bottom: 20px; right: 20px; display: none;">
                        <div class="toast-body">
                            OTP sent successfully!
                        </div>
                    </div>
                    


                </div>
                </div>

                <!-- Register Modal -->
                <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="registerModalLabel">Agent Registration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST"  action="{{route('signup_agent')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="number" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" id="number" name="number" placeholder="Enter your number" required maxlength="10" minlength="10">
                                    </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="mb-3">
                                        <label for="businessName" class="form-label">Business Name</label>
                                        <input type="text" class="form-control" id="businessName" name="business_name" placeholder="Enter your business name" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <select class="form-control" id="state" name="state_id">
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{ old('state', isset($user) ? $user->state : null) == $state->id ? 'selected' : '' }}>
                                                        {{ $state->state_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <div id="output"></div>
                                            <select data-placeholder="" class="form-control" id="city" class="chosen-select" name="city_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="aadhar" class="form-label">Aadhar Upload Front</label>
                                        <input type="file" class="form-control" id="aadhar" name="aadhar_image" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="aadhar" class="form-label">Aadhar Upload back</label>
                                        <input type="file" class="form-control" id="aadhar" name="aadhar_image_back" required>
                                    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                           <div class="mb-3">
                                        <label for="pan" class="form-label">Pan Upload</label>
                                        <input type="file" class="form-control" id="pan" name="pan_image" required>
                                    </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                        <label for="gst" class="form-label">GST Number</label>
                                        <input type="text" class="form-control" id="gst" name="GST_number" placeholder="Enter your GST Number">
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="email" class="form-label">E-mail ID</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="logo" class="form-label">Logo Upload</label>
                                        <input type="file" class="form-control" id="logo" name="logo">
                                    </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="charge" class="form-label">Registration Charge</label>
                                        <input type="number" name="registration_charge" value="{{$Constants->agent_fees ?? ''}}" class="form-control" id="charge" name="registration_charge" placeholder="Enter registration charge" readonly>
                                    </div>
                                        </div>
                                    </div>

                                    
                                   
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forgot Password Modal -->
                <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('password.email')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="resetEmail" class="form-label">Enter Your Email</label>
                                        <input name="email" type="email" class="form-control" id="resetEmail" name="resetEmail" placeholder="Enter your email to reset password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="property-section">
    <h1>Everything Your Customer Needs!</h1>
    <p>Helping you find a perfect stay for everyone.</p>

    <div class="property-row">

        <div class="property-card">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945" alt="">
            <div class="property-label">HOTELS</div>
        </div>

        <div class="property-card">
            <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511" alt="">
            <div class="property-label">HOMESTAYS</div>
        </div>

        <div class="property-card">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b" alt="">
            <div class="property-label">RESORTS</div>
        </div>

        <div class="property-card">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="">
            <div class="property-label">VILLAS</div>
        </div>

        <div class="property-card">
            <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb" alt="">
            <div class="property-label">APARTMENTS</div>
        </div>

    </div>
</section>

<section class="adv-section">
    <div class="adv-container">

        <!-- LEFT -->
        <div class="adv-left">
            <h2>Why Choose Our Partner Platform?</h2>
            <p>A smarter, faster and feature-rich ecosystem built for modern travel agents.</p>

            <div class="feature">
                <div class="feature-icon">💳</div>
                <div class="feature-text">Instant access to bookings & transaction history</div>
            </div>

            <div class="feature">
                <div class="feature-icon">✈️</div>
                <div class="feature-text">Easy post-booking changes & rescheduling</div>
            </div>

            <div class="feature">
                <div class="feature-icon">🛡️</div>
                <div class="feature-text">Verified safe & premium stay options</div>
            </div>

            <div class="feature">
                <div class="feature-icon">📲</div>
                <div class="feature-text">Share deals instantly via WhatsApp</div>
            </div>

            <div class="feature">
                <div class="feature-icon">🖨️</div>
                <div class="feature-text">Custom branded booking confirmations</div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="adv-right">
            <img class="device" src="{{asset('frontend/images/sds.png')}}" alt="Device Mockup">
        </div>

    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function () {
    // Show the OTP form when the Send OTP button is clicked
    $('#sendOtpBtn').on('click', function (e) {
        e.preventDefault(); // Prevent form submission
        
        var phone_number = $('#phoneLogin').val(); // Get the phone number value from input

        $.ajax({
            url: "{{ route('agentLoginWithMobile') }}",  // Send request to your backend to send OTP
            method: "POST",
            data: {
                _token: $("input[name='_token']").val(),
                mobile_number: phone_number, // Passing the phone number
            },
            success: function (response) {
                if (response.errors) {
                $('#validationErrors').html('');
                $.each(response.errors, function (key, value) {
                    $('#validationErrors').append('<li>' + value + '</li>');
                });
                $('#validationErrors').show();
            } else if (response.success) {
                $('#successMessage').text(response.success);
                $('#successMessage').show();

                $('#otpFormGroup').show();
                $('#phoneFormGroup').hide();
                $('#sendOtpBtn').hide();
                $('#submitOtpBtn').show();
            }
            },
            error: function () {
                // Handle server error
                $('#errorMessage').text('Error while processing the request. Please try again later.');
                $('#errorMessage').show();
            }
        });
    });

    // Handle OTP form submission via AJAX
   $('#otpVerificationForm').on('submit', function (e) {
    e.preventDefault();

    var otp = $('#otpLogin').val();
    var phone_number = $('#phoneLogin').val();

    $.ajax({
        url: "{{ route('verifyOtp') }}",
        method: "POST",
        data: {
            _token: $("input[name='_token']").val(),
            otp: otp,
            mobile_number: phone_number,
        },
        success: function (response) {
            if (response.success) {
                $('#otpSuccessMessage').text(response.message).show();
                
                // Redirect to the page like normal login
                window.location.href = response.redirect;
            } else {
                $('#otpErrorMessage').text(response.error).show();
            }
        },
        error: function () {
            $('#otpErrorMessage').text('An error occurred while verifying the OTP. Please try again.').show();
        }
    });
});

});


</script>





<script>
    // Toast functionality
    $('#otpSuccessToast').toast({
        autohide: true,
        delay: 3000
    });
</script>


<script>
    function toggleLoginForm() {
        const emailForm = document.getElementById("loginWithEmail");
        const phoneForm = document.getElementById("loginWithPhone");
        const loginTitle = document.getElementById("loginFormTitle");
        const toggleButton = document.getElementById("toggleLoginTypeBtn");

        emailForm.classList.toggle("hidden");
        phoneForm.classList.toggle("hidden");

        if (phoneForm.classList.contains("hidden")) {
            loginTitle.textContent = "Login";
            toggleButton.textContent = "Login with Phone";
        } else {
            loginTitle.textContent = "Login with Phone";
            toggleButton.textContent = "Login with Email";
        }

        // Reset OTP form when switching back to the email form
        document.getElementById('phoneLogin').value = '';
        document.getElementById('otpLogin').value = '';
        document.getElementById('phoneFormGroup').style.display = 'block';
        document.getElementById('otpFormGroup').style.display = 'none';
        document.getElementById('submitOtpBtn').style.display = 'none';
    }


    // Handle phone login form submission
    document.getElementById('loginWithPhone').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting traditionally
        
        const otp = document.getElementById('otpLogin').value;

        if (otp) {
            alert("OTP verified successfully!");
            // Proceed with login or further processing
        } else {
            alert("Please enter the OTP.");
        }
    });

   
</script>

<link rel="stylesheet" href="https://harvesthq.github.io/chosen/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>

<script>
    document.getElementById('output').innerHTML = location.search;
    $(".chosen-select").chosen();
</script>
<script>
    $(document).ready(function() {
        console.log('nasdjdibhsaihdihasiudhisabnioj');
        // Load cities for the selected state when the page loads
        let selectedState = $('#state').val();  // Get the selected state
        if (selectedState) {
            loadCities(selectedState, "{{ old('city', isset($user) ? $user->city : '') }}");  // Preselect the city if it's available
        }

        // Fetch cities when state is changed
        $('#state').change(function() {
            let stateId = $(this).val();
            loadCities(stateId);  // Load cities based on selected state
        });

        function loadCities(stateId, selectedCity = null) {
            if (stateId) {
                  let url = "{{ route('filter_city', ':id') }}";
                  url = url.replace(':id', stateId);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        let cities = response.cities;
              
                        $('#city').empty().append('<option value="">Select a City</option>');
                        cities.forEach(function(city) {
                            // Append the city options
                            $('#city').append('<option value="' + city.id + '" ' + (selectedCity == city.id ? 'selected' : '') + '>' + city.city_name + '</option>');
                        });
                        $('#city').prop('disabled', false);
                    },
                    error: function() {
                        alert('Error fetching cities');
                    }
                });
            } else {
                $('#city').prop('disabled', true).empty().append('<option value="">Select a City</option>');
            }
        }

        // Initialize select2 for interests
        $('#interest').select2({
            placeholder: 'Select interests',
            allowClear: true
        });
    });
</script>

@endsection

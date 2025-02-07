@extends('front.common.app')
@section('title','home')
@section('content')
<style>
    .form-container {
        max-width: 400px;
        margin: auto;
        margin-top: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
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
</style>

<section class="login_regg fgRbqL">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="adding_head cnppKe">
                    <h3>Your Gateway</h3>
                    <span>To Seamless Travel Adventures</span>
                </div>
                <div class="gate_para">
                    <p class="kWdvAD">Welcome to <b>Trip Dekho</b>, your all-in-one platform designed to simplify travel planning. With user-friendly features, unbeatable deals, and personalized services, we make booking your next adventure effortless and enjoyable.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-container" style="position: relative;">
                    <div class="heasdds d-flex justify-content-center">
                    <h2 class="text-center mb-4" id="loginFormTitle">Login</h2>
                    <button type="button" class="ashrsy" data-bs-toggle="modal" data-bs-target="#registerModal">Signup</button>
                    </div>
                    <form id="loginWithEmail" class="showEmailForm">
                        <div class="mb-3">
                            <label for="emailLogin" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailLogin" name="emailLogin" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwordLogin" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Enter your password" required>
                        </div>
                        <div class="small-buttons-container">
                            
                            <button style="width: 50%;" type="button" class="khadk" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</button>
                            <button style="width: 50%;" type="button" class="khadk" id="toggleLoginTypeBtn" onclick="toggleLoginForm()">Login with Phone</button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Login</button>

                       
                    </form>

                    <!-- Phone Login Form -->
                    <form id="loginWithPhone" class="hidden">
                        <!-- Phone Number Field -->
                        <div id="phoneFormGroup" class="mb-3">
                            <label for="phoneLogin" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneLogin" name="phoneLogin" placeholder="Enter your phone number" required>
                        </div>

                        <!-- Submit Button for Phone Number -->
                        <button type="button" class="btn btn-outline-primary mt-2" id="sendOtpBtn">Send OTP</button>
                        
                        <!-- OTP Field (Initially hidden) -->
                        <div id="otpFormGroup" class="mb-3" style="display: none;">
                            <label for="otpLogin" class="form-label">OTP</label>
                            <input type="text" class="form-control" id="otpLogin" name="otpLogin" placeholder="Enter OTP">
                            <button type="button" class="btn btn-outline-primary mt-2" id="submitOtpBtn">Submit OTP</button>
                        </div>

                        <button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="toggleLoginForm()">Back to Email Login</button>
                    </form>
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
                                <form method="POST" action="{{route('signup')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="mb-3">
                                        <label for="businessName" class="form-label">Business Name</label>
                                        <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter your business name" required>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="aadhar" class="form-label">Aadhar Upload Front</label>
                                        <input type="file" class="form-control" id="aadhar" name="aadhar" required>
                                    </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="mb-3">
                                        <label for="aadhar" class="form-label">Aadhar Upload back</label>
                                        <input type="file" class="form-control" id="aadhar" name="aadhar" required>
                                    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                           <div class="mb-3">
                                        <label for="pan" class="form-label">Pan Upload</label>
                                        <input type="file" class="form-control" id="pan" name="pan" required>
                                    </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                        <label for="gst" class="form-label">GST Number</label>
                                        <input type="text" class="form-control" id="gst" name="gst" placeholder="Enter your GST Number">
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
                                        <input type="number" class="form-control" id="charge" name="charge" placeholder="Enter registration charge">
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
                                <form>
                                    <div class="mb-3">
                                        <label for="resetEmail" class="form-label">Enter Your Email</label>
                                        <input type="email" class="form-control" id="resetEmail" name="resetEmail" placeholder="Enter your email to reset password" required>
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

    // Handle OTP submission
    document.getElementById('sendOtpBtn').addEventListener('click', function () {
        const phoneNumber = document.getElementById('phoneLogin').value;

        if (phoneNumber) {
            // Assume an OTP is sent and the OTP field is shown
            // alert("OTP sent to " + phoneNumber);
            // Hide phone number input and show OTP input
            document.getElementById('phoneFormGroup').style.display = 'none';
            document.getElementById('otpFormGroup').style.display = 'block';
            document.getElementById('sendOtpBtn').style.display = 'none';
            document.getElementById('submitOtpBtn').style.display = 'block';
        } else {
            alert("Please enter a valid phone number");
        }
    });

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

    // Handle email login form submission
    document.getElementById('loginWithEmail').addEventListener('submit', function (event) {
        event.preventDefault();
        const email = document.getElementById('emailLogin').value;
        const password = document.getElementById('passwordLogin').value;

        if (email && password) {
            // alert("Logged in with email!");
            // Proceed with further logic or redirect
        } else {
            alert("Please fill in both email and password.");
        }
    });
</script>
@endsection

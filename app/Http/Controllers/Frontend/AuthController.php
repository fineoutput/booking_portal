<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Agent;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
    // ============================= START INDEX ============================ 
 

    public function successResponse($message, $status = true, $statusCode = 201)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ], $statusCode);
    }

    // public function signup(Request $request)
    // {
    //     $validationRules = [
    //         'number' => 'required|numeric|unique:agent', 
    //         'name' => 'required', 
    //         'email' => 'required|string|email|max:255|unique:agent,email', 
    //         'password' => 'required|string|min:6',
    //         'business_name' => 'required',
    //         'state_id' => 'required',
    //         'city_id' => 'required',
    //         'aadhar_image' => 'required',
    //         'aadhar_image_back' => 'required',
    //         'pan_image' => 'required',
    //         'GST_number' => 'required',
    //         'logo' => 'required', 
    //         'registration_charge' => 'nullable|numeric',
    //     ];
    
    //     $validator = Validator::make($request->all(), $validationRules);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput(); 
    //     }
    
    //     // Check and store files only if they exist
    //     // $aadharImagePath = $request->hasFile('aadhar_image') ? $request->file('aadhar_image')->store('uploads/aadhar_images', 'public') : null;
    //     // $aadharImageBackPath = $request->hasFile('aadhar_image_back') ? $request->file('aadhar_image_back')->store('uploads/aadhar_images', 'public') : null;
    //     // $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('uploads/logos', 'public') : null;
    //     // $panImagePath = $request->hasFile('pan_image') ? $request->file('pan_image')->store('uploads/pan_images', 'public') : null;

    //     // Define the upload directory within the public folder
    //     $aadharImagePath = null;
    //     $aadharImageBackPath = null;
    //     $logoPath = null;
    //     $panImagePath = null;

    //     // Check if files are uploaded and move them to the public directory
    //     if ($request->hasFile('aadhar_image')) {
    //         $aadharImage = $request->file('aadhar_image');
    //         $aadharImagePath = 'uploads/aadhar_images/' . time() . '_' . $aadharImage->getClientOriginalName();
    //         $aadharImage->move(public_path('uploads/aadhar_images'), $aadharImagePath);
    //     }

    //     if ($request->hasFile('aadhar_image_back')) {
    //         $aadharImageBack = $request->file('aadhar_image_back');
    //         $aadharImageBackPath = 'uploads/aadhar_images/' . time() . '_' . $aadharImageBack->getClientOriginalName();
    //         $aadharImageBack->move(public_path('uploads/aadhar_images'), $aadharImageBackPath);
    //     }

    //     if ($request->hasFile('logo')) {
    //         $logo = $request->file('logo');
    //         $logoPath = 'uploads/logos/' . time() . '_' . $logo->getClientOriginalName();
    //         $logo->move(public_path('uploads/logos'), $logoPath);
    //     }

    //     if ($request->hasFile('pan_image')) {
    //         $panImage = $request->file('pan_image');
    //         $panImagePath = 'uploads/pan_images/' . time() . '_' . $panImage->getClientOriginalName();
    //         $panImage->move(public_path('uploads/pan_images'), $panImagePath);
    //     }

    
    //     // Create the user record in the database
    //     $user = Agent::create([
    //         'number' => $request->number,
    //         'number_verify' => 0,
    //         'email' => $request->email,
    //         'name' => $request->name,
    //         'business_name' => $request->business_name,
    //         'state_id' => $request->state_id,
    //         'city' => $request->city_id,
    //         'registration_charge' => $request->registration_charge,
    //         'GST_number' => $request->GST_number,
    //         'password' => Hash::make($request->password), 
    //         'aadhar_image' => $aadharImagePath,
    //         'aadhar_image_back' => $aadharImageBackPath,
    //         'logo' => $logoPath,
    //         'pan_image' => $panImagePath,
    //         'approved' => 0,
    //     ]);

        
    //     return redirect()->back()
    //         ->with('message', 'Agent Created, Waiting for Admin Approval!');
    // }


    public function signup(Request $request)
{
    $validationRules = [
        'number' => 'required|numeric|unique:agent',
        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:agent,email',
        'password' => 'required|string|min:6',
        'business_name' => 'required',
        'address' => 'required',
        'state_id' => 'required',
        'city_id' => 'required',
        'aadhar_image' => 'required',
        'aadhar_image_back' => 'required',
        'pan_image' => 'required',
        'GST_number' => 'required',
        'logo' => 'required',
        'registration_charge' => 'required|numeric',
    ];

    $validator = Validator::make($request->all(), $validationRules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    /* -------------------------------
        UPLOAD FILES TO PUBLIC FOLDER
    --------------------------------*/
    $aadharImagePath = null;
    $aadharImageBackPath = null;
    $logoPath = null;
    $panImagePath = null;

    if ($request->hasFile('aadhar_image')) {
        $aadhar = $request->file('aadhar_image');
        $aadharImagePath = 'uploads/aadhar_images/' . time() . '_' . $aadhar->getClientOriginalName();
        $aadhar->move(public_path('uploads/aadhar_images'), $aadharImagePath);
    }

    if ($request->hasFile('aadhar_image_back')) {
        $aadharBack = $request->file('aadhar_image_back');
        $aadharImageBackPath = 'uploads/aadhar_images/' . time() . '_' . $aadharBack->getClientOriginalName();
        $aadharBack->move(public_path('uploads/aadhar_images'), $aadharImageBackPath);
    }

    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoPath = 'uploads/logos/' . time() . '_' . $logo->getClientOriginalName();
        $logo->move(public_path('uploads/logos'), $logoPath);
    }

    if ($request->hasFile('pan_image')) {
        $pan = $request->file('pan_image');
        $panImagePath = 'uploads/pan_images/' . time() . '_' . $pan->getClientOriginalName();
        $pan->move(public_path('uploads/pan_images'), $panImagePath);
    }


    /* -------------------------------
        CREATE RAZORPAY ORDER
    --------------------------------*/
    $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
        'receipt' => 'AGENT_' . time(),
        'amount'  => $request->registration_charge * 100, 
        'currency' => 'INR'
    ]);

    /* -------------------------------
        TEMPORARY SAVE USER DATA IN SESSION
    --------------------------------*/
    session([
        'pending_user' => [
            'number' => $request->number,
            'email' => $request->email,
            'name' => $request->name,
            'business_name' => $request->business_name,
            'address' => $request->address,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'registration_charge' => $request->registration_charge,
            'GST_number' => $request->GST_number,
            'password' => Hash::make($request->password),

            'aadhar_image' => $aadharImagePath,
            'aadhar_image_back' => $aadharImageBackPath,
            'logo' => $logoPath,
            'pan_image' => $panImagePath,
        ],
        'razorpay_order_id' => $order->id
    ]);

    /* -------------------------------
        SAVE TRANSACTION AS PENDING
    --------------------------------*/
    Transaction::create([
        'order_id' => $order->id,
        'amount' => $request->registration_charge,
        'status' => 'pending',
    ]);

    /* -------------------------------
        SHOW PAYMENT PAGE
    --------------------------------*/
    return view('front.payment.razorpay', [
        'order_id' => $order->id,
        'amount' => $request->registration_charge,
        'name' => $request->name,
        'email' => $request->email,
        'number' => $request->number
    ]);
}


public function razorpayCallback(Request $request)
{
    Log::info("------ Razorpay Callback Hit ------");
    Log::info("Callback Data: ", $request->all());

    $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {

        Log::info("Step 1: Extract Required Attributes");

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        Log::info("Step 2: Verifying Razorpay Signature...");
        $api->utility->verifyPaymentSignature($attributes);
        Log::info("Signature Verified Successfully!");

        Log::info("Step 3: Fetching Payment from Razorpay API...");
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        Log::info("Payment Fetched: ", $payment->toArray());

        /* ----------------------------
        FIX: DO NOT RE-CAPTURE PAYMENT
        -----------------------------*/
        if (!$payment['captured']) {
            $payment->capture(['amount' => $payment['amount']]);
            Log::info("Payment Captured Now");
        } else {
            Log::info("Payment Already Captured — Skipping...");
        }

        Log::info("Step 4: Get Session User Data");
        $data = session('pending_user');

        if (!$data) {
            Log::error("Session Expired");
            return redirect('/')->with('error', 'Session expired!');
        }

        Log::info("Step 5: Creating Agent...");
        $agent = Agent::create([
            'number' => $data['number'],
            'number_verify' => 0,
            'email' => $data['email'],
            'name' => $data['name'],
            'business_name' => $data['business_name'],
            'state_id' => $data['state_id'],
            'city' => $data['city_id'],
            'registration_charge' => $data['registration_charge'],
            'GST_number' => $data['GST_number'],
            'password' => $data['password'],
            'aadhar_image' => $data['aadhar_image'],
            'aadhar_image_back' => $data['aadhar_image_back'],
            'logo' => $data['logo'],
            'pan_image' => $data['pan_image'],
            'approved' => 0,
        ]);

        Log::info("Agent Created: " . $agent->id);

        Log::info("Step 6: Updating Transaction Status SUCCESS");
        Transaction::where('order_id', session('razorpay_order_id'))
            ->update([
                'payment_id' => $request->razorpay_payment_id,
                'status' => 'success',
                'agent_id' => $agent->id
            ]);

        session()->forget(['pending_user', 'razorpay_order_id']);

        return redirect('/')->with('message', 'Payment Success — Agent Created!');

    } catch (\Exception $e) {

        Log::error("❌ ERROR in Callback: " . $e->getMessage());

        Transaction::where('order_id', session('razorpay_order_id'))
            ->update(['status' => 'failed']);

        return redirect('/')->with('error', 'Payment Failed: ' . $e->getMessage());
    }
}



    

  
  
    public function verify_auth_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:4', 
            'source_name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $messages) {
                $errors[$field] = $messages[0];
                break;
            }
            return response()->json(['errors' => $errors], 400);
        }

        $validated = $validator->validated();
        $otp = $validated['otp'];
        $source_name = $validated['source_name']; 

        $otpUser = UserOtp::where('source_name', $source_name)
                        ->where('otp', $otp)
                        ->first();

        if (!$otpUser) {
            return $this->successResponse('Invalid OTP or details!', false, 400);
        }

        if ($otpUser->expires_at < now()) {
            return $this->successResponse('OTP has expired. Please request a new OTP.', false, 400);
        }

        UserOtp::where('source_name', $source_name)->update(['otp' => 0]);

        $existingUser = Agent::where('number', $source_name)->first();

        if ($existingUser) {
            $token = base64_encode($existingUser->email . ',' . $existingUser->password);
            $existingUser->auth = $token;
            $existingUser->save();

            $responseData = [
                'message' => 'Login successful !',
                'status' => 200,
                'data' => [
                    'id' => $existingUser->id,
                    'name' => $existingUser->name,
                    'email' => $existingUser->email,
                    'number' => $existingUser->number,
                    'business_name' => $existingUser->business_name,
                    'state' => $existingUser->state,
                    'city' => $existingUser->city,
                    'aadhar_image' => asset('storage/' . $existingUser->aadhar_image), 
                    'aadhar_image_back' => asset('storage/' . $existingUser->aadhar_image_back), 
                    'pan_image' => asset('storage/' . $existingUser->pan_image),
                    'GST_number' => $existingUser->GST_number,
                    'logo' => asset('storage/' . $existingUser->logo),
                    'registration_charge' => $existingUser->registration_charge,
                    'auth' => $token, 
                ]
            ];
        
            return response()->json($responseData, 200);

        }

        $unverifyUser = UnverifyUser::where('number', $source_name)->first();

        if (!$unverifyUser) {
            return $this->successResponse('No user found with the provided phone number.', false, 404);
        }

        $unverifyUser->update(['number_verify' => 1]);

        $newUser = Agent::create([
            'number' => $unverifyUser->number,
            'email' => $unverifyUser->email,
            'password' => $unverifyUser->password,
            'name' => $unverifyUser->name,
            'business_name' => $unverifyUser->business_name, 
            'state' => $unverifyUser->state, 
            'city' => $unverifyUser->city, 
            'aadhar_image' => $unverifyUser->aadhar_image, 
            'aadhar_image_back' => $unverifyUser->aadhar_image_back, 
            'pan_image' => $unverifyUser->pan_image, 
            'GST_number' => $unverifyUser->GST_number, 
            'logo' => $unverifyUser->logo, 
            'registration_charge' => $unverifyUser->registration_charge, 
        ]);

        $token = base64_encode($newUser->email . ',' . $unverifyUser->password);

        $newUser->auth = $token;
        $newUser->save();

        $unverifyUser->delete();

        $responseData = [
            'message' => 'User phone verified and moved to users table successfully!',
            'status' => 200,
            'data' => [
                'id' => $newUser->id,
                'name' => $newUser->name,
                'email' => $newUser->email,
                'number' => $newUser->number,
                'business_name' => $newUser->business_name,
                'state' => $newUser->state,
                'city' => $newUser->city,
                'aadhar_image' => asset('storage/' . $newUser->aadhar_image), 
                'aadhar_image_back' => asset('storage/' . $newUser->aadhar_image_back), 
                'pan_image' => asset('storage/' . $newUser->pan_image),
                'GST_number' => $newUser->GST_number,
                'logo' => asset('storage/' . $newUser->logo),
                'registration_charge' => $newUser->registration_charge,
                'auth' => $token, 
            ]
        ];
        
        return response()->json($responseData, 200);
    }



    
public function agentlogin(Request $request)
{
    // Validate the input
    $validator = Validator::make($request->all(), [
        'email' => 'required_without:mobile_number|string|exists:agent,email',
        'password' => 'required_without:mobile_number|string|min:6', 
        'mobile_number' => 'required_without:email|exists:agent,number',
    ]);
    
    // If validation fails, return errors
    if ($validator->fails()) {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $field => $messages) {
            $errors[$field] = $messages[0];
            break; // break to return the first error only
        }
        return response()->json([
            'message' => $errors,
            'status' => 201,
            'data' => [],
        ], 400);
    }

    // Check if login is using email and password or mobile number
    if ($request->has('email') && $request->has('password')) {
        // Email and password login
        $credentials = $request->only('email', 'password');
        
        if (!Auth::guard('agent')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials. Please check your email and password.'], 401);
        }

        $user = Auth::guard('agent')->user();

        // Check if the user is approved
        if ($user->approved != 1) {
            return response()->json([
                'message' => 'Your account is not approved by the admin. Please wait for approval.',
                'status' => 201,
            ], 403);
        }

        $token = base64_encode($user->email . ',' . $user->password);

        // Update the user's auth token and expiration date
        $user->update([
            'auth' => $token,
            'token_expires_at' => Carbon::now()->addDays(7), 
        ]);

        return response()->json([
            'message' => 'Login successful.',
            'data' => $token,
            'status' => 200,
        ], 200);
    } elseif ($request->has('mobile_number')) {
        // Mobile number login
        $user = Agent::where('number', $request->mobile_number)->first();
        
        if (!$user) {
            return response()->json(['message' => 'User not found with this mobile number.'], 404);
        }

        // Check if the user is approved
        if ($user->approved != 1) {
            return response()->json(['message' => 'Your account is not approved by the admin. Please wait for approval.'], 403);
        }

        // Send OTP to the mobile number
        $otp = $this->sendOtp($user->number);

        // You may want to save the OTP and expiration time for validation later
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),  // OTP expiration time (5 minutes, adjust as needed)
        ]);

        return response()->json([
            'message' => 'OTP sent successfully!',
            'status' => 200,
            'data' => [],
        ], 200);
    }

    return response()->json([
        'message' => 'Invalid request.',
        'status' => 201,
        'data' => [],
    ], 400);
}


public function agentLoginWithMobile(Request $request)
{
    $validator = Validator::make($request->all(), [
        'mobile_number' => 'required|string|exists:agent,number|digits:10',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400); 
    }

    $user = Agent::where('number', $request->mobile_number)->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found with this mobile number.'], 404);
    }

    if ($user->approved != 1) {
        return response()->json(['error' => 'Your account is not approved by the admin. Please wait for approval.'], 403);
    }

    // Send OTP and update user record
    $otp = $this->sendOtp($user->number);
    $user->update([
        'otp' => $otp,
        'otp_expires_at' => Carbon::now()->addMinutes(5),
    ]);

    return response()->json(['success' => 'OTP sent successfully!']);
}


private function sendOtp($phone)
{
    $otp = rand(1000, 9999);

    $authKey = "1401583980000074503"; 
    $senderId = "TRPDKH";
    $route = 4;
    $dltTemplateId = "693952d21a9eac422c6a57bf";

    // Format Mobile
    $formattedPhone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($formattedPhone) === 10) {
        $formattedPhone = '91' . $formattedPhone;
    }

    // Msg text
    $templateContent = "Login Message- Your OTP for logging in to the Trip Dekho account is ##var## and is valid for the next 5 min. Do not share your OTP with anyone. - Tripdekho
    www.tripsdekho.com";

    $message = str_replace('##var##', $otp, $templateContent);

    // Query Parameters
    $queryParams = [
        'authkey'    => $authKey,
        'mobiles'    => $formattedPhone,
        'message'    => urlencode($message),
        'sender'     => $senderId,
        'route'      => $route,
        'DLT_TE_ID'  => $dltTemplateId,
    ];

    try {
        // Send using MSG91 HTTP API
        $response = Http::get("http://api.msg91.com/api/sendhttp.php", $queryParams);
        $body = trim($response->body());

        Log::info("MSG91 Login OTP Response:", [
            'phone' => $formattedPhone,
            'otp'   => $otp,
            'raw'   => $body
        ]);

        // SUCCESS = 24 Digital Hex Message ID
        if (preg_match('/^[A-Za-z0-9]{20,}$/', $body)) {
            return $otp; // OTP return — important
        } else {
            Log::error("OTP Send Failed: " . $body);
        }

    } catch (\Exception $e) {
        Log::error("MSG91 Error: " . $e->getMessage());
    }

    return $otp; // fallback
}



 public function agentLoginWithEmail(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (!Auth::guard('agent')->attempt($credentials)) {
        return redirect()->back()->with('error', 'Invalid credentials. Please check your email and password.');
    }

    $user = Auth::guard('agent')->user();

    Auth::login($user);

    if ($user->approved != 1) {
        Auth::guard('agent')->logout();
        return redirect()->back()->with('error', 'Your account is not approved by the admin.');
    }

    // If URL saved before login, use that
    $redirectUrl = session()->pull('redirect_after_login');

if ($redirectUrl) {
    return redirect()->to($redirectUrl)->with('message', 'Login successful.');
}

return redirect()->route('index')->with('message', 'Login successful.');
}



// public function agentLoginWithEmail(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'email' => 'required',
//         'password' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

//     $credentials = $request->only('email', 'password');
    
//     if (!Auth::guard('agent')->attempt($credentials)) {
//         return redirect()->back()->with('error', 'Invalid credentials. Please check your email and password.');
//     }

//     $user = Auth::guard('agent')->user();
//     Auth::login($user);

//     if ($user->approved != 1) {
//         return redirect()->back()->with('error', 'Your account is not approved by the admin. Please wait for approval.');
//     }

//     // No need for this line as 'attempt' already handles the login
//     // Auth::guard('agent')->login($user);

//     return redirect()->route('index')->with('message', 'Login successful.');
// }



public function verifyOtp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'otp' => 'required|digits:4',
        'mobile_number' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Invalid OTP or phone number format.']);
    }

    $userOtp = UserOtp::where('source_name', $request->mobile_number)
                      ->where('otp', $request->otp)
                      ->first();

    if (!$userOtp) {
        return response()->json(['error' => 'Invalid OTP. Please try again.']);
    }

    if (Carbon::now()->greaterThan($userOtp->expires_at)) {
        return response()->json(['error' => 'OTP has expired. Please request a new one.']);
    }

    $user = Agent::where('number', $request->mobile_number)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found.']);
    }

    if ($user->approved != 1) {
        return response()->json(['error' => 'Your account is not approved by the admin.']);
    }

    // Log in the user using the same guard as email login
    Auth::guard('agent')->login($user);

    // Optional: Clear OTP so it can't be reused
    $userOtp->delete();

    // Return redirect URL instead of just success message
    return response()->json([
        'success' => true,
        'message' => 'OTP verified successfully! You are now logged in.',
        'redirect' => route('index'), // or agent dashboard
    ]);
}






    // public function agentlogin(Request $request)
    // {
    //     // Validate the input
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|exists:agent,email', 
    //         'password' => 'required|string|min:6', 
    //     ]);
        
    //     // If validation fails, return errors
    //     if ($validator->fails()) {
    //         $errors = [];
    //         foreach ($validator->errors()->getMessages() as $field => $messages) {
    //             $errors[$field] = $messages[0];
    //             break; // break to return the first error only
    //         }
    //         return response()->json(['errors' => $errors], 400);
    //     }
    
    //     // Get the credentials from the request (email and password)
    //     $credentials = $request->only('email', 'password');
        
    //     // Attempt to authenticate the user using the provided credentials
    //     if (!Auth::guard('agent')->attempt($credentials)) { 
    //         return response()->json(['message' => 'Invalid credentials. Please check your email and password.'], 401);
    //     }
    
    //     $user = Auth::guard('agent')->user(); 
    
    //     $userPhoneNumber = $user->number;
    
    //     $otp = $this->sendOtp($userPhoneNumber);
    
    //     return response()->json([
    //         'message' => 'Login successful. OTP sent successfully!',
    //         'status' => 200,    
    //     ], 200);
    // }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Successfully logged out');
    }
    

    
}

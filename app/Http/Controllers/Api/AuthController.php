<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use App\Mail\OtpMail;
use App\Models\TempUser;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use Razorpay\Api\Api;





class AuthController extends Controller
{

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
    //         'number' => 'required|string|unique:agent,number|regex:/^\d{10}$/',

    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:agent,email', 
    //         'password' => 'required|string|min:6',
    //         'business_name' => 'required',
    //         'state' => 'required',
    //         'city' => 'required',
    //         'aadhar_image' => 'required',
    //         'aadhar_image_back' => 'required',
    //         'pan_image' => 'required',
    //         'GST_number' => 'required',
    //         'logo' => 'required',
    //         'registration_charge' => 'nullable',
    //     ];
    
    //     // Validate the request input
    //     $validator = Validator::make($request->all(), $validationRules);
    //     if ($validator->fails()) {
    //         $errors = [];
    //         foreach ($validator->errors()->getMessages() as $field => $messages) {
    //             $errors[$field] = $messages[0]; 
    //         }
    //         return response()->json([
    //             'message' => $errors,
    //             'status' => 201,
    //             'data' => [],
    //         ], 400);
    //     }
    
    //     // Step 1: Store user data in UnverifyUser (initially with number_verify = 0)
    //     if ($request->number) {
    //         // $aadharImagePath = $request->file('aadhar_image')->store('uploads/aadhar_images', 'public');
    //         // $aadharImageBackPath = $request->file('aadhar_image_back')->store('uploads/aadhar_images', 'public');
    //         // $logoPath = $request->file('logo')->store('uploads/logos', 'public');
    //         // $panImagePath = $request->file('pan_image')->store('uploads/pan_images', 'public');

                        
    //             $aadharImage = $request->file('aadhar_image');
    //             $aadharImageBack = $request->file('aadhar_image_back');
    //             $logo = $request->file('logo');
    //             $panImage = $request->file('pan_image');

    //             // Define paths for storing the files in the public directory
    //             $aadharImagePath = 'uploads/aadhar_images/' . $aadharImage->getClientOriginalName();
    //             $aadharImageBackPath = 'uploads/aadhar_images/' . $aadharImageBack->getClientOriginalName();
    //             $logoPath = 'uploads/logos/' . $logo->getClientOriginalName();
    //             $panImagePath = 'uploads/pan_images/' . $panImage->getClientOriginalName();

    //             // Move the files to the public directory
    //             $aadharImage->move(public_path('uploads/aadhar_images'), $aadharImage->getClientOriginalName());
    //             $aadharImageBack->move(public_path('uploads/aadhar_images'), $aadharImageBack->getClientOriginalName());
    //             $logo->move(public_path('uploads/logos'), $logo->getClientOriginalName());
    //             $panImage->move(public_path('uploads/pan_images'), $panImage->getClientOriginalName());

    //         $user = Agent::create([
    //             'number' => $request->number,
    //             'number_verify' => 0, 
    //             'email' => $request->email, 
    //             'name' => $request->name,
    //             'business_name' => $request->business_name,
    //             'state_id' => $request->state,
    //             'city' => $request->city,
    //             'registration_charge' => $request->registration_charge,
    //             'GST_number' => $request->GST_number,
    //             'password' =>  Hash::make($request->password),
    //             'aadhar_image' => $aadharImagePath,
    //             'aadhar_image_back' => $aadharImageBackPath, 
    //             'logo' => $logoPath,
    //             'pan_image' => $panImagePath,
    //             'approved' => 0,
    //         ]);

    //         // $otp = $this->sendOtp($request->number);
    //         return response()->json([
    //             'message' => 'Agent Created, Waiting for Admin Approval!',
    //             'data' => [],
    //             'status' => 200,
    //         ]);
    //     }
    
    //     if ($request->otp && $request->number) {
    //         $user = UnverifyUser::where('number', $request->number)->first();
            
    //         if (!$user) {
    //             return response()->json([
    //                 'message' => 'User not found.',
    //                 'data' => [],
    //                 'status' => 201,
    //             ], 404);
    //         }
    
    //         $existingOtp = UserOtp::where('source_name', $request->number)
    //             ->where('otp', $request->otp)
    //             ->where('expires_at', '>=', now()) 
    //             ->first();
    
    //         if (!$existingOtp) {
    //             return response()->json([
    //                 'message' => 'Invalid OTP or OTP has expired.',
    //                 'data' => [],
    //                 'status' => 201,
    //             ], 400);
    //         }

    //         $user->number_verify = 1;
    //         $user->save();

    //         $newUser = Agent::create([
    //             'number' => $user->number,
    //             'email' => $user->email,
    //             'password' => $user->password,
    //             'name' => $user->name,
    //             'profile_image' => $user->profile_image, 
    //             'state_id' => $user->state, 
    //             'city' => $user->city, 
    //             'age' => $user->age, 
    //             'gender' => $user->gender, 
    //             'looking_for' => $user->looking_for, 
    //             'interest' => $user->interest, 
    //         ]);

    //         UnverifyUser::where('number', $request->number)->delete();

    //         $token = $newUser->createToken('token')->plainTextToken;
    
    //         return response()->json([
    //             'message' => 'User verified and moved to Agent table successfully!', 'token' => $token], 200);
    //     }
    
    //     return response()->json([
    //         'message' => 'OTP not provided or invalid.',
    //         'status' => 201,
    //         'data' => [],
    //     ], 400);
    // }

    public function signup(Request $request)
{
    $validationRules = [
        'number' => 'required|string|unique:agent,number|regex:/^\d{10}$/',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:agent,email', 
        'password' => 'required|string|min:6',
        'business_name' => 'required',
        'state' => 'required',
        'city' => 'required',
        'aadhar_image' => 'required',
        'aadhar_image_back' => 'required',
        'pan_image' => 'required',
        'GST_number' => 'required',
        'logo' => 'required',
        'registration_charge' => 'required|numeric',
    ];

    $validator = Validator::make($request->all(), $validationRules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()
        ]);
    }

    /* -------------------------
        1. Upload Files
    ------------------------- */
    $aadhar = $request->file('aadhar_image');
    $aadhar_back = $request->file('aadhar_image_back');
    $logo = $request->file('logo');
    $pan = $request->file('pan_image');

    $aadhar_path = 'uploads/aadhar/' . time() . '_' . $aadhar->getClientOriginalName();
    $aadhar_back_path = 'uploads/aadhar/' . time() . '_' . $aadhar_back->getClientOriginalName();
    $logo_path = 'uploads/logo/' . time() . '_' . $logo->getClientOriginalName();
    $pan_path = 'uploads/pan/' . time() . '_' . $pan->getClientOriginalName();

    $aadhar->move(public_path('uploads/aadhar'), basename($aadhar_path));
    $aadhar_back->move(public_path('uploads/aadhar'), basename($aadhar_back_path));
    $logo->move(public_path('uploads/logo'), basename($logo_path));
    $pan->move(public_path('uploads/pan'), basename($pan_path));

    /* -------------------------
        2. Create Razorpay Order
    ------------------------- */
    $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
        'receipt' => 'AGENT_API_' . time(),
        'amount' => $request->registration_charge * 100,
        'currency' => 'INR'
    ]);

    /* -------------------------
        3. Save PENDING Transaction
    ------------------------- */
    Transaction::create([
        'order_id' => $order->id,
        'amount' => $request->registration_charge,
        'status' => 'pending'
    ]);

    /* -------------------------
        4. Save Temp User
    ------------------------- */
    $tempUser = TempUser::create([
        'number' => $request->number,
        'email' => $request->email,
        'name' => $request->name,
        'password' => Hash::make($request->password),
        'business_name' => $request->business_name,
        'state' => $request->state,
        'city' => $request->city,
        'registration_charge' => $request->registration_charge,
        'GST_number' => $request->GST_number,
        'aadhar_image' => $aadhar_path,
        'aadhar_image_back' => $aadhar_back_path,
        'logo' => $logo_path,
        'pan_image' => $pan_path,
        'razorpay_order_id' => $order->id
    ]);

    /* -------------------------
        5. Return Razorpay Data to Mobile APP
    ------------------------- */
    return response()->json([
        'status' => true,
        'message' => "Order Created",
        'order_id' => $order->id,
        'razorpay_key' => env('RAZORPAY_KEY'),
        'amount' => $request->registration_charge * 100,
        'currency' => "INR"
    ]);
}



public function razorpayCallbackApi(Request $request)
{
    Log::info("📥 API Callback Received", $request->all());

    $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        Log::info("✔ Verifying signature");
        $api->utility->verifyPaymentSignature($attributes);

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        Log::info("Payment Data:", $payment->toArray());

        /* FIX → Don't capture twice */
        if (!$payment['captured']) {
            $payment->capture(['amount' => $payment['amount']]);
            Log::info("✔ Payment Captured Now");
        } else {
            Log::info("✔ Payment Already Captured — Skipping");
        }

        /* Fetch temp user */
        $temp = TempUser::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$temp) {
            return response()->json([
                'status' => false,
                'message' => "Temporary user not found"
            ]);
        }

        /* Create Agent */
        $agent = Agent::create([
            'number' => $temp->number,
            'email' => $temp->email,
            'name' => $temp->name,
            'password' => $temp->password,
            'business_name' => $temp->business_name,
            'state_id' => $temp->state,
            'city' => $temp->city,
            'registration_charge' => $temp->registration_charge,
            'GST_number' => $temp->GST_number,
            'aadhar_image' => $temp->aadhar_image,
            'aadhar_image_back' => $temp->aadhar_image_back,
            'logo' => $temp->logo,
            'pan_image' => $temp->pan_image,
            'approved' => 0,
        ]);

        /* Update Transaction */
        Transaction::where('order_id', $request->razorpay_order_id)
            ->update([
                'payment_id' => $request->razorpay_payment_id,
                'status' => 'success',
                'agent_id' => $agent->id
            ]);

        /* cleanup */
        $temp->delete();

        return response()->json([
            'status' => true,
            'message' => "Payment Successful, Agent Created",
            'agent_id' => $agent->id
        ]);

    } catch (\Exception $e) {

        Log::error("❌ API Payment Error", [$e->getMessage()]);

        Transaction::where('order_id', $request->razorpay_order_id)
            ->update(['status' => 'failed']);

        return response()->json([
            'status' => false,
            'message' => "Payment Failed",
            'error' => $e->getMessage()
        ]);
    }
}

    

    private function sendOtp($phone = null, $email = null)
    {
        // $otp = rand(1000, 9999); 
        $otp = 123456; 
        $sourceName = $phone ?? $email; 
        $existingOtp = UserOtp::where('source_name', $sourceName);
        if ($existingOtp) {
            $existingOtp->update(['otp' => 0]);
        }
        $data = [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10), // Set expiry time for OTP (e.g., 10 minutes)
            'source_name' => $sourceName,
            'type' => $phone ? 'phone' : 'email',
        ];
        UserOtp::create($data);
        if ($phone) {
            // $this->sendOtpToPhone($phone, $otp);
        } elseif ($email) {
            // $this->sendOtpToEmail($email, $otp);
        }
    }
    
    private function sendOtpToEmail($email, $otp)
    {
    // \Mail::to($email)->send(new OtpMail($otp)); 
    }   

    // public function verify_auth_otp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'otp' => 'required|numeric|digits:4', 
    //         'source_name' => 'required|string',
    //     ]);
    
    //     if ($validator->fails()) {
    //         $errors = [];
    //         foreach ($validator->errors()->getMessages() as $field => $messages) {
    //             $errors[$field] = $messages[0];
    //             break;
    //         }
    //         return response()->json(['errors' => $errors], 400);
    //     }
    
    //     $validated = $validator->validated();
    //     $otp = $validated['otp'];
    //     $source_name = $validated['source_name']; 
    
    //     $otpUser = UserOtp::where('source_name', $source_name)
    //                       ->where('otp', $otp)
    //                       ->first();
    
    //     if (!$otpUser) {
    //         return $this->successResponse('Invalid OTP or details!', false, 400);
    //     }
    
    //     if ($otpUser->expires_at < now()) {
    //         return $this->successResponse('OTP has expired. Please request a new OTP.', false, 400);
    //     }
    
    //     UserOtp::where('source_name', $source_name)
    //            ->update(['otp' => 0]);
    
    //     $unverifyUser = UnverifyUser::where('number', $source_name)->first();

    //     if (!$unverifyUser) {
    //         return $this->successResponse('No user found with the provided phone number.', false, 404);
    //     }
    //     $unverifyUser->update(['number_verify' => 1]);

    //     $newUser = Agent::create([
    //         'number' => $unverifyUser->number,
    //         'email' => $unverifyUser->email,
    //         'password' => $unverifyUser->password,
    //         'name' => $unverifyUser->name,
    //         'business_name' => $unverifyUser->business_name, 
    //         'state' => $unverifyUser->state, 
    //         'city' => $unverifyUser->city, 
    //         'aadhar_image' => $unverifyUser->aadhar_image, 
    //         'aadhar_image_back' => $unverifyUser->aadhar_image_back, 
    //         'pan_image' => $unverifyUser->pan_image, 
    //         'GST_number' => $unverifyUser->GST_number, 
    //         'logo' => $unverifyUser->logo, 
    //         'registration_charge' => $unverifyUser->registration_charge, 
    //     ]);

    //     $token = base64_encode($newUser->email . ',' . $unverifyUser->password);
        
    //     // Save the token to the user record
    //     $newUser->auth = $token;
    //     $newUser->save();
        
    //     // Delete the unverified user
    //     $unverifyUser->delete();
        
    //     // Prepare the response data
    //     $responseData = [
    //         'message' => 'User phone verified and moved to users table successfully!',
    //         'status' => 200,
    //         'user' => [
    //             'id' => $newUser->id,
    //             'name' => $newUser->name,
    //             'email' => $newUser->email,
    //             'number' => $newUser->number,
    //             'business_name' => $newUser->business_name,
    //             'state' => $newUser->state,
    //             'city' => $newUser->city,
    //             'aadhar_image' => $newUser->aadhar_image, 
    //             'aadhar_image_back' => $newUser->aadhar_image_back, 
    //             'pan_image' => $newUser->pan_image,
    //             'GST_number' => $newUser->GST_number,
    //             'logo' => $newUser->logo,
    //             'registration_charge' => $newUser->registration_charge,
    //             'auth' => $token,  // Include the token
    //         ]
    //     ];
    //     return response()->json($responseData, 200);
    // }


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
            return response()->json([
                'message' => 'Invalid OTP or details!',
                'status' => 200,
                'data' => [],
            ], 400);
            
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
                    'state' => $existingUser->state_id,
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
            'state_id' => $unverifyUser->state, 
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

    // public function login(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|exists:agent,email', 
    //         'password' => 'required|string|min:6', 
    //     ]);
        
    //     if ($validator->fails()) {
    //         $errors = [];
    //         foreach ($validator->errors()->getMessages() as $field => $messages) {
    //             $errors[$field] = $messages[0];
    //             break; 
    //         }
    //         return response()->json(['errors' => $errors], 400);
    //     }

    //     $credentials = $request->only('email', 'password');
        
    //     if (!Auth::guard('agent')->attempt($credentials)) { 
    //         return response()->json(['message' => 'Invalid credentials. Please check your email and password.'], 401);
    //     }

    //     $user = Auth::guard('agent')->user(); 
    //     $email = $user->email;
    //     $password = $request->password; 
    //     $base64Token = base64_encode($email . ',' . $password);

    //     $user->auth = $base64Token; 
    //     $user->save();
  
    //     return response()->json([
    //         'message' => 'Login successful.',
    //         'token' => $base64Token,
    //     ], 200);
    // }

//     public function login(Request $request)
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


public function login(Request $request)
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
            return response()->json([
                'message' => 'Invalid credentials. Please check your email and password.',
                'data' => [],
                'status' => 201,
            ], 401);
        }

        $user = Auth::guard('agent')->user();

        // Check if the user is approved
        if ($user->approved != 1) {
            return response()->json([
                'message' => 'Your account is not approved by the admin. Please wait for approval.',
                'data' => [],
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
            return response()->json([
                'message' => 'User not found with this mobile number.',
                'data' => [],
                'status' => 201,
            ], 404);
        }

        // Check if the user is approved
        if ($user->approved != 1) {
            return response()->json([
                'message' => 'Your account is not approved by the admin. Please wait for approval.',
                'data' => [],
                'status' => 201,
            ], 403);
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


public function logout(Request $request)
{
    // Check for Authorization header
    if (!$request->header('Authorization')) {
        return response()->json([
            'message' => 'No authentication token provided',
            'status' => 401
        ], 200);
    }

    // Extract the token
    $auth_token = str_replace('Bearer ', '', $request->header('Authorization'));

    // Find user by token
    $user = Agent::where('auth', $auth_token)->first();

    if (!$user) {
        return response()->json([
            'message' => 'No authenticated user found',
            'status' => 201
        ], 401);
    }

    // Clear the auth token
    $user->update([
        'auth' => null,
        'token_expires_at' => null,
    ]);

    return response()->json([
        'message' => 'Successfully logged out',
        'status' => 200
    ], 200);
}



public function add_wallet_api(Request $request)
{
    Log::info("------ Add Wallet API Hit ------");
    Log::info("Request Data: ", $request->all());

     $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'data' => [],
                'status' => 401,
            ]);
        }

        $decodedToken = base64_decode($token); 
        list($email, $password) = explode(',', $decodedToken);
    
        $user = Agent::where('email', $email)->first();
    
        if (!$user || $password != $user->password) {
            return response()->json([
                'message' => 'Invalid credentials.',
                'data' => [],
                'status' => 401,
            ]);
        }

    $validator = Validator::make($request->all(), [
        'transaction_type' => 'required|string|in:credit,debit',
        'amount' => 'required|numeric|min:1',
        'note' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        Log::error("Validation Failed: ", $validator->errors()->toArray());
        return response()->json([
            'status' => 400,
            'message' => $validator->errors()->first(),
            'data' => [],
        ], 400);
    }

    try {
        $userId = $user->id; 
        $userdata = $user; 
        Log::info("Authenticated User ID: {$userId}");

        // Create Wallet Transaction
        $transaction = new WalletTransactions();
        $transaction->user_id = $userId;
        $transaction->transaction_type = $request->transaction_type;
        $transaction->amount = $request->amount;
        $transaction->note = $request->note ?? '';
        $transaction->status = 0; // pending
        $transaction->save();

        Log::info("Wallet Transaction Created: ", $transaction->toArray());

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $userId],
            ['balance' => 0]
        );
        Log::info("Current Wallet Balance: {$wallet->balance}");

        if ($request->transaction_type === 'credit') {
            // Razorpay order creation
            Log::info("Creating Razorpay Order for credit transaction...");
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $orderData = [
                'receipt' => 'wallet_txn_' . $transaction->id,
                'amount' => $request->amount * 100,
                'currency' => 'INR',
            ];
            $razorpayOrder = $api->order->create($orderData);
            Log::info("Razorpay Order Created: ", $razorpayOrder->toArray());

            $transaction->razorpay_order_id = $razorpayOrder->id;
            $transaction->save();

            return response()->json([
                'status' => 200,
                'message' => 'Credit transaction created. Complete payment.',
                'data' => [
                    'wallet_transaction' => $transaction,
                    'razorpay_order' => $razorpayOrder,
                    'userdata' => [
                       'name' => $userdata->name,
                       'email' => $userdata->email,
                       'number' => $userdata->number,
                    ],
                ],
            ], 200);

        } else {
            // Debit transaction
            if ($wallet->balance < $request->amount) {
                Log::error("Insufficient balance for debit! Wallet balance: {$wallet->balance}, requested: {$request->amount}");
                return response()->json([
                    'status' => 400,
                    'message' => 'Insufficient wallet balance for debit!',
                    'data' => [],
                ], 400);
            }

            // $wallet->balance -= $request->amount;
            $wallet->save();

            $transaction->status = 0;
            $transaction->save();

            Log::info("Debit transaction completed. Updated Wallet Balance: {$wallet->balance}");

            return response()->json([
                'status' => 200,
                'message' => 'Debit transaction completed successfully.',
                'data' => [
                    'wallet_transaction' => $transaction,
                    'wallet' => $wallet,
                ],
            ], 200);
        }

    } catch (\Exception $e) {
        Log::error("Exception in Add Wallet API: " . $e->getMessage());
        Log::error("Trace: ", $e->getTrace());
        return response()->json([
            'status' => 500,
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'data' => [],
        ], 500);
    }
}



public function walletRazorpayCallback(Request $request)
{
    Log::info("------ Wallet Razorpay Callback Hit ------");
    Log::info("Callback Request Data: ", $request->all());

    $request->validate([
        'razorpay_payment_id' => 'required',
        'razorpay_order_id' => 'required',
        'razorpay_signature' => 'required',
    ]);

    $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {
        Log::info("Verifying Razorpay Signature...");
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ];
        $api->utility->verifyPaymentSignature($attributes);
        Log::info("Signature verified successfully.");

        $transaction = WalletTransactions::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();
        Log::info("Wallet Transaction Found: ", $transaction->toArray());

        $payment = $api->payment->fetch($request->razorpay_payment_id);
        Log::info("Razorpay Payment Fetched: ", $payment->toArray());

        if ($payment->status !== 'captured') {
            Log::info("Capturing payment...");
            $payment->capture(['amount' => $payment['amount']]);
        }

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $transaction->user_id],
            ['balance' => 0]
        );

        $wallet->balance += $transaction->amount; 
        $wallet->save();

        $transaction->status = 1;
        $transaction->payment_id = $request->razorpay_payment_id;
        $transaction->save();

        Log::info("Wallet credited successfully. New balance: {$wallet->balance}");
        Log::info("Transaction updated: ", $transaction->toArray());

        return response()->json([
            'status' => 200,
            'message' => 'Payment successful and wallet credited!',
            'data' => [
                'wallet' => $wallet,
                'transaction' => $transaction,
            ],
        ], 200);

    } catch (\Exception $e) {
        Log::error("Payment verification failed: " . $e->getMessage());
        Log::error("Trace: ", $e->getTrace());

        return response()->json([
            'status' => 400,
            'message' => 'Payment verification failed: ' . $e->getMessage(),
            'data' => [],
        ], 400);
    }
}


}

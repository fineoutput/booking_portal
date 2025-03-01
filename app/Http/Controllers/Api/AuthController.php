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

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function successResponse($message, $status = true, $statusCode = 201)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ], $statusCode);
    }

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
            'registration_charge' => 'nullable',
        ];
    
        // Validate the request input
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $messages) {
                $errors[$field] = $messages[0]; 
            }
            return response()->json([
                'message' => $errors,
                'status' => 201,
                'data' => [],
            ], 400);
        }
    
        // Step 1: Store user data in UnverifyUser (initially with number_verify = 0)
        if ($request->number) {
            $aadharImagePath = $request->file('aadhar_image')->store('uploads/aadhar_images', 'public');
            $aadharImageBackPath = $request->file('aadhar_image_back')->store('uploads/aadhar_images', 'public');
            $logoPath = $request->file('logo')->store('uploads/logos', 'public');
            $panImagePath = $request->file('pan_image')->store('uploads/pan_images', 'public');

            $user = Agent::create([
                'number' => $request->number,
                'number_verify' => 0, 
                'email' => $request->email, 
                'name' => $request->name,
                'business_name' => $request->business_name,
                'state_id' => $request->state,
                'city' => $request->city,
                'registration_charge' => $request->registration_charge,
                'GST_number' => $request->GST_number,
                'password' =>  Hash::make($request->password),
                'aadhar_image' => $aadharImagePath,
                'aadhar_image_back' => $aadharImageBackPath, 
                'logo' => $logoPath,
                'pan_image' => $panImagePath,
                'approved' => 0,
            ]);

            // $otp = $this->sendOtp($request->number);
            return response()->json([
                'message' => 'Agent Created, Waiting for Admin Approval!',
                'data' => [],
                'status' => 200,
            ]);
        }
    
        if ($request->otp && $request->number) {
            $user = UnverifyUser::where('number', $request->number)->first();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not found.',
                    'data' => [],
                    'status' => 201,
                ], 404);
            }
    
            $existingOtp = UserOtp::where('source_name', $request->number)
                ->where('otp', $request->otp)
                ->where('expires_at', '>=', now()) 
                ->first();
    
            if (!$existingOtp) {
                return response()->json([
                    'message' => 'Invalid OTP or OTP has expired.',
                    'data' => [],
                    'status' => 201,
                ], 400);
            }

            $user->number_verify = 1;
            $user->save();

            $newUser = Agent::create([
                'number' => $user->number,
                'email' => $user->email,
                'password' => $user->password,
                'name' => $user->name,
                'profile_image' => $user->profile_image, 
                'state_id' => $user->state, 
                'city' => $user->city, 
                'age' => $user->age, 
                'gender' => $user->gender, 
                'looking_for' => $user->looking_for, 
                'interest' => $user->interest, 
            ]);

            UnverifyUser::where('number', $request->number)->delete();

            $token = $newUser->createToken('token')->plainTextToken;
    
            return response()->json([
                'message' => 'User verified and moved to Agent table successfully!', 'token' => $token], 200);
        }
    
        return response()->json([
            'message' => 'OTP not provided or invalid.',
            'status' => 201,
            'data' => [],
        ], 400);
    }
    

    private function sendOtp($phone = null, $email = null)
    {
        $otp = rand(1000, 9999); 
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
    // Check if user is authenticated
    if (!$request->user()) {
        return response()->json([
            'message' => 'No authenticated user found'
        ], 401); // Unauthorized
    }

    // Delete all tokens for the authenticated user
    $request->user()->tokens()->delete();

    return response()->json([
        'message' => 'Successfully logged out'
    ], 200);
}
}

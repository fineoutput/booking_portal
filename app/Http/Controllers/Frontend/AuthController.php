<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;


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

    public function signup(Request $request)
    {
        // Define the validation rules
        $validationRules = [
            'number' => 'required|string|unique:agent,number|regex:/^\d{10}$/', 
            'name' => 'required', 
            'email' => 'required|string|email|max:255|unique:agent,email', 
            'password' => 'required|string|min:6',
            'business_name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'aadhar_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Added mime & size validation
            'aadhar_image_back' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pan_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'GST_number' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Added mime & size validation
            'registration_charge' => 'nullable|numeric',
        ];
    
        // Run the validator
        $validator = Validator::make($request->all(), $validationRules);
        
        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); 
        }
    
        // Check and store files only if they exist
        $aadharImagePath = $request->hasFile('aadhar_image') ? $request->file('aadhar_image')->store('uploads/aadhar_images', 'public') : null;
        $aadharImageBackPath = $request->hasFile('aadhar_image_back') ? $request->file('aadhar_image_back')->store('uploads/aadhar_images', 'public') : null;
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('uploads/logos', 'public') : null;
        $panImagePath = $request->hasFile('pan_image') ? $request->file('pan_image')->store('uploads/pan_images', 'public') : null;
    
        // Create the user record in the database
        $user = Agent::create([
            'number' => $request->number,
            'number_verify' => 0,
            'email' => $request->email,
            'name' => $request->name,
            'business_name' => $request->business_name,
            'state' => $request->state,
            'city' => $request->city,
            'registration_charge' => $request->registration_charge,
            'GST_number' => $request->GST_number,
            'password' => Hash::make($request->password), 
            'aadhar_image' => $aadharImagePath,
            'aadhar_image_back' => $aadharImageBackPath,
            'logo' => $logoPath,
            'pan_image' => $panImagePath,
            'approved' => 0,
        ]);

        
        return redirect()->back()
            ->with('message', 'Agent Created, Waiting for Admin Approval!');
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


    public function verify_auth_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:4', 
            'source_name' => 'required|string',
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
                'user' => [
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
            'user' => [
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
            'email' => 'required|string|exists:agent,email', 
            'password' => 'required|string|min:6', 
        ]);
        
        // If validation fails, return errors
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $messages) {
                $errors[$field] = $messages[0];
                break; // break to return the first error only
            }
            return response()->json(['errors' => $errors], 400);
        }
    
        // Get the credentials from the request (email and password)
        $credentials = $request->only('email', 'password');
        
        // Attempt to authenticate the user using the provided credentials
        if (!Auth::guard('agent')->attempt($credentials)) { 
            return response()->json(['message' => 'Invalid credentials. Please check your email and password.'], 401);
        }
    
        $user = Auth::guard('agent')->user(); 
    
        $userPhoneNumber = $user->number;
    
        $otp = $this->sendOtp($userPhoneNumber);
    
        return response()->json([
            'message' => 'Login successful. OTP sent successfully!',
            'status' => 200,    
        ], 200);
    }


    
}

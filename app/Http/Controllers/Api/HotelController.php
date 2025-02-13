<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Hotels;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Mail\OtpMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class HotelController extends Controller
{

   
    // public function hotel(Request $request)
    // {
    //     $token = $request->bearerToken();
        
    //     if (!$token) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }   

    //     $decodedToken = base64_decode($token);

    //     list($email, $password) = explode(',', $decodedToken);

    //     $user = Agent::where('email', $email)->first();

    //     if ($user && $password == $user->password) {
            
    //         $hotels = Hotels::all();
    
    //         return response()->json([
    //             'message' => 'Hotels fetched successfully.',
    //             'data' => $hotels,
    //             'status' => 200
    //         ], 200);
    //     }
    
    //     // If authentication fails
    //     return response()->json(['message' => 'Unauthenticated'], 401);
    // }

    
    public function hotel(Request $request)
{
    $token = $request->bearerToken();
    
    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {
        
        $hotels = Hotels::all();

        $hotelsData = $hotels->map(function($hotel) {
            $baseUrl = url('');

            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'state_id' => $hotel->state_id,
                'city_id' => $hotel->city_id,
                'images' => $this->generateImageUrls($hotel->images, $baseUrl),
                'location' => $hotel->location,
                'hotel_category' => $hotel->hotel_category,
                'package_id' => $hotel->package_id,
            ];
        });

        return response()->json([
            'message' => 'Hotels fetched successfully.',
            'data' => $hotelsData,
            'status' => 200
        ], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
}


private function generateImageUrls($images, $baseUrl)
{
    $imagePaths = json_decode($images);

    return array_map(function($image) use ($baseUrl) {
        return url($baseUrl . '/' . $image); 
    }, $imagePaths);
}




        
}

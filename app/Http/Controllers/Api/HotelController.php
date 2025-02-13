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

    // Decode the token
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Verify user authentication
    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {
        
        // Fetch all hotels
        $hotels = Hotels::all();

        // Format the hotel data into an array
        $hotelsData = $hotels->map(function($hotel) {
            // Base URL for images (based on public path)
            $baseUrl = url(''); // Directly using URL without 'storage/'

            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'state_id' => $hotel->state_id,
                'city_id' => $hotel->city_id,
                'images' => $this->generateImageUrls($hotel->images, $baseUrl), // Generate URLs for images
                'location' => $hotel->location,
                'hotel_category' => $hotel->hotel_category,
                'package_id' => $hotel->package_id,
                'created_at' => $hotel->created_at->toDateTimeString(),
                'updated_at' => $hotel->updated_at->toDateTimeString(),
            ];
        });

        // Return the formatted response
        return response()->json([
            'message' => 'Hotels fetched successfully.',
            'data' => $hotelsData,
            'status' => 200
        ], 200);
    }

    // If authentication fails
    return response()->json(['message' => 'Unauthenticated'], 401);
}

/**
 * Helper method to generate image URLs from the database
 */
private function generateImageUrls($images, $baseUrl)
{
    // Decode the JSON-encoded images column
    $imagePaths = json_decode($images);

    // Add the base URL to each image path
    return array_map(function($image) use ($baseUrl) {
        return url($baseUrl . '/' . $image); // Construct the full image URL directly
    }, $imagePaths);
}




        
}

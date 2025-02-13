<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Hotels;
use App\Models\Agent;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Mail\OtpMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class HotelController extends Controller
{

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
                
                $stateName = $hotel->state ? $hotel->state->state_name : null;
                $cityName = $hotel->cities ? $hotel->cities->city_name : null;

                $hotelPrices = $hotel->prices;

                $pricesData = $hotelPrices->map(function($price) {
                    return [
                        'id' => $price->id,
                        'night_cost' => $price->night_cost,
                        'start_date' => $price->start_date,
                        'end_date' => $price->end_date,
                    ];
                });

                return [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'state' => $stateName, 
                    'city' => $cityName, 
                    'images' => $this->generateImageUrls($hotel->images, $baseUrl),
                    'location' => $hotel->location,
                    'hotel_category' => $hotel->hotel_category,
                    'package_id' => $hotel->package_id,
                    'prices' => $pricesData,  
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


    // public function getHotelWithPackages(Request $request)
    // {
    //     $token = $request->bearerToken();
        
    //     if (!$token) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }

    //     // Decode and verify token
    //     $decodedToken = base64_decode($token);
    //     list($email, $password) = explode(',', $decodedToken);

    //     // Verify user credentials
    //     $user = Agent::where('email', $email)->first();

    //     if (!$user || $password !== $user->password) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }

    //     // Now that the user is authenticated, proceed with fetching hotel details
    //     $request->validate([
    //         'hotel_id' => 'required|integer|exists:hotels,id',  // Ensure hotel_id exists in the Hotels table
    //     ]);

    //     // Retrieve the hotel_id from form-data
    //     $hotelId = $request->input('hotel_id');

    //     // Find the hotel by its ID
    //     $hotel = Hotels::find($hotelId);

    //     if (!$hotel) {
    //         // If hotel is not found, return an error
    //         return response()->json(['message' => 'Hotel not found.'], 404);
    //     }

    //     // Get the package_ids associated with the hotel
    //     $packageIds = explode(',', $hotel->package_id); // package_id is a comma-separated string

    //     // Fetch the packages based on the package_ids
    //     $packages = Package::whereIn('id', $packageIds)->get();

    //     // Prepare the response data
    //     $hotelData = [
    //         'id' => $hotel->id,
    //         'name' => $hotel->name,
    //         'state' => $hotel->state ? $hotel->state->name : null,
    //         'city' => $hotel->city ? $hotel->city->name : null,
    //         'images' => $this->generateImageUrls($hotel->images, url('')),  // Assuming this is a method you use to generate image URLs
    //         'location' => $hotel->location,
    //         'hotel_category' => $hotel->hotel_category,
    //         'package_id' => $hotel->package_id,
    //         'packages' => $packages,  // Return the related packages
    //     ];

    //     // Return the hotel details along with its packages
    //     return response()->json([
    //         'message' => 'Hotel and related packages fetched successfully.',
    //         'data' => $hotelData,
    //         'status' => 200
    //     ], 200);
    // }

    
    public function getHotelWithPackages(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $decodedToken = base64_decode($token);
        list($email, $password) = explode(',', $decodedToken);
    
        $user = Agent::where('email', $email)->first();
    
        if (!$user || $password !== $user->password) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'hotel_id' => 'required|integer|exists:hotels,id', 
        ]);
    
        $hotelId = $request->input('hotel_id');
    
        $hotel = Hotels::find($hotelId);
    
        if (!$hotel) {

            return response()->json(['message' => 'Hotel not found.'], 404);
        }
    
        $packageIds = explode(',', $hotel->package_id);

        $packages = Package::whereIn('id', $packageIds)->get();

        $hotelData = $packages->map(function($package) {
            return [
                'id' => $package->id,
                'package_name' => $package->package_name,
                'state_id' => $package->state_id,
                'city_id' => $package->city_id,
                'image' => $this->generateResourceUrls(json_decode($package->image, true), 'packages/images'), 
                'video' => $this->generateResourceUrls(json_decode($package->video, true), 'packages/videos'), 
                'pdf' => url('') . '/packages/pdf/' . $package->pdf,
                'text_description' => $package->text_description,
                'text_description_2' => $package->text_description_2,
            ];
        });
    
        return response()->json([
            'message' => 'Hotel and related packages fetched successfully.',
            'data' => $hotelData, 
            'status' => 200
        ], 200);
    }

    private function generateResourceUrls($files, $type)
    {
        $baseUrl = url('');  // Get the base URL for your app
    
        // Ensure $files is an array, otherwise make it an array with one string
        if (is_string($files)) {
            $files = [$files];  // Convert string to array
        }
    
        // Generate URLs for each file in the array (image, video, etc.)
        return array_map(function($file) use ($baseUrl, $type) {
            return $baseUrl . '/' . $type . '/' . $file;  // Return the full URL
        }, $files);
    }
    
    


private function generateImageUrls($images, $baseUrl)
{
    $imagePaths = json_decode($images);

    return array_map(function($image) use ($baseUrl) {
        return url($baseUrl . '/' . $image); 
    }, $imagePaths);
}




        
}

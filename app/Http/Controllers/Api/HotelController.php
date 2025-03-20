<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Hotels;
use App\Models\Agent;
use App\Models\Package;
use App\Models\Vehicle;
use App\Models\State;
use App\Models\HotelBooking;
use App\Models\HotelBooking2;
use App\Models\WildlifeSafariOrder2;
use App\Models\TaxiBooking2;
use App\Models\Airport;
use App\Models\HotelPrice;
use App\Models\TaxiBooking;
use App\Models\WildlifeSafari;
use App\Models\WildlifeSafariOrder;
use App\Models\VehiclePrice;
use App\Models\TripGuideBook;
use App\Models\Outstation;
use App\Models\RoundTrip;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Route;
use App\Models\PackagePrice;
use App\Models\Constants;
use App\Models\PackageBooking;
use App\Models\TripGuideBook2;
use App\Models\PackageBookingTemp;
use App\Models\TripGuide;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Mail\OtpMail;
use App\Models\AdminCity;
use App\Models\Languages;
use App\Models\LocalVehiclePrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class HotelController extends Controller
{

    public function hotel(Request $request)
    {

        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'data' => [],
                'status' => 201,
            ], 401);
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
                        'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                        'end_date' => Carbon::parse($price->end_date)->format('F Y'),
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

        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }


    public function filterHotels(Request $request)
{
    // Extract the token for authentication
    $token = $request->bearerToken();
    
    // Check if the token exists
    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    // Decode the token to get the email and password
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Find the user based on the email
    $user = Agent::where('email', $email)->first();

    // If user exists and password matches
    if ($user && $password == $user->password) {

        // Get state_id and city_id from the form data
        $stateId = $request->input('state_id');
        $cityId = $request->input('city_id');

        // Query hotels, applying filters for state_id and city_id if they are provided
        $query = Hotels::query();

        if ($stateId) {
            // Filter hotels by state_id if provided
            $query->where('state_id', $stateId);
        }

        if ($cityId) {
            // Filter hotels by city_id if provided
            $query->where('city_id', $cityId);
        }

        // Get the filtered hotels
        $hotels = $query->get();

        // Map the hotels data to the required format
        $hotelsData = $hotels->map(function ($hotel) {
            $baseUrl = url('');
            
            $stateName = $hotel->state ? $hotel->state->state_name : null;
            $cityName = $hotel->cities ? $hotel->cities->city_name : null;

            $hotelPrices = $hotel->prices;

            $pricesData = $hotelPrices->map(function ($price) {
                return [
                    'id' => $price->id,
                    'night_cost' => $price->night_cost,
                    'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                    'end_date' => Carbon::parse($price->end_date)->format('F Y'),
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

        // Return the filtered hotels data with a success message
        return response()->json([
            'message' => 'Filtered hotels fetched successfully.',
            'data' => $hotelsData,
            'status' => 200
        ], 200);
    }

    // If user is unauthenticated
    return response()->json([
        'message' => 'Unauthenticated',
        'data' => [],
        'status' => 201,
    ], 401);
}



    public function package(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'data' => [],
                'status' => 201,
            ], 401);
        }

        $decodedToken = base64_decode($token);
        list($email, $password) = explode(',', $decodedToken);

        $user = Agent::where('email', $email)->first();

        if ($user && $password == $user->password) {
            
            $hotels = Hotels::all();
            $packages = Package::get();

            $states = State::all()->pluck('state_name', 'id');
            $cities = City::all()->pluck('city_name', 'id');

            $hotelData = 
                $packages->map(function($package) use ($states, $cities) {
        
                    // Get the images
                    $imageUrls = array_values(json_decode($package->image, true));
        
                    // Get state and city names
                    $stateNames = $this->getNamesByIds($package->state_id, $states);
                    $cityNames = $this->getNamesByIds($package->city_id, $cities);

                    $today = Carbon::today()->format('Y-m-d');

                    $packagePrice = PackagePrice::where('package_id', $package->id)
                        ->where('start_date', '<=',$today)  
                        ->where('end_date', '>=',$today) 
                        ->get();

                    // $packagePrice = PackagePrice::where('package_id', $package->id)->get();
                    $prices = null;
                    if($packagePrice){
                    $prices = $packagePrice->map(function($price) {
                        return [
                            'id' => $price->id,
                            'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                            'end_date' => Carbon::parse($price->end_date)->format('F Y'),
                            'display_price' => $price->display_cost,
                            // 'standard_cost' => $price->standard_cost,
                            // 'deluxe_cost' => $price->deluxe_cost,
                            // 'premium_cost' => $price->premium_cost,
                            // 'super_deluxe_cost' => $price->super_deluxe_cost,
                            // 'luxury_cost' => $price->luxury_cost,
                            // 'nights_cost' => $price->nights_cost,
                            // 'adults_cost' => $price->adults_cost,
                            // 'child_with_bed_cost' => $price->child_with_bed_cost,
                            // 'child_no_bed_infant_cost' => $price->child_no_bed_infant_cost,
                            // 'child_no_bed_child_cost' => $price->child_no_bed_child_cost,
                            // 'meal_plan_only_room_cost' => $price->meal_plan_only_room_cost,
                            // 'meal_plan_breakfast_cost' => $price->meal_plan_breakfast_cost,
                            // 'meal_plan_breakfast_lunch_dinner_cost' => $price->meal_plan_breakfast_lunch_dinner_cost,
                            // 'meal_plan_all_meals_cost' => $price->meal_plan_all_meals_cost,
                            // 'hatchback_cost' => $price->hatchback_cost,
                            // 'sedan_cost' => $price->sedan_cost,
                            // 'economy_suv_cost' => $price->economy_suv_cost,
                            // 'luxury_suv_cost' => $price->luxury_suv_cost,
                            // 'traveller_mini_cost' => $price->traveller_mini_cost,
                            // 'traveller_big_cost' => $price->traveller_big_cost,
                            // 'premium_traveller_cost' => $price->premium_traveller_cost,
                            // 'ac_coach_cost' => $price->ac_coach_cost,
                            // 'extra_bed_cost' => $price->extra_bed_cost,
                            
                            // // Calculate total cost by summing all the costs
                            'total_cost' => 
                            $price->standard_cost ?? 0 +
                            $price->deluxe_cost ?? 0 +
                            $price->premium_cost ?? 0 +
                            $price->super_deluxe_cost ?? 0 +
                            $price->luxury_cost ?? 0 +
                            $price->nights_cost ?? 0 +
                            $price->adults_cost ?? 0 +
                            $price->child_with_bed_cost ?? 0 +
                            $price->child_no_bed_infant_cost ?? 0 +
                            $price->child_no_bed_child_cost ?? 0 +
                            $price->meal_plan_only_room_cost ?? 0 +
                            $price->meal_plan_breakfast_cost ?? 0 +
                            $price->meal_plan_breakfast_lunch_dinner_cost ?? 0 +
                            $price->meal_plan_all_meals_cost ?? 0 +
                            $price->hatchback_cost ?? 0 +
                            $price->sedan_cost ?? 0 +
                            $price->economy_suv_cost ?? 0 +
                            $price->luxury_suv_cost ?? 0 +
                            $price->traveller_mini_cost ?? 0 +
                            $price->traveller_big_cost ?? 0 +
                            $price->premium_traveller_cost ?? 0 +
                            $price->ac_coach_cost ?? 0 +
                            $price->extra_bed_cost ?? 0
                        ];
                        
                    });
                }
        
                    return [
                        'id' => $package->id,
                        'package_name' => $package->package_name,
                        'state_names' => $stateNames, 
                        'city_names' => $cityNames,
                        'image' => array_map(function($image) {
                            return url('') . '/' . $image;
                        }, $imageUrls),
                        'video' => array_map(function($video) {
                        return url('') . '/' . $video;
                        }, is_array($videos = json_decode($package->video, true)) ? $videos : []),

                        'pdf' => url('') . '/' . $package->pdf,
                        'text_description' => strip_tags($package->text_description),
                        'text_description_2' => strip_tags($package->text_description_2),
                        'prices' => $prices,  // Added prices to the response
                    ];
                });
            // ];

            return response()->json([
                'message' => 'Package fetched successfully.',
                'data' => $hotelData,
                'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }


    public function packagedetailes(Request $request)
{
    $token = $request->bearerToken();
    
    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    // Decode the token
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Verify the user credentials
    $user = Agent::where('email', $email)->first();

    if (!$user || $password !== $user->password) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $request->validate([
        'package_id' => 'required|integer|exists:package,id',
    ]);

    $hotelId = $request->input('package_id');
    
    // Fetch packages as a collection
    $packages = Package::where('id', $hotelId)->get();  // Using get() to retrieve multiple packages if needed
    
    // Retrieve states and cities
    $states = State::all()->pluck('state_name', 'id');
    $cities = City::all()->pluck('city_name', 'id');

    $hotelData = [
        'packages' => $packages->map(function($package) use ($states, $cities) {
            // Get the images
            $imageUrls = array_values(json_decode($package->image, true));

            // Get state and city names
            $stateNames = $this->getNamesByIds($package->state_id, $states);
            $cityNames = $this->getNamesByIds($package->city_id, $cities);

            // Get the prices for the current package
            $packagePrices = PackagePrice::where('package_id', $package->id)->get();

            // Prepare the price data
            $prices = $packagePrices->map(function($price) {
                $totalprice = $price->standard_cost + $price->deluxe_cost + $price->premium_cost + $price->super_deluxe_cost + $price->luxury_cost + $price->nights_cost + $price->adults_cost + $price->child_with_bed_cost + $price->child_no_bed_infant_cost + $price->child_no_bed_child_cost + $price->meal_plan_only_room_cost + $price->meal_plan_breakfast_cost + $price->meal_plan_breakfast_lunch_dinner_cost + $price->meal_plan_all_meals_cost + $price->hatchback_cost + $price->sedan_cost + $price->economy_suv_cost + $price->luxury_suv_cost + $price->traveller_mini_cost
                + $price->traveller_big_cost + $price->premium_traveller_cost + $price->ac_coach_cost + $price->extra_bed_cost;
                return [
                    'id' => $price->id,
                    'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                    'end_date' => Carbon::parse($price->end_date)->format('F Y'),
                    'standard_cost' => $price->standard_cost,
                    'deluxe_cost' => $price->deluxe_cost,
                    'premium_cost' => $price->premium_cost,
                    'super_deluxe_cost' => $price->super_deluxe_cost,
                    'luxury_cost' => $price->luxury_cost,
                    'nights_cost' => $price->nights_cost,
                    'adults_cost' => $price->adults_cost,
                    'child_with_bed_cost' => $price->child_with_bed_cost,
                    'child_no_bed_infant_cost' => $price->child_no_bed_infant_cost,
                    'child_no_bed_child_cost' => $price->child_no_bed_child_cost,
                    'meal_plan_only_room_cost' => $price->meal_plan_only_room_cost,
                    'meal_plan_breakfast_cost' => $price->meal_plan_breakfast_cost,
                    'meal_plan_breakfast_lunch_dinner_cost' => $price->meal_plan_breakfast_lunch_dinner_cost,
                    'meal_plan_all_meals_cost' => $price->meal_plan_all_meals_cost,
                    'hatchback_cost' => $price->hatchback_cost,
                    'sedan_cost' => $price->sedan_cost,
                    'economy_suv_cost' => $price->economy_suv_cost,
                    'luxury_suv_cost' => $price->luxury_suv_cost,
                    'traveller_mini_cost' => $price->traveller_mini_cost,
                    'traveller_big_cost' => $price->traveller_big_cost,
                    'premium_traveller_cost' => $price->premium_traveller_cost,
                    'ac_coach_cost' => $price->ac_coach_cost,
                    'extra_bed_cost' => $price->extra_bed_cost,
                    'totalprice' => $totalprice,
                ];
            });

            return [
                'id' => $package->id,
                'package_name' => $package->package_name,
                'state_names' => $stateNames, 
                'city_names' => $cityNames,
                'image' => array_map(function($image) {
                    return url('') . '/' . $image;
                }, $imageUrls),
                'video' => array_map(function($video) {
                    return url('') . '/' . $video;
                }, json_decode($package->video, true)),
                'pdf' => url('') . '/' . $package->pdf,
                'text_description' => strip_tags($package->text_description),
                'text_description_2' => strip_tags($package->text_description_2),
                'prices' => $prices,  // Added prices to the response
            ];
        }),
    ];

    return response()->json([
        'message' => 'Hotel and related packages fetched successfully.',
        'data' => $hotelData,
        'status' => 200
    ], 200);
}



//     public function getHotelWithPackages(Request $request)
// {
//     $token = $request->bearerToken();
    
//     if (!$token) {
//         return response()->json(['message' => 'Unauthenticated.'], 401);
//     }

//     // Decode the token
//     $decodedToken = base64_decode($token);
//     list($email, $password) = explode(',', $decodedToken);

//     // Verify the user credentials
//     $user = Agent::where('email', $email)->first();

//     if (!$user || $password !== $user->password) {
//         return response()->json(['message' => 'Unauthenticated.'], 401);
//     }

//     $request->validate([
//         'hotel_id' => 'required|integer|exists:hotels,id',
//     ]);

//     $hotelId = $request->input('hotel_id');
//     $hotel = Hotels::find($hotelId);

//     if (!$hotel) {
//         return response()->json(['message' => 'Hotel not found.'], 404);
//     }

//     $packageIds = explode(',', $hotel->package_id);
//     $packages = Package::whereIn('id', $packageIds)->get();

//     $states = State::all()->pluck('state_name', 'id');
//     $cities = City::all()->pluck('city_name', 'id');

//     $hotelData = [
//         'packages' => $packages->map(function($package) use ($states, $cities) {

//             $imageUrls = array_values(json_decode($package->image, true));

//             $stateNames = $this->getNamesByIds($package->state_id, $states);
//             $cityNames = $this->getNamesByIds($package->city_id, $cities);

//             return [
//                 'id' => $package->id,
//                 'package_name' => $package->package_name,
//                 // 'state_id' => $package->state_id,
//                 // 'city_id' => $package->city_id,
//                 'state_names' => $stateNames, 
//                 'city_names' => $cityNames,   
//                 'image' => array_map(function($image) {
//                     return url('') . '/' . $image;
//                 }, $imageUrls),
//                 'video' => array_map(function($video) {
//                     return url('') . '/' . $video;
//                 }, json_decode($package->video, true)),
//                 'pdf' => url('') . '/' . $package->pdf,
//                 'text_description' => $package->text_description,
//                 'text_description_2' => $package->text_description_2,
//             ];
//         }),
//     ];

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
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    // Decode the token
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Verify the user credentials
    $user = Agent::where('email', $email)->first();

    if (!$user || $password !== $user->password) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
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

    $states = State::all()->pluck('state_name', 'id');
    $cities = City::all()->pluck('city_name', 'id');

    $hotelData = [
        'packages' => $packages->map(function($package) use ($states, $cities) {

            // Get the images
            $imageUrls = array_values(json_decode($package->image, true));

            // Get state and city names
            $stateNames = $this->getNamesByIds($package->state_id, $states);
            $cityNames = $this->getNamesByIds($package->city_id, $cities);

            // Get the prices for the current package
            $packagePrices = PackagePrice::where('package_id', $package->id)->get();

            // Prepare the price data
            $prices = $packagePrices->map(function($price) {
                return [
                    'id' => $price->id,
                    'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                    'end_date' => Carbon::parse($price->end_date)->format('F Y'),
                    'standard_cost' => $price->standard_cost,
                    'deluxe_cost' => $price->deluxe_cost,
                    'premium_cost' => $price->premium_cost,
                    'super_deluxe_cost' => $price->super_deluxe_cost,
                    'luxury_cost' => $price->luxury_cost,
                    'nights_cost' => $price->nights_cost,
                    'adults_cost' => $price->adults_cost,
                    'child_with_bed_cost' => $price->child_with_bed_cost,
                    'child_no_bed_infant_cost' => $price->child_no_bed_infant_cost,
                    'child_no_bed_child_cost' => $price->child_no_bed_child_cost,
                    'meal_plan_only_room_cost' => $price->meal_plan_only_room_cost,
                    'meal_plan_breakfast_cost' => $price->meal_plan_breakfast_cost,
                    'meal_plan_breakfast_lunch_dinner_cost' => $price->meal_plan_breakfast_lunch_dinner_cost,
                    'meal_plan_all_meals_cost' => $price->meal_plan_all_meals_cost,
                    'hatchback_cost' => $price->hatchback_cost,
                    'sedan_cost' => $price->sedan_cost,
                    'economy_suv_cost' => $price->economy_suv_cost,
                    'luxury_suv_cost' => $price->luxury_suv_cost,
                    'traveller_mini_cost' => $price->traveller_mini_cost,
                    'traveller_big_cost' => $price->traveller_big_cost,
                    'premium_traveller_cost' => $price->premium_traveller_cost,
                    'ac_coach_cost' => $price->ac_coach_cost,
                    'extra_bed_cost' => $price->extra_bed_cost,
                ];
            });

            return [
                'id' => $package->id,
                'package_name' => $package->package_name,
                'state_names' => $stateNames, 
                'city_names' => $cityNames,
                'image' => array_map(function($image) {
                    return url('') . '/' . $image;
                }, $imageUrls),
                'video' => array_map(function($video) {
                    return url('') . '/' . $video;
                }, json_decode($package->video, true)),
                'pdf' => url('') . '/' . $package->pdf,
                'text_description' => strip_tags($package->text_description),
                'text_description_2' => strip_tags($package->text_description_2),
                'prices' => $prices,  // Added prices to the response
            ];
        }),
    ];

    return response()->json([
        'message' => 'Hotel and related packages fetched successfully.',
        'data' => $hotelData,
        'status' => 200
    ], 200);
}

// Helper function to map IDs to their corresponding names
private function getNamesByIds($ids, $list)
{
    // Convert the IDs string into an array
    $idsArray = explode(',', $ids);

    // Map the IDs to the respective names
    return array_map(function($id) use ($list) {
        return isset($list[$id]) ? $list[$id] : null;
    }, $idsArray);
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

public function vehicle(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $decodedToken = base64_decode($token);

    if (strpos($decodedToken, ',') === false) {
        return response()->json([
            'message' => 'Invalid token format.',
            'data' => [],
            'status' => 201,
        ], 400);
    }

    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {


        // $validatedData = $request->validate([
        //     'airport_id' => 'nullable',
        //     'city_id' => 'nullable',
        // ]);

        // $airport_id = Airport::where('id',$request->airport_id)->get();
        // $vehicleIds = explode(',', $airport_id->vehicle_id);

        // $city_id = Outstation::where('trip_type',$request->city_id)->get();


        // if($airport_id){

        // $vehicles = Vehicle::whereIn('id', $vehicleIds)->orderBy('id','DESC')->where('status',1)->with('vehiclePrices', 'outstation','roundtrip')->get();

        // }elseif($airport_id){
        //     $vehicles = Vehicle::whereIn('id', $city_id->vehicle_type)->orderBy('id','DESC')->where('status',1)->with('vehiclePrices', 'outstation','roundtrip')->get();
        // }else{

        // $vehicles = Vehicle::orderBy('id','DESC')->where('status',1)->with('vehiclePrices', 'outstation','roundtrip')->get();
        // }

        $validatedData = $request->validate([
            'airport_id' => 'nullable',
            'city_id' => 'nullable',
        ]);

        $vehicles = collect();

        $airport_id = Airport::find($request->airport_id);
    
        if ($airport_id) {
            $vehicleIds = explode(',', $airport_id->vehicle_id);

            $vehicles = Vehicle::whereIn('id', $vehicleIds)
                ->orderBy('id', 'DESC')
                ->where('status', 1)
                ->with('vehiclePrices', 'outstation', 'roundtrip')
                ->get();
        } elseif ($request->city_id) {
            $outstations = Outstation::where('trip_type', $request->city_id)->get();
            foreach ($outstations as $outstation) {
                $vehicleIds = explode(',', $outstation->vehicle_type);
    
                $vehicles = $vehicles->merge(Vehicle::whereIn('id', $vehicleIds)
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->with('vehiclePrices', 'outstation', 'roundtrip')
                    ->get());
            }

            $vehicles = $vehicles->unique('id');
        } else {
            $vehicles = Vehicle::orderBy('id', 'DESC')
                ->where('status', 1)
                ->with('vehiclePrices', 'outstation', 'roundtrip')
                ->get();
        }
    
    
        $vehiclesData = $vehicles->map(function($vehicle) {
            $baseUrl = url('');

            $pricesData = $vehicle->vehiclePrices ? $vehicle->vehiclePrices->map(function($price) {
                return [
                    'id' => $price->id,
                    'price' => $price->price,
                    'city' => $price->city,
                    'type' => $price->type,
                    'description' => strip_tags($price->description),
                ];
            }) : [];

            $outstationData = [];
            if ($vehicle->outstation) {
                if ($vehicle->outstation instanceof \Illuminate\Database\Eloquent\Collection) {
                    $outstationData = $vehicle->outstation->map(function($outstation) {
                        return [
                            'id' => $outstation->id,
                            'drop_point' => $outstation->drop_point,
                            'available_km' => $outstation->available_km,
                            'extra_km_charge' => $outstation->extra_km_charge,
                            'trip_type' => $outstation->trip_type,
                            'cost' => $outstation->cost,
                            'description' => strip_tags($outstation->description),
                        ];
                    });
                } else {
                    // If outstation is a single instance, just use it directly
                    $outstationData[] = [
                        'id' => $vehicle->outstation->id,
                        'drop_point' => $vehicle->outstation->drop_point,
                        'available_km' => $vehicle->outstation->available_km,
                        'extra_km_charge' => $vehicle->outstation->extra_km_charge,
                        'trip_type' => $vehicle->outstation->trip_type,
                        'cost' => $vehicle->outstation->cost,
                        'description' => strip_tags($vehicle->outstation->description),
                    ];
                }
            }

            $roundtrip = [];
            if ($vehicle->roundtrip) {
                if ($vehicle->roundtrip instanceof \Illuminate\Database\Eloquent\Collection) {
                    $roundtrip = $vehicle->roundtrip->map(function($roundtrip) {
                        return [
                            'id' => $roundtrip->id,
                            'per_km_charge' => $roundtrip->per_km_charge,
                            'description' => strip_tags($roundtrip->description),
                        ];
                    });
                } else {
                    $roundtrip[] = [
                        'id' => $vehicle->roundtrip->id,
                        'per_km_charge' => $vehicle->roundtrip->per_km_charge,
                        'description' => strip_tags($vehicle->roundtrip->description),
                    ];
                }
            }

            // If vehicle has an image, use the asset path
            $imagepath = $vehicle->image ? asset($vehicle->image) : null;

            return [
                'id' => $vehicle->id,
                'vehicle_type' => $vehicle->vehicle_type,
                'image' => $imagepath,
                'prices' => $pricesData,
                'outstation' => $outstationData,  // Added outstation data
                'roundtrip' => $roundtrip,  // Added outstation data
            ];
        });

        return response()->json([
            'message' => 'Vehicles fetched successfully.',
            // 'data' => $vehiclesData,
            'data' => $vehiclesData->values()->all(),
            'status' => 200
        ], 200);
    }

    return response()->json([
        'message' => 'Unauthenticated',
        'data' => [],
        'status' => 201,
    ], 401);
}





public function statecityhotel(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {
        // Get state_id and city_id from the request
        $stateId = $request->input('state_id');
        $cityId = $request->input('city_id');

        // Query the hotels based on state_id and city_id
        $hotelsQuery = Hotels::query();

        // Filter by state_id if provided
        if ($stateId) {
            $hotelsQuery->where('state_id', $stateId);
        }

        // Filter by city_id if provided
        if ($cityId) {
            $hotelsQuery->where('city_id', $cityId);
        }

        $hotels = $hotelsQuery->get();

        $hotelsData = $hotels->map(function($hotel) {
            $baseUrl = url('');
            
            $stateName = $hotel->state ? $hotel->state->state_name : null;
            $cityName = $hotel->cities ? $hotel->cities->city_name : null;

            $hotelPrices = $hotel->prices;

            $pricesData = $hotelPrices->map(function($price) {
                return [
                    'id' => $price->id,
                    'night_cost' => $price->night_cost,
                    'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                    'end_date' => Carbon::parse($price->end_date)->format('F Y'),
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

    return response()->json([
        'message' => 'Unauthenticated',
        'data' => [],
        'status' => 201,
    ], 401);
}


 
// public function hotelBooking(Request $request) {

//     $token = $request->bearerToken();

//     if (!$token) {
//         return response()->json(['message' => 'Unauthenticated.'], 401);
//     }

//     $decodedToken = base64_decode($token);
//     list($email, $password) = explode(',', $decodedToken);

//     $user = Agent::where('email', $email)->first();

//     if (!$user || $password != $user->password) {
//         return response()->json(['message' => 'Unauthorized. Invalid credentials.'], 401);
//     }

//     $validatedData = $request->validate([
//         'hotel_id' => 'required',
//         'city_id' => 'required', 
//         'check_in_date' => 'required|date',
//         'check_out_date' => 'required|date|after_or_equal:check_in_date',
//         'no_occupants' => 'required|integer',
//     ]);

//     // Calculate the night count (difference between check-out and check-in dates)
//     $checkInDate = Carbon::parse($request->check_in_date);
//     $checkOutDate = Carbon::parse($request->check_out_date);
//     $nightCount = $checkInDate->diffInDays($checkOutDate);  
//     return $nightCount;

//     $hotelBooking = new HotelBooking();
//     $hotelBooking->hotel_id = $request->hotel_id;
//     $hotelBooking->city_id = $request->city_id;
//     $hotelBooking->check_in_date = $request->check_in_date;
//     $hotelBooking->check_out_date = $request->check_out_date;
//     $hotelBooking->no_occupants = $request->no_occupants;
//     $hotelBooking->user_id = $user->id;
//     $hotelBooking->status = 0;
//     $hotelBooking->night_count = $nightCount; // Save the calculated night count
//     $hotelBooking->save();

//     return response()->json([
//         'message' => 'Hotel booking successfully created.',
//         'data' => [
//             'id' => $hotelBooking->id,
//             'hotel_id' => $hotelBooking->hotel_id,
//             'city_id' => $hotelBooking->city_id,
//             'check_in_date' => $hotelBooking->check_in_date,
//             'check_out_date' => $hotelBooking->check_out_date,
//             'no_occupants' => $hotelBooking->no_occupants,
//             'user_id' => $hotelBooking->user_id,
//             'status' => $hotelBooking->status,
//             'night_count' => $hotelBooking->night_count,  // Include the night count in the response
//         ],
//         'status' => 200,
//     ], 200);
// }


public function hotelBooking(Request $request) {

    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Unauthorized. Invalid credentials.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $validatedData = $request->validate([
        'hotel_id' => 'required',
        'city_id' => 'nullable', 
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after_or_equal:check_in_date',
        'no_occupants' => 'required',
    ]);

    $checkInDate = Carbon::parse($request->check_in_date);
    $checkOutDate = Carbon::parse($request->check_out_date);
    $nightCount = $checkInDate->diffInDays($checkOutDate);  

    $totalPrice = 0;
    $currentDate = $checkInDate->copy();
    $hotelPrices = HotelPrice::where('hotel_id', $request->hotel_id)
                             ->where('start_date', '<=', $checkOutDate)
                             ->where('end_date', '>=', $checkInDate)
                             ->get();
    foreach ($hotelPrices as $price) {
        $overlapStart = max($currentDate, Carbon::parse($price->start_date));
        $overlapEnd = min($checkOutDate, Carbon::parse($price->end_date));

        if ($overlapStart->lt($overlapEnd)) {
            $priceNights = $overlapStart->diffInDays($overlapEnd);
            $totalPrice += $priceNights * $price->night_cost; 
        }

        $currentDate = $overlapEnd->addDay();
    }

    // return $totalPrice;

    $hotelBooking = new HotelBooking();
    $hotelBooking->hotel_id = $request->hotel_id;
    $hotelBooking->city_id = $request->city_id;
    $hotelBooking->check_in_date = $request->check_in_date;
    $hotelBooking->check_out_date = $request->check_out_date;
    $hotelBooking->no_occupants = $request->no_occupants;
    $hotelBooking->user_id = $user->id;
    $hotelBooking->status = 0;
    $hotelBooking->night_count = $nightCount; 
    $hotelBooking->cost = $totalPrice;
    $hotelBooking->save();

    return response()->json([
        'message' => 'Hotel booking successfully created.',
        'data' => [
            'id' => $hotelBooking->id,
            'hotel_id' => $hotelBooking->hotel_id,
            'city_id' => $hotelBooking->city_id,
            'check_in_date' => $hotelBooking->check_in_date,
            'check_out_date' => $hotelBooking->check_out_date,
            'no_occupants' => $hotelBooking->no_occupants,
            'user_id' => $hotelBooking->user_id,
            'status' => $hotelBooking->status,
            'night_count' => $hotelBooking->night_count, 
            'cost' => $hotelBooking->cost, 
        ],
        'status' => 200,
    ], 200);
}


    
public function taxibooking(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'status' => 401,
            'data' => [],
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Unauthorized. Invalid credentials.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $request->validate([
        'location' => 'nullable',
        'vehicle_id' => 'nullable',
        'trip_type' => 'nullable',
        'cost' => 'nullable',
        'trip' => 'nullable',
        'tour_type' => 'required|integer',
        'user_id' => 'nullable',
    ]);

    $tourType = $request->tour_type;
    $data = [];

    $vehicleprice = VehiclePrice::where('type','Airport/Railway station')->where('vehicle_id',$request->vehicle_id)->first();
    $vehiclepricetour = VehiclePrice::where('type','Local Tour')->where('vehicle_id',$request->vehicle_id)->first();

    if ($tourType == 1) {
        if($request->trip == 'pickup'){
        $data = [
            'location' => $request->location,
            'city_id' => $request->city_id,
            'user_id' => $user->id, 
            'vehicle_id' => $request->vehicle_id,
            'airport_id' => $request->airport_id,
            'trip' => $request->trip,
            'pickup_time' => $request->pickup_time,
            'pickup_date' => $request->pickup_date ?? null,
            'cost' => $vehicleprice->price ?? null,
            'tour_type' => 'Airport/Railway station',
            'status' => 0,
        ];
    }else{
        $data = [
            'location' => $request->location,
            'user_id' => $user->id, 
            'city_id' => $request->city_id, 
            'vehicle_id' => $request->vehicle_id,
            'airport_id' => $request->airport_id,
            'trip' => $request->trip,
            'pickup_time' => $request->pickup_time,
            'pickup_date' => $request->pickup_date ?? null,
            'cost' => $vehicleprice->price ?? null,
            'drop_pickup_address' => $request->drop_pickup_address ?? null,
            'tour_type' => 'Airport/Railway station',
            'status' => 0,
        ];
    }
    }

    if ($tourType == 2) {
        $data = [
            'location' => $request->location,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'city_id' => $request->city_id, 
            'vehicle_id' => $request->vehicle_id,
            'user_id' => $user->id,
            'drop_time' => $request->drop_time,
            'drop_date' => $request->drop_date,
            'cost' => $vehiclepricetour->price ?? null,
            'tour_type' => 'Local Tour',
            'status' => 0,
        ];
    }

    if ($tourType == 3) {

        // $cityImagePath = null;
        // if ($request->hasFile('city_image')) {
        //     $cityImagePath = $request->file('city_image')->store('city_images', 'public');
        // }

        if($request->trip_type == 'one-way'){
        $data = [
            'trip_type' => $request->trip_type,
            'pickup_date' => $request->pickup_date,
            'user_id' => $user->id,
            'vehicle_id' => $request->vehicle_id,
            'destination_city' => $request->destination_city,
            'cost' => $request->cost,
            'tour_type' => 'Outstation',
            'status' => 0,
        ];
    }else{
        $data = [
            'trip_type' => $request->trip_type,
            'pickup_date_1' => $request->pickup_date_1,
            'user_id' => $user->id,
            'vehicle_id_1' => $request->vehicle_id_1,
            'departure_location' => $request->departure_location,
            'drop_date' => $request->drop_date,
            'destination_location' => $request->destination_location,
            'tour_type' => 'Outstation',
            'status' => 0,
        ];
    }
}

    $taxiBooking = TaxiBooking::create($data);

    $taxiBooking->makeHidden('updated_at','created_at');

    return response()->json([
        'message' => 'Taxi booking created successfully',
        'data' => $taxiBooking,
        'status' => 200,
    ], 
    201);
}
    
// public function taxibooking(Request $request)
// {
//     $token = $request->bearerToken();

//     if (!$token) {
//         return response()->json([
//             'message' => 'Unauthenticated.',
//             'status' => 401,
//             'data' => [],
//         ], 401);
//     }

//     $decodedToken = base64_decode($token);
//     list($email, $password) = explode(',', $decodedToken);

//     $user = Agent::where('email', $email)->first();

//     if (!$user || $password != $user->password) {
//         return response()->json(['message' => 'Unauthorized. Invalid credentials.'], 401);
//     }

//     $request->validate([
//         'location' => 'nullable',
//         'vehicle_id' => 'nullable',
//         'trip_type' => 'nullable',
//         'cost' => 'nullable',
//         'city_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'state' => 'nullable',
//         'city' => 'nullable',
//         'one_way' => 'nullable',
//         'description' => 'nullable',
//         'trip' => 'nullable',
//         'start_date' => 'nullable',
//         'end_date' => 'nullable',
//         'end_time' => 'nullable',
//         'start_time' => 'nullable',
//         'pickup_address' => 'nullable',
//         'tour_type' => 'required|integer',
//         'user_id' => 'nullable',
//         'one_way_location' => 'nullable',
//         'round_start_location' => 'nullable',
//         'round_end_location' => 'nullable',
//     ]);

//     $tourType = $request->tour_type;
//     $data = [];

//     if ($tourType == 1) {
//         $data = [
//             'pickup_address' => $request->pickup_address,
//             'location' => $request->location,
//             'user_id' => $user->id, 
//             'vehicle_id' => $request->vehicle_id,
//             'trip' => $request->trip,
//             'start_date' => $request->start_date,
//             'start_time' => $request->start_time ?? null,
//             'end_time' => $request->end_time ?? null,
//             'tour_type' => $request->tour_type,
            
//         ];
//     }

//     if ($tourType == 2) {
//         $data = [
//             'location' => $request->location,
//             'vehicle_id' => $request->vehicle_id,
//             'user_id' => $user->id,
//             'start_date' => $request->start_date,
//             'end_date' => $request->end_date,
//             'tour_type' => $request->tour_type,
//             'end_time' => $request->end_time ?? null,
//             'start_time' => $request->start_time ?? null,
//         ];
//     }

//     if ($tourType == 3) {
//         $cityImagePath = null;
//         if ($request->hasFile('city_image')) {
//             $cityImagePath = $request->file('city_image')->store('city_images', 'public');
//         }
//         $data = [
//             'start_date' => $request->start_date,
//             'end_date' => $request->end_date,
//             'user_id' => $user->id,
//             'vehicle_id' => $request->vehicle_id,
//             'trip_type' => $request->trip_type,
//             'one_way_location' => $request->one_way_location,
//             'round_start_location' => $request->round_start_location,
//             'round_end_location' => $request->round_end_location,
//             'tour_type' => $request->tour_type,
//             'city_image' => $cityImagePath,
//             'start_time' => $request->start_time ?? null,
//         ];
//     }

//     $taxiBooking = TaxiBooking::create($data);

//     return response()->json([
//         'message' => 'Taxi booking created successfully',
//         'data' => $taxiBooking,
//         'status' => 200,
//     ], 
//     201);
// }




public function profile(Request $request) {
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'status' => 201,
            'data' => [],
        ], 401);
    }

    // Decode the token
    $decodedToken = base64_decode($token);

    $tokenParts = explode(',', $decodedToken);

    if (count($tokenParts) !== 2) {
        return response()->json([
            'message' => 'Invalid token format.',
            'status' => 400,
            'data' => [],
        ], 400);
    }

    // Get email and password from the token
    list($email, $password) = $tokenParts;

    // Find the user based on the email from the Agent model
    $user = Agent::where('email', $email)->first();

    // Check if the user exists and if the password matches
    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Unauthorized. Invalid credentials.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $aadharImageUrl = asset($user->aadhar_image);
    $aadharImageBackUrl = asset($user->aadhar_image_back);
    $logoUrl = asset($user->logo);
    $panImageUrl = asset($user->pan_image);

    // Prepare the response data
    $data = [
        'id' => $user->id,
        'name' => $user->name,
        'business_name' => $user->business_name,
        'state_id' => $user->state->state_name,
        'city' => $user->cities->city_name,
        'number' => $user->number,
        'GST_number' => $user->GST_number,
        'email' => $user->email,
        'pan_image' => $panImageUrl,
        'aadhar_image' => $aadharImageUrl,
        'aadhar_image_back' => $aadharImageBackUrl,
        'logo' => $logoUrl, 
    ];

    // Return the response with the user data
    return response()->json([
        'message' => 'User profile retrieved successfully.',
        'status' => 200,
        'data' => $data,
    ], 200);
}


public function packagebooking(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'status' => 201,
            'data' => [],
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Unauthorized. Invalid credentials.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $validatedData = $request->validate([
        'package_id' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'adults_count' => 'required|integer|min:1',
        'child_with_bed_count' => 'nullable|integer|min:0',
        'child_no_bed_child_count' => 'nullable|integer|min:0',
        'extra_bed' => 'nullable|in:yes,no',
        'meal' => 'nullable|in:only_room,breakfast,breakfast_lunch,breakfast_dinner,all_meals',
        'hotel_preference' => 'nullable|in:standard,deluxe,super_deluxe,luxury,premium',
        'vehicle_options' => 'nullable|in:hatchback_cost,sedan_cost,economy_suv_cost,luxury_suv_cost,traveller_mini_cost,traveller_big_cost,premium_traveller_cost,ac_coach_cost',
        // 'travelinsurance' => 'nullable|boolean',
        'specialremarks' => 'nullable|string',
    ]);

    // Parse dates
    $start_date = Carbon::parse($request->start_date);
    $end_date = Carbon::parse($request->end_date);
    $night_count = $start_date->diffInDays($end_date); 
    $formatted_date = Carbon::now()->format('Y-m');

    // Get package price for the specific package
    $package_price = PackagePrice::where('package_id', $request->package_id)
        ->where('start_date', '<=', $formatted_date)
        ->where('end_date', '>=', $formatted_date)
        ->first();

    if (!$package_price) {
        return response()->json([
            'message' => 'Package not found for the selected dates',
            'data' => [],
            'status' => 201,
        ], 404);
    }

    // Initialize PackageBookingTemp object
    $wildlife = new PackageBookingTemp();
    $wildlife->user_id = $user->id;
    $wildlife->package_id = $request->package_id;
    $wildlife->start_date = $start_date;
    $wildlife->end_date = $end_date;
    $wildlife->adults_count = $request->adults_count;
    $wildlife->child_with_bed_count = $request->child_with_bed_count;
    $wildlife->night_count = $night_count;  
    $wildlife->child_no_bed_child_count = $request->child_no_bed_child_count;  
    $wildlife->extra_bed = $request->extra_bed;  
    $wildlife->meal = $request->meal;  
    $wildlife->hotel_preference = $request->hotel_preference;  
    $wildlife->vehicle_options = $request->vehicle_options;  
    $wildlife->travelinsurance = $request->travelinsurance;  
    $wildlife->specialremarks = $request->specialremarks;  
    $wildlife->status = 0;

    // Meal cost calculation
    switch ($request->meal) {
        case 'only_room':
            $meal_cost = $package_price->meal_plan_only_room_cost;
            break;
        case 'breakfast':
            $meal_cost = $package_price->meal_plan_breakfast_cost;
            break;
        case 'breakfast_lunch':
        case 'breakfast_dinner':
            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost;
            break;
        default:
            $meal_cost = $package_price->meal_plan_all_meals_cost;
    }

    // Hotel preference cost calculation
    switch ($request->hotel_preference) {
        case 'standard':
            $hotel_preference_cost = $package_price->standard_cost;
            break;
        case 'deluxe':
            $hotel_preference_cost = $package_price->deluxe_cost;
            break;
        case 'super_deluxe':
            $hotel_preference_cost = $package_price->super_deluxe_cost;
            break;
        case 'luxury':
            $hotel_preference_cost = $package_price->luxury_cost;
            break;
        default:
            $hotel_preference_cost = $package_price->premium_cost;
    }

    // Vehicle options cost calculation
    switch ($request->vehicle_options) {
        case 'hatchback_cost':
            $vehicle_options_cost = $package_price->hatchback_cost;
            break;
        case 'sedan_cost':
            $vehicle_options_cost = $package_price->sedan_cost;
            break;
        case 'economy_suv_cost':
            $vehicle_options_cost = $package_price->economy_suv_cost;
            break;
        case 'luxury_suv_cost':
            $vehicle_options_cost = $package_price->luxury_suv_cost;
            break;
        case 'traveller_mini_cost':
            $vehicle_options_cost = $package_price->traveller_mini_cost;
            break;
        case 'traveller_big_cost':
            $vehicle_options_cost = $package_price->traveller_big_cost;
            break;
        case 'premium_traveller_cost':
            $vehicle_options_cost = $package_price->premium_traveller_cost;
            break;
        default:
            $vehicle_options_cost = $package_price->ac_coach_cost;
    }

    // Extra bed cost
    $extrabed_cost = ($request->extra_bed == 'yes') ? $package_price->extra_bed_cost : 0;

    // Calculate total costs
    $total_night_cost = $package_price->nights_cost * $night_count;
    $adults_cost = $package_price->adults_cost * $request->adults_count;
    $child_with_bed_cost = $package_price->child_with_bed_cost * $request->child_with_bed_count;
    $child_no_bed_child_cost = $package_price->child_no_bed_child_cost * $request->child_no_bed_child_count;
    $total_meal_cost = $meal_cost;
    $total_hotel_preference_cost = $hotel_preference_cost;
    $total_vehicle_options_cost = $vehicle_options_cost;

    $finaltotal = $total_night_cost + $adults_cost + $child_with_bed_cost + $child_no_bed_child_cost + $total_meal_cost + $total_hotel_preference_cost + $total_vehicle_options_cost + $extrabed_cost; 

    // Save package booking data
    $wildlife->total_cost = $finaltotal;
    $wildlife->save();

    // Return response as JSON
    return response()->json([
        'message' => 'Package booking successfully added.',
        'status' => 200,
        'data' => [
            'id' => $wildlife->id,
            'total_cost' => $finaltotal,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
            'adults_count' => $request->adults_count,
            'child_with_bed_count' => $request->child_with_bed_count,
            'child_no_bed_child_count' => $request->child_no_bed_child_count,
            'meal' => $request->meal,
            'hotel_preference' => $request->hotel_preference,
            'vehicle_options' => $request->vehicle_options,
            'extra_bed' => $request->extra_bed,
            'specialremarks' => $request->specialremarks,
        ]
    ], 200);
}

// ======================================= Booking Confirm start ========================================

public function confirm(Request $request)
{
    
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'status' => 201,
            'data' => [],
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Unauthorized. Invalid credentials.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $validatedData = $request->validate([
        'package_id' => 'nullable',
        'hotel_id' => 'nullable',
        'safari_id' => 'nullable',
        'guide_id' => 'nullable',
        'taxi_id' => 'nullable',
        'agent_margin' => 'required|numeric',
        'salesman_name' => 'required|string|max:255',
        'salesman_mobile' => 'required|string|max:15',
    ]);

    $package_id = $request->package_id;
    $hotel_id = $request->hotel_id;
    $safari_id = $request->safari_id;
    $guide_id = $request->guide_id;
    $taxi_id = $request->taxi_id;

    if($package_id){
    $packagetempbooking = PackageBookingTemp::find($request->package_id);

    if (!$packagetempbooking) {
        return response()->json(['message' => 'Package booking not found', 'status' => 201], 404);
    }

    $final_price = ($packagetempbooking->total_cost ?? 0) + ($request->agent_margin ?? 0);

    $packagebooking = new PackageBooking();
    $packagebooking->package_temp_id = $request->package_id;
    $packagebooking->user_id = $packagetempbooking->user_id;
    $packagebooking->package_id = $packagetempbooking->package_id;
    $packagebooking->fetched_price = $packagetempbooking->total_cost;
    $packagebooking->agent_margin = $request->agent_margin;
    $packagebooking->final_price = $final_price;
    $packagebooking->salesman_name = $request->salesman_name;
    $packagebooking->salesman_mobile = $request->salesman_mobile;
    $packagebooking->status = 0; // assuming status 0 is default, change if needed
    $packagebooking->save();
    $packagetempbooking->update(['status' => 1]);

    $data = [
        'id' => $packagebooking->id,
        'package_temp_id' => $packagebooking->package_temp_id,
        'fetched_price' => $packagebooking->fetched_price,
        'agent_margin' => $packagebooking->agent_margin,
        'final_price' => $packagebooking->final_price,
        'salesman_name' => $packagebooking->salesman_name,
        'salesman_mobile' => $packagebooking->salesman_mobile,
        'status' => $packagebooking->status,
    ];
    }elseif($hotel_id){
        $packagetempbooking = HotelBooking::where('id',$request->hotel_id)->first();

        if (!$packagetempbooking) {
            return response()->json(['message' => 'Package booking not found', 'status' => 201], 404);
        }
    
        $final_price = ($packagetempbooking->total_cost ?? 0) + ($request->agent_margin ?? 0);
    
        $packagebooking = new HotelBooking2();
        $packagebooking->hotel_order_id = $request->hotel_id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->hotel_id = $packagetempbooking->package_id;
        $packagebooking->fetched_price = $packagetempbooking->total_cost;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0; // assuming status 0 is default, change if needed
        $packagebooking->save();
        $packagetempbooking->update(['status' => 1]);
    
        $data = [
            'id' => $packagebooking->id,
            'hotel_order_id' => $packagebooking->hotel_order_id,
            'fetched_price' => $packagebooking->fetched_price,
            'agent_margin' => $packagebooking->agent_margin,
            'final_price' => $packagebooking->final_price,
            'salesman_name' => $packagebooking->salesman_name,
            'salesman_mobile' => $packagebooking->salesman_mobile,
            'status' => $packagebooking->status,
        ];
    }elseif($safari_id){
        $packagetempbooking = WildlifeSafariOrder::where('id',$request->safari_id)->first();

        if (!$packagetempbooking) {
            return response()->json(['message' => 'Package booking not found', 'status' => 201], 404);
        }
    
        $final_price = ($packagetempbooking->total_cost ?? 0) + ($request->agent_margin ?? 0);
    
        $packagebooking = new WildlifeSafariOrder2();
        $packagebooking->safari_order_id = $request->safari_id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->safari_id = $packagetempbooking->safari_id;
        $packagebooking->fetched_price = $packagetempbooking->total_cost;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0; // assuming status 0 is default, change if needed
        $packagebooking->save();
        $packagetempbooking->update(['status' => 1]);
    
        $data = [
            'id' => $packagebooking->id,
            'safari_order_id' => $packagebooking->safari_order_id,
            'fetched_price' => $packagebooking->fetched_price,
            'agent_margin' => $packagebooking->agent_margin,
            'final_price' => $packagebooking->final_price,
            'salesman_name' => $packagebooking->salesman_name,
            'salesman_mobile' => $packagebooking->salesman_mobile,
            'status' => $packagebooking->status,
        ];
    }elseif($guide_id){
        $packagetempbooking = TripGuideBook::where('id',$request->guide_id)->first();

        if (!$packagetempbooking) {
            return response()->json(['message' => 'Package booking not found','status' => 201], 404);
        }
    
        $final_price = ($packagetempbooking->total_cost ?? 0) + ($request->agent_margin ?? 0);
    
        $packagebooking = new TripGuideBook2();
        $packagebooking->guide_order_id = $request->guide_id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->guide_id = $packagetempbooking->tour_guide_id;
        $packagebooking->fetched_price = $packagetempbooking->total_cost;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0; // assuming status 0 is default, change if needed
        $packagebooking->save();
        $packagetempbooking->update(['status' => 1]);
    
        $data = [
            'id' => $packagebooking->id,
            'guide_order_id' => $packagebooking->guide_order_id,
            'fetched_price' => $packagebooking->fetched_price,
            'agent_margin' => $packagebooking->agent_margin,
            'final_price' => $packagebooking->final_price,
            'salesman_name' => $packagebooking->salesman_name,
            'salesman_mobile' => $packagebooking->salesman_mobile,
            'status' => $packagebooking->status,
        ];
    }else{
        $packagetempbooking = TaxiBooking::where('id',$request->taxi_id)->first();

        if (!$packagetempbooking) {
            return response()->json([
                'message' => 'Package booking not found',
                'status' => 201
            ], 404);
        }
    
        $final_price = ($packagetempbooking->total_cost ?? 0) + ($request->agent_margin ?? 0);
    
        $packagebooking = new TaxiBooking2();
        $packagebooking->taxi_order_id = $request->taxi_id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->tour_type = $packagetempbooking->tour_type;
        $packagebooking->fetched_price = $packagetempbooking->total_cost;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0; // assuming status 0 is default, change if needed
        $packagebooking->save();
        $packagetempbooking->update(['status' => 1]);
    
        $data = [
            'id' => $packagebooking->id,
            'guide_order_id' => $packagebooking->guide_order_id,
            'fetched_price' => $packagebooking->fetched_price,
            'agent_margin' => $packagebooking->agent_margin,
            'final_price' => $packagebooking->final_price,
            'salesman_name' => $packagebooking->salesman_name,
            'salesman_mobile' => $packagebooking->salesman_mobile,
            'status' => $packagebooking->status,
        ];
    }

    return response()->json([
        'message' => 'Package Booking Created Successfully',
        'data' => $data,
        'status' => 200,
    ], 200);
}


// ======================================= Booking Confirm end ========================================


public function city(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {
        
        // Fetch all routes (RoundTrips)
        $roundTrips = Route::all();

        // Map each round trip data
        $roundTripsData = $roundTrips->map(function ($route) {
            return [
                'id' => $route->id,
                'from_destination' => $route->from_destination,
                'to_destination' => $route->to_destination,
                'city_image' => $route->city_image ? asset($route->city_image) : null,
            ];
        });

        return response()->json([
            'message' => 'RoundTrip fetched successfully.',
            'data' => $roundTripsData, // Returning the mapped data
            'status' => 200
        ], 200);
    }

    return response()->json([
        'message' => 'Unauthenticated',
        'data' => [],
        'status' => 201,
    ], 401);
}


public function bookGuide(Request $request)
{
    
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {

    // If authentication is successful, proceed with the booking process
    $validator = Validator::make($request->all(), [
        // 'state_id' => 'required',
        'city_id' => 'required',
        'languages_id' => 'required',
        // 'tour_guide_id' => 'required',
        'guide_type' => 'required',
        // 'cost' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 201,
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 422);
    }

    try {

        $cityId = $request->city_id;
        $languageId = $request->languages_id;
    
        // Query the TripGuide model based on city and language
        $tripguide = TripGuide::where('city_id', $cityId)
                              ->where('languages_id', $languageId)
                              ->first();
    
    
        if ($tripguide) {
            $guideTypes = explode(',', $tripguide->guide_type);

        $tripGuide = new TripGuideBook();

        $tripGuide->user_id = $user->id;
        $tripGuide->tour_guide_id = $tripguide->id;
        $tripGuide->languages_id = $request->languages_id;
        $tripGuide->state_id = $request->state_id;
        $tripGuide->location = $request->location;
        $tripGuide->guide_type = $request->guide_type;
        $tripGuide->cost = $tripguide->cost;
        $tripGuide->status = 0; 
        }else{
            return response()->json([
            'status' => 200,
            'message' => 'The selected guide type is not valid for this tour guide!',
            'data' => []
        ], 201);
        }

        $tripGuide->save();
        $tripGuide->makeHidden('updated_at','created_at');

        return response()->json([
            'status' => 200,
            'message' => 'Tour Guide Booked Successfully!',
            'data' => $tripGuide
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 201,
            'message' => 'Failed to book the tour guide. Please try again later.',
            'error' => $e->getMessage()
        ], 500);
    }
}
return response()->json([
    'message' => 'Unauthenticated',
    'data' => [],
    'status' => 201,
], 401);
}


public function guideCity(Request $request)
{
    $tripguides = TripGuide::latest()->get();

    $cities = City::whereIn('id', $tripguides->pluck('city_id'))->get(['id', 'city_name']);

    return response()->json([
        'message' => 'Guide Cities Fetched Successfully.',
        'data' => $cities,
        'status' => 200,
    ]);
}



public function getLanguages(Request $request)
{
    $validated = $request->validate([
        'city_id' => 'required|integer',
    ]);

    $tripGuides = TripGuide::where('city_id', $request->city_id)->get();

    $languages = $tripGuides->map(function ($guide) {
        return $guide->languages_id; 
    })->unique();

    $languageNames = Languages::whereIn('id', $languages)->get(['id', 'language_name']);

    $formattedLanguages = $languageNames->map(function($language) {
        return [
            'id' => $language->id,
            'language_name' => $language->language_name,
        ];
    });

    return response()->json([
        'message' => 'Languages fetched successfully.',
        'data' => $formattedLanguages,
        'status' => 200
    ], 200);
}




    public function airport()
    {
        $airports = Airport::all();

        $response = [];

        foreach ($airports as $airport) {
            $response[] = [
                'id' => $airport->id,  
                'airport' => $airport->airport,  
                'railway' => $airport->railway, 
                'vehicle_id' => $airport->vehicle_id, 
                'description' => strip_tags($airport->description), 
            ];
        }

        return response()->json([
            'message' => 'Data Fetch Succesfully',
            'data' => $response,
            'status' => 200,
        ],
        );
    }


    private function getStatusLabel($status) {
        $statusLabels = [
            0 => 'pending',  
            1 => 'complete', 
            2 => 'reject',   
        ];
    
        return $statusLabels[$status] ?? 'unknown';  // Default to 'unknown' if status doesn't match any of the values
    }
    

    public function allbookings(Request $request) {
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
    
        if ($user && $password == $user->password) {
            $bookings = collect(); // Initialize an empty collection to store all bookings
    
            // Fetch hotel bookings
            $hotelBookings = HotelBooking2::where('user_id', $user->id)->get();
            foreach ($hotelBookings as $booking) {
                $hotel = Hotels::find($booking->hotel_id);
    
                if ($hotel) {
                    $imagePaths = $hotel->images;
    
                    if (is_string($imagePaths)) {
                        $imagePaths = json_decode($imagePaths, true);
                    }
    
                    if (!is_array($imagePaths)) {
                        $imagePaths = [$imagePaths];
                    }
    
                    $baseUrl = url('');
                    $fullImageUrls = array_map(function ($image) use ($baseUrl) {
                        return $baseUrl . '/' . ltrim($image, '/');
                    }, $imagePaths);
    
                    $booking->image = $fullImageUrls;
                } else {
                    $booking->image = [];
                }
    
                // Add booking_name for hotel bookings
                $booking->booking_name = 'hotel';
                $booking->status_label = $this->getStatusLabel($booking->status); // Use status from booking
                $bookings->push($booking); // Add hotel booking to the collection
            }
    
            // Fetch package bookings
            $packageBookings = PackageBooking::where('user_id', $user->id)->get();
            foreach ($packageBookings as $booking) {
                $package = Package::find($booking->package_id);
    
                if ($package) {
                    $imagePaths = $package->image;
    
                    if (is_string($imagePaths)) {
                        $imagePaths = json_decode($imagePaths, true);
                    }
    
                    if (!is_array($imagePaths)) {
                        $imagePaths = [$imagePaths];
                    }
    
                    $baseUrl = url('');
                    $fullImageUrls = array_map(function ($image) use ($baseUrl) {
                        return $baseUrl . '/' . ltrim($image, '/');
                    }, $imagePaths);
    
                    $booking->image = array_values($fullImageUrls);
                } else {
                    $booking->image = [];
                }
    
                // Add booking_name for package bookings
                $booking->booking_name = 'package';
                $booking->status_label = $this->getStatusLabel($booking->status); // Use status from booking
                $bookings->push($booking); // Add package booking to the collection
            }
    
            // Fetch safari bookings
            $safariBookings = WildlifeSafariOrder2::where('user_id', $user->id)->get();
            foreach ($safariBookings as $booking) {
                $safari = WildlifeSafari::find($booking->safari_id);
    
                if ($safari) {
                    $imagePaths = $safari->image;
    
                    if (is_string($imagePaths)) {
                        $imagePaths = json_decode($imagePaths, true);
                    }
    
                    if (!is_array($imagePaths)) {
                        $imagePaths = [$imagePaths];
                    }
    
                    $baseUrl = url('');
                    $fullImageUrls = array_map(function ($image) use ($baseUrl) {
                        return $baseUrl . '/' . ltrim($image, '/');
                    }, $imagePaths);
    
                    $booking->image = array_values($fullImageUrls);
                } else {
                    $booking->image = [];
                }
    
                // Add booking_name for safari bookings
                $booking->booking_name = 'safari';
                $booking->status_label = $this->getStatusLabel($booking->status); // Use status from booking
                $bookings->push($booking); // Add safari booking to the collection
            }
    
            // Fetch taxi bookings
            $taxiBookings = TaxiBooking2::where('user_id', $user->id)->get();
            foreach ($taxiBookings as $booking) {
                $vehicleId_1 = $booking->taxi_order_id;
                $vh = TaxiBooking::find($vehicleId_1);

                $vehicleId = $vh->vehicle_id ?: $vh->vehicle_id_1;
    
                if ($vehicleId) {
                    $vehicle = Vehicle::find($vehicleId);
    
                    if ($vehicle) {
                        $imagePath = $vehicle->image;
                        if ($imagePath) {
                            $baseUrl = url('');
                            $fullImageUrl = $baseUrl . '/' . ltrim($imagePath, '/');
                            $booking->image = [$fullImageUrl];
                        } else {
                            $booking->image = [];
                        }
                    } else {
                        $booking->image = [];
                    }
                } else {
                    $booking->image = [];
                }
    
                // Add booking_name for taxi bookings
                $booking->booking_name = 'taxi';
                $booking->status_label = $this->getStatusLabel($booking->status); // Use status from booking
                $bookings->push($booking); // Add taxi booking to the collection
            }


            $taxiBookings = TripGuideBook2::where('user_id', $user->id)->get();
            foreach ($taxiBookings as $booking) {
                $vehicleId = $booking->	guide_id;
    
                    $vehicle = TripGuide::find($vehicleId);
    
                    if ($vehicle) {
                        $imagePaths = $safari->image;
        
                        if (is_string($imagePaths)) {
                            $imagePaths = json_decode($imagePaths, true);
                        }
        
                        if (!is_array($imagePaths)) {
                            $imagePaths = [$imagePaths];
                        }
        
                        $baseUrl = url('');
                        $fullImageUrls = array_map(function ($image) use ($baseUrl) {
                            return $baseUrl . '/' . ltrim($image, '/');
                        }, $imagePaths);
        
                        $booking->image = array_values($fullImageUrls);
                    } else {
                        $booking->image = [];
                    }
                
    
                // Add booking_name for taxi bookings
                $booking->booking_name = 'guide';
                $booking->status_label = $this->getStatusLabel($booking->status); // Use status from booking
                $bookings->push($booking); // Add taxi booking to the collection
            }
    
            $bookings->each(function ($booking) {
                $booking->makeHidden(['updated_at', 'deleted_at']);
            });
    
            // Return the response with the message and data
            return response()->json([
                'message' => 'Data fetched successfully',
                'data' => $bookings,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthenticated. Invalid credentials.',
                'data' => [],
                'status' => 401,
            ], 401);
        }
    }
    
    // Helper method to get the status label
   
    


    // public function allbookings(Request $request) {
    //     $token = $request->bearerToken();
    
    //     if (!$token) {
    //         return response()->json([
    //             'message' => 'Unauthenticated.',
    //             'data' => [],
    //             'status' => 401,
    //         ]);
    //     }
    
    //     $decodedToken = base64_decode($token);
    //     list($email, $password) = explode(',', $decodedToken);
    
    //     $user = Agent::where('email', $email)->first();
    
    //     if ($user && $password == $user->password) {
    //         $type = $request->input('type');
    //         $status = (int) $request->input('status'); 
    
    //         $bookings = [];
    
    //         switch ($type) {
    //             case 'hotel':
    //                 $bookings = HotelBooking::where('user_id', $user->id)
    //                     ->where('status', $status)
    //                     ->get();
    
    //                 foreach ($bookings as $booking) {
        
    //                     $hotel = Hotels::find($booking->hotel_id);
                        
    //                     if ($hotel) {
    //                         $imagePaths = $hotel->images;
    
    //                         if (is_string($imagePaths)) {
            
    //                             $imagePaths = json_decode($imagePaths, true);
    //                         }
    
    //                         if (!is_array($imagePaths)) {
    //                             $imagePaths = [$imagePaths];
    //                         }
    
    //                         $baseUrl = url('');
    //                         $fullImageUrls = array_map(function ($image) use ($baseUrl) {

    //                             return $baseUrl . '/' . ltrim($image, '/');
    //                         }, $imagePaths);
    
    //                         $booking->hotel_images = $fullImageUrls;
    //                     } else {
    //                         $booking->hotel_images = []; 
    //                     }
    //                 }
    //                 break;
    
    //             case 'package':
    //                 $bookings = PackageBooking::where('user_id', $user->id)
    //                     ->where('status', $status) 
    //                     ->get();
    

    //                 foreach ($bookings as $booking) {

    //                     $package = Package::find($booking->package_id);  
    
    //                     if ($package) {
    //                         $imagePaths = $package->image;
    
    //                         if (is_string($imagePaths)) {

    //                             $imagePaths = json_decode($imagePaths, true);
    //                         }

    //                         if (!is_array($imagePaths)) {
    //                             $imagePaths = [$imagePaths];
    //                         }

    //                         $baseUrl = url(''); 

    //                         $fullImageUrls = array_map(function ($image) use ($baseUrl) {

    //                             return $baseUrl . '/' . ltrim($image, '/');
    //                         }, $imagePaths);
    
    //                         $booking->package_images = array_values($fullImageUrls); 
    //                     } else {
    //                         $booking->package_images = [];
    //                     }
    //                 }
    //                 break;
    
    //             case 'safari':
    //                 $bookings = WildlifeSafariOrder::where('user_id', $user->id)
    //                     ->where('status', $status) 
    //                     ->get();
    
    //                 foreach ($bookings as $booking) {
  
    //                     $safari = WildlifeSafari::find($booking->safari_id);  
                        
    //                     if ($safari) {

    //                         $imagePaths = $safari->image;

    //                         if (is_string($imagePaths)) {

    //                             $imagePaths = json_decode($imagePaths, true);
    //                         }

    //                         if (!is_array($imagePaths)) {
    //                             $imagePaths = [$imagePaths];
    //                         }
    
    //                         $baseUrl = url(''); 

    //                         $fullImageUrls = array_map(function ($image) use ($baseUrl) {

    //                             return $baseUrl . '/' . ltrim($image, '/');
    //                         }, $imagePaths);
    
    //                         $booking->safari_images = array_values($fullImageUrls); 
    //                     } else {
    //                         $booking->safari_images = [];
    //                     }
    //                 }
    //                 break;

    //                 case 'taxi':
    //                     $bookings = TaxiBooking::where('user_id', $user->id)
    //                         ->where('status', $status)
    //                         ->get();

    //                     foreach ($bookings as $booking) {
    //                         $vehicleId = $booking->vehicle_id ?: $booking->vehicle_id_1; 
                    
    //                         if ($vehicleId) {
    //                             $vehicle = Vehicle::find($vehicleId);  
                                
    //                             if ($vehicle) {
    //                                 $imagePath = $vehicle->image;
    //                                 if ($imagePath) {
    //                                     $baseUrl = url(''); 
    //                                     $fullImageUrl = $baseUrl . '/' . ltrim($imagePath, '/');
    //                                     $booking->vehicle_images = [$fullImageUrl]; 
    //                                 } else {
    //                                     $booking->vehicle_images = []; 
    //                                 }
    //                             } else {
    //                                 $booking->vehicle_images = []; 
    //                             }
    //                         } else {
    //                             $booking->vehicle_images = [];
    //                         }
    //                     }
    //                     break;
    
    //             default:
    //                 return response()->json([
    //                     'message' => 'Invalid booking type',
    //                     'data' => null,
    //                     'status' => 400,
    //                 ]);
    //         }
    
    //         $statusLabels = [
    //             0 => 'pending',
    //             1 => 'complete',
    //             2 => 'reject',
    //         ];
    
    //         // Transform the result to include the status label
    //         $bookings = $bookings->map(function ($booking) use ($statusLabels) {
    //             $booking->status_label = $statusLabels[$booking->status];
    //             return $booking;
    //         });
    
    //         // Make hidden specific fields
    //         $bookings->makeHidden(['created_at','updated_at','deleted_at']);
    
    //         // Return the response with the message and data
    //         return response()->json([
    //             'message' => 'Data fetched successfully',
    //             'data' => $bookings,
    //             'status' => 200,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Unauthenticated. Invalid credentials.',
    //             'data' => [],
    //             'status' => 401,
    //         ], 401);
    //     }
    // }


    public function popularCity(Request $request)
    {

        $popularCities = DB::table('package_booking')
            ->selectRaw('count(*) as bookings_count, package.city_id')
            ->join('package', 'package_booking.package_id', '=', 'package.id')
            ->join('all_cities', 'package.city_id', '=', 'all_cities.id')
            ->groupBy('package.city_id')
            ->orderByDesc('bookings_count')
            ->get(); 

        $hotelBookings = DB::table('hotel_booking_2') 
            ->selectRaw('count(*) as bookings_count, hotels.city_id')
            ->join('hotels', 'hotel_booking_2.hotel_id', '=', 'hotels.id')
            ->join('all_cities', 'hotels.city_id', '=', 'all_cities.id')
            ->groupBy('hotels.city_id')
            ->get(); 
    
        $safariBookings = DB::table('wildlife_safari_order_2')
            ->selectRaw('count(*) as bookings_count, wildlife_safari.city_id')
            ->join('wildlife_safari', 'wildlife_safari_order_2.safari_id', '=', 'wildlife_safari.id')
            ->join('all_cities', 'wildlife_safari.city_id', '=', 'all_cities.id')
            ->groupBy('wildlife_safari.city_id')
            ->get();

        $allCities = $popularCities->merge($hotelBookings)->merge($safariBookings);
    
        if ($allCities->isEmpty()) {
            return response()->json([
                'message' => 'No bookings found.',
                'data' => [],
                'status' => 404,
            ]);
        }
    
        $groupedCities = $allCities->groupBy('city_id')->map(function ($cities) {
            return $cities->sum('bookings_count');
        });
    
        $sortedCities = $groupedCities->sortDesc();
    
        $responseCities = $sortedCities->map(function ($bookingsCount, $cityId) {
            $cityName = \DB::table('all_cities')->where('id', $cityId)->value('city_name');
            return [
                'city_name' => $cityName,
                'bookings_count' => $bookingsCount,
            ];
        });
    
        return response()->json([
            'message' => 'Most popular cities fetched successfully.',
            'data' => $responseCities->values(),
            'status' => 200,
        ]);
    }
    
    

    


    public function packagesearch(Request $request)
    {
        // Get the search term from the request (if any)
        $searchTerm = $request->get('package_name');
    
        // Get all packages by default
        $packagesQuery = Package::query();
    
        // If a search term is provided, filter the packages by package_name
        if ($searchTerm) {
            $packagesQuery->where('package_name', 'like', '%' . $searchTerm . '%');
        }
    
        // Get the packages (either all or filtered by package_name)
        $packages = $packagesQuery->get();
    
        // If no packages are found, return a message
        if ($packages->isEmpty()) {
            return response()->json([
                'message' => 'No packages found matching the search term.',
                'data' => [],
                'status' => 404,
            ], 404);
        }
    
        // Get all states and cities as you did before
        $states = State::all()->pluck('state_name', 'id');
        $cities = City::all()->pluck('city_name', 'id');
    
        // Map through the packages and return the necessary data
        $hotelData = $packages->map(function($package) use ($states, $cities) {
    
            // Get the images
            $imageUrls = array_values(json_decode($package->image, true));
    
            // Get state and city names
            $stateNames = $this->getNamesByIds($package->state_id, $states);
            $cityNames = $this->getNamesByIds($package->city_id, $cities);
    
            $today = Carbon::today()->format('Y-m');
    
            $packagePrice = PackagePrice::where('package_id', $package->id)
                ->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->get();
    
            // Get prices
            $prices = null;
            if ($packagePrice) {
                $prices = $packagePrice->map(function ($price) {
                    return [
                        'id' => $price->id,
                        'start_date' => Carbon::parse($price->start_date)->format('F Y'),
                        'end_date' => Carbon::parse($price->end_date)->format('F Y'),
                        'total_cost' => 
                            $price->standard_cost ?? 0 +
                            $price->deluxe_cost ?? 0 +
                            $price->premium_cost ?? 0 +
                            $price->super_deluxe_cost ?? 0 +
                            $price->luxury_cost ?? 0 +
                            $price->nights_cost ?? 0 +
                            $price->adults_cost ?? 0 +
                            $price->child_with_bed_cost ?? 0 +
                            $price->child_no_bed_infant_cost ?? 0 +
                            $price->child_no_bed_child_cost ?? 0 +
                            $price->meal_plan_only_room_cost ?? 0 +
                            $price->meal_plan_breakfast_cost ?? 0 +
                            $price->meal_plan_breakfast_lunch_dinner_cost ?? 0 +
                            $price->meal_plan_all_meals_cost ?? 0 +
                            $price->hatchback_cost ?? 0 +
                            $price->sedan_cost ?? 0 +
                            $price->economy_suv_cost ?? 0 +
                            $price->luxury_suv_cost ?? 0 +
                            $price->traveller_mini_cost ?? 0 +
                            $price->traveller_big_cost ?? 0 +
                            $price->premium_traveller_cost ?? 0 +
                            $price->ac_coach_cost ?? 0 +
                            $price->extra_bed_cost ?? 0
                    ];
                });
            }
    
            // return [
            //     'id' => $package->id,
            //     'package_name' => $package->package_name,
            //     'state_names' => $stateNames,
            //     'city_names' => $cityNames,
            //     'image' => array_map(function($image) {
            //         return url('') . '/' . $image;
            //     }, $imageUrls),
            //     'video' => array_map(function($video) {
            //         return url('') . '/' . $video;
            //     }, json_decode($package->video, true)),
            //     'pdf' => url('') . '/' . $package->pdf,
            //     'text_description' => strip_tags($package->text_description),
            //     'text_description_2' => strip_tags($package->text_description_2),
            //     'prices' => $prices,
            // ];
            return [
                'id' => $package->id,
                'package_name' => $package->package_name,
                'state_names' => $stateNames,
                'city_names' => $cityNames,
                'image' => array_map(function($image) {
                    return url('') . '/' . $image;
                }, $imageUrls),
                'video' => is_array($videoArray = json_decode($package->video, true)) ? array_map(function($video) {
                    return url('') . '/' . $video;
                }, $videoArray) : [], // If it's not an array or invalid JSON, return an empty array
                'pdf' => url('') . '/' . $package->pdf,
                'text_description' => strip_tags($package->text_description),
                'text_description_2' => strip_tags($package->text_description_2),
                'prices' => $prices,
            ];
        });
    
        return response()->json([
            'message' => 'Package search results fetched successfully.',
            'data' => $hotelData,
            'status' => 200,
        ], 200);
    }
    
    
    public function add_wallet(Request $request)
{
    // Step 1: Validate the request
    $request->validate([
        'transaction_type' => 'required|string',
        'amount' => 'required|numeric',
        'note' => 'nullable|string',
    ]);

    // Step 2: Get and validate the Bearer token
    $token = $request->bearerToken();
    
    if (!$token) {
        return response()->json([
            'message' => 'Unauthenticated.',
            'data' => [],
            'status' => 401,
        ]);
    }

    // Step 3: Decode the token and authenticate the user
    $decodedToken = base64_decode($token); 
    list($email, $password) = explode(',', $decodedToken);

    // Find the agent based on the decoded email
    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json([
            'message' => 'Invalid credentials.',
            'data' => [],
            'status' => 401,
        ]);
    }

    // Step 4: Create the wallet transaction
    $wallet = new Wallet;
    $wallet->user_id = $user->id; // Use the authenticated agent's ID
    $wallet->transaction_type = $request->transaction_type;
    $wallet->amount = $request->amount;
    $wallet->note = $request->note ?? '';  // Default to an empty string if note is not provided
    $wallet->status = 0;  // Set status to 0 (pending)
    $wallet->save();

    // Step 5: Return success response
    return response()->json([
        'message' => 'Wallet transaction added successfully.',
        'data' => [
            'transaction_id' => $wallet->id,
            'transaction_type' => $wallet->transaction_type,
            'amount' => $wallet->amount,
            'note' => $wallet->note,
            'status' => $wallet->status,
            'created_at' => $wallet->created_at->toDateTimeString(),
        ],
        'status' => 200,
    ]);
}


 public function get_user_transactions(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'data' => [],
                'status' => 201,
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

        $transactions = Wallet::where('user_id', $user->id)->get();

        $totalAmount = $transactions->where('transaction_type', 'recharge')->sum('amount');

        $transactionData = $transactions->map(function($transaction) {
            $formattedTransaction = [
                'transaction_id' => $transaction->id,
                'transaction_type' => $transaction->transaction_type,
                'amount' => $transaction->amount,
                'note' => $transaction->note,
                'status' => $transaction->status,
                'created_at' => $transaction->created_at->toDateTimeString(),
            ];

            if ($transaction->transaction_type == 'recharge') {
                return $formattedTransaction;
            }

            if ($transaction->transaction_type == 'refund') {
                if ($transaction->status == 0) {
                    $formattedTransaction['status_text'] = 'Pending';
                } elseif ($transaction->status == 1) {
                    $formattedTransaction['status_text'] = 'Accepted';
                } elseif ($transaction->status == 2) {
                    $formattedTransaction['status_text'] = 'Rejected';
                }
                return $formattedTransaction;
            }

            return $formattedTransaction;
        });

        return response()->json([
            'message' => 'Transactions fetched successfully.',
            'data' => [
                'transactions' => $transactionData,
                'total_amount' => $totalAmount,
            ],
            'status' => 200,
        ]);
    }


    public function admin_city(Request $request)
    {
        // Get the bearer token from the request
        $token = $request->bearerToken();
        
        // Check if the token is provided
        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'data' => [],
                'status' => 201,
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

        $data = AdminCity::all();

        return response()->json([
            'message' => 'Cities fetched successfully.',
            'data' => $data->map(function ($city) {
                return [
                    'id' => $city->id,
                    'state_id' => $city->state_id,
                    'city_name' => $city->city_name,
                    'status' => $city->status,
                ];
            }),
            'status' => 200,
        ]);
    }




    public function airport_vehicle(Request $request)
    {
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

        $cityId = $request->input('city_id');

        if (!$cityId) {
            return response()->json([
                'message' => 'City ID is required.',
                'data' => [],
                'status' => 400,
            ]);
        }

        $airports = Airport::where('city_id', $cityId)->get();

        if ($airports->isEmpty()) {
            return response()->json([
                'message' => 'No airports found for this city.',
                'data' => [],
                'status' => 404,
            ]);
        }
    
        $airportDetails = [];
    
        foreach ($airports as $airport) {

            $vehicleIds = explode(',', $airport->vehicle_id);

            $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();

            $vehiclePrices = VehiclePrice::whereIn('vehicle_id', $vehicleIds)
                                          ->where('airport_id', $airport->id)
                                          ->get();
    
            $vehiclesWithPrice = $vehicles->map(function ($vehicle) use ($vehiclePrices) {
                $price = $vehiclePrices->where('vehicle_id', $vehicle->id)->first();
    
                return [
                    'id' => $vehicle->id,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'price' => $price ? $price->price : null,
                ];
            });
    
            $airportDetails[] = [
                'airport_id' => $airport->id,
                'airport_name' => $airport->airport,
                'vehicles' => $vehiclesWithPrice
            ];
        }
    
        return response()->json([
            'message' => 'Airports and their vehicles fetched successfully.',
            'data' => $airportDetails,
            'status' => 200,
        ]);
    }


    public function local_vehicle(Request $request)
    {
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
    
        $cityId = $request->input('city_id');
    
        if (!$cityId) {
            return response()->json([
                'message' => 'City ID is required.',
                'data' => [],
                'status' => 400,
            ]);
        }
    
        $airports = LocalVehiclePrice::where('city_id', $cityId)->get();

        if ($airports->isEmpty()) {
            return response()->json([
                'message' => 'No Local Vehicle found for this city.',
                'data' => [],
                'status' => 404,
            ]);
        }
    
        $airportDetails = [];
    
        foreach ($airports as $airport) {
            $vehicleIds = explode(',', $airport->vehicle_id);

            $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();
    
            $vehiclePrices = LocalVehiclePrice::whereIn('vehicle_id', $vehicleIds)
                                          ->get();

            $vehiclesWithPrice = $vehicles->map(function ($vehicle) use ($vehiclePrices,$airport) {
                $price = $vehiclePrices->where('vehicle_id', $vehicle->id)->first();
    
                return [
                    'id' => $vehicle->id,
                    'vehicle_type' => $vehicle->vehicle_type,
                    'price' => $airport->price,
                    'description' => strip_tags($airport->description),
                ];
            });
    
            // $airportDetails[] = [
            //     'id' => $airport->id,
            //     'airport_name' => $airport->airport,
            //     'vehicles' => $vehiclesWithPrice
            // ];
        }
    
        return response()->json([
            'message' => 'Loacl Tour vehicles fetched successfully.',
            'data' => $vehiclesWithPrice,
            'status' => 200,
        ]);
    }
    


    public function constant(Request $request)
    {
       
    
        $constant = Constants::first(); 

        if (!$constant) {
            return response()->json([
                'message' => 'No constant found.',
                'data' => [],
                'status' => 404,
            ]);
        }

        $Constants[] = [
            'id' => $constant->id,
            'agent_fees' => $constant->agent_fees,
        ];
    
        // Return the constants data
        return response()->json([
            'message' => 'Constant data retrieved successfully.',
            'data' => $Constants,
            'status' => 200,
        ]);
    }


    


    
 
}

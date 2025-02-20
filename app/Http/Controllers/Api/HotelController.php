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
use App\Models\HotelPrice;
use App\Models\TaxiBooking;
use App\Models\RoundTrip;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Route;
use App\Models\PackagePrice;
use App\Models\PackageBooking;
use App\Models\PackageBookingTemp;
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

        return response()->json(['message' => 'Unauthenticated'], 401);
    }


    public function filterHotels(Request $request)
{
    // Extract the token for authentication
    $token = $request->bearerToken();
    
    // Check if the token exists
    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
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
    return response()->json(['message' => 'Unauthenticated'], 401);
}



    public function package(Request $request)
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
                });
            // ];

            return response()->json([
                'message' => 'Package fetched successfully.',
                'data' => $hotelData,
                'status' => 200
            ], 200);
        }

        return response()->json(['message' => 'Unauthenticated'], 401);
    }


    public function packagedetailes(Request $request)
{
    $token = $request->bearerToken();
    
    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    // Decode the token
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Verify the user credentials
    $user = Agent::where('email', $email)->first();

    if (!$user || $password !== $user->password) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
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
                + $price->traveller_big_cost + $price->premium_traveller_cost +$price->ac_coach_cost;
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
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    // Decode the token
    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    // Verify the user credentials
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
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $decodedToken = base64_decode($token);

    if (strpos($decodedToken, ',') === false) {
        return response()->json(['message' => 'Invalid token format.'], 400);
    }

    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if ($user && $password == $user->password) {

        // Fetch vehicles with vehiclePrices and outstation relationships
        $vehicles = Vehicle::orderBy('id','DESC')->where('status',1)->with('vehiclePrices', 'outstation','roundtrip')->get();

        // Map vehicle data into desired format
        $vehiclesData = $vehicles->map(function($vehicle) {
            $baseUrl = url('');

            // Handle vehiclePrices: Check if vehiclePrices is not null and map data
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
            'data' => $vehiclesData,
            'status' => 200
        ], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
}





public function statecityhotel(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
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

    return response()->json(['message' => 'Unauthenticated'], 401);
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
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();

    if (!$user || $password != $user->password) {
        return response()->json(['message' => 'Unauthorized. Invalid credentials.'], 401);
    }

    $validatedData = $request->validate([
        'hotel_id' => 'required',
        'city_id' => 'required', 
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
        return response()->json(['message' => 'Unauthorized. Invalid credentials.'], 401);
    }

    $request->validate([
        'location' => 'nullable',
        'vehicle_id' => 'nullable',
        'trip_type' => 'nullable',
        'cost' => 'nullable',
        'city_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'state' => 'nullable',
        'city' => 'nullable',
        'one_way' => 'nullable',
        'description' => 'nullable',
        'trip' => 'nullable',
        'start_date' => 'nullable',
        'end_date' => 'nullable',
        'end_time' => 'nullable',
        'start_time' => 'nullable',
        'pickup_address' => 'nullable',
        'tour_type' => 'required|integer',
        'user_id' => 'nullable',
        'one_way_location' => 'nullable',
        'round_start_location' => 'nullable',
        'round_end_location' => 'nullable',
    ]);

    $tourType = $request->tour_type;
    $data = [];

    if ($tourType == 1) {
        $data = [
            'pickup_address' => $request->pickup_address,
            'location' => $request->location,
            'user_id' => $user->id, // Use $user->id instead of Auth::id()
            'vehicle_id' => $request->vehicle_id,
            'trip' => $request->trip,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time ?? null,
            'end_time' => $request->end_time ?? null,
            'tour_type' => $request->tour_type,
            
        ];
    }

    if ($tourType == 2) {
        $data = [
            'location' => $request->location,
            'vehicle_id' => $request->vehicle_id,
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'tour_type' => $request->tour_type,
            'end_time' => $request->end_time ?? null,
            'start_time' => $request->start_time ?? null,
        ];
    }

    if ($tourType == 3) {
        $cityImagePath = null;
        if ($request->hasFile('city_image')) {
            $cityImagePath = $request->file('city_image')->store('city_images', 'public');
        }
        $data = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $user->id,
            'vehicle_id' => $request->vehicle_id,
            'trip_type' => $request->trip_type,
            'one_way_location' => $request->one_way_location,
            'round_start_location' => $request->round_start_location,
            'round_end_location' => $request->round_end_location,
            'tour_type' => $request->tour_type,
            'city_image' => $cityImagePath,
        ];
    }

    $taxiBooking = TaxiBooking::create($data);

    return response()->json([
        'message' => 'Taxi booking created successfully',
        'data' => $taxiBooking,
        'status' => 200,
    ], 
    201);
}


public function packagebooking(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.', 'status' => 201], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();
    if (!$user || $password != $user->password) {
        return response()->json(['message' => 'Unauthorized. Invalid credentials.', 'status' => 201], 401);
    }

    $request->validate([
        'package_id' => 'required', 'start_date' => 'nullable', 'end_date' => 'nullable',
        'standard_count' => 'nullable|integer', 'premium_count' => 'nullable|integer',
        'deluxe_count' => 'nullable|integer', 'super_deluxe_count' => 'nullable|integer',
        'luxury_count' => 'nullable|integer', 'nights_count' => 'nullable|integer', 'adults_count' => 'nullable|integer',
        'child_with_bed_count' => 'nullable|integer', 'child_no_bed_infant_count' => 'nullable|integer',
        'child_no_bed_child_count' => 'nullable|integer', 'meal_plan_only_room_count' => 'nullable|integer',
        'meal_plan_breakfast_count' => 'nullable|integer', 'meal_plan_breakfast_lunch_dinner_count' => 'nullable|integer',
        'meal_plan_all_meals_count' => 'nullable|integer', 'hatchback_count' => 'nullable|integer',
        'sedan_count' => 'nullable|integer', 'economy_suv_count' => 'nullable|integer', 'luxury_suv_count' => 'nullable|integer',
        'traveller_mini_count' => 'nullable|integer', 'traveller_big_count' => 'nullable|integer',
        'premium_traveller_count' => 'nullable|integer', 'ac_coach_count' => 'nullable|integer'
    ]);

    $start_date = Carbon::parse($request->start_date);
    $end_date = Carbon::parse($request->end_date);
    $nights_count = $start_date->diffInDays($end_date);

    // Create new booking
    $packageBooking = new PackageBookingTemp([
        'user_id' => $user->id, 
        'package_id' => $request->package_id,
        'start_date' => $request->start_date, 
        'end_date' => $request->end_date,
        'nights_count' => $nights_count, 
        'status' => 0
    ]);
    // Set counts
    $packageBooking->fill($request->only([
        'standard_count', 'premium_count', 'deluxe_count', 'super_deluxe_count',
        'luxury_count', 'adults_count', 'child_with_bed_count', 'child_no_bed_infant_count',
        'child_no_bed_child_count', 'meal_plan_only_room_count', 'meal_plan_breakfast_count',
        'meal_plan_breakfast_lunch_dinner_count', 'meal_plan_all_meals_count', 'hatchback_count',
        'sedan_count', 'economy_suv_count', 'luxury_suv_count', 'traveller_mini_count',
        'traveller_big_count', 'premium_traveller_count', 'ac_coach_count'
    ]));

    // Get package price for given package_id and date range
    $formatted_date = Carbon::parse($request->start_date)->format('Y-m');
    $package_price = PackagePrice::where('package_id', $request->package_id)
    ->where('start_date', '<=', $formatted_date)
    ->where('end_date', '>=', $formatted_date)
    ->first();
    // return $package_price;

if ($package_price) {
    $total_cost = 0;
    $fields = [
        'standard', 'premium', 'deluxe', 'super_deluxe', 'luxury', 'nights', 'adults',
        'child_with_bed', 'child_no_bed_infant', 'child_no_bed_child', 'meal_plan_only_room',
        'meal_plan_breakfast', 'meal_plan_breakfast_lunch_dinner', 'meal_plan_all_meals',
        'hatchback', 'sedan', 'economy_suv', 'luxury_suv', 'traveller_mini', 'traveller_big',
        'premium_traveller', 'ac_coach'
    ];

    foreach ($fields as $field) {
        // Ensure count is an integer
        $count = (int) $request->get("{$field}_count", 0);
        
        // Get the cost from the PackagePrice object and ensure it's a float
        $cost = (float) $package_price->{"{$field}_cost"};
        
        // Multiply count and cost and add to the total cost
        $total_cost += $count * $cost;
    }

    $packageBooking->total_cost = $total_cost;
}
$packageBooking->save();
$packageBooking->makeHidden('updated_at','created_at');

    // Save the booking
    // $packageBooking->save();

    return response()->json([
        'message' => 'Package booking created successfully.',
        'data' => $packageBooking,
        'status' => 201
    ], 201);
}


public function packagebookingse(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.', 'status' => 201], 401);
    }

    $decodedToken = base64_decode($token);
    list($email, $password) = explode(',', $decodedToken);

    $user = Agent::where('email', $email)->first();
    if (!$user || $password != $user->password) {
        return response()->json(['message' => 'Unauthorized. Invalid credentials.', 'status' => 201], 401);
    }

    $request->validate([
        'package_id' => 'required', 'start_date' => 'nullable', 'end_date' => 'nullable',
        'standard_count' => 'nullable|integer', 'premium_count' => 'nullable|integer',
        'deluxe_count' => 'nullable|integer', 'super_deluxe_count' => 'nullable|integer',
        'luxury_count' => 'nullable|integer', 'nights_count' => 'nullable|integer', 'adults_count' => 'nullable|integer',
        'child_with_bed_count' => 'nullable|integer', 'child_no_bed_infant_count' => 'nullable|integer',
        'child_no_bed_child_count' => 'nullable|integer', 'meal_plan_only_room_count' => 'nullable|integer',
        'meal_plan_breakfast_count' => 'nullable|integer', 'meal_plan_breakfast_lunch_dinner_count' => 'nullable|integer',
        'meal_plan_all_meals_count' => 'nullable|integer', 'hatchback_count' => 'nullable|integer',
        'sedan_count' => 'nullable|integer', 'economy_suv_count' => 'nullable|integer', 'luxury_suv_count' => 'nullable|integer',
        'traveller_mini_count' => 'nullable|integer', 'traveller_big_count' => 'nullable|integer',
        'premium_traveller_count' => 'nullable|integer', 'ac_coach_count' => 'nullable|integer'
    ]);

    $start_date = Carbon::parse($request->start_date);
    $end_date = Carbon::parse($request->end_date);
    $nights_count = $start_date->diffInDays($end_date);

    // Create new booking
    $packageBooking = new PackageBooking([
        'user_id' => $user->id, 
        'package_id' => $request->package_id,
        'start_date' => $request->start_date, 
        'end_date' => $request->end_date,
        'nights_count' => $nights_count, 
        'status' => 0
    ]);
    // Set counts
    $packageBooking->fill($request->only([
        'standard_count', 'premium_count', 'deluxe_count', 'super_deluxe_count',
        'luxury_count', 'adults_count', 'child_with_bed_count', 'child_no_bed_infant_count',
        'child_no_bed_child_count', 'meal_plan_only_room_count', 'meal_plan_breakfast_count',
        'meal_plan_breakfast_lunch_dinner_count', 'meal_plan_all_meals_count', 'hatchback_count',
        'sedan_count', 'economy_suv_count', 'luxury_suv_count', 'traveller_mini_count',
        'traveller_big_count', 'premium_traveller_count', 'ac_coach_count'
    ]));

    // Get package price for given package_id and date range
    $formatted_date = Carbon::parse($request->start_date)->format('Y-m');
    $package_price = PackagePrice::where('package_id', $request->package_id)
    ->where('start_date', '<=', $formatted_date)
    ->where('end_date', '>=', $formatted_date)
    ->first();
    // return $package_price;

if ($package_price) {
    $total_cost = 0;
    $fields = [
        'standard', 'premium', 'deluxe', 'super_deluxe', 'luxury', 'nights', 'adults',
        'child_with_bed', 'child_no_bed_infant', 'child_no_bed_child', 'meal_plan_only_room',
        'meal_plan_breakfast', 'meal_plan_breakfast_lunch_dinner', 'meal_plan_all_meals',
        'hatchback', 'sedan', 'economy_suv', 'luxury_suv', 'traveller_mini', 'traveller_big',
        'premium_traveller', 'ac_coach'
    ];

    foreach ($fields as $field) {
        // Ensure count is an integer
        $count = (int) $request->get("{$field}_count", 0);
        
        // Get the cost from the PackagePrice object and ensure it's a float
        $cost = (float) $package_price->{"{$field}_cost"};
        
        // Multiply count and cost and add to the total cost
        $total_cost += $count * $cost;
    }

    $packageBooking->total_cost = $total_cost;
}
$packageBooking->save();
$packageBooking->makeHidden('updated_at','created_at');

    // Save the booking
    // $packageBooking->save();

    return response()->json([
        'message' => 'Package booking created successfully.',
        'data' => $packageBooking,
        'status' => 201
    ], 201);
}




// public function packagebooking(Request $request)
// {
//     $token = $request->bearerToken();

//     if (!$token) {
//         return response()->json([
//             'message' => 'Unauthenticated.',
//             'status' => 201,
//             'data' => [],
//         ], 401);
//     }

//     $decodedToken = base64_decode($token);
//     list($email, $password) = explode(',', $decodedToken);

//     $user = Agent::where('email', $email)->first();

//     if (!$user || $password != $user->password) {
//         return response()->json([
//             'message' => 'Unauthorized. Invalid credentials.',
//             'status' => 201,
//         ], 401);
//     }

//     $request->validate([
//         'package_id' => 'required',
//         'start_date' => 'nullable',
//         'end_date' => 'nullable',
//         'standard_count' => 'nullable|integer',
//         'premium_count' => 'nullable|integer',
//         'deluxe_count' => 'nullable|integer',
//         'super_deluxe_count' => 'nullable|integer',
//         'luxury_count' => 'nullable|integer',
//         'nights_count' => 'nullable|integer',
//         'adults_count' => 'nullable|integer',
//         'child_with_bed_count' => 'nullable|integer',
//         'child_no_bed_infant_count' => 'nullable|integer',
//         'child_no_bed_child_count' => 'nullable|integer',
//         'meal_plan_only_room_count' => 'nullable|integer',
//         'meal_plan_breakfast_count' => 'nullable|integer',
//         'meal_plan_breakfast_lunch_dinner_count' => 'nullable|integer',
//         'meal_plan_all_meals_count' => 'nullable|integer',
//         'hatchback_count' => 'nullable|integer',
//         'sedan_count' => 'nullable|integer',
//         'economy_suv_count' => 'nullable|integer',
//         'luxury_suv_count' => 'nullable|integer',
//         'traveller_mini_count' => 'nullable|integer',
//         'traveller_big_count' => 'nullable|integer',
//         'premium_traveller_count' => 'nullable|integer',
//         'ac_coach_count' => 'nullable|integer',
//     ]);

//     $start_date = Carbon::parse($request->start_date);
//     $end_date = Carbon::parse($request->end_date);
  
//     $nights_count = $start_date->diffInDays($end_date);

//     $packageBooking = new PackageBookingTemp();
//     $packageBooking->user_id = $user->id; 
//     $packageBooking->package_id = $request->package_id;
//     $packageBooking->start_date = $request->start_date;
//     $packageBooking->end_date = $request->end_date;
//     $packageBooking->standard_count = $request->standard_count;
//     $packageBooking->premium_count = $request->premium_count;
//     $packageBooking->deluxe_count = $request->deluxe_count;
//     $packageBooking->super_deluxe_count = $request->super_deluxe_count;
//     $packageBooking->luxury_count = $request->luxury_count;
//     $packageBooking->nights_count = $nights_count; 
//     $packageBooking->adults_count = $request->adults_count;
//     $packageBooking->child_with_bed_count = $request->child_with_bed_count;
//     $packageBooking->child_no_bed_infant_count = $request->child_no_bed_infant_count;
//     $packageBooking->child_no_bed_child_count = $request->child_no_bed_child_count;
//     $packageBooking->meal_plan_only_room_count = $request->meal_plan_only_room_count;
//     $packageBooking->meal_plan_breakfast_count = $request->meal_plan_breakfast_count;
//     $packageBooking->meal_plan_breakfast_lunch_dinner_count = $request->meal_plan_breakfast_lunch_dinner_count;
//     $packageBooking->meal_plan_all_meals_count = $request->meal_plan_all_meals_count;
//     $packageBooking->hatchback_count = $request->hatchback_count;
//     $packageBooking->sedan_count = $request->sedan_count;
//     $packageBooking->economy_suv_count = $request->economy_suv_count;
//     $packageBooking->luxury_suv_count = $request->luxury_suv_count;
//     $packageBooking->traveller_mini_count = $request->traveller_mini_count;
//     $packageBooking->traveller_big_count = $request->traveller_big_count;
//     $packageBooking->premium_traveller_count = $request->premium_traveller_count;
//     $packageBooking->ac_coach_count = $request->ac_coach_count;
//     $packageBooking->status = 0;
//     $packageBooking->save();

//     $request_date = \Carbon\Carbon::parse($request->start_date);
//     $formatted_date = $request_date->format('Y-m');

//     $package_price = PackagePrice::where('package_id', $request->package_id)
//         ->where('start_date', '<=', $formatted_date)
//         ->where('end_date', '>=', $formatted_date)
//         ->first();

//     if ($package_price) {
//         $total_standard_cost = $package_price->standard_cost * $request->standard_count;
//         $total_premium_cost = $package_price->premium_cost * $request->premium_count;
//         $total_deluxe_cost = $package_price->deluxe_cost * $request->deluxe_count;
//         $total_super_deluxe_cost = $package_price->super_deluxe_cost * $request->super_deluxe_count;
//         $total_luxury_cost = $package_price->luxury_cost * $request->luxury_count;
//         $total_nights_cost = $package_price->nights_cost * $nights_count;
//         $total_adults_cost = $package_price->adults_cost * $request->adults_count;
//         $total_child_with_bed_cost = $package_price->child_with_bed_cost * $request->child_with_bed_count;
//         $total_child_no_bed_infant_cost = $package_price->child_no_bed_infant_cost * $request->child_no_bed_infant_count;
//         $total_child_no_bed_child_cost = $package_price->child_no_bed_child_cost * $request->child_no_bed_child_count;
//         $total_meal_plan_only_room_cost = $package_price->meal_plan_only_room_cost * $request->meal_plan_only_room_count;
//         $total_meal_plan_breakfast_cost = $package_price->meal_plan_breakfast_cost * $request->meal_plan_breakfast_count;
//         $total_meal_plan_breakfast_lunch_dinner_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost * $request->meal_plan_breakfast_lunch_dinner_count;
//         $total_meal_plan_all_meals_cost = $package_price->meal_plan_all_meals_cost * $request->meal_plan_all_meals_count;
//         $total_hatchback_cost = $package_price->hatchback_cost * $request->hatchback_count;
//         $total_sedan_cost = $package_price->sedan_cost * $request->sedan_count;
//         $total_economy_suv_cost = $package_price->economy_suv_cost * $request->economy_suv_count;
//         $total_luxury_suv_cost = $package_price->luxury_suv_cost * $request->luxury_suv_count;
//         $total_traveller_mini_cost = $package_price->traveller_mini_cost * $request->traveller_mini_count;
//         $total_traveller_big_cost = $package_price->traveller_big_cost * $request->traveller_big_count;
//         $total_premium_traveller_cost = $package_price->premium_traveller_cost * $request->premium_traveller_count;
//         $total_ac_coach_cost = $package_price->ac_coach_cost * $request->ac_coach_count;

//         $total_cost = $total_standard_cost + $total_premium_cost + $total_deluxe_cost + $total_super_deluxe_cost +
//             $total_luxury_cost + $total_nights_cost + $total_adults_cost + $total_child_with_bed_cost +
//             $total_child_no_bed_infant_cost + $total_child_no_bed_child_cost + $total_meal_plan_only_room_cost +
//             $total_meal_plan_breakfast_cost + $total_meal_plan_breakfast_lunch_dinner_cost + $total_meal_plan_all_meals_cost +
//             $total_hatchback_cost + $total_sedan_cost + $total_economy_suv_cost + $total_luxury_suv_cost +
//             $total_traveller_mini_cost + $total_traveller_big_cost + $total_premium_traveller_cost + $total_ac_coach_cost;

//         $packageBooking->total_cost = $total_cost;
//     }

//     // $packageBooking->save();

//     return response()->json([
//         'message' => 'Package booking created successfully.',
//         'data' => $packageBooking,
//         'status' => 201,
//     ], 201);
// }



public function city(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
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
            ];
        });

        return response()->json([
            'message' => 'RoundTrip fetched successfully.',
            'data' => $roundTripsData, // Returning the mapped data
            'status' => 200
        ], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
}


 
}

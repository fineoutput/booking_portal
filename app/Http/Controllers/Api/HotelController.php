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
use Carbon\Carbon;
use App\Models\City;
use App\Models\PackagePrice;
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

        $vehicles = Vehicle::orderBy('id','DESC')->where('status',1)->with('vehiclePrices')->get();

        $vehiclesData = $vehicles->map(function($vehicle) {
            $baseUrl = url('');

            $vehiclePrices = $vehicle->vehiclePrices;

            $pricesData = $vehiclePrices->map(function($price) {
                return [
                    'id' => $price->id,
                    'price' => $price->price,
                    'city' => $price->city,
                    'type' => $price->type,
                    'description' => strip_tags($price->description),
                ];
            });

            return [
                'id' => $vehicle->id,
                'vehicle_type' => $vehicle->vehicle_type,
                'description' => strip_tags($vehicle->description),
                'prices' => $pricesData,
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
            'status' => 201,
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
        'location' => 'nullable|string',
        'vehicle_id' => 'nullable|integer',
        'trip_type' => 'nullable|string',
        'cost' => 'nullable|numeric',
        'image' => 'nullable|image',
        'state' => 'nullable|string',
        'city' => 'nullable|string',
        'one_way' => 'nullable|boolean',
        'description' => 'nullable|string',
        'trip' => 'nullable|string',
        'start_date' => 'nullable|date',
        'start_time' => 'nullable',
        'pickup_address' => 'nullable|string',
        'tour_type' => 'required|integer',
        'user_id' => 'nullable|integer',
    ]);


    $tourType = $request->tour_type;
    $data = [];

    // $data['location'] = $request->location;
    // $data['vehicle_id'] = $request->vehicle_id;
    // $data['trip_type'] = $request->trip_type;
    // $data['cost'] = $request->cost;

    if ($tourType == 1) {
        $data =  [
            'pickup_address' => $request->pickup_address,
            'location' => $request->location,
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'trip_type' => $request->trip_type,
            'trip' => $request->trip,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time ?? null,
            'cost' => $request->cost,
        ];
    }

    if ($tourType == 2) {
        $data =  [
            'image' => $request->file('image') ? $request->file('image')->store('taxi_images') : null,
            'state' => $request->state,
            'city' => $request->city,
            'user_id' => Auth::id(),
            'one_way' => $request->one_way,
            'description' => $request->description,
        ];
    }

    if ($tourType == 3) {
        $data =  [
            'start_date' => $request->start_date,
            'user_id' => Auth::id(),
            'start_time' => $request->start_time ?? null,
            'pickup_address' => $request->pickup_address,
        ];
    }

    $taxiBooking = TaxiBooking::create($data);

    return response()->json([
        'message' => 'Taxi booking created successfully',
        'data' => $taxiBooking,
    ], 201);
}

 
}

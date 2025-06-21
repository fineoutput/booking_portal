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
use App\Models\WildlifeSafari;
use App\Models\Languages;
use App\Models\TripGuide;
use App\Models\WildlifeSafariOrder;
use App\Models\Route;
use App\Models\State;
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



class SafariController extends Controller
{

public function alldata(Request $request)
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

    if (!$user || $user->password !== $password) {
        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    // Common filters
    $stateId = $request->input('state_id');
    $cityId = $request->input('city_id');
    $timing_value = $request->input('time');
    $min_price = $request->input('min_price', 0);
    $max_price = $request->input('max_price', 10000000);

    $states = State::all()->pluck('state_name', 'id');
    $cities = City::all()->pluck('city_name', 'id');

    // ================= PACKAGE DATA ================= //
    $packageQuery = Package::query();

    if ($stateId) $packageQuery->where('state_id', $stateId);
    if ($cityId) $packageQuery->where('city_id', $cityId);

    if ($min_price > 0 || $max_price < 10000000) {
        $packageQuery->whereHas('packagePrices', function ($query) use ($min_price, $max_price) {
            $query->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
                ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]);
        });
    }

    $packages = $packageQuery->get();

    $packageData = $packages->map(function ($package) use ($states, $cities) {
        $imageUrls = array_values(json_decode($package->image, true));
        $stateNames = $states[$package->state_id] ?? null;
        $cityNames = $cities[$package->city_id] ?? null;

        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $packagePrices = PackagePrice::where('package_id', $package->id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();

        $prices = $packagePrices->map(function ($price) {
            return [
                'id' => $price->id,
                'start_date' => \Carbon\Carbon::parse($price->start_date)->format('F Y'),
                'end_date' => \Carbon\Carbon::parse($price->end_date)->format('F Y'),
                'display_price' => $price->display_cost,
                'total_cost' =>
                    ($price->standard_cost ?? 0) +
                    ($price->deluxe_cost ?? 0) +
                    ($price->premium_cost ?? 0) +
                    ($price->premium_3_cost ?? 0) +
                    ($price->super_deluxe_cost ?? 0) +
                    ($price->luxury_cost ?? 0) +
                    ($price->nights_cost ?? 0) +
                    ($price->adults_cost ?? 0) +
                    ($price->child_with_bed_cost ?? 0) +
                    ($price->child_no_bed_infant_cost ?? 0) +
                    ($price->child_no_bed_child_cost ?? 0) +
                    ($price->meal_plan_only_room_cost ?? 0) +
                    ($price->meal_plan_breakfast_cost ?? 0) +
                    ($price->meal_plan_breakfast_lunch_dinner_cost ?? 0) +
                    ($price->meal_plan_all_meals_cost ?? 0) +
                    ($price->hatchback_cost ?? 0) +
                    ($price->sedan_cost ?? 0) +
                    ($price->economy_suv_cost ?? 0) +
                    ($price->luxury_suv_cost ?? 0) +
                    ($price->traveller_mini_cost ?? 0) +
                    ($price->traveller_big_cost ?? 0) +
                    ($price->premium_traveller_cost ?? 0) +
                    ($price->ac_coach_cost ?? 0) +
                    ($price->extra_bed_cost ?? 0),
            ];
        });

        return [
            'id' => $package->id,
            'package_name' => $package->package_name,
            'state_names' => $stateNames,
            'city_names' => $cityNames,
            'image' => array_map(fn($img) => url('') . '/' . $img, $imageUrls),
            'video' => array_map(fn($vid) => url('') . '/' . $vid, is_array($videos = json_decode($package->video, true)) ? $videos : []),
            'pdf' => url('') . '/' . $package->pdf,
            'text_description' => strip_tags($package->text_description),
            'text_description_2' => strip_tags($package->text_description_2),
            'prices' => $prices,
        ];
    });

    // ================= SAFARI DATA ================= //
    $wildlifeSafaris = WildlifeSafari::orderBy('id', 'DESC')
        ->when($stateId, fn($q) => $q->where('state_id', $stateId))
        ->when($timing_value, fn($q) => $q->where('timings', 'LIKE', "%{$timing_value}%"))
        ->get();

    $safariData = $wildlifeSafaris->map(function ($safari) {
        $images = is_array($decoded = json_decode($safari->image, true)) ? array_values($decoded) : [];
        $imageUrls = array_map(fn($img) => url('') . '/' . trim($img, ' "'), $images);

        return [
            'id' => $safari->id,
            'state_name' => $safari->state->state_name ?? null,
            'city_name' => $safari->cities->city_name ?? null,
            'national_park' => $safari->national_park,
            'date' => $safari->date,
            'timings' => explode(',', $safari->timings),
            'vehicle' => $safari->vehicle,
            'jeep_price' => $safari->jeep_price,
            'center_price' => $safari->center_price,
            'cost' => $safari->cost,
            'description' => strip_tags($safari->description),
            'images' => $imageUrls,
        ];
    });

    // ================= HOTEL DATA ================= //
    $hotels = Hotels::all();

    $hotelData = $hotels->map(function ($hotel) {
        $baseUrl = url('');
        $stateName = $hotel->state->state_name ?? null;
        $cityName = $hotel->cities->city_name ?? null;

        $hotelPrices = $hotel->prices;
        $pricesData = $hotelPrices->map(function ($price) {
            return [
                'id' => $price->id,
                'night_cost' => $price->night_cost,
                'start_date' => \Carbon\Carbon::parse($price->start_date)->format('F Y'),
                'end_date' => \Carbon\Carbon::parse($price->end_date)->format('F Y'),
            ];
        });

        return [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'state' => $stateName,
            'city' => $cityName,
            'images' => array_map(fn($img) => url('') . '/' . $img, is_array($images = json_decode($hotel->images, true)) ? $images : []),
            'location' => $hotel->location,
            'hotel_category' => $hotel->hotel_category,
            'package_id' => $hotel->package_id,
            'prices' => $pricesData,
        ];
    });

    // ========== FINAL RESPONSE ========== //
    return response()->json([
        'message' => 'Data fetched successfully.',
        'data' => [
            'packages' => $packageData,
            'safaris' => $safariData,
            'hotels' => $hotelData,
        ],
        'status' => 200,
    ], 200);
}




    public function wildsafari(Request $request)
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

            $state_id = $request->input('state_id');
            $timing_value = $request->input('time');

            $wildlifeSafaris = WildlifeSafari::orderBy('id', 'DESC')
                ->when($state_id, function($query) use ($state_id) {
                    return $query->where('state_id', $state_id);
                })
                ->when($timing_value, function($query) use ($timing_value) {
                    return $query->where('timings', 'LIKE', "%{$timing_value}%");
                })
                ->get();

            
    
            $wildlifeSafarisData = $wildlifeSafaris->map(function($safari) {
        
                $stateName = $safari->state ? $safari->state->state_name : null;  
                $cityName = $safari->cities ? $safari->cities->city_name : null; 
    
                // If image is not null, split by commas and clean each path
                // $images = $safari->image ? explode(",", $safari->image) : [];
                $images = array_values(json_decode($safari->image, true));
    
                // Clean up and prepend the base URL to each image path
                $imageUrls = array_map(function($image) {
                    $image = trim($image, ' "'); // Trim any extra spaces or quotes
                    return url('') . '/' . $image; // Prepend the base URL
                }, $images);
    
                return [
                    'id' => $safari->id,
                    'state_name' => $stateName,
                    'city_name' => $cityName,  
                    'national_park' => $safari->national_park,
                    'date' => $safari->date,
                    'timings' => explode(',', $safari->timings), 
                    'vehicle' => $safari->vehicle,
                    'jeep_price' => $safari->jeep_price,
                    'center_price' => $safari->center_price,
                    'cost' => $safari->cost,
                    'description' => strip_tags($safari->description),
                    'images' => $imageUrls, // Array of image URLs
                ];
            });
    
            return response()->json([
                'message' => 'Wildlife safaris fetched successfully.',
                'data' => $wildlifeSafarisData,
                'status' => 200
            ], 200);
        }
    
        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }

    public function wildsafaristate(){
        $wildlifeSafaris = WildlifeSafari::get();

    $stateIds = $wildlifeSafaris->pluck('state_id')->unique();

    $state = State::whereIn('id', $stateIds)->get();

    $citiesArray = $state->map(function($state) {
        return [
            'id' => $state->id,
            'state_name' => $state->state_name
        ];
    });

    return response()->json([
        'message' => 'State fetched successfully.',
        'data' => $citiesArray,
        'status' => 200,
    ]);

    }
    
    



    public function wildsafaribooked(Request $request)
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

            $validatedData = $request->validate([
                'safari_id' => 'required', 
                // 'national_park' => 'required|string|max:255',
                'date' => 'required|date',
                'timings' => 'required|string|max:255',
                'no_persons' => 'required|integer|min:1',
                'no_adults' => 'required|integer|min:0',
                'no_kids' => 'required|integer|min:0',
                // 'vehicle' => 'required|string|max:255',
                'cost' => 'nullable|numeric|min:0',
            ]);

            $order = new WildlifeSafariOrder();
            $order->safari_id = $request->safari_id;
            $order->user_id = $user->id;
            $order->national_park = $request->national_park;
            $order->date = $request->date;
            $order->timings = $request->timings;
            $order->no_persons = $request->no_persons;
            $order->no_adults = $request->no_adults;
            $order->no_kids = $request->no_kids;
            $order->vehicle = $request->vehicle;
            $order->cost = $request->cost;
            $order->status = 0;

            $order->save();

            $orderData = [
                'id' => $order->id,
                'safari_id' => $order->safari_id,
                'agent_name' => $order->user->name,
                // 'national_park' => $order->national_park,
                // 'date' => $order->date,
                'timings' => $order->timings,
                'no_persons' => $order->no_persons,
                'no_adults' => $order->no_adults,
                'no_kids' => $order->no_kids,
                'vehicle' => $order->vehicle,
                'cost' => $order->cost,
            ];

            return response()->json([
                'message' => 'Wildlife safari order booked successfully.',
                'data' => $orderData,
                'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }




    public function routes(Request $request)
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

            $wildlifeSafaris = Route::orderBy('id', 'DESC')->get();

            $wildlifeSafarisData = $wildlifeSafaris->map(function($safari) {

                return [
                    'id' => $safari->id,
                    'from_destination' => $safari->from_destination,
                    'to_destination' => $safari->to_destination,
                ];
            });

            return response()->json([
                'message' => 'Routes fetched successfully.',
                'data' => $wildlifeSafarisData,
                'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }


    public function tripguide(Request $request)
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
    
            $tripGuides = TripGuide::query();
    
            if ($request->has('state_id') && $request->state_id !== '') {
                $tripGuides->where('state_id', $request->state_id);
            }
    
            if ($request->has('location') && $request->location !== '') {
                $tripGuides->where('location', 'LIKE', '%' . $request->location . '%');
            }
    
            if ($request->has('languages_id') && $request->languages_id !== '') {
                $tripGuides->where('languages_id', $request->languages_id);
            }
    
            $wildlifeSafaris = $tripGuides->orderBy('id', 'DESC')->get();
    
            $wildlifeSafarisData = $wildlifeSafaris->map(function ($safari) {
    
                $stateName = $safari->state ? $safari->state->state_name : null;
                $cityName = $safari->cities ? $safari->cities->city_name : null;
                $language_name = $safari->languages ? $safari->languages->language_name : null;
    
                // Check if the image field is not empty and decode the JSON safely
                $imageData = $safari->image ? json_decode($safari->image, true) : null;
    
                // If imageData is null or not an array, return an empty array
                $imageUrls = is_array($imageData) ? array_map(function($image) {
                    $image = trim($image, ' "'); // Trim any extra spaces or quotes
                    return url('') . '/' . $image; // Prepend the base URL
                }, $imageData) : [];
    
                return [
                    'id' => $safari->id,
                    'state_name' => $stateName,
                    'city_name' => $cityName,
                    'location' => $safari->location,
                    'language' => $language_name,
                    'guide_type' => $safari->guide_type,
                    'cost' => $safari->cost,
                    'image' => $imageUrls,
                ];
            });
    
            return response()->json([
                'message' => 'Trip Guide fetched successfully.',
                'data' => $wildlifeSafarisData,
                'status' => 200
            ], 200);
        }
    
        return response()->json([
            'message' => 'Unauthenticated',
            'data' => [],
            'status' => 201,
        ], 401);
    }
    



    // public function tripguide(Request $request)
    // {

    //     $token = $request->bearerToken();

    //     if (!$token) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }

    //     $decodedToken = base64_decode($token);

    //     if (strpos($decodedToken, ',') === false) {
    //         return response()->json(['message' => 'Invalid token format.'], 400);
    //     }

    //     list($email, $password) = explode(',', $decodedToken);

    //     $user = Agent::where('email', $email)->first();

    //     if ($user && $password == $user->password) {

    //         $wildlifeSafaris = TripGuide::orderBy('id', 'DESC')->get();

    //         $wildlifeSafarisData = $wildlifeSafaris->map(function($safari) {

    //             $stateName = $safari->state ? $safari->state->state_name : null;  
    //             $cityName = $safari->cities ? $safari->cities->city_name : null; 
    //             $language_name = $safari->languages ? $safari->languages->language_name : null; 

    //             return [
    //                 'id' => $safari->id,
    //                 'state_name' => $stateName,
    //                 'city_name' => $cityName, 
    //                 'location' => $safari->location,
    //                 'language' => $language_name,
    //                 'local_guide' => $safari->local_guide,
    //                 'out_station_guide' => $safari->out_station_guide,
    //                 'cost' => $safari->cost,
    //             ];
    //         });

    //         return response()->json([
    //             'message' => 'Trip Guide fetched successfully.',
    //             'data' => $wildlifeSafarisData,
    //             'status' => 200
    //         ], 200);
    //     }

    //     return response()->json(['message' => 'Unauthenticated'], 401);
    // }


   

    
    // public function filterStateCity(Request $request)
    // {
        
    //     $validator = Validator::make($request->all(), [
    //         'state_id' => 'nullable',  
    //         'city_id' => 'nullable', 
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation failed',
    //             'errors' => $validator->errors(),
    //             'status' => 422,
    //         ], 422);
    //     }

    //     $query = City::query();

    //     if ($request->has('state_id')) {
    //         $query->where('state_id', $request->state_id);
    //     }

    //     if ($request->has('city_id')) {
    //         $query->where('id', $request->city_id);
    //     }

    //     $cities = $query->with('state')->get();

    //     if ($request->has('state_id')) {
    //         $cityData = $cities->map(function ($city) {
    //             return [
    //                 'id' => $city->id,
    //                 'city_name' => $city->city_name,
    //                 'state_id' => $city->state_id,
    //                 'state_name' => $city->state->state_name, 
    //             ];
    //         });
    //     } else {
    //         $states = State::all(); 
    //         $cityData = $states->map(function ($state) {
    //             return [
    //                 'id' => $state->id,
    //                 'state_name' => $state->state_name,
    //             ];
    //         });
    //     }
    
    //     return response()->json([
    //         'message' => 'Cities filtered successfully.',
    //         'data' => $cityData,
    //         'status' => 200,
    //     ], 200);
    // }
    


    public function filterStateCity(Request $request)
{
    $validator = Validator::make($request->all(), [
        'state_id' => 'nullable',  
        'city_id' => 'nullable', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
            'status' => 422,
        ], 422);
    }

    $query = City::query();

    if($request->has('type') == 'hotel'){
    if ($request->has('state_id')) {
        // Filter cities by state_id
        $query->where('state_id', $request->state_id);

        // Get the list of cities that are associated with hotels
        $query->whereIn('id', function($subQuery) use ($request) {
            $subQuery->select('city_id')->from('hotels')->where('state_id', $request->state_id);
        });
    }

    if ($request->has('city_id')) {
        $query->where('id', $request->city_id);
    }

    $cities = $query->with('state')->get();

    if ($request->has('state_id')) {
        $cityData = $cities->map(function ($city) {
            return [
                'id' => $city->id,
                'city_name' => $city->city_name,
                'state_id' => $city->state_id,
                'state_name' => $city->state->state_name,
            ];
        });
    } else {
        // If no state_id is passed, return all states
        $states = State::all();
        $cityData = $states->map(function ($state) {
            return [
                'id' => $state->id,
                'state_name' => $state->state_name,
            ];
        });
    }
}else{
    if ($request->has('state_id')) {
                $query->where('state_id', $request->state_id);
            }
    
            if ($request->has('city_id')) {
                $query->where('id', $request->city_id);
            }
    
            $cities = $query->with('state')->get();
    
            if ($request->has('state_id')) {
                $cityData = $cities->map(function ($city) {
                    return [
                        'id' => $city->id,
                        'city_name' => $city->city_name,
                        'state_id' => $city->state_id,
                        'state_name' => $city->state->state_name, 
                    ];
                });
            } else {
                $states = State::all(); 
                $cityData = $states->map(function ($state) {
                    return [
                        'id' => $state->id,
                        'state_name' => $state->state_name,
                    ];
                });
            }
}

    return response()->json([
        'message' => 'Cities filtered successfully.',
        'data' => $cityData,
        'status' => 200,
    ], 200);
}

    


        
}

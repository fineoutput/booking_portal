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

    public function wildsafari(Request $request)
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

            $wildlifeSafaris = WildlifeSafari::orderBy('id', 'DESC')->get();

            $wildlifeSafarisData = $wildlifeSafaris->map(function($safari) {
    
                $stateName = $safari->state ? $safari->state->state_name : null;  
                $cityName = $safari->cities ? $safari->cities->city_name : null; 

                return [
                    'id' => $safari->id,
                    // 'state_id' => $safari->state_id,
                    // 'city_id' => $safari->city_id,
                    'state_name' => $stateName,
                    'city_name' => $cityName,  
                    'national_park' => $safari->national_park,
                    'date' => $safari->date,
                    'timings' => $safari->timings,
                    'vehicle' => $safari->vehicle,
                    'cost' => $safari->cost,
                ];
            });

            return response()->json([
                'message' => 'Wildlife safaris fetched successfully.',
                'data' => $wildlifeSafarisData,
                'status' => 200
            ], 200);
        }

        return response()->json(['message' => 'Unauthenticated'], 401);
    }


    public function wildsafaribooked(Request $request)
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

            $validatedData = $request->validate([
                'safari_id' => 'required', 
                // 'national_park' => 'required|string|max:255',
                // 'date' => 'required|date',
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

        return response()->json(['message' => 'Unauthenticated'], 401);
    }




    public function routes(Request $request)
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

        return response()->json(['message' => 'Unauthenticated'], 401);
    }


    public function tripguide(Request $request)
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

            return [
                'id' => $safari->id,
                'state_name' => $stateName,
                'city_name' => $cityName, 
                'location' => $safari->location,
                'language' => $language_name,
                'local_guide' => $safari->local_guide,
                'out_station_guide' => $safari->out_station_guide,
                'cost' => $safari->cost,
            ];
        });

        return response()->json([
            'message' => 'Trip Guide fetched successfully.',
            'data' => $wildlifeSafarisData,
            'status' => 200
        ], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
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


    public function getLanguages()
    {
        $languages = Languages::all();

        $languagesData = $languages->map(function($language) {
            return [
                'language_name' => $language->language_name,
                'iso_code' => $language->iso_code,
                'native_name' => $language->native_name,
                'status' => $language->status
            ];
        });

        return response()->json([
            'message' => 'Languages fetched successfully.',
            'data' => $languagesData
        ], 200);
    }




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
    
        // Query the Cities with the given filters
        $query = City::query();
    
        if ($request->has('state_id')) {
            $query->where('state_id', $request->state_id);
        }
    
        if ($request->has('city_id')) {
            $query->where('id', $request->city_id);
        }
    
        $cities = $query->with('state')->get();
    
        // Transform the response into an array structure
        $cityData = $cities->map(function ($city) {
            return [
                'id' => $city->id,
                'city_name' => $city->city_name,
                'state_id' => $city->state_id,
                'state' => [
                    'id' => $city->state->id,
                    'state_name' => $city->state->state_name,
                ]
            ];
        });
    
        return response()->json([
            'message' => 'Cities filtered successfully.',
            'data' => $cityData,
            'status' => 200,
        ], 200);
    }
    


        
}

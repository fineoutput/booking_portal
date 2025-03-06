<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnverifyUser;
use App\Models\UserOtp;
use App\Models\Agent;
use App\Models\State;
use App\Models\HotelPrice;
use App\Models\VehiclePrice;
use App\Models\WildlifeSafariOrder2;
use App\Models\Hotels;
use App\Models\HotelBooking;
use App\Models\Airport;
use App\Models\TaxiBooking2;
use App\Models\TripGuideBook2;
use App\Models\PackagePrice;
use App\Models\Outstation;
use App\Models\TripGuideBook;
use App\Models\HotelBooking2;
use App\Models\PackageBookingTemp;
use App\Models\TaxiBooking;
use App\Models\TripGuide;
use App\Models\Route;
use App\Models\PackageBooking;
use App\Models\City;
use App\Models\Package;
use App\Models\Vehicle;
use App\Models\Tourist;
use App\Models\WildlifeSafari;
use App\Models\WildlifeSafariOrder;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use Illuminate\Support\Facades\DB;
use Ramsey\Console\Repl;

class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    // public function index(Request $req)
    // {
    //     // $city['city'] = City::where('id', $id)->first();
    
    //     $data['packages'] = Package::get();
    
    //     $formatted_date = Carbon::now()->format('Y-m'); // Get current date formatted as 'Y-m'
    
    //     foreach ($data['packages'] as $package) {
    //         $package_price = PackagePrice::where('package_id', $package->id)
    //             ->where('start_date', '<=', $formatted_date)
    //             ->where('end_date', '>=', $formatted_date)
    //             ->first();
    
    //         $package->prices = $package_price;
    
    //         $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
    //         $package->hotels = $hotels;
    //     }

    //     $popularCities = DB::table('package_booking')
    //     ->selectRaw('count(*) as bookings_count, package.city_id')
    //     ->join('package', 'package_booking.package_id', '=', 'package.id')
    //     ->join('all_cities', 'package.city_id', '=', 'all_cities.id')
    //     ->groupBy('package.city_id')
    //     ->orderByDesc('bookings_count')
    //     ->get();
    //     // $data['states'] = State::with('cities')->get();
    //     return view('front/index',$data)->withTitle('home');
    // }



    public function index(Request $req)
{
    $data['packages'] = Package::get();

    $formatted_date = Carbon::now()->format('Y-m'); 

    foreach ($data['packages'] as $package) {
        $package_price = PackagePrice::where('package_id', $package->id)
            ->where('start_date', '<=', $formatted_date)
            ->where('end_date', '>=', $formatted_date)
            ->first();

        $package->prices = $package_price;

        $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
        
        $package->hotels = $hotels;
    }

    $popularCities = DB::table('package_booking')
    ->selectRaw('count(*) as bookings_count, package.city_id, package_booking.package_temp_id')
    ->join('package', 'package_booking.package_id', '=', 'package.id')
    ->join('all_cities', 'package.city_id', '=', 'all_cities.id')
    ->join('package_booking_temp', 'package_booking.package_temp_id', '=', 'package_booking_temp.id')
    ->groupBy('package.city_id', 'package_booking.package_temp_id')
    ->orderByDesc('bookings_count')
    ->get();

    if ($popularCities->isEmpty()) {
        $data['popularCities'] = [];
    } else {
        $groupedCities = $popularCities->groupBy('city_id')->map(function ($cities) {
            return $cities->sum('bookings_count');
        });

        $sortedCities = $groupedCities->sortDesc();

        $data['popularCities'] = $sortedCities->map(function ($bookingsCount, $cityId) use ($popularCities) {
            $city = $popularCities->firstWhere('city_id', $cityId);

            $adultCount = \DB::table('package_booking_temp')
                ->where('id', $city->package_temp_id)
                ->value('adults_count'); 

            $cityName = \DB::table('all_cities')->where('id', $cityId)->value('city_name');
            return [
                'city_name' => $cityName,
                'bookings_count' => $bookingsCount,
                'adults_count' => $adultCount,
            ];
        })->values();
    }


    return view('front/index', $data)->withTitle('home');
}



    public function add_wallet(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|string',
            'amount' => 'required',
            'note' => 'nullable|string',
        ]);

        $wallet = new Wallet;

        $wallet->user_id = Auth::guard('agent')->id();

        $wallet->transaction_type = $request->transaction_type;
        $wallet->amount = $request->amount;
        $wallet->note = $request->note ?? '';
        $wallet->status = 0;
        $wallet->save();

        return redirect()->back()->with('message', 'Wallet transaction added successfully.');
    }


    public function getCitiesByState($stateId)
    {
     $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
     return response()->json(['cities' => $cities]);
    }

    public function login()
    {
        $data['states'] = State::all();
        return view('front/login',$data);
    }
    public function options()
    {
        return view('front/options');
    }
   
    public function all_images()
    {
        return view('front/all_images');
    }
    public function state_detail()
    {
        return view('front/state_detail');
    }


    // public function user_profile()
    // {
    //     if (Auth::guard('agent')->check()) {
    //         $data['user'] = Auth::guard('agent')->user()->load('cities', 'state');
    //         $data['booking'] = PackageBooking::where('id',$data['user']->id)->get();
    //         return view('front/user_profile', $data);
    //     }
    //     return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
    // }


    public function user_profile()
    {
        if (Auth::guard('agent')->check()) {

            $data['user'] = Auth::guard('agent')->user();

            $data['user']->load('cities', 'state');

            $data['booking'] = PackageBooking::with('tourists')->where('user_id', $data['user']->id)->get();
            
            $user_id = Auth::guard('agent')->id();

            $data['wallet'] = Wallet::where('user_id', $user_id)
            ->where('transaction_type', 'recharge')
            ->get();
        
            $totalAmount = $data['wallet']->sum('amount');
        
            $lastRecharge = Wallet::where('user_id', $user_id)
                ->where('transaction_type', 'recharge')
                ->latest('created_at')
                ->first();
        
            $lastRechargeAmount = $lastRecharge ? $lastRecharge->amount : 0;
            $lastRechargeDate = $lastRecharge ? $lastRecharge->created_at->format('Y-m-d H:i:s') : 'No recharges found';
        
            $data['totalAmount'] = $totalAmount;
            $data['lastRechargeAmount'] = $lastRechargeAmount;
            $data['lastRechargeDate'] = $lastRechargeDate;

            return view('front/user_profile',$data);
        }

        return redirect()->route('login')->with('error', 'You must be logged in to view this page.');

    }


//     public function saveTouristDetails(Request $request)
// {
//     // Validate incoming data
//     $request->validate([
//         'booking_id' => 'nullable',
//         'tourist.*.name' => 'required',
//         'tourist.*.age' => 'required',
//         'tourist.*.phone' => 'required',
//         'tourist.*.aadhar_front' => 'nullable',
//         'tourist.*.aadhar_back' => 'nullable',
//         'additional_info' => 'nullable',
//     ]);

//     $bookingId = $request->input('booking_id');
//     foreach ($request->tourist as $tourist) {
//         $touristRecord = new Tourist();
//         $touristRecord->booking_id = $bookingId; 
//         $touristRecord->user_id = Auth::guard('agent')->id(); 
//         $touristRecord->name = $tourist['name'];
//         $touristRecord->age = $tourist['age'];
//         $touristRecord->phone = $tourist['phone'];
//         $touristRecord->additional_info = $request->additional_info;
        
//         // Handle file uploads
//         if ($request->hasFile("tourist.*.aadhar_front")) {
//             $touristRecord->aadhar_front = $tourist['aadhar_front']->store('aadhar_cards');
//         }
//         if ($request->hasFile("tourist.*.aadhar_back")) {
//             $touristRecord->aadhar_back = $tourist['aadhar_back']->store('aadhar_cards');
//         }

//         // Save the tourist record
//         $touristRecord->save();
//     }

//     return response()->json(['message' => 'Tourist details saved successfully!']);
// }


public function saveTouristDetails(Request $request)
{
    $validated = $request->validate([
        'tourist.*.name' => 'required',
        'tourist.*.age' => 'required',
        'tourist.*.phone' => 'required',
        'tourist.*.aadhar_front' => 'required|file',  
        'tourist.*.aadhar_back' => 'required|file', 
        'additional_info' => 'nullable',
    ]);

    foreach ($request->tourist as $touristData) {
        $aadharFrontPath = null;
        $aadharBackPath = null;

        if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
            $aadharFrontPath = $touristData['aadhar_front']->store('uploads/tourist');
        }

        if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
            $aadharBackPath = $touristData['aadhar_back']->store('uploads/tourist');
        }

        $tourist = new Tourist([
            'user_id' => Auth::guard('agent')->id(),
            'name' => $touristData['name'],
            'age' => $touristData['age'],
            'phone' => $touristData['phone'],
            'aadhar_front' => $aadharFrontPath,
            'aadhar_back' => $aadharBackPath,
            'additional_info' => $request->additional_info,
            'booking_id' => $request->booking_id,
        ]);

        $tourist->save();
    }

    return redirect()->back()->with([
        'message' => 'Tourist details saved successfully!']);
}


public function getVehiclesByAirport(Request $request)
{
    $airportId = $request->input('airport_id');
    $airport = Airport::find($airportId);

    $vehicleIds = explode(',', $airport->vehicle_id);

    $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();
    $vehiclePrices = VehiclePrice::all();

    $data = $vehicles->map(function ($vehicle) use ($vehiclePrices) {
        $price = $vehiclePrices->where('vehicle_id', $vehicle->id)->first()->price ?? null;

        return [
            'id' => $vehicle->id,
            'vehicle_type' => $vehicle->vehicle_type,
            'price' => $price 
        ];
    });

    return response()->json($data);
}



    public function taxi_booking()
    {
        $data['user'] = Auth::guard('agent')->user();
        $data['airport'] = Airport::all();
        $data['vehicle'] = Vehicle::where('status',1)->get();
        $data['vehicleprice'] = VehiclePrice::where('type','Airport/Railway station')->get();
        $data['vehiclepricetour'] = VehiclePrice::where('type','Local Tour')->get();
        $data['route'] = Route::get();
        $data['outstation'] = Outstation::get();
        return view('front/taxi_booking',$data);
    }


    
    public function taxiconfirmation(Request $request, $id)
    {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = TaxiBooking::where('id', $id)->first();
        return view('front/taxi_confirmation', $data);
    }

    public function add_taxi_confirm_booking(Request $request,$id)
    {
        $packagetempbooking = TaxiBooking::where('id',$id)->first();


        $packagebooking = new TaxiBooking2();
        $packagebooking->taxi_order_id = $id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->tour_type = $packagetempbooking->tour_type;
        $packagebooking->fetched_price = $request->fetched_price;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $request->final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0;
        $packagebooking->save();

        $packagetempbooking->update(['status' => 1]);

        return redirect()->route('index')->with('message', 'Taxi Booking Created Successfully');
    }


    public function book_airport_railway(Request $request){
        // return $request;

        $taxibooking = new TaxiBooking();

        if($request->trip == 'pickup'){

        $taxibooking->tour_type = 'Airport/Railway station';
        $taxibooking->user_id = Auth::guard('agent')->id();
        $taxibooking->trip = $request->trip;
        $taxibooking->location = $request->location;
        $taxibooking->airport_id = $request->airport_id;
        $taxibooking->vehicle_id = $request->vehicle_id;
        $taxibooking->start_date = $request->start_date;
        $taxibooking->pickup_date = $request->pickup_date;
        $taxibooking->pickup_time = $request->pickup_time;
        $taxibooking->start_time = $request->start_time;
        $taxibooking->cost = $request->cost;

    }else{

        $taxibooking->tour_type = 'Airport/Railway station';
        $taxibooking->user_id = Auth::guard('agent')->id();
        $taxibooking->trip = $request->trip;
        // $taxibooking->drop_location = $request->drop_location;
        $taxibooking->drop_pickup_address = $request->drop_pickup_address;
        $taxibooking->location = $request->location;
        $taxibooking->airport_id = $request->airport_id;
        $taxibooking->vehicle_id = $request->vehicle_id;
        $taxibooking->start_date = $request->start_date;
        $taxibooking->start_time = $request->start_time;
        $taxibooking->pickup_date = $request->pickup_date;
        $taxibooking->pickup_time = $request->pickup_time;
        $taxibooking->cost = $request->cost;

    }

    $taxibooking->save();

    // return redirect()->back()->with(['message' => 'Taxi booked successfully!']);
    return redirect()->route('taxi_confirmation', ['id' => base64_encode($taxibooking->id)]);

    }

    public function book_local_tour(Request $request){
        
        
        $taxibooking = new TaxiBooking();

        $taxibooking->tour_type = 'Local Tour';
        $taxibooking->user_id = Auth::guard('agent')->id();
        $taxibooking->location = $request->location;
        $taxibooking->vehicle_id = $request->vehicle_id;
        $taxibooking->pickup_date = $request->pickup_date;
        $taxibooking->pickup_time = $request->pickup_time;
        $taxibooking->drop_date = $request->drop_date;
        $taxibooking->drop_time = $request->drop_time;
        $taxibooking->cost = $request->cost;
        $taxibooking->save();

        return redirect()->route('taxi_confirmation', ['id' => base64_encode($taxibooking->id)]);

    }

    public function outstation(Request $request){

        $taxibooking = new TaxiBooking();

        if($request->trip_type == 'one-way'){
            $validated = $request->validate([
                // 'vehicle_id' => 'required',
                'pickup_date' => 'required', 
                'destination_city' => 'required', 
            ]);

        $taxibooking->tour_type = 'Outstation';
        $taxibooking->user_id = Auth::guard('agent')->id();
        $taxibooking->trip_type = $request->trip_type;
        $taxibooking->vehicle_id = $request->vehicle_id;
        $taxibooking->pickup_date = $request->pickup_date;
        $taxibooking->destination_city = $request->destination_city;
        $taxibooking->cost = $request->cost;

    }else{
        $validated = $request->validate([
            'vehicle_id_1' => 'required',
            'pickup_date_1' => 'required', 
            'departure_location' => 'required', 
        ]);
        $taxibooking->tour_type = 'Outstation';
        $taxibooking->user_id = Auth::guard('agent')->id();
        $taxibooking->trip_type = $request->trip_type;
        $taxibooking->vehicle_id_1 = $request->vehicle_id_1;
        $taxibooking->pickup_date_1 = $request->pickup_date_1;
        $taxibooking->departure_location = $request->departure_location;
        $taxibooking->drop_date = $request->drop_date;
        $taxibooking->destination_location = $request->destination_location;

    }
        $taxibooking->save();

    // return redirect()->back()->with(['message' => 'Taxi booked successfully!']);
    return redirect()->route('taxi_confirmation', ['id' => base64_encode($taxibooking->id)]);

    }


    public function list($id)
    {
        $id = base64_decode($id);
        
        $city['city'] = City::where('id', $id)->first();
    
        $data['packages'] = Package::whereRaw("FIND_IN_SET(?, city_id)", [$id])->get();
    
        $formatted_date = Carbon::now()->format('Y-m');
    
        foreach ($data['packages'] as $package) {
            $package_price = PackagePrice::where('package_id', $package->id)
                ->where('start_date', '<=', $formatted_date)
                ->where('end_date', '>=', $formatted_date)
                ->first();
    
            $package->prices = $package_price;
    
            $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
            $package->hotels = $hotels;
        }
        return view('front.list', $data);
    }
    



    public function detail($id)
    {
        $id = base64_decode($id);

        $data['packages'] = Package::where('id',$id)->first();

        return view('front/detail',$data);
    }


    public function hotelsbooking()
    {
        $data['hotel'] = Hotels::all();
        return view('front/hotelsbooking',$data);
    }


    public function hotel_details(Request $request, $id)
    {
        $id = base64_decode($id);
        $data['hotel'] = Hotels::where('id',$id)->first();
        $data['hotel_price'] = HotelPrice::where('hotel_id',$id)->first();
        return view('front/hotel_details',$data);
    }


    public function hotelconfirmation(Request $request, $id) {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = HotelBooking::where('id', $id)->first();
        return view('front/hotel_confirmation', $data);
    }



    public function add_hotel_confirm_booking(Request $request,$id)
    {
        $packagetempbooking = HotelBooking::where('id',$id)->first();


        $packagebooking = new HotelBooking2();
        $packagebooking->hotel_order_id = $id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->hotel_id = $packagetempbooking->hotel_id;
        $packagebooking->fetched_price = $request->fetched_price;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $request->final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0;
        $packagebooking->save();

        $packagetempbooking->update(['status' => 1]);

        return redirect()->route('index')->with('message', 'Hotel Booking Created Successfully');
    }

    public function add_hotel_booking(Request $request,$id)
    {
        // return $request;
        $wildlife = new HotelBooking();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->hotel_id = $id;
        $wildlife->check_in_date = $request->check_in_date;
        $wildlife->check_out_date = $request->check_out_date;
        $wildlife->no_occupants = $request->guest_count;
        $wildlife->night_count = $request->night_count;
        $wildlife->cost = $request->total_cost;
        $wildlife->status = 0;
        $wildlife->save();

        // return redirect()->back()->with('message','Hotel Booking Created Succesfully');
        return redirect()->route('hotel_confirmation', ['id' => base64_encode($wildlife->id)]);
    }


    public function add_package_booking(Request $request, $id)
    {
        
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        
        $night_count = $start_date->diffInDays($end_date); 

        $formatted_date = Carbon::now()->format('Y-m');

        $package_price = PackagePrice::where('package_id', $id)
                ->where('start_date', '<=', $formatted_date)
                ->where('end_date', '>=', $formatted_date)
                ->first();

        $wildlife = new PackageBookingTemp();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->package_id = $id;
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

        if($request->meal == 'only_room'){

           $meal_cost = $package_price->meal_plan_only_room_cost;

        }elseif($request->meal == 'breakfast'){

            $meal_cost = $package_price->meal_plan_breakfast_cost;

        }elseif($request->meal == 'breakfast_lunch'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost;

        }elseif($request->meal == 'breakfast_dinner'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost;

        }else{

            $meal_cost = $package_price->meal_plan_all_meals_cost;
        }


        // hotel_preference

        if($request->hotel_preference == 'standard'){

           $hotel_preference_cost = $package_price->standard_cost;

        }elseif($request->hotel_preference == 'deluxe'){

            $hotel_preference_cost = $package_price->deluxe_cost;

        }elseif($request->hotel_preference == 'super_deluxe'){

            $hotel_preference_cost = $package_price->super_deluxe_cost;

        }elseif($request->hotel_preference == 'luxury'){

            $hotel_preference_cost = $package_price->luxury_cost;

        }else{

            $hotel_preference_cost = $package_price->premium_cost;
        }

        // vehicle_options

        if($request->vehicle_options == 'hatchback_cost'){

           $vehicle_options_cost = $package_price->hatchback_cost;

        }elseif($request->vehicle_options == 'sedan_cost'){

            $vehicle_options_cost = $package_price->sedan_cost;

        }elseif($request->vehicle_options == 'economy_suv_cost'){

            $vehicle_options_cost = $package_price->economy_suv_cost;

        }elseif($request->vehicle_options == 'luxury_suv_cost'){

            $vehicle_options_cost = $package_price->luxury_suv_cost;

        }
        elseif($request->vehicle_options == 'traveller_mini_cost'){

            $vehicle_options_cost = $package_price->traveller_mini_cost;

        }
        elseif($request->vehicle_options == 'traveller_big_cost'){

            $vehicle_options_cost = $package_price->traveller_big_cost;

        }
        elseif($request->vehicle_options == 'premium_traveller_cost'){

            $vehicle_options_cost = $package_price->premium_traveller_cost;

        }
        else{

            $vehicle_options_cost = $package_price->ac_coach_cost;
        }

        if($request->extra_bed == 'yes'){
            $extrabed_cost = $package_price->extra_bed_cost;
        }
        else{
            $extrabed_cost = 0;
        }

        $total_night_cost = $package_price->nights_cost *  $night_count;
        $adults_cost = $package_price->adults_cost *  $request->adults_count;
        $child_with_bed_cost = $package_price->child_with_bed_cost *  $request->child_with_bed_count;
        $child_no_bed_child_cost = $package_price->child_no_bed_child_cost *  $request->child_no_bed_child_count;
        $total_meal_cost = $meal_cost;
        $total_hotel_preference_cost = $hotel_preference_cost;
        $total_vehicle_options_cost = $vehicle_options_cost;

        $finaltotal = $total_night_cost +  $adults_cost + $child_with_bed_cost + $child_no_bed_child_cost + $total_meal_cost + $total_hotel_preference_cost + $total_vehicle_options_cost + $extrabed_cost; 

        $wildlife->total_cost = $finaltotal;
        //   return $finaltotal;
        $wildlife->save();
    
        return redirect()->route('confirmation', ['id' => base64_encode($wildlife->id)]);
    }

    
    

    public function confirmation(Request $request, $id)
    {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = PackageBookingTemp::where('id', $id)->first();
        return view('front/confirmation', $data);
    }
    

    public function add_confirmation(Request $request, $id)
    {
            // return $request;
            $packagetempbooking = PackageBookingTemp::where('id',$id)->first();

            // return $packagetempbooking;

            $packagebooking = new PackageBooking();
            $packagebooking->package_temp_id = $id;
            $packagebooking->user_id = $packagetempbooking->user_id;
            $packagebooking->package_id = $packagetempbooking->package_id;
            $packagebooking->fetched_price = $request->fetched_price;
            $packagebooking->agent_margin = $request->agent_margin;
            $packagebooking->final_price = $request->final_price;
            $packagebooking->salesman_name = $request->salesman_name;
            $packagebooking->salesman_mobile = $request->salesman_mobile;
            $packagebooking->status = 0;
            $packagebooking->save();

            $packagetempbooking->update(['status' => 1]);

            return redirect()->route('index')->with('message', 'Package Booking Created Successfully');

    }


    public function wildlife()
    {
        $data['wildlife'] = WildlifeSafari::all();
        return view('front/wildlife',$data);
    }

    public function wildlife_detail(Request $request,$id)
    {
        $id = base64_decode($id);
        $data['wildlife'] = WildlifeSafari::where('id',$id)->first();
        return view('front/wildlife_detail',$data);
    }

    public function safariconfirmation(Request $request, $id)
    {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = WildlifeSafariOrder::where('id', $id)->first();
        return view('front/wildlife_confirmation', $data);
    }

    public function add_confirm_wildlife_booking(Request $request,$id) {

        $packagetempbooking = WildlifeSafariOrder::where('id',$id)->first();


        $packagebooking = new WildlifeSafariOrder2();
        $packagebooking->safari_order_id = $id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->safari_id = $packagetempbooking->safari_id;
        $packagebooking->fetched_price = $request->fetched_price;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $request->final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0;
        $packagebooking->save();

        $packagetempbooking->update(['status' => 1]);

        return redirect()->route('index')->with('message', 'Safari Booking Created Successfully');
    }

    public function add_wildlife_booking(Request $request,$id)
    {
        // return $request;
        $wildlife = new WildlifeSafariOrder();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->safari_id = $id;
        $wildlife->date = $request->date;
        $wildlife->no_adults = $request->no_adults;
        $wildlife->no_persons = $request->no_persons;
        $wildlife->no_kids = $request->no_kids;
        $wildlife->cost = $request->total_price;
        $wildlife->vehicle = $request->vehicle;
        $wildlife->guest_count = $request->guest_count;
        $wildlife->timings = $request->selected_time;
        $wildlife->status = 0;

        $wildlife->save();
        return redirect()->route('safari_confirmation', ['id' => base64_encode($wildlife->id)]);

    }

    public function guide()
    {
        $data['tripguide'] = TripGuide::latest()->first();
        $data['state'] = State::where('id',$data['tripguide']->state_id)->first();
        return view('front/guide',$data);
    }


    public function guideconfirmation(Request $request, $id)
    {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = TripGuideBook::where('id', $id)->first();
        return view('front/guide_confirmation', $data);
    }

    public function add_confirm_guide_booking(Request $request,$id) {

        $packagetempbooking = TripGuideBook::where('id',$id)->first();

        $packagebooking = new TripGuideBook2();
        $packagebooking->guide_order_id = $id;
        $packagebooking->user_id = $packagetempbooking->user_id;
        $packagebooking->guide_id = $packagetempbooking->tour_guide_id;
        $packagebooking->fetched_price = $request->fetched_price;
        $packagebooking->agent_margin = $request->agent_margin;
        $packagebooking->final_price = $request->final_price;
        $packagebooking->salesman_name = $request->salesman_name;
        $packagebooking->salesman_mobile = $request->salesman_mobile;
        $packagebooking->status = 0;
        $packagebooking->save();

        $packagetempbooking->update(['status' => 1]);

        return redirect()->route('index')->with('message', 'Tour Guide Booked Succesfully!');
    }




    public function bookguide(Request $request){

        $validated = $request->validate([
            'state_id' => 'required',
            'location' => 'required',
            'languages_id' => 'required',
        ]);

        $TripGuide = new TripGuideBook();

        $TripGuide->user_id = Auth::guard('agent')->id();
        $TripGuide->tour_guide_id = $request->tour_guide_id;
        $TripGuide->languages_id = $request->languages_id;
        $TripGuide->state_id = $request->state_id;
        $TripGuide->location = $request->location;
        $TripGuide->guide_type = $request->guide_type;
        $TripGuide->cost = $request->cost;
        $TripGuide->status = 0;

        $TripGuide->save();

        return redirect()->route('guide_confirmation', ['id' => base64_encode($TripGuide->id)]);
        // return redirect()->back()->with('message','Tour Guide Booked Succesfully!');
        
    }


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
            'name' => 'required', 
            'email' => 'required|string|email|max:255|unique:agent,email', 
            'password' => 'required|string|min:6',
            'business_name' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'aadhar_image' => 'required',
            'aadhar_image_back' => 'required',
            'pan_image' => 'required',
            'GST_number' => 'required',
            'logo' => 'required', 
            'registration_charge' => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $validationRules);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); 
        }
    
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
                'state' => $request->city_id,
                'city' => $request->city_id,
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

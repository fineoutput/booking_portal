<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdminCity;
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
use App\Models\Constants;
use App\Models\HomeSlider;
use App\Models\Languages;
use App\Models\LocalVehiclePrice;
use App\Models\Package;
use App\Models\Slider;
use App\Models\UpgradeRequest;
use App\Models\Vehicle;
use App\Models\Tourist;
use App\Models\WildlifeSafari;
use App\Models\WildlifeSafariOrder;
use App\Models\Wallet;
use App\Models\HotelPrefrence;
use App\Models\Testimonials;
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
    $data['slider'] = Slider::where('type','home_slider')->get();
    $data['offer'] = HomeSlider::orderBy('id','DESC')->where('type','Offer')->get();
    $data['bottom'] = HomeSlider::orderBy('id','DESC')->where('type','Bottom')->get();
    $data['banner'] = HomeSlider::orderBy('id','DESC')->where('type','Banner')->get();

    $formatted_date = Carbon::now()->format('Y-m-d'); 

    foreach ($data['packages'] as $package) {
        $package_price = PackagePrice::where('package_id', $package->id)
            ->where('start_date', '<=', $formatted_date)
            ->where('end_date', '>=', $formatted_date)
            ->first();

        $package->prices = $package_price;

        $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
        
        $package->hotels = $hotels;
    }


    // $popularCities = DB::table('package_booking')
    // ->selectRaw('count(*) as bookings_count, package.city_id, package_booking.package_temp_id')
    // ->join('package', 'package_booking.package_id', '=', 'package.id')
    // ->join('all_cities', 'package.city_id', '=', 'all_cities.id')
    // ->join('package_booking_temp', 'package_booking.package_temp_id', '=', 'package_booking_temp.id')
    // ->groupBy('package.city_id', 'package_booking.package_temp_id')
    // ->orderByDesc('bookings_count')
    // ->get();
    $data['popularCities'] = Package::where('holidaypackage',1)->get();
    $data['popularhotels'] = Package::where('travelpackage',1)->get();
    // $data['popularhotels'] = Hotels::where('show_front',1)->get();
// if ($popularCities->isEmpty()) {
//     $data['popularCities'] = [];
// } else {
//     // Group by city_id and sum the bookings count for each city
//     $groupedCities = $popularCities->groupBy('city_id')->map(function ($cities) {
//         // Sum the bookings count across all packages for each city
//         return $cities->sum('bookings_count');
//     });

//     // Sort cities by the summed bookings count in descending order
//     $sortedCities = $groupedCities->sortDesc();

//     $data['popularCities'] = $sortedCities->map(function ($bookingsCount, $cityId) use ($popularCities) {
//         // Get the first entry for each city (after grouping) for details
//         $city = $popularCities->firstWhere('city_id', $cityId);

//         // Get the adult count for this city's package
//         $adultCount = \DB::table('package_booking_temp')
//             ->where('id', $city->package_temp_id)
//             ->value('adults_count'); 

//         // Get the city name
//         $cityName = \DB::table('all_cities')->where('id', $cityId)->value('city_name');

//         // Decode the image field (assuming it was stored as an escaped JSON string)
//         $image = \DB::table('package')->where('city_id', $cityId)->value('image');
        
//         // Decode the HTML entities and JSON string
//         $decodedImage = json_decode(html_entity_decode($image), true);
        
//         // Extract the image URL from the decoded array (assuming it's the first element)
//         $imageUrl = $decodedImage['1'] ?? '';

//         return [
//             'city_name' => $cityName,
//             'bookings_count' => $bookingsCount,
//             'adults_count' => $adultCount,
//             'image' => $imageUrl, // Use the decoded image URL
//         ];
//     })->values();
// }



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
        $data['Constants'] = Constants::orderBy('id','DESC')->first();
        return view('front/login',$data);
    }
    public function options()
    {
        return view('front/options');
    }
    public function shipping_policy()
    {
        return view('front/shipping_policy');
    }
    public function terms_condition()
    {
        return view('front/terms_condition');
    }
    

   
    public function all_images($id)
    {
        $id = base64_decode($id);
        $data['hotels'] = Hotels::where('id',$id)->first();
        return view('front/all_images',$data);
    }

    
    // public function state_detail($id)
    // {
    //     $id = base64_decode($id);
        
    //     $city['city'] = State::where('id', $id)->first();
    
    //     $data['packages'] = Package::whereRaw("FIND_IN_SET(?, state_id)", [$id])->get();
    //     $data['slider'] = Slider::orderBy('id','DESC')->where('type','package')->get();
    
    //     $formatted_date = Carbon::now()->format('Y-m-d');
    
    //     foreach ($data['packages'] as $package) {
    //         $package_price = PackagePrice::where('package_id', $package->id)
    //             ->where('start_date', '<=', $formatted_date)
    //             ->where('end_date', '>=', $formatted_date)
    //             ->first();
    
    //         $package->prices = $package_price;
    
    //         $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
    //         $package->hotels = $hotels;
    //     }

    //     return view('front/state_detail',$data);
    // }

    // public function state_detail($id, Request $request)
    // {
    //     $id = base64_decode($id);

    //     $min_price = $request->input('min_price', 0); 
    //     $max_price = $request->input('max_price', 10000000); 

    //     if (!is_numeric($id)) {
    //         abort(404, 'Invalid State ID');
    //     }
    
    //     $data['city'] = $id;

    //     $query = Package::where('state_id', $id); 

    //     if ($min_price > 0 || $max_price < 10000000) {
    //         $query->whereHas('packagePrices', function ($query) use ($min_price, $max_price) {
    //             $query->where('display_cost', '>=', $min_price)
    //                   ->where('display_cost', '<=', $max_price);
    //         });
    //     }
        
    //     $data['packages'] = $query->get();

    //     $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'package')->get();

    //     $formatted_date = Carbon::now()->format('Y-m-d');
        
    //     foreach ($data['packages'] as $package) {
    //         $package_price = PackagePrice::where('package_id', $package->id)
    //             ->where('start_date', '<=', $formatted_date)
    //             ->where('end_date', '>=', $formatted_date)
    //             ->first();
    
    //         $package->prices = $package_price;
    
    //         // Get the hotels associated with the package
    //         $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
    //         $package->hotels = $hotels;
    //     }
    
    //     // Return the filtered data to the view
    //     return view('front/state_detail', $data);
    // }


public function state_detail($id, Request $request)
{
    $id = base64_decode($id);

    $min_price = $request->input('min_price', 0); 
    $max_price = $request->input('max_price', 10000000); 
    
    if (!is_numeric($id)) {
        abort(404, 'Invalid State ID');
    }

    $data['city'] = $id;

    $state = State::where('id', $id)->first();

    $packageCities = Package::where('state_id', $state->id)
        ->pluck('city_id') 
        ->toArray();

    $allCityIds = collect($packageCities)
        ->flatMap(fn($item) => explode(',', $item))
        ->map(fn($id) => trim($id))
        ->unique()
        ->filter()
        ->values()
        ->toArray();

    $cityMap = City::pluck('city_name', 'id')->toArray();

    $uniqueCityNames = City::whereIn('id', $allCityIds)
        ->pluck('city_name')
        ->unique()
        ->values()
        ->toArray();

    $data['city_data'] = $uniqueCityNames;

    $query = Package::where('state_id', $id);

    // Apply price range filter
    $formatted_date = Carbon::now()->format('Y-m-d');
    if ($min_price > 0 || $max_price < 10000000) {
        $query->whereHas('packagePrices', function ($q) use ($min_price, $max_price, $formatted_date) {
            $q->where('start_date', '<=', $formatted_date)
              ->where('end_date', '>=', $formatted_date)
              ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
              ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]);
        });
    }

    // Get all packages first
    $packages = $query->with('packagePrices')->get();

    // Filter by selected cities if any
    $selectedCities = $request->input('cities', []);
    if (!empty($selectedCities)) {
        $packages = $packages->filter(function ($package) use ($selectedCities, $cityMap) {
            $cityIds = explode(',', $package->city_id);
            $citiesForPackage = collect($cityIds)->map(function ($id) use ($cityMap) {
                return $cityMap[$id] ?? null;
            })->filter();

            // Check if any selected city is present in this package
            return $citiesForPackage->intersect($selectedCities)->isNotEmpty();
        })->values(); // reindex the collection
    }

    // Continue processing packages
    foreach ($packages as $package) {
        $package_price = PackagePrice::where('package_id', $package->id)
            ->where('start_date', '<=', $formatted_date)
            ->where('end_date', '>=', $formatted_date)
            ->first();

        $package->prices = $package_price;

        $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
        $package->hotels = $hotels;

        $packageCityIds = explode(',', $package->city_id);
        $packageCityNames = collect($packageCityIds)
            ->map(fn($id) => trim($id))
            ->filter()
            ->map(fn($id) => $cityMap[$id] ?? null)
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $package->city_names = $packageCityNames;
    }

    $data['packages'] = $packages;
    $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'package')->get();

    return view('front.state_detail', $data);
}

    


    public function user_profile()
    {
        if (Auth::guard('agent')->check()) {

            $data['user'] = Auth::guard('agent')->user();

            $data['user']->load('cities', 'state');

            $data['booking'] = PackageBooking::with('tourists', 'hotels')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();

            $data['selected_hotels'] = HotelPrefrence::where('user_id', $data['user']->id)
            ->pluck('hotel_id', 'booking_id')->toArray(); 
            
            $packageIds = $data['booking']->pluck('package_id')->map(function($id) {
                return (int)$id;
            })->toArray();
            // return $packageIds;

            $data['hotels'] = Hotels::whereIn('package_id', $packageIds)->get();
            // return $data['hotels'];
            $data['hotels_data'] = HotelBooking2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();

            $data['WildlifeSafari_data'] = WildlifeSafariOrder2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();

            

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

        // if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
        //     $aadharFrontPath = $touristData['aadhar_front']->store('uploads/tourist');
        // }

        // if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
        //     $aadharBackPath = $touristData['aadhar_back']->store('uploads/tourist');
        // }

        if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
            $file = $touristData['aadhar_front'];
            $filename = time().'_aadhar_front.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true); // Folder create if not exists
            }

            $file->move($destination, $filename);
            $aadharFrontPath = 'uploads/tourist/' . $filename; // Save this to DB
        }

        if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
            $file = $touristData['aadhar_back'];
            $filename = time().'_aadhar_back.'.$file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true); // No need to repeat if already done
            }

            $file->move($destination, $filename);
            $aadharBackPath = 'uploads/tourist/' . $filename; // Save this to DB
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
            'type' => 'package',
        ]);

        $tourist->save();
    }

    return redirect()->back()->with([
        'message' => 'Tourist details saved successfully!']);
}



  public function saveTouristDetailshotel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'aadhar_front' => 'required|file',
            'aadhar_back' => 'required|file',
            'additional_info' => 'nullable',
            'booking_id' => 'required',
        ]);

        $aadharFrontPath = null;
        $aadharBackPath = null;

        // Upload Aadhar Front
        if ($request->hasFile('aadhar_front')) {
            $file = $request->file('aadhar_front');
            $filename = time() . '_aadhar_front.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $aadharFrontPath = 'uploads/tourist/' . $filename;
        }

        // Upload Aadhar Back
        if ($request->hasFile('aadhar_back')) {
            $file = $request->file('aadhar_back');
            $filename = time() . '_aadhar_back.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $aadharBackPath = 'uploads/tourist/' . $filename;
        }

        // Save to DB
        $tourist = new Tourist([
            'user_id' => Auth::guard('agent')->id(),
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'aadhar_front' => $aadharFrontPath,
            'aadhar_back' => $aadharBackPath,
            'additional_info' => $request->additional_info,
            'booking_id' => $request->booking_id,
            'type' => 'hotel',
        ]);

        $tourist->save();

        return redirect()->back()->with([
            'message' => 'Tourist details saved successfully!'
        ]);
    }


  public function saveTouristDetailssafari(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'phone' => 'required',
            'aadhar_front' => 'required|file',
            'aadhar_back' => 'required|file',
            'additional_info' => 'nullable',
            'booking_id' => 'required',
        ]);

        $aadharFrontPath = null;
        $aadharBackPath = null;

        // Upload Aadhar Front
        if ($request->hasFile('aadhar_front')) {
            $file = $request->file('aadhar_front');
            $filename = time() . '_aadhar_front.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $aadharFrontPath = 'uploads/tourist/' . $filename;
        }

        // Upload Aadhar Back
        if ($request->hasFile('aadhar_back')) {
            $file = $request->file('aadhar_back');
            $filename = time() . '_aadhar_back.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/tourist');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $aadharBackPath = 'uploads/tourist/' . $filename;
        }

        // Save to DB
        $tourist = new Tourist([
            'user_id' => Auth::guard('agent')->id(),
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'aadhar_front' => $aadharFrontPath,
            'aadhar_back' => $aadharBackPath,
            'additional_info' => $request->additional_info,
            'booking_id' => $request->booking_id,
            'type' => 'safari',
        ]);

        $tourist->save();

        return redirect()->back()->with([
            'message' => 'Tourist details saved successfully!'
        ]);
    }


    public function invoice(Request $request, $id){

        $data['user'] = Agent::where('id',Auth::id())->first();
        $data['booking'] = PackageBooking::with('tourists', 'hotels')->where('id', $id)->first();
        return view('front.invoice',$data);

    }

public function upgrade_request(Request $request)
{
    $validated = $request->validate([
        'booking_id' => 'required',
        'upgrade_details' => 'required',
        'notes' => 'required',
    ]);
    
        $UpgradeRequest = new UpgradeRequest([
            'user_id' => Auth::guard('agent')->id(),
            'upgrade_details' => $request->upgrade_details,
            'notes' => $request->notes,
            'booking_id' => $request->booking_id,
            'type' => 'package',
            'status' => 0,
        ]);

        $UpgradeRequest->save();


    return redirect()->back()->with([
        'message' => 'Upgrade Request send successfully!']);
}

public function upgrade_requesthotel(Request $request)
{
    $validated = $request->validate([
        'booking_id' => 'required',
        'upgrade_details' => 'required',
        'notes' => 'required',
    ]);
    
        $UpgradeRequest = new UpgradeRequest([
            'user_id' => Auth::guard('agent')->id(),
            'upgrade_details' => $request->upgrade_details,
            'notes' => $request->notes,
            'booking_id' => $request->booking_id,
            'type' => 'hotel',
            'status' => 0,
        ]);

        $UpgradeRequest->save();


    return redirect()->back()->with([
        'message' => 'Upgrade Request send successfully!']);
}

public function hotel_prefrence(Request $request)
{
    $validated = $request->validate([
        'hotel_id' => 'required',  
        'hotel_id.*' => 'integer|exists:hotels,id', 
        'booking_id' => 'required|integer', 
    ]);

    $hotelIds = $request->input('hotel_id');
    // return $hotelIds;
    $booking_id = $request->input('booking_id');

    foreach ($hotelIds as $hotelId) {
        $UpgradeRequest = new HotelPrefrence([
            'user_id' => Auth::guard('agent')->id(),
            'hotel_id' => $hotelId,
            'booking_id' => $booking_id, 
        ]);
        
        $UpgradeRequest->save(); 
    }

    return redirect()->back()->with([
        'message' => 'Hotel preferences have been saved successfully!',
    ]);
}


// public function getVehiclesByAirport(Request $request)
// {
//     $airportId = $request->input('airport_id');
//     $airport = Airport::find($airportId);

//     $vehicleIds = explode(',', $airport->vehicle_id);

//     $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();
//     $vehiclePrices = VehiclePrice::all();

//     $data = $vehicles->map(function ($vehicle) use ($vehiclePrices) {
//         $price = $vehiclePrices->where('vehicle_id', $vehicle->id)->first()->price ?? null;

//         return [
//             'id' => $vehicle->id,
//             'vehicle_type' => $vehicle->vehicle_type,
//             'price' => $price 
//         ];
//     });

//     return response()->json($data);
// }


public function getVehiclesByAirport(Request $request)
{
    $airportId = $request->input('airport_id');
    $airport = Airport::find($airportId);

    if (!$airport) {
        return response()->json(['message' => 'Airport not found'], 404);
    }

    $vehicleIds = explode(',', $airport->vehicle_id); // assuming vehicle_id contains a comma-separated list of vehicle ids.

    // Fetch vehicles and their prices for the selected airport
    $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();
    
    // Get prices for these vehicles
    $vehiclePrices = VehiclePrice::whereIn('vehicle_id', $vehicleIds)
    ->whereIn('airport_id', (array) $airportId)  // Ensures airport_id is always treated as an array
    ->get();


    $data = $vehicles->map(function ($vehicle) use ($vehiclePrices) {
        // Find the price for the current vehicle at the selected airport
        $price = $vehiclePrices->where('vehicle_id', $vehicle->id)->first();

        return [
            'id' => $vehicle->id,
            'vehicle_type' => $vehicle->vehicle_type,
            'price' => $price ? $price->price : null,
            'description' => $price ? $price->description : null,
        ];
    });

    return response()->json($data);
}


public function getVehiclesByCity($cityId)
{
    $localVehiclePrices = LocalVehiclePrice::where('city_id', $cityId)->get();

    if ($localVehiclePrices->isEmpty()) {
        return response()->json(['message' => 'No vehicles found for this city'], 404);
    }

    $vehicleIds = [];

    foreach ($localVehiclePrices as $localPrice) {
        $vehicleIds = array_merge($vehicleIds, explode(',', $localPrice->vehicle_id));  
    }

    // Remove duplicate vehicle_ids if any
    $vehicleIds = array_unique($vehicleIds);

    // Fetch vehicles associated with the given vehicle_ids
    $vehicles = Vehicle::whereIn('id', $vehicleIds)->get();

    // Map the vehicle data with the associated prices
    $data = $vehicles->map(function ($vehicle) use ($localVehiclePrices) {
        // Find the first matching price record for this vehicle
        $price = null;
        $description = null; // Add description here

        foreach ($localVehiclePrices as $localPrice) {
            // Check if vehicle_id is in the comma-separated list of vehicle_ids in local_vehicleprice
            if (in_array($vehicle->id, explode(',', $localPrice->vehicle_id))) {
                $price = $localPrice->price;
                $description = $localPrice->description; // Ensure description is assigned
                break; // Exit loop after finding the first match
            }
        }

        // Debugging statement to check the value of description
        \Log::debug("Vehicle ID: {$vehicle->id}, Description: {$description}");

        return [
            'id' => $vehicle->id,
            'vehicle_type' => $vehicle->vehicle_type,
            'price' => $price ?? null,
            'description' => $description ?? null, // Ensure description is returned correctly
        ];
    });

    return response()->json($data);
}



    public function taxi_booking()
    {
        $data['user'] = Auth::guard('agent')->user();
        $data['airport'] = Airport::all();
        $data['vehicle'] = Vehicle::where('status',1)->get();
        // $data['localVehiclePrices'] = LocalVehiclePrice::all();
        // $data['vehicleprice'] = VehiclePrice::get();
        $data['vehiclepricetour'] = LocalVehiclePrice::get();
        $data['route'] = Route::get();
        $data['outstation'] = Outstation::get();
        $data['admincity'] = AdminCity::get();
        $data['admincity'] = AdminCity::get();
        $data['testimonials'] = Testimonials::where('type','Taxi Booking')->get();
        return view('front/taxi_booking',$data);
    }

    public function getAirports($cityId)
{
    // Fetch the airports that belong to the selected city
    $airports = Airport::where('city_id', $cityId)->get();

    // Return the airports as JSON
    return response()->json([
        'airports' => $airports
    ]);
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
        $taxibooking->city_id = $request->city_id;
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
        $taxibooking->city_id = $request->city_id;
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
        $taxibooking->city_id = $request->city_id;
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


    // public function list($id)
    // {
    //     $id = base64_decode($id);
        
    //     $city['city'] = City::where('id', $id)->first();
    
    //     $data['packages'] = Package::whereRaw("FIND_IN_SET(?, city_id)", [$id])->get();
    //     $data['slider'] = Slider::orderBy('id','DESC')->where('type','package')->get();
    
    //     $formatted_date = Carbon::now()->format('Y-m-d');
    
    //     foreach ($data['packages'] as $package) {
    //         $package_price = PackagePrice::where('package_id', $package->id)
    //             ->where('start_date', '<=', $formatted_date)
    //             ->where('end_date', '>=', $formatted_date)
    //             ->first();
    
    //         $package->prices = $package_price;
    
    //         $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
    //         $package->hotels = $hotels;
    //     }
    //     return view('front.list', $data);
    // }

    // public function list($id)
    // {
    //     $id = base64_decode($id);
        
    //     $data['city'] = City::where('id', $id)->first();

    //     $data['city_data'] = Package::where('state_id', $data['city']->state_id)->get();

    //     $data['allpackages'] = Package::all();

    //     $min_price = request()->input('min_price', 0); 
    //     $max_price = request()->input('max_price', 100000); 

    //     $data['packages'] = Package::whereRaw("FIND_IN_SET(?, city_id)", [$id])
    //         ->whereHas('packagePrices', function($query) use ($min_price, $max_price) {
    //             $query->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])  
    //                   ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]); 
    //         })
    //         ->get();

    //     $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'package')->get();
 
    //     $formatted_date = Carbon::now()->format('Y-m-d');

    //     foreach ($data['packages'] as $package) {
    //         $package_price = PackagePrice::where('package_id', $package->id)
    //             ->where('start_date', '<=', $formatted_date)
    //             ->where('end_date', '>=', $formatted_date)
    //             ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])  
    //             ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]) 
    //             ->first();

    //         if ($package_price) {
    //             $package->prices = $package_price;
    //         } else {
    //             $package->prices = null; 
    //         }

    //         $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            
    //         $package->hotels = $hotels;
    //     }
        
    //     return view('front.list', $data);
    // }
    
    
    public function list($id, Request $request)
    {
        $id = base64_decode($id);

        if (!is_numeric($id)) {
            abort(404, 'Invalid City ID');
        }

        $data['city'] = City::where('id', $id)->first();
        if (!$data['city']) {
            abort(404, 'City not found');
        }

        $packageCities = Package::where('state_id', $data['city']->state_id)
        ->pluck('city_id') 
        ->toArray();

            $allCityIds = collect($packageCities)
        ->flatMap(function ($item) {
            return explode(',', $item); 
        })
        ->map(function ($id) {
            return trim($id); 
        })
        ->unique()
        ->filter()
        ->values()
        ->toArray();

        $uniqueCityNames = City::whereIn('id', $allCityIds)
            ->pluck('city_name') 
            ->unique()
            ->values()
            ->toArray();

       $data['city_data'] = $uniqueCityNames;
    //    return $data['city_names'];

        $data['allpackages'] = Package::get();

        // Get min and max price from request
        $min_price = $request->input('min_price', 0);
        $max_price = $request->input('max_price', 10000000);

        // Start building the query for packages
        $query = Package::whereRaw("FIND_IN_SET(?, city_id)", [$id]);

        // Filter based on packagePrices (date + price)
        $formatted_date = Carbon::now()->format('Y-m-d');
        if ($min_price > 0 || $max_price < 10000000) {
            $query->whereHas('packagePrices', function ($q) use ($min_price, $max_price, $formatted_date) {
                $q->where('start_date', '<=', $formatted_date)
                ->where('end_date', '>=', $formatted_date)
                ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
                ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]);
            });
        }

        $data['packages'] = $query->with('packagePrices')->get();

        // Fetch sliders
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'package')->get();

        // Attach prices and hotels to each package
        foreach ($data['packages'] as $package) {

                $package_price = PackagePrice::where('package_id', $package->id)
                ->where('start_date', '<=', $formatted_date)
                ->where('end_date', '>=', $formatted_date)
                ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
                ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price])
                ->first();

            if (!$package_price) {
                $package_price = PackagePrice::where('package_id', $package->id)
                    ->where('start_date', '>', $formatted_date)
                    ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
                    ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price])
                    ->orderBy('start_date', 'asc')
                    ->first();
            }

            $package->prices = $package_price ?: null;

            $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
            $package->hotels = $hotels;
        }

        return view('front.list', $data);
    }



    public function detail($id)
    {
        $id = base64_decode($id);

        $data['packages'] = Package::where('id',$id)->first();
        $data['packagesprices'] = PackagePrice::where('package_id',$data['packages']->id)->get();

        return view('front/detail',$data);
    }


    // public function hotelsbooking()
    // {
    //     $data['hotel'] = Hotels::all();
    //     $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();

    //     // Fetch prices for each hotel using a map
    //     $formatted_date = Carbon::now()->format('Y-m-d');

    //     $data['hotel_prices'] = HotelPrice::where('start_date', '<=', $formatted_date)
    //                 ->where('end_date', '>=', $formatted_date)->whereIn('hotel_id', $data['hotel']->pluck('id'))->get()->keyBy('hotel_id');
        
    //     return view('front/hotelsbooking', $data);
    // }



    public function hotelsbooking()
    {
        // Get all hotels
        $data['hotel'] = Hotels::all();
    
        // Get all sliders for hotels
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();
    
        // Get today's date in the required format
        $formatted_date = Carbon::now()->format('Y-m-d');
    
        // Get hotel prices that are valid for today
        $data['hotel_prices'] = HotelPrice::where('start_date', '<=', $formatted_date)
                        ->where('end_date', '>=', $formatted_date)
                        ->whereIn('hotel_id', $data['hotel']->pluck('id'))
                        ->get()
                        ->keyBy('hotel_id');
        
        // Get unique city_ids from hotels
        $cityIds = $data['hotel']->pluck('city_id')->unique();
    
        // Fetch city names by using the city_ids from the Cities table
        $data['cities'] = City::whereIn('id', $cityIds)->get();
    
        // Pass the data to the view
        return view('front/hotelsbooking', $data);
    }

   

  public function filterHotels(Request $request)
    {
        // Retrieve the parameters from the URL query string
        $city_id = $request->query('city_id');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $min_price = $request->query('min_price');  // Min price from the form
        $max_price = $request->query('max_price');  // Max price from the form

        // Query to get all hotels
        $query = Hotels::query();

        // If a city_id is provided, filter by city
        if ($city_id) {
            $query = $query->where('city_id', $city_id);
        }

        $hotels = $query->get();

        $formatted_start_date = Carbon::parse($start_date)->format('Y-m-d');
        $formatted_end_date = Carbon::parse($end_date)->format('Y-m-d');

        $hotel_ids = $hotels->pluck('id');

        $hotel_prices_query = HotelPrice::whereIn('hotel_id', $hotel_ids)
                                ->where('start_date', '<=', $formatted_start_date)
                                ->where('end_date', '>=', $formatted_end_date);

// If min_price is provided, filter by min price
if ($min_price) {
    $hotel_prices_query = $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) >= ?', [$min_price]);
}

// If max_price is provided, filter by max price
if ($max_price) {
    $hotel_prices_query = $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) <= ?', [$max_price]);
}

        $hotel_prices = $hotel_prices_query->get()->keyBy('hotel_id');

        $filtered_hotels = $hotels->filter(function ($hotel) use ($hotel_prices) {
            return isset($hotel_prices[$hotel->id]) && $hotel_prices[$hotel->id]->night_cost >= request()->query('min_price', 0) && $hotel_prices[$hotel->id]->night_cost <= request()->query('max_price', 1000000);
        });


        $slider = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();

        // Prepare data for the view
        $data = [
            'hotels' => $filtered_hotels, // Only pass the filtered hotels
            'hotel_prices' => $hotel_prices,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'slider' => $slider,
            'city_id' => $city_id,  // Include city_id for re-populating the filter form
            'min_price' => $min_price,  // Pass min_price to the view
            'max_price' => $max_price,  // Pass max_price to the view
        ];

        // Return the updated filtered hotel list view with the necessary data
        return view('front.hotel_list', $data);
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
        $wildlife->room_count = $request->room_count;
        $wildlife->status = 0;
        $wildlife->save();

        // return redirect()->back()->with('message','Hotel Booking Created Succesfully');
        return redirect()->route('hotel_confirmation', ['id' => base64_encode($wildlife->id)]);
    }


    public function add_package_booking(Request $request, $id)
    {

         if (!Auth::guard('agent')->check()) {
            // Store the form data in session
            session()->put('booking_form_data', $request->all());
            // Store the redirect URL (to return to after login)
            session()->put('redirect_after_login', url()->previous());

            return redirect()->route('login');
        }

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        
        $night_count = $start_date->diffInDays($end_date); 

        $package_data = Package::where('id',$id)->first();

        if($package_data->night_count < $night_count){
            return redirect()->back()->with('message', "You can only book for {$package_data->night_count} nights.");
        }

        $formatted_date = Carbon::now()->format('Y-m-d');

        $start_dates = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d') : null;
      $end_dates = $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null;
        

        $package_price = PackagePrice::where('package_id', $id)->where('hotel_category',$request->hotel_preference)
                ->where('start_date', '<=', $start_dates)
                ->where('end_date', '>=', $end_dates)
                ->first();

                if(empty($package_price)){
                  return redirect()->back()->with('message', "Price not available for these dates.");
                  }

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

           $meal_cost = $package_price->meal_plan_only_room_cost ?? 0;

        }elseif($request->meal == 'breakfast'){

            $meal_cost = $package_price->meal_plan_breakfast_cost ?? 0;

        }elseif($request->meal == 'breakfast_lunch'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }elseif($request->meal == 'breakfast_dinner'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $meal_cost = $package_price->meal_plan_all_meals_cost ?? 0;
        }


        if($request->hotel_preference == 'standard_cost'){
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'deluxe_cost'){
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'super_deluxe_cost'){

           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'luxury_cost'){

           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'premium_3_cost'){
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'premium_5_cost'){
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }elseif($request->hotel_preference == 'hostels'){
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }else{
           $hotel_preference_cost = $package_price->category_cost ?? 0;

        }

        // vehicle_options

        if($request->vehicle_options == 'hatchback_cost'){

           $vehicle_options_cost = $package_price->hatchback_cost ?? 0;

        }elseif($request->vehicle_options == 'sedan_cost'){

            $vehicle_options_cost = $package_price->sedan_cost ?? 0;

        }elseif($request->vehicle_options == 'economy_suv_cost'){

            $vehicle_options_cost = $package_price->economy_suv_cost ?? 0;

        }elseif($request->vehicle_options == 'luxury_suv_cost'){

            $vehicle_options_cost = $package_price->luxury_suv_cost ?? 0;

        }
        elseif($request->vehicle_options == 'traveller_mini_cost'){

            $vehicle_options_cost = $package_price->traveller_mini_cost ?? 0;

        }
        elseif($request->vehicle_options == 'traveller_big_cost'){

            $vehicle_options_cost = $package_price->traveller_big_cost ?? 0;

        }
        elseif($request->vehicle_options == 'premium_traveller_cost'){

            $vehicle_options_cost = $package_price->premium_traveller_cost ?? 0;
        }
        elseif($request->vehicle_options == 'luxury_sedan_cost'){

            $vehicle_options_cost = $package_price->luxury_sedan_cost ?? 0;
        }
        elseif($request->vehicle_options == 'suv_cost'){

            $vehicle_options_cost = $package_price->suv_cost ?? 0;
        }
        elseif($request->vehicle_options == 'muv_cost'){

            $vehicle_options_cost = $package_price->muv_cost ?? 0;
        }
        elseif($request->vehicle_options == 'bus_nonac_cost'){

            $vehicle_options_cost = $package_price->bus_nonac_cost ?? 0;
        }
        else{

            $vehicle_options_cost = $package_price->ac_coach_cost ?? 0;
        }

        if($request->extra_bed == 'yes'){
            $extrabed_cost = $package_price->extra_bed_cost ?? 0;
        }
        else{
            $extrabed_cost = 0;
        }

        $total_night_cost = $package_price->nights_cost *  $night_count;
        $adults_cost = $package_price->nights_cost *  $request->adults_count;
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
        $id = base64_decode($id); 
        $data['packagebookingtemp'] = PackageBookingTemp::where('id', $id)->first();
        $data['package'] = Package::where('id', $data['packagebookingtemp']->package_id)->first();
        $data['agent'] = Agent::where('id', $data['packagebookingtemp']->user_id)->first();
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
        $cityIds = $data['wildlife']->pluck('state_id')->unique();

        $data['cities'] = State::whereIn('id', $cityIds)->get();

        $data['slider'] = Slider::orderBy('id','DESC')->where('type','safari')->get();
        return view('front/wildlife',$data);
    }

    public function filtersafari(Request $request)
    {

        $city_id = $request->query('city_id');
        $timing_value = $request->query('time');
        // return $timing_value;

        $min_price = $request->query('min_price');  // Min price from the form
        $max_price = $request->query('max_price');  // Max price from the form

        // Initialize the query for WildlifeSafari
        $safari_query = WildlifeSafari::where('state_id', $city_id)
        ->where('timings', 'LIKE', "%{$timing_value}%");

        if ($min_price) {
            $safari_query = $safari_query->whereRaw('CAST(cost AS UNSIGNED) >= ?', [$min_price]);
        }

        // If max_price is provided, filter by max price
        if ($max_price) {
            $safari_query = $safari_query->whereRaw('CAST(cost AS UNSIGNED) <= ?', [$max_price]);
        }

        // If timing_value is provided, filter by timing
        if ($timing_value) {
            // Assuming there's a 'timing' field in the WildlifeSafari model to filter by timing
            $safari_query = $safari_query->where('timings', $timing_value);
        }

        // Fetch the filtered safari records
        $safari_data = $safari_query->get();

        // Prepare data for the view
        $slider = Slider::orderBy('id', 'DESC')->where('type', 'safari')->get();

        // Prepare data for the view
        $data = [
            'safari' => $safari_data,  // Only pass the filtered safari data
            'slider' => $slider,
            'city_id' => $city_id,  // Include city_id for re-populating the filter form
            'min_price' => $min_price,  // Pass min_price to the view
            'max_price' => $max_price,  // Pass max_price to the view
            'timing_value' => $timing_value, // Pass the selected timing_value to the view
        ];

        // Return the updated filtered safari list view with the necessary data
        return view('front.safari_list', $data);
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
               if (!Auth::guard('agent')->check()) {
        // Save form data to session before redirect to login
        session(['wildlife_booking_form_data' => $request->all()]);
        return redirect()->route('login');
    }


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

    // public function guide()
    // {
    //     // $data['tripguide'] = TripGuide::latest()->first();
    //     // $data['slider'] = Slider::orderBy('id','DESC')->where('type','guide')->get();
    //     // $data['state'] = State::where('id',$data['tripguide']->state_id)->first();
    //     // return view('front/guide',$data);
        
    //     $data['tripguide'] = TripGuide::latest()->get(); 
    //     $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'guide')->get();
    //     $data['city'] = City::whereIn('id', $data['tripguide']->pluck('city_id'))->get(); 
    //     $data['state'] = State::whereIn('id', $data['tripguide']->pluck('state_id'))->get(); 
    //     return view('front/guide', $data);

    // }

    public function guide(Request $request)
    {
        $data['city'] = City::all();

        if (session()->has('guide_form_data.city_id')) {
            $cityId = session('guide_form_data.city_id');

            $langs = TripGuide::where('city_id', $cityId)
                ->pluck('languages_id')
                ->unique();

            $guide_languages = Languages::whereIn('id', $langs)
                ->get()
                ->map(fn($l) => ['id' => $l->id, 'name' => $l->language_name]);
            
            session(['guide_languages' => $guide_languages]);
        }

            $data['tripguide'] = TripGuide::latest()->get(); 
            $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'guide')->get();
            $data['city'] = City::whereIn('id', $data['tripguide']->pluck('city_id'))->get(); 
            $data['state'] = State::whereIn('id', $data['tripguide']->pluck('state_id'))->get(); 

        return view('front/guide', $data);
    }

    public function getLanguagesByCity($cityId)
    {
        $tripGuides = TripGuide::where('city_id', $cityId)->get();

        $languages = $tripGuides->map(function ($guide) {
            return $guide->languages_id;
        })->unique();

        $languageNames = Languages::whereIn('id', $languages)->pluck('language_name', 'id');

        return response()->json(['languages' => $languageNames]);
    }

    public function getTourGuideDetails(Request $request)
    {
        $cityId = $request->city_id;
        $languageId = $request->language_id;
    
        // Query the TripGuide model based on city and language
        $tripguide = TripGuide::where('city_id', $cityId)
                              ->where('languages_id', $languageId)
                              ->first();
    
        if ($tripguide) {
            // Return the tour guide ID and cost
            return response()->json([
                'tour_guide_id' => $tripguide->id,
                'cost' => $tripguide->cost
            ]);
        }
    
        return response()->json(['error' => 'No trip guide found'], 404);
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




  public function bookguide(Request $request)
    {
        // Validate required inputs first (only for session saving purpose)
        $validated = $request->validate([
            'city_id' => 'required',
            'languages_id' => 'required',
            'guide_type' => 'required',
        ]);

        if (!Auth::guard('agent')->check()) {
            // session me user ke form selections save karo
            session(['guide_form_data' => $request->all()]);
            session(['redirect_after_login' => url()->previous()]);
            return redirect()->route('login');
        }

        $trip = TripGuide::find($request->tour_guide_id);
        if (!$trip) {
            return back()->with('message', 'Tour guide not found.');
        }

        $guideTypes = explode(',', $trip->guide_type);
        if (!in_array($request->guide_type, $guideTypes)) {
            return back()->with('message', 'The selected guide type is not valid for this tour guide.');
        }

        $booking = new TripGuideBook();
        $booking->user_id = Auth::guard('agent')->id();
        $booking->tour_guide_id = $request->tour_guide_id;
        $booking->languages_id = $request->languages_id;
        $booking->state_id = $request->state_id;
        $booking->location = $request->location;
        $booking->guide_type = $request->guide_type;
        $booking->cost = $request->cost;
        $booking->status = 0;
        $booking->save();

        session()->forget('guide_form_data'); // 🔄 clear old data after save

        return redirect()->route('guide_confirmation', ['id' => base64_encode($booking->id)])
            ->with('success', 'Tour Guide booked successfully!');
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

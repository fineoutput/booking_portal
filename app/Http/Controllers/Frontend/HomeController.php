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
use App\Models\HotelsRoom;
use App\Models\LocationCost;
use App\Models\SafariPrices;
use App\Models\Testimonials;
use App\Models\TripGuidePrice;
use App\Models\VehicleCost;
use App\Models\WalletTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use Illuminate\Support\Facades\DB;
use Ramsey\Console\Repl;
use Razorpay\Api\Api;
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
    $data['offer'] = HomeSlider::orderBy('id','DESC')->where('type_2','package')->where('type','Offer')->get();
    $data['bottom'] = HomeSlider::orderBy('id','DESC')->where('type_2','package')->where('type','Bottom')->get();
    $data['banner'] = HomeSlider::orderBy('id','DESC')->where('type_2','package')->where('type','Banner')->get();

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
            'transaction_type' => 'required|string|in:credit,debit',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        $userId = Auth::guard('agent')->id();

        // Create wallet transaction entry
        $transaction = new WalletTransactions();
        $transaction->user_id = $userId;
        $transaction->transaction_type = $request->transaction_type;
        $transaction->amount = $request->amount;
        $transaction->note = $request->note ?? '';
        $transaction->status = 0; // directly mark complete
        $transaction->save();

        // Update user wallet balance
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $userId],
            ['balance' => 0]
        );

        if ($request->transaction_type == 'credit') {
            $wallet->balance += $request->amount;
        } else { // debit
            if ($wallet->balance < $request->amount) {
                return redirect()->back()->with('error', 'Insufficient balance!');
            }
            // $wallet->balance -= $request->amount;
        }

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
    public function cancelation_policy()
    {
        return view('front/cancelation_policy');
    }
    public function privacy_policy()
    {
        return view('front/privacy_policy');
    }
    public function contact_us()
    {
        return view('front/contact_us');
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

   $formatted_date = Carbon::now()->format('Y-m-d');

$query = Package::whereRaw("FIND_IN_SET(?, state_id)", [$id]);

    // Price filter for current date
    if ($min_price > 0 || $max_price < 10000000) {
        $query->whereHas('packagePrices', function ($q) use ($min_price, $max_price, $formatted_date) {
            $q->where('start_date', '<=', $formatted_date)
            ->where('end_date', '>=', $formatted_date)
            ->whereRaw('CAST(display_cost AS UNSIGNED) >= ?', [$min_price])
            ->whereRaw('CAST(display_cost AS UNSIGNED) <= ?', [$max_price]);
        });
    }

    $packages = $query->with(['packagePrices' => function($q) use ($formatted_date) {
        // First try current prices
        $q->where('start_date', '<=', $formatted_date)
        ->where('end_date', '>=', $formatted_date);
    }])->get();

    // Agar current date me price na mile kisi package ke liye, toh future price fetch karo
    foreach ($packages as $package) {
        if ($package->packagePrices->isEmpty()) {
            // Get next available price after current date
            $futurePrice = PackagePrice::where('package_id', $package->id)
                ->where('start_date', '>', $formatted_date)
                ->orderBy('start_date', 'asc')
                ->first();

            if ($futurePrice) {
                // Replace empty collection with future price
                $package->packagePrices = collect([$futurePrice]);
            }
        }
    }

    // Filter by selected cities if any
    $selectedCities = $request->input('cities', []);
    if (!empty($selectedCities)) {
        $cityMap = City::pluck('city_name', 'id')->toArray();

        $packages = $packages->filter(function ($package) use ($selectedCities, $cityMap) {
            $cityIds = explode(',', $package->city_id);
            $citiesForPackage = collect($cityIds)->map(function ($id) use ($cityMap) {
                return $cityMap[$id] ?? null;
            })->filter();

            return $citiesForPackage->intersect($selectedCities)->isNotEmpty();
        })->values();
    }

    // Continue processing packages
    foreach ($packages as $package) {
        $package_price = $package->packagePrices->first(); // Use eager loaded or future price

        $package->prices = $package_price;

        $hotels = Hotels::whereRaw("FIND_IN_SET(?, package_id)", [$package->id])->get(['id', 'name']);
        $package->hotels = $hotels;

        $packageCityIds = explode(',', $package->city_id);
        $cityMap = City::pluck('city_name', 'id')->toArray();
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

            
            $data['selected_hotels'] = HotelPrefrence::where('user_id', $data['user']->id)
                ->pluck('hotel_id', 'booking_id')->toArray();

            $data['booking'] = PackageBooking::with('tourists', 'hotels')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();
            
            $packageIds = $data['booking']->pluck('package_id')->map(function($id) {
                return (int)$id;
            })->toArray();
            
            $data['hotels'] = Hotels::where(function ($query) use ($packageIds) {
                foreach ($packageIds as $id) {
                    $query->orWhereRaw("FIND_IN_SET(?, package_id)", [$id]);
                }
            })->get();
            // return $data['hotels'];
            $data['hotels_data'] = HotelBooking2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();

            $data['WildlifeSafari_data'] = WildlifeSafariOrder2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();
            
            $data['Taxi_data'] = TaxiBooking2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();
            
            $data['Guide_data'] = TripGuideBook2::with('tourists')->where('user_id', $data['user']->id)->orderBy('id','DESC')->get();
            
            

            $user_id = Auth::guard('agent')->id();

            $data['wallet'] = Wallet::where('user_id', $user_id)
    ->select('balance')
    ->first() ?? null;
        
            $totalAmount = $data['wallet'];
        
            $lastRecharge = WalletTransactions::where('user_id', $user_id)
                ->where('transaction_type', 'credit')
                ->latest('created_at')
                ->first();
        
            $lastRechargeAmount = $lastRecharge ? $lastRecharge->amount : 0;
            $lastRechargeDate = $lastRecharge ? $lastRecharge->created_at->format('Y-m-d H:i:s') : 'No recharges found';
        
            $data['totalAmount'] = Wallet::where('user_id', $user_id)
            ->first();
            $data['lastRechargeAmount'] = $lastRecharge;
            $data['lastRechargeDate'] = $lastRecharge;

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
            'tourist.*.name' => 'required',
            'tourist.*.age' => 'required',
            'tourist.*.phone' => 'required',
            'tourist.*.aadhar_front' => 'required|file',
            'tourist.*.aadhar_back' => 'required|file',
            'additional_info' => 'nullable',
            'booking_id' => 'required',
        ]);

        foreach ($request->tourist as $touristData) {
            $aadharFrontPath = null;
            $aadharBackPath = null;

            if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
                $file = $touristData['aadhar_front'];
                $filename = time() . '_aadhar_front.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharFrontPath = 'uploads/tourist/' . $filename;
            }

            if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
                $file = $touristData['aadhar_back'];
                $filename = time() . '_aadhar_back.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharBackPath = 'uploads/tourist/' . $filename;
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
                'type' => 'hotel',
            ]);

            $tourist->save();
        }

        return redirect()->back()->with([
            'message' => 'Tourist details saved successfully!'
        ]);
    }


  public function saveTouristDetailssafari(Request $request)
    {
        $validated = $request->validate([
            'tourist.*.name' => 'required',
            'tourist.*.age' => 'required',
            'tourist.*.phone' => 'required',
            'tourist.*.aadhar_front' => 'required|file',
            'tourist.*.aadhar_back' => 'required|file',
            'additional_info' => 'nullable',
            'booking_id' => 'required',
        ]);

        foreach ($request->tourist as $touristData) {
            $aadharFrontPath = null;
            $aadharBackPath = null;

            if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
                $file = $touristData['aadhar_front'];
                $filename = time() . '_aadhar_front.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharFrontPath = 'uploads/tourist/' . $filename;
            }

            if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
                $file = $touristData['aadhar_back'];
                $filename = time() . '_aadhar_back.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharBackPath = 'uploads/tourist/' . $filename;
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
                'type' => 'safari',
            ]);

            $tourist->save();
        }

        return redirect()->back()->with([
            'message' => 'Tourist details saved successfully!'
        ]);
    }
 
    public function saveTouristDetailsTaxi(Request $request)
    {
        $validated = $request->validate([
            'tourist.*.name' => 'required',
            'tourist.*.age' => 'required',
            'tourist.*.phone' => 'required',
            'tourist.*.aadhar_front' => 'required|file',
            'tourist.*.aadhar_back' => 'required|file',
            'additional_info' => 'nullable',
            'booking_id' => 'required',
        ]);

        foreach ($request->tourist as $touristData) {
            $aadharFrontPath = null;
            $aadharBackPath = null;

            if (isset($touristData['aadhar_front']) && $touristData['aadhar_front']) {
                $file = $touristData['aadhar_front'];
                $filename = time() . '_aadhar_front.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharFrontPath = 'uploads/tourist/' . $filename;
            }

            if (isset($touristData['aadhar_back']) && $touristData['aadhar_back']) {
                $file = $touristData['aadhar_back'];
                $filename = time() . '_aadhar_back.' . $file->getClientOriginalExtension();
                $destination = public_path('uploads/tourist');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $aadharBackPath = 'uploads/tourist/' . $filename;
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
                'type' => 'Taxi',
            ]);

            $tourist->save();
        }

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
        $taxibooking->drop_pickup_address = $request->drop_pickup_address;

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
    $formatted_date = Carbon::now()->format('Y-m-d');
    // return $formatted_date;
    // Get specific package with current price range
    // $data['package_location'] = LocationCost::where('package_id', $id)->get();
    $data['package_location'] = LocationCost::where('package_id', $id)
    ->select('location')
    ->distinct()
    ->get();
    $package = Package::with(['packagePrices' => function ($q) use ($formatted_date) {
        $q->whereDate('start_date', '<=', $formatted_date)
          ->whereDate('end_date', '>=', $formatted_date)
          ->orderBy('start_date', 'asc');
    }])->where('id', $id)->first();

    if (!$package) {
        abort(404, 'Package not found');
    }

    // Get the first current price (if any)
    $package_price = $package->packagePrices->first();
    if (!$package_price) {
        $package_price = PackagePrice::where('package_id', $package->id)
            ->whereDate('start_date', '>', $formatted_date)
            ->orderBy('start_date', 'asc')
            ->first();  // only one
    }

    // return $package_price;

    $package->prices = $package_price;

    // Optional: all price ranges for JS use or display
    $data['packagesprices'] = PackagePrice::where('package_id', $package->id)->get();

    // Final data
    $data['packages'] = $package;

    $vehicleCost = VehicleCost::where('package_id', $id)->first();

    $vehicleLabels = [
        'hatchback_cost' => 'Hatchback',
        'sedan_cost' => 'Sedan',
        'economy_suv_cost' => 'Economy SUV',
        'luxury_suv_cost' => 'Premium SUV',
        'traveller_mini_cost' => 'Tempo Traveller(8-16 Seat)',
        'traveller_big_cost' => 'Tempo Traveller(17-25 Seat)',
        'premium_traveller_cost' => 'Urbania(12-17 Seat)',
        'ac_coach_cost' => 'Luxury Bus',
        'bus_nonac_cost' => 'Deluxe Bus'
    ];

    $availableVehicles = [];

    if ($vehicleCost) {
        foreach ($vehicleLabels as $field => $label) {
            $cost = $vehicleCost->$field;

            if (!is_null($cost) && floatval($cost) > 0) {
                $availableVehicles[$field] = $label;
            }
        }
    }

    $data['availableVehicles'] = $availableVehicles;

    return view('front/detail', $data);
}



  public function hotelsbooking()
    {
        // Current date set for checking room price validity
        $formatted_start_date = Carbon::now()->format('Y-m-d');
        $formatted_end_date   = Carbon::now()->format('Y-m-d');

        $data['hotel'] = Hotels::where('show_front',1)->get();
        $roomsWithPrice = [];

        foreach ($data['hotel'] as $hotel) {

            $room = HotelsRoom::where('hotel_id', $hotel->id)
                ->where('show_front', 'Yes')
                ->first();

            if ($room) {

                // PRICE FOR CURRENT DATE
                $roomPrice = HotelPrice::where('room_id', $room->id)
                    ->where('start_date', '<=', $formatted_start_date)
                    ->where('end_date', '>=', $formatted_end_date)
                    ->first();

                $roomsWithPrice[] = [
                    'hotel_id'   => $hotel->id,
                    'hotel_name' => $hotel->name,
                    'room_id'    => $room->id,
                    'room_name'  => $room->title,
                    'night_cost' => $roomPrice->night_cost ?? null,
                    'start_date' => $roomPrice->start_date ?? null,
                    'end_date'   => $roomPrice->end_date ?? null,
                ];
            }
        }

        $roomsCollection = collect($roomsWithPrice)->keyBy('hotel_id');

        $data['hotelsWithPrice'] = $data['hotel']->map(function ($hotel) use ($roomsCollection) {
            if (isset($roomsCollection[$hotel->id])) {
                $room = $roomsCollection[$hotel->id];

                $hotel->room_id    = $room['room_id'];
                $hotel->room_name  = $room['night_cost'];
                $hotel->night_cost = $room['night_cost'];
                $hotel->start_date = $room['start_date'];
                $hotel->end_date   = $room['end_date'];
            } else {
                $hotel->room_id    = null;
                $hotel->room_name  = null;
                $hotel->night_cost = null;
                $hotel->start_date = null;
                $hotel->end_date   = null;
            }
            return $hotel;
        });

        // SLIDERS
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();

        // CURRENT DATE PRICE COLLECTION
        $formatted_date = Carbon::now()->format('Y-m-d');

        $data['hotel_prices'] = HotelPrice::where('start_date', '<=', $formatted_date)
            ->where('end_date', '>=', $formatted_date)
            ->whereIn('hotel_id', $data['hotel']->pluck('id'))
            ->get()
            ->keyBy('hotel_id');

        // CITIES
        $cityIds = $data['hotel']->pluck('city_id')->unique();
        $data['cities'] = City::whereIn('id', $cityIds)->get();

        return view('front/hotelsbooking', $data);
    }


    // public function hotelsbooking()
    // {
    //     // Get all hotels
    //     $data['hotel'] = Hotels::where('show_front',1)->get();
    
    //     // Get all sliders for hotels
    //     $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();
    
    //     // Get today's date in the required format
    //     $formatted_date = Carbon::now()->format('Y-m-d');
    
    //     // Get hotel prices that are valid for today
    //     $data['hotel_prices'] = HotelPrice::where('start_date', '<=', $formatted_date)
    //                     ->where('end_date', '>=', $formatted_date)
    //                     ->whereIn('hotel_id', $data['hotel']->pluck('id'))
    //                     ->get()
    //                     ->keyBy('hotel_id');
        
                        
    //     $cityIds = $data['hotel']->pluck('city_id')->unique();
    
    //     // Fetch city names by using the city_ids from the Cities table
    //     $data['cities'] = City::whereIn('id', $cityIds)->get();
    
    //     // Pass the data to the view
    //     return view('front/hotelsbooking', $data);
    // }

   

//  public function filterHotels(Request $request)
//     {
//         $city_id = $request->query('city_id');
//         $start_date = $request->query('start_date');
//         $end_date = $request->query('end_date');
//         $min_price = $request->query('min_price');
//         $max_price = $request->query('max_price');

//         $query = Hotels::where('show_front', 1);

//         if ($city_id) {
//             $query->where('city_id', $city_id);
//         }

//         $hotels = $query->get();
//         $hotel_ids = $hotels->pluck('id');

//         $formatted_start_date = null;
//         $formatted_end_date = null;

//         try {
//             if (!empty($start_date)) {
//                 $formatted_start_date = Carbon::createFromFormat('m-d-Y', $start_date)->format('Y-m-d');
//             }
//             if (!empty($end_date)) {
//                 $formatted_end_date = Carbon::createFromFormat('m-d-Y', $end_date)->format('Y-m-d');
//             }
//         } catch (\Exception $e) {
//             return redirect()->back()->withErrors(['Invalid date format provided.']);
//         }

//         $hotel_prices = collect();
//         $filtered_hotels = $hotels;

//         if ($formatted_start_date && $formatted_end_date) {
//             $hotel_prices_query = HotelPrice::whereIn('hotel_id', $hotel_ids)
//                 ->where('start_date', '<=', $formatted_start_date)
//                 ->where('end_date', '>=', $formatted_end_date);

//             if ($min_price) {
//                 $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) >= ?', [$min_price]);
//             }

//             if ($max_price) {
//                 $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) <= ?', [$max_price]);
//             }

//             $hotel_prices = $hotel_prices_query->get()->keyBy('hotel_id');

//             $filtered_hotels = $hotels->filter(function ($hotel) use ($hotel_prices, $min_price, $max_price) {
//                 $min = $min_price ?? 0;
//                 $max = $max_price ?? 1000000;

//                 return isset($hotel_prices[$hotel->id]) &&
//                     $hotel_prices[$hotel->id]->night_cost >= $min &&
//                     $hotel_prices[$hotel->id]->night_cost <= $max;
//             });
//         }

//         $slider = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();

//         return view('front.hotel_list', [
//             'hotels' => $filtered_hotels,
//             'hotel_prices' => $hotel_prices,
//             'start_date' => $start_date,
//             'end_date' => $end_date,
//             'slider' => $slider,
//             'city_id' => $city_id,
//             'min_price' => $min_price,
//             'max_price' => $max_price,
//         ]);
//     }
  
public function filterHotels(Request $request)
{
    // Basic filters
    $city_id = $request->query('city_id');
    $start_date = $request->query('start_date');
    $end_date = $request->query('end_date');
    $min_price = $request->query('min_price');
    $max_price = $request->query('max_price');

    // New filters
    $stars = $request->query('star');
    $meal_plans = $request->query('meal_plan');
    $nearby = $request->query('nearby');
    $localities = $request->query('locality');
    $chains = $request->query('chains');
    $house_rules = $request->query('house_rules');
    $room_amenities = $request->query('room_amenities');
    $hotel_amenities = $request->query('hotel_amenities');

    // Hotels base query
    $query = Hotels::where('show_front', 1);

    if ($city_id) {
        $query->where('city_id', $city_id);
    }

    // -----------------------------
    //  FIX ROOM FILTERS APPLY LOGIC
    // -----------------------------
    $roomQuery = HotelsRoom::where('show_front', 'Yes');

   if (!empty($stars)) {
    $query->whereIn('hotel_category', $stars); // hotels table
}

    if (!empty($meal_plans)) {
        $roomQuery->whereIn('meal_plan', $meal_plans);
    }

    if (!empty($nearby)) {
        $roomQuery->whereIn('nearby', $nearby);
    }

    if (!empty($localities)) {
        $roomQuery->whereIn('locality', $localities);
    }

    if (!empty($chains)) {
        $roomQuery->whereIn('chains', $chains);
    }

    if (!empty($house_rules)) {
        $roomQuery->whereIn('house_rules', $house_rules);
    }

    if (!empty($room_amenities)) {
        $roomQuery->whereIn('room_amenities', $room_amenities);
    }

    if (!empty($hotel_amenities)) {
        $roomQuery->whereIn('hotel_amenities', $hotel_amenities);
    }

    // Get hotel IDs that match room filters
    $filteredRoomHotelIDs = $roomQuery->pluck('hotel_id')->unique();

    // Apply room filters to hotel query
    if ($filteredRoomHotelIDs->count()) {
        $query->whereIn('id', $filteredRoomHotelIDs);
    }

    // Final hotels list after applying filters
    $hotels = $query->get();
    $hotel_ids = $hotels->pluck('id');


    // -----------------------------
    // DATE + PRICE FILTERS
    // -----------------------------
    $formatted_start_date = $formatted_end_date = null;

    try {
        if (!empty($start_date)) {
            $formatted_start_date = Carbon::createFromFormat('m-d-Y', $start_date)->format('Y-m-d');
        }
        if (!empty($end_date)) {
            $formatted_end_date = Carbon::createFromFormat('m-d-Y', $end_date)->format('Y-m-d');
        }
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['Invalid date format provided.']);
    }

    $hotel_prices = collect();
    $filtered_hotels = $hotels;

    if ($formatted_start_date && $formatted_end_date) {
        $hotel_prices_query = HotelPrice::whereIn('hotel_id', $hotel_ids)
            ->where('start_date', '<=', $formatted_start_date)
            ->where('end_date', '>=', $formatted_end_date);

        if ($min_price) {
            $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) >= ?', [$min_price]);
        }

        if ($max_price) {
            $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) <= ?', [$max_price]);
        }

        $hotel_prices = $hotel_prices_query->get()->keyBy('hotel_id');

        $filtered_hotels = $hotels->filter(function ($hotel) use ($hotel_prices, $min_price, $max_price) {
            return isset($hotel_prices[$hotel->id]) &&
                $hotel_prices[$hotel->id]->night_cost >= ($min_price ?? 0) &&
                $hotel_prices[$hotel->id]->night_cost <= ($max_price ?? 999999);
        });
    }

    // Common data
    $data['hotel'] = Hotels::where('show_front', 1)->get();
    $cityIds = $data['hotel']->pluck('city_id')->unique();
    $cities = City::whereIn('id', $cityIds)->get();
    $slider = Slider::where('type', 'hotel')->orderBy('id', 'DESC')->get();

    // Add room price for hotels
    $roomsWithPrice = [];

    foreach ($filtered_hotels as $hotel) {
        $room = HotelsRoom::where('hotel_id', $hotel->id)
            ->where('show_front', 'Yes')
            ->first();

        if ($room) {
            $roomPrice = HotelPrice::where('room_id', $room->id)
                ->when($formatted_start_date, fn($q) => $q->where('start_date', '<=', $formatted_start_date))
                ->when($formatted_end_date, fn($q) => $q->where('end_date', '>=', $formatted_end_date))
                ->first();

            $roomsWithPrice[] = [
                'hotel_id'   => $hotel->id,
                'hotel_name' => $hotel->name,
                'room_id'    => $room->id,
                'room_name'  => $room->title,
                'night_cost' => $roomPrice->night_cost ?? null,
                'start_date' => $roomPrice->start_date ?? null,
                'end_date'   => $roomPrice->end_date ?? null,
            ];
        }
    }

    $roomsCollection = collect($roomsWithPrice)->keyBy('hotel_id');

    $hotelsWithPrice = $filtered_hotels->map(function ($hotel) use ($roomsCollection) {
        if (isset($roomsCollection[$hotel->id])) {
            foreach ($roomsCollection[$hotel->id] as $k => $v) {
                $hotel->$k = $v;
            }
        }
        return $hotel;
    });

    return view('front.hotel_list', [
        'hotels' => $hotelsWithPrice,
        'hotel_prices' => $hotel_prices,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'slider' => $slider,
        'city_id' => $city_id,
        'min_price' => $min_price,
        'max_price' => $max_price,
        'cities' => $cities
    ]);
}

    
//  public function filterHotels(Request $request)
//     {
//         $city_id = $request->query('city_id');
//         $start_date = $request->query('start_date');
//         $end_date = $request->query('end_date');
//         $min_price = $request->query('min_price');
//         $max_price = $request->query('max_price');
//        $params = $request->query();
//         // NEW FILTERS
//         $stars = $request->query('star'); // array
//         $meal_plans = $request->query('meal_plan'); // array
//         $nearby = $request->query('nearby'); // array
//         $localities = $request->query('locality'); // array
//         $chains = $request->query('chains'); // array
//         $house_rules = $request->query('house_rules'); // array
//         $room_amenities = $request->query('room_amenities'); // array
//         $hotel_amenities = $request->query('hotel_amenities'); // array

//         $query = Hotels::where('show_front', 1);
//         $query2 = HotelsRoom::where('show_front', 1);

//         if ($city_id) {
//             $query->where('city_id', $city_id);
//         }

//         if (!empty($stars)) {
//             $query2->whereIn('hotel_category', $stars);
//         }

//         if (!empty($meal_plans)) {
//             $query2->whereIn('meal_plan', $meal_plans);
//         }

//         if (!empty($nearby)) {
//             $query2->whereIn('nearby', $nearby);
//         }

//         if (!empty($localities)) {
//             $query2->whereIn('locality', $localities);
//         }

//         if (!empty($chains)) {
//             $query2->whereIn('chains', $chains);
//         }

//         if (!empty($house_rules)) {
//             $query2->whereIn('house_rules', $house_rules);
//         }

//         if (!empty($room_amenities)) {
//             $query2->whereIn('room_amenities', $room_amenities);
//         }

//         if (!empty($hotel_amenities)) {
//             $query2->whereIn('hotel_amenities', $hotel_amenities);
//         }

//         $hotels = $query->get();
//         $hotel_ids = $hotels->pluck('id');
//       $filtered_hotels = $query->get();
//         // Dates
//         $formatted_start_date = null;
//         $formatted_end_date = null;

//         try {
//             if (!empty($start_date)) {
//                 $formatted_start_date = Carbon::createFromFormat('m-d-Y', $start_date)->format('Y-m-d');
//             }
//             if (!empty($end_date)) {
//                 $formatted_end_date = Carbon::createFromFormat('m-d-Y', $end_date)->format('Y-m-d');
//             }
//         } catch (\Exception $e) {
//             return redirect()->back()->withErrors(['Invalid date format provided.']);
//         }

//         $hotel_prices = collect();
//         $filtered_hotels = $hotels;

//         if ($formatted_start_date && $formatted_end_date) {
//             $hotel_prices_query = HotelPrice::whereIn('hotel_id', $hotel_ids)
//                 ->where('start_date', '<=', $formatted_start_date)
//                 ->where('end_date', '>=', $formatted_end_date);

//             if ($min_price) {
//                 $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) >= ?', [$min_price]);
//             }

//             if ($max_price) {
//                 $hotel_prices_query->whereRaw('CAST(night_cost AS UNSIGNED) <= ?', [$max_price]);
//             }

//             $hotel_prices = $hotel_prices_query->get()->keyBy('hotel_id');

//             $filtered_hotels = $hotels->filter(function ($hotel) use ($hotel_prices, $min_price, $max_price) {
//                 $min = $min_price ?? 0;
//                 $max = $max_price ?? 1000000;

//                 return isset($hotel_prices[$hotel->id]) &&
//                     $hotel_prices[$hotel->id]->night_cost >= $min &&
//                     $hotel_prices[$hotel->id]->night_cost <= $max;
//             });
//         }

//         $data['hotel'] = Hotels::where('show_front',1)->get();
  
//         $cityIds = $data['hotel']->pluck('city_id')->unique();
    
//         $cities = City::whereIn('id', $cityIds)->get();

//         $slider = Slider::orderBy('id', 'DESC')->where('type', 'hotel')->get();


//        $roomsWithPrice = []; // final data array

//         foreach ($filtered_hotels as $hotel) {

//             // Get first room with show_front = 'Yes'
//             $room = HotelsRoom::where('hotel_id', $hotel->id)
//                 ->where('show_front', 'Yes')
//                 ->first();

//             if ($room) {

//                 // Get room price based on date range
//                 $roomPrice = HotelPrice::where('room_id', $room->id)
//                     ->when($formatted_start_date, function($query) use ($formatted_start_date) {
//                         $query->where('start_date', '<=', $formatted_start_date);
//                     })
//                     ->when($formatted_end_date, function($query) use ($formatted_end_date) {
//                         $query->where('end_date', '>=', $formatted_end_date);
//                     })
//                     ->first();

//                 $roomsWithPrice[] = [
//                     'hotel_id'   => $hotel->id,
//                     'hotel_name' => $hotel->name,
//                     'room_id'    => $room->id,
//                     'room_name'  => $room->title,
//                     'night_cost' => $roomPrice->night_cost ?? null,
//                     'start_date' => $roomPrice->start_date ?? null,
//                     'end_date'   => $roomPrice->end_date ?? null,
//                 ];
//             }
//         }

        
//         $roomsCollection = collect($roomsWithPrice)->keyBy('hotel_id');

//         // Attach night_cost and room info to each hotel in the filtered collection
//         $hotelsWithPrice = $filtered_hotels->map(function ($hotel) use ($roomsCollection) {
//             if (isset($roomsCollection[$hotel->id])) {
//                 $room = $roomsCollection[$hotel->id]; // array

//                 $hotel->room_id    = $room['room_id'];
//                 $hotel->room_name  = $room['room_name'];
//                 $hotel->night_cost = $room['night_cost'];
//                 $hotel->start_date = $room['start_date'];
//                 $hotel->end_date   = $room['end_date'];
//             } else {
//                 $hotel->room_id = null;
//                 $hotel->room_name = null;
//                 $hotel->night_cost = null;
//                 $hotel->start_date = null;
//                 $hotel->end_date = null;
//             }
//             return $hotel;
//         });

//         // return $hotelsWithPrice;
//         return view('front.hotel_list', [
//             'hotels' => $hotelsWithPrice,
//                 'hotel_prices' => $hotel_prices,
//                 'start_date' => $start_date,
//                 'end_date' => $end_date,
//                 'slider' => $slider,
//                 'city_id' => $city_id,
//                 'min_price' => $min_price,
//                 'max_price' => $max_price,
//                 'cities' => $cities,
//                 // 'rooms' => $roomsWithPrice,
//             ]);
//     }
        



    // public function hotel_details(Request $request, $id)
    // {
    //     $id = base64_decode($id);
    //     $data['hotel'] = Hotels::where('id',$id)->first();
    //     $data['hotel_room'] = HotelsRoom::where('hotel_id',$id)->get();

    //      $start_dates = $request->check_in_date ? Carbon::parse($request->check_in_date)->format('Y-m-d') : null;

    //     $end_dates = $request->check_out_date ? Carbon::parse($request->check_out_date)->format('Y-m-d') : null;

    //     $data['hotel_price'] = HotelPrice::where('room_id', $data['hotel_room']->id)
    //             ->where('start_date', '<=', $start_dates)
    //             ->where('end_date', '>=', $end_dates)
    //             ->first();

    //     return view('front/hotel_details',$data);
    // }

    public function hotel_details(Request $request, $id)
    {
        $id = base64_decode($id);
        $data['hotel'] = Hotels::where('id', $id)->first();
        $data['hotel_room'] = HotelsRoom::with('prices')->where('hotel_id', $id)->get();
        $data['hotel_room_1'] = HotelsRoom::with('prices')->where('hotel_id', $id)->inRandomOrder()->first();

        $data['start_date'] =  Carbon::now()->format('Y-m-d') ?? null;
        $data['end_date'] =  Carbon::now()->format('Y-m-d') ?? null;

        foreach ($data['hotel_room'] as $room) {
            if ($data['start_date'] && $data['end_date']) {
                $room->price = HotelPrice::where('room_id', $room->id)
                    ->where('start_date', '<=', $data['start_date'])
                    ->where('end_date', '>=', $data['end_date'])
                    ->first();
            } else {
                $room->price = null;
            }
        }

       if (!$data['hotel_room_1']) {
            $data['hotel_room_1'] = HotelsRoom::with('prices')
                ->where('hotel_id', $id)
                ->first();
        }

        if ($data['hotel_room_1']) {
            if ($data['start_date'] && $data['end_date']) {
                $data['hotel_room_1']->price = HotelPrice::where('room_id', $data['hotel_room_1']->id)
                    ->where('start_date', '<=', $data['start_date'])
                    ->where('end_date', '>=', $data['end_date'])
                    ->first();
            } else {
                $data['hotel_room_1']->price = null;
            }
        }

        $data['hotels'] = Hotels::where('show_front',1)->get();
        $cityIds = $data['hotels']->pluck('city_id')->unique();
        $data['cities'] = City::whereIn('id', $cityIds)->get();

        return view('front.hotel_details', $data);
    }


    public function hotelconfirmation(Request $request, $id) {
        $id = base64_decode($id);  // Decode the ID
        $data['packagebookingtemp'] = HotelBooking::where('id', $id)->first();
        return view('front/hotel_confirmation', $data);
    }
    
    public function final_booking(Request $request,$id) {

         $data['start_date'] =  Carbon::now()->format('Y-m-d') ?? null;
        $data['end_date'] =  Carbon::now()->format('Y-m-d') ?? null;

        $data['hotel_room_1'] = HotelsRoom::with('prices')->where('id', $id)->inRandomOrder()->first();
        $data['hotel'] = Hotels::where('id', $data['hotel_room_1']->hotel_id)->first();

          if ($data['hotel_room_1']) {
            if ($data['start_date'] && $data['end_date']) {
                $data['hotel_room_1']->price = HotelPrice::where('room_id', $data['hotel_room_1']->id)
                    ->where('start_date', '<=', $data['start_date'])
                    ->where('end_date', '>=', $data['end_date'])
                    ->first();
            } else {
                $data['hotel_room_1']->price = null;
            }
        }

        return view('front/final_booking',$data);
    }

public function calculatePrice(Request $request, $id)
{
    $start_dates = $request->check_in_date ? Carbon::parse($request->check_in_date)->format('Y-m-d') : null;
    $end_dates   = $request->check_out_date ? Carbon::parse($request->check_out_date)->format('Y-m-d') : null;

    $existsDate = HotelPrice::where('room_id', $id)
        ->where('start_date', '<=', $start_dates)
        ->where('end_date', '>=', $end_dates)
        ->first();

    if (!$existsDate) {
        return response()->json([
            'status' => false,
            'message' => "Price Not Available."
        ]);
    }

    $checkIn  = Carbon::parse($request->check_in_date);
    $checkOut = Carbon::parse($request->check_out_date);
    $numberOfNights = $checkOut->diffInDays($checkIn);

    // 🍽 Meals cost
    if ($request->meals == 'no_meal') {
        $meal_cost = 0;
    } elseif ($request->meals == 'breakfast') {
        $meal_cost = $existsDate->meal_plan_breakfast_cost ?? 0;
    } elseif ($request->meals == 'breakfast_dinner') {
        $meal_cost = $existsDate->meal_plan_breakfast_lunch_dinner_cost ?? 0;
    } else {
        $meal_cost = $existsDate->meal_plan_all_meals_cost ?? 0;
    }

    // 🛏 Extra Bed
    if ($request->meals == 'no_meal') {
        $extra_meal_cost = $existsDate->extra_bed_cost ?? 0;
    } elseif ($request->meals == 'breakfast') {
        $extra_meal_cost = $existsDate->extra_breakfast_cost ?? 0;
    } elseif ($request->meals == 'breakfast_dinner') {
        $extra_meal_cost = $existsDate->extra_breakfast_lunch_dinner_cost ?? 0;
    } else {
        $extra_meal_cost = $existsDate->extra_all_meals_cost ?? 0;
    }

    // 👶 Child No Bed
    if ($request->meals == 'no_meal') {
        $nochild_meal_cost = $existsDate->child_no_bed_infant_cost ?? 0;
    } elseif ($request->meals == 'breakfast') {
        $nochild_meal_cost = $existsDate->child_breakfast_cost ?? 0;
    } elseif ($request->meals == 'breakfast_dinner') {
        $nochild_meal_cost = $existsDate->child_breakfast_lunch_dinner_cost ?? 0;
    } else {
        $nochild_meal_cost = $existsDate->child_all_meals_cost ?? 0;
    }

    // ✔ Total Calculation
    $meal_cost_total = $meal_cost * $request->room_count * $numberOfNights;
    $extra_meal_cost_total = $extra_meal_cost * $numberOfNights * $request->beds;
    $nochild_meal_cost_total = $nochild_meal_cost * $numberOfNights * $request->nobed;

    $base_room_cost = $existsDate->night_cost * $numberOfNights;

    $total = $base_room_cost + $meal_cost_total + $extra_meal_cost_total + $nochild_meal_cost_total;

    return response()->json([
        'status' => true,
        'total_cost' => $total,
        'meal_cost_total' => $meal_cost_total,
        'extra_meal_cost_total' => $extra_meal_cost_total,
        'request->meals' => $request->meals,
        'nochild_meal_cost_total' => $nochild_meal_cost_total,
        'base_room_cost' => $base_room_cost,
        'nights' => $numberOfNights
    ]);
}

    // public function add_hotel_confirm_booking(Request $request,$id)
    // {
    //     $packagetempbooking = HotelBooking::where('id',$id)->first();
    //     $user =  Auth::guard('agent')->user();
    //     $wallet =  Wallet::where('user_id',$user->id)->first();

    //     $packagebooking = new HotelBooking2();
    //     $packagebooking->hotel_order_id = $id;
    //     $packagebooking->user_id = $packagetempbooking->user_id;
    //     $packagebooking->hotel_id = $packagetempbooking->hotel_id;
    //     $packagebooking->fetched_price = $request->fetched_price;
    //     $packagebooking->agent_margin = $request->agent_margin;
    //     $packagebooking->final_price = $request->final_price;
    //     $packagebooking->salesman_name = $request->salesman_name;
    //     $packagebooking->salesman_mobile = $request->salesman_mobile;
    //     $packagebooking->status = 0;
    //     $packagebooking->save();

    //     $packagetempbooking->update(['status' => 1]);

    //     return redirect()->route('index')->with('message', 'Hotel Booking Created Successfully');
    // }

    public function add_hotel_confirm_booking(Request $request, $id)
    {
        $packagetempbooking = HotelBooking::where('id', $id)->first();
        $user = Auth::guard('agent')->user();

        // Fetch wallet
        $wallet = Wallet::where('user_id', $user->id)->first();

        if (!$wallet) {
            return redirect()->back()->with('message', 'Wallet not found!');
        }

        // Amount to deduct
        $deductAmount = floatval($request->fetched_price); // only fetched price deducted

        // New balance (can go negative)
        $newBalance = $wallet->balance - $deductAmount;

        // Check negative limit
        if ($newBalance < -$user->negative_limit_amount) {
            return redirect()->back()->with('message', 'Wallet limit exceeded! You cannot go beyond negative limit of ₹' . $user->negative_limit_amount);
        }

        // Update wallet balance
        $wallet->balance = $newBalance;
        $wallet->save();

        // Save booking
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

        // Update temp booking status
        $packagetempbooking->update(['status' => 1]);

        return redirect()->route('index')->with('message', 'Hotel Booking Created Successfully & Wallet Updated');
    }


    public function add_hotel_booking(Request $request,$id)
    {

        $start_dates = $request->check_in_date ? Carbon::parse($request->check_in_date)->format('Y-m-d') : null;

        $end_dates = $request->check_out_date ? Carbon::parse($request->check_out_date)->format('Y-m-d') : null;

        $hotel_room = HotelsRoom::where('id', $id)->first();

        $existsDate = HotelPrice::where('room_id', $id)
                // ->where('room_category', $request->room_id)
                ->where('start_date', '<=', $start_dates)
                ->where('end_date', '>=', $end_dates)
                ->first();

            $checkIn = Carbon::parse($request->check_in_date);
            $checkOut = Carbon::parse($request->check_out_date);

            $numberOfNights = $checkOut->diffInDays($checkIn);


            if (empty($existsDate)) {
                $msg = "Price Not Available.";
            }   

             if (empty($existsDate)) {
                return redirect()->back()->with('message', $msg);
            }


        // Meals
        // return $request->meals;

        if($request->meals == 'no_meal'){

           $meal_cost =  0;

        }elseif($request->meals == 'breakfast'){

            $meal_cost = $existsDate->meal_plan_breakfast_cost ?? 0;

        }elseif($request->meals == 'breakfast_lunch'){

            $meal_cost = $existsDate->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }elseif($request->meals == 'breakfast_dinner'){

            $meal_cost = $existsDate->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $meal_cost = $existsDate->meal_plan_all_meals_cost ?? 0;
        }

     // extra bed cost

        if($request->meals == 'no_meal'){

            $extra_meal_cost = $existsDate->extra_bed_cost ?? 0;

        }elseif($request->meals == 'breakfast'){

            $extra_meal_cost = $existsDate->extra_breakfast_cost ?? 0;

        }elseif($request->meals == 'breakfast_dinner'){

            $extra_meal_cost = $existsDate->extra_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $extra_meal_cost = $existsDate->extra_all_meals_cost ?? 0;
        }


        // Child With No Bed

         if($request->meals == 'no_meal'){

           $nochild_meal_cost = $existsDate->child_no_bed_infant_cost ?? 0;

        }elseif($request->meals == 'breakfast'){

            $nochild_meal_cost = $existsDate->child_breakfast_cost ?? 0;

        }elseif($request->meals == 'breakfast_dinner'){

            $nochild_meal_cost = $existsDate->child_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $nochild_meal_cost = $existsDate->child_all_meals_cost ?? 0;
        }

        // return $request->children_ages_array;

        // return  $id;
        $wildlife = new HotelBooking();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->hotel_id = $hotel_room->hotel_id;
        $wildlife->check_in_date = $request->check_in_date;
        $wildlife->check_out_date = $request->check_out_date;
        $wildlife->no_occupants = $request->guest_count;
        $wildlife->child_count = $request->child_count;
        $wildlife->night_count = $numberOfNights;
        $wildlife->room_count = $request->room_count;
        $wildlife->meals = $request->meals;
        $wildlife->beds = $request->beds;
        $wildlife->nobed = $request->nobed;
        $wildlife->children_ages = $request->children_ages_array;
        $wildlife->room_id = $id ?? '';
        $wildlife->status = 0;

        $meal_cost_total = $meal_cost * $request->room_count * $numberOfNights;
        $extra_meal_cost_total = $extra_meal_cost * $numberOfNights * $request->beds;
        $nochild_meal_cost_total = $nochild_meal_cost * $numberOfNights * $request->nobed;
        $base_room_cost =  $existsDate->night_cost * $numberOfNights;


        $total = $base_room_cost + $meal_cost_total + $extra_meal_cost_total + $nochild_meal_cost_total;
// return $request->nobed;
        $finel = $request->room_count * $existsDate->night_cost * $numberOfNights;
        $wildlife->cost = $total;

        // if($request->room_id == 'deluxe'){
        // }else{
        //   $wildlife->cost = $total;
        // }
        $wildlife->save();

        return redirect()->route('hotel_confirmation', ['id' => base64_encode($wildlife->id)]);
    }


    public function add_package_booking(Request $request, $id)
    {

         $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'pickup_location' => 'required',
        'vehicle_count' => 'required',
        'number_of_rooms' => 'required',
        'children_1_5' => 'required',
        'children_5_11' => 'required',
        'adults_count' => 'required',
        'child_no_bed_child_count' => 'required',
        'meal' => 'required',
        'hotel_preference' => 'required',
        'hotel_category' => 'required',
        'vehicle_options' => 'required',
    ]);

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
        

      $package_vehicle = VehicleCost::where('package_id', $id)->first();
        // $package_price = PackagePrice::where('package_id', $id)->where('hotel_category',$request->hotel_preference)->where('room_category',$request->room_category)
        //         ->where('start_date', '<=', $start_dates)
        //         ->where('end_date', '>=', $end_dates)
        //         ->first();

        //         if(empty($package_price)){
        //           return redirect()->back()->with('message', "Price not available for these dates.");
        //           }

        $package_price = null;
        
        $existsHotel = PackagePrice::where('package_id', $id)
                ->where('hotel_category', $request->hotel_preference)
                ->exists();

            $existsRoom = PackagePrice::where('package_id', $id)
                ->where('hotel_category', $request->hotel_preference)
                ->where('room_category', $request->hotel_category)
                ->exists();

            $existsDate = PackagePrice::where('package_id', $id)
                ->where('hotel_category', $request->hotel_preference)
                ->where('room_category', $request->hotel_category)
                ->where('start_date', '<=', $start_dates)
                ->where('end_date', '>=', $end_dates)
                ->exists();

            if (!$existsHotel) {
                $msg = "No price entry found for selected hotel category.";
            } elseif (!$existsRoom) {
                $msg = "Price exists for hotel category, but not for selected room category.";
            } elseif (!$existsDate) {
                $msg = "Price exists for hotel and room category, but not for these dates.";
            } else {
                $package_price = PackagePrice::where('package_id', $id)
                    ->where('hotel_category', $request->hotel_preference)
                    ->where('room_category', $request->hotel_category)
                    ->where('start_date', '<=', $start_dates)
                    ->where('end_date', '>=', $end_dates)
                    ->first();
                    // return $package_price;
                }

             if (!$package_price) {
                return redirect()->back()->with('message', $msg);
            }

        $wildlife = new PackageBookingTemp();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->package_id = $id;
        $wildlife->start_date = $start_date;
        $wildlife->end_date = $end_date;
        $wildlife->room_category = $request->hotel_category;
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

        $wildlife->pickup_location = $request->pickup_location;  
        // $wildlife->drop_location = $request->drop_location;  
        $wildlife->vehicle_count = $request->vehicle_count;  
        $wildlife->number_of_rooms = $request->number_of_rooms;  
        $wildlife->hotel_category = $request->hotel_category;   
        $wildlife->children_5_11 = $request->children_5_11;  
        $wildlife->children_1_5 = $request->children_1_5;   
        $wildlife->status = 0;

      $package_location = LocationCost::where('package_id', $id)->where('location',$request->pickup_location)->where('vehicle',$request->vehicle_options)->first();
   
        if($request->meal == 'no_meal'){

           $meal_cost =  0;

        }elseif($request->meal == 'breakfast'){

            $meal_cost = $package_price->meal_plan_breakfast_cost ?? 0;

        }elseif($request->meal == 'breakfast_lunch'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }elseif($request->meal == 'breakfast_dinner'){

            $meal_cost = $package_price->meal_plan_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $meal_cost = $package_price->meal_plan_all_meals_cost ?? 0;
        }

        
        if($request->meal == 'no_meal'){

            $extra_meal_cost = $package_price->extra_bed_cost ?? 0;

        }elseif($request->meal == 'breakfast'){

            $extra_meal_cost = $package_price->extra_breakfast_cost ?? 0;

        }elseif($request->meal == 'breakfast_dinner'){

            $extra_meal_cost = $package_price->extra_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $extra_meal_cost = $package_price->extra_all_meals_cost ?? 0;
        }

        if($request->meal == 'no_meal'){

           $nochild_meal_cost = $package_price->child_no_bed_infant_cost ?? 0;

        }elseif($request->meal == 'breakfast'){

            $nochild_meal_cost = $package_price->child_breakfast_cost ?? 0;

        }elseif($request->meal == 'breakfast_dinner'){

            $nochild_meal_cost = $package_price->child_breakfast_lunch_dinner_cost ?? 0;

        }else{

            $nochild_meal_cost = $package_price->child_all_meals_cost ?? 0;
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

        // if($request->hotel_category == 'hotel_delux_cost'){
        //     $hotel_cat_cost = $package_price->hotel_delux_cost ?? 0;
        // }else{
        //     $hotel_cat_cost = $package_price->hotel_premium_cost ?? 0;
        // }
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



        $total_night_cost = $hotel_preference_cost *  $night_count;
        $adults_cost = $package_price->adults_cost *  $request->adults_count;

        $children_5_11 = $package_price->child_no_bed_infant_cost *  $request->children_5_11;


        $children_1_5 = $package_price->children_1_5_cost *  $request->children_1_5;

        $child_with_bed_cost = $package_price->child_with_bed_cost *  $request->child_with_bed_count;

       


        $total_meal_cost = $meal_cost;


        $total_vehicle_options_cost = $vehicle_options_cost * $request->vehicle_count;

        $room_cost =  $package_price->room_cost * $request->number_of_rooms;

        $package_location_cost =  $package_location->cost * $request->vehicle_count;

        //  $extrabed_cost = $package_price->extra_bed_cost * $request->extra_bed;
         $extrabed_meal_cost = $extra_meal_cost * $request->extra_bed;

        //  if($request->child_no_bed_child_count == 0){

        //   $child_meal_cost = $package_price->child_no_bed_infant_cost *  $request->child_no_bed_child_count;
          
        //  }else{

             $child_meal_cost = $nochild_meal_cost * $request->child_no_bed_child_count;
        //  }



        $fin_price = $room_cost * $night_count;
        
        // $fin_price_0 = $hotel_cat_cost * $night_count;
        $fin_price_1 = $request->number_of_rooms * $total_meal_cost * $night_count;
        $fin_price_2 = $total_vehicle_options_cost;
        

        $fin_price_3 = $extrabed_meal_cost * $night_count;
        $fin_price_01 = $child_meal_cost * $night_count;


        $fin_price_4 =  $package_location_cost + $fin_price_01;

        // return $night_count;

        // $fin_price_4 =  $package_location_cost + $fin_price_01 + $children_5_11;
        
        $total_price = $fin_price + $fin_price_1 + $fin_price_2 + $fin_price_3 + $fin_price_4;

        $admin_margin =  $package_price->admin_margin;

        $finaltotal = $admin_margin + $total_price; 

        $wildlife->total_cost = $finaltotal;

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

            return redirect()->route('index')->with([
                'message' => 'Package Booking Created Successfully',
                'download_pdf_route' => route('pdf.download', [
                    'user_id' => $packagebooking->user_id,
                    'booking_id' => $packagebooking->id,
                    'pdf_name' => urlencode(basename($packagebooking->package->pdf))
                ])
            ]);
        }

        private function downloadpdf($packagebooking){

                 return redirect()->route('pdf.download', [
                    'user_id' => $packagebooking->user_id,
                    'booking_id' => $packagebooking->id,
                    'pdf_name' => urlencode(basename($packagebooking->package->pdf))
                ]);

        }


    public function wildlife()
    {
        $data['wildlife'] = WildlifeSafari::where('status',1)->get();
        $cityIds = $data['wildlife']->pluck('state_id')->unique();

        $data['cities'] = State::whereIn('id', $cityIds)->get();

        $data['slider'] = Slider::orderBy('id','DESC')->where('type','safari')->get();
        return view('front/wildlife',$data);
    }






    public function getLivePrice(Request $request)
    {
        try {
            $start_dates = $request->check_in_date ? Carbon::parse($request->check_in_date)->format('Y-m-d') : null;
            $end_dates = $request->check_out_date ? Carbon::parse($request->check_out_date)->format('Y-m-d') : null;

            $roomId = $request->room_id;
            $hotel_room = HotelsRoom::find($roomId);

            $existsDate = HotelPrice::where('room_id', $roomId)
                ->where('start_date', '<=', $start_dates)
                ->where('end_date', '>=', $end_dates)
                ->first();

            if (!$existsDate) {
                return response()->json([
                    'message' => 'Price Not Available.',
                    'total' => 0,
                    'status' => 404
                ]);
            }

            $checkIn = Carbon::parse($start_dates);
            $checkOut = Carbon::parse($end_dates);
            $numberOfNights = $checkOut->diffInDays($checkIn);

            $roomCount = (int) $request->room_count ?? 0;
            $beds = (int) $request->beds ?? 0;
            $nobed = (int) $request->nobed ?? 0;
            $meal = $request->meal ?? 'no_meal';

            // Meal cost
            if ($meal == 'no_meal') {
                $meal_cost = 0;
            } elseif ($meal == 'breakfast') {
                $meal_cost = $existsDate->meal_plan_breakfast_cost ?? 0;
            } elseif ($meal == 'breakfast_dinner') {
                $meal_cost = $existsDate->meal_plan_breakfast_lunch_dinner_cost ?? 0;
            } else {
                $meal_cost = $existsDate->meal_plan_all_meals_cost ?? 0;
            }

            // Extra bed
            if ($meal == 'no_meal') {
                $extra_meal_cost = $existsDate->extra_bed_cost ?? 0;
            } elseif ($meal == 'breakfast') {
                $extra_meal_cost = $existsDate->extra_breakfast_cost ?? 0;
            } elseif ($meal == 'breakfast_dinner') {
                $extra_meal_cost = $existsDate->extra_breakfast_lunch_dinner_cost ?? 0;
            } else {
                $extra_meal_cost = $existsDate->extra_all_meals_cost ?? 0;
            }

            // No bed child
            if ($meal == 'no_meal') {
                $nochild_meal_cost = $existsDate->child_no_bed_infant_cost ?? 0;
            } elseif ($meal == 'breakfast') {
                $nochild_meal_cost = $existsDate->child_breakfast_cost ?? 0;
            } elseif ($meal == 'breakfast_dinner') {
                $nochild_meal_cost = $existsDate->child_breakfast_lunch_dinner_cost ?? 0;
            } else {
                $nochild_meal_cost = $existsDate->child_all_meals_cost ?? 0;
            }

            // Final total
            $meal_cost_total = $meal_cost * $roomCount * $numberOfNights;
            $extra_meal_cost_total = $extra_meal_cost * $numberOfNights * $beds;
            $nochild_meal_cost_total = $nochild_meal_cost * $numberOfNights * $nobed;

            $total = $meal_cost_total + $extra_meal_cost_total + $nochild_meal_cost_total;

            return response()->json([
                'total' => $total,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
                'status' => 500
            ]);
        }
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
          $data['start_date'] =  Carbon::now()->format('Y-m-d') ?? null;
        $data['end_date'] =  Carbon::now()->format('Y-m-d') ?? null;

        $data['price'] = SafariPrices::where('safari_id', $id)
                    ->where('start_month', '<=', $data['start_date'])
                    ->where('end_month', '>=', $data['end_date'])
                    ->first();

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

               if (!Auth::guard('agent')->check()) {
                    session(['wildlife_booking_form_data' => $request->all()]);
                    return redirect()->route('login');
                }

            $childrenCount = (int) $request->input('children_count', 0);

            $childAges = [];

            for ($i = 0; $i < $childrenCount; $i++) {
                $key = 'child_age_' . $i;
                if ($request->has($key)) {
                    $childAges[] = $request->input($key);
                }
            }

        $data['start_date'] = Carbon::now()->format('Y-m-d');
        $data['end_date']   = Carbon::now()->format('Y-m-d');
        
        $dayType = Carbon::now()->isWeekend() ? 'Weekend' : 'Weekday';
        // return $dayType;

        if ($request->vehicle == 'Canter') {
            $veh = 'Per_Seat';
        } else {
            $veh = 'Per_Jeep';
        }

        $price = SafariPrices::where('safari_id', $id)
            ->where('start_month', '<=', $data['start_date'])
            ->where('end_month', '>=', $data['end_date'])
            ->where('visitor_type', $request->guest_type)
            ->where('price_type', $veh)
            ->where('day_type', $dayType)
            ->first();


        if (!$price) {
            return redirect()->back()->with('message', 'Price not found.');
        }

        if($price->price_type == 'Per_Seat'){
            $finPrice = $price->price * $request->no_adults;
        }else{
              // Per Jeep (6 persons max per jeep)
            $totalPersons = (int)$request->no_adults + (int)$childrenCount;

            // Minimum 1 jeep
            $jeepCount = max(1, ceil($totalPersons / 6));

            // Total cost based on jeep count
            $finPrice = $price->price * $jeepCount;
        }

        $wildlife = new WildlifeSafariOrder();
        $wildlife->user_id = Auth::guard('agent')->id();
        $wildlife->safari_id = $id;
        $wildlife->date = $request->date;
        $wildlife->no_adults = $request->no_adults;
        $wildlife->no_persons = $request->children_count;
        $wildlife->no_kids = $request->no_kids;
        $wildlife->child_age = json_encode($childAges);
        $wildlife->guest_type = $request->guest_type;
        $wildlife->cost = $finPrice;
        $wildlife->jeep_count = $jeepCount ?? 0;
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

    // public function guide(Request $request)
    // {
    //     $data['city'] = City::all();

    //     if (session()->has('guide_form_data.city_id')) {
    //         $cityId = session('guide_form_data.city_id');

    //         $langs = TripGuide::where('city_id', $cityId)
    //             ->pluck('languages_id')
    //             ->unique();

    //         $guide_languages = Languages::whereIn('id', $langs)
    //             ->get()
    //             ->map(fn($l) => ['id' => $l->id, 'name' => $l->language_name]);
            
    //         session(['guide_languages' => $guide_languages]);
    //     }

    //         $data['tripguide'] = TripGuide::latest()->get(); 
    //         $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'guide')->get();
    //         $data['city'] = City::whereIn('id', $data['tripguide']->pluck('city_id'))->get(); 
    //         $data['state'] = State::whereIn('id', $data['tripguide']->pluck('state_id'))->get(); 

    //     return view('front/guide', $data);
    // }


    public function guide(Request $request)
    {
        $data['city'] = City::all();

        if (session()->has('guide_form_data.city_id')) {
            $cityId = session('guide_form_data.city_id');

            $tripGuides = TripGuide::where('city_id', $cityId)->get();

            $languageIds = $tripGuides->flatMap(function($tg) {
                if (!$tg->languages_id) {
                    return [];
                }
                $parts = collect(explode(',', $tg->languages_id))
                            ->map(fn($p) => trim($p))
                            ->filter(fn($p) => $p !== '');

                return $parts;
            })->unique()->values()->all(); 

            $guide_languages = Languages::whereIn('id', $languageIds)
                ->get()
                ->map(fn($l) => ['id' => $l->id, 'name' => $l->language_name]);

            session(['guide_languages' => $guide_languages]);
        }

        $data['tripguide'] = TripGuide::latest()->get();
        $data['slider'] = Slider::orderBy('id', 'DESC')
            ->where('type', 'guide')->get();
        $data['city'] = City::whereIn('id', $data['tripguide']->pluck('city_id'))->get();
        $data['state'] = State::whereIn('id', $data['tripguide']->pluck('state_id'))->get();

        return view('front/guide', $data);
    }


    // public function getLanguagesByCity($cityId)
    // {
    //     $tripGuides = TripGuide::where('city_id', $cityId)->get();

    //     $languages = $tripGuides->map(function ($guide) {
    //         return $guide->languages_id;
    //     })->unique();

    //     $languageNames = Languages::whereIn('id', $languages)->pluck('language_name', 'id');

    //     return response()->json(['languages' => $languageNames]);
    // }

    public function getLanguagesByCity($cityId)
    {
        // Find TripGuides belonging to this city
        $tripGuides = TripGuide::where('city_id', $cityId)->get();

        // Collect all languages_id strings, split them
        $languageIds = $tripGuides->flatMap(function($guide) {
            $str = $guide->languages_id;   // example "1,2,3"
            if (!$str) {
                return []; 
            }
            // Explode by comma, trim spaces
            return collect(explode(',', $str))
                ->map(fn($id) => trim($id))
                ->filter(fn($id) => is_numeric($id) && $id !== '')
                ->all();
        })
        ->unique()
        ->values()
        ->all();

        // Then fetch language names
        $languages = Languages::whereIn('id', $languageIds)
            ->get()
            ->mapWithKeys(fn($lang) => [$lang->id => $lang->language_name]);

        return response()->json([
            'languages' => $languages,
        ]);
    }

    public function getTourGuideDetails(Request $request)
    {
        $cityId = $request->city_id;
        $languageId = $request->language_id;

        $tripguide = TripGuide::where('city_id', $cityId)
        ->where(function($q) use ($languageId) {
            $q->whereRaw("FIND_IN_SET(?, languages_id)", [$languageId]);
        })
        ->first();

        $trip_price = TripGuidePrice::where('trip_id',$tripguide->id)->first();

        if ($tripguide) {
            return response()->json([
                'tour_guide_id' => $tripguide->id,
                'cost' => $tripguide->cost,
                'trip_price' => $trip_price
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
        // return $request;
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
        
         $trip_price = TripGuidePrice::where('trip_id',$trip->id)->first();

         if ($trip_price) {
        $adults = (int)$request->adults_count;

        if ($adults < 1) {
            return redirect()->back()->with('message', 'Please Select At least 1 Adult');
        }

        if ($adults <= 4) {
            $fine_price = $trip_price->price_1_to_4;
        } elseif ($adults == 5) {
            $fine_price = $trip_price->price_1_to_4 + $trip_price->price_5;
        } elseif ($adults == 6) {
            $fine_price = $trip_price->price_1_to_4 + $trip_price->price_5 + $trip_price->price_6;
        } elseif ($adults >= 7 && $adults <= 10) {
            $fine_price = $trip_price->price_1_to_4 + $trip_price->price_5 + $trip_price->price_6 + $trip_price->price_6_to_10;
        } else { // $adults > 10
            return redirect()->back()->with('message', 'Adults can not be more than 10');
        }

            // ab $fine_price use karo aage
        } else {
            return redirect()->back()->with('message', 'Price not found.');
        }


        $booking = new TripGuideBook();
        $booking->user_id = Auth::guard('agent')->id();
        $booking->tour_guide_id = $request->tour_guide_id;
        $booking->languages_id = $request->languages_id;
        $booking->state_id = $request->state_id;
        $booking->location = $request->location;
        $booking->adults_count = $request->adults_count;
        $booking->guide_type = $request->guide_type;
        $booking->cost = $fine_price;
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

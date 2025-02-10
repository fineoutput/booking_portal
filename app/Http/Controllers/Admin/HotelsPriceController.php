<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\City;
use App\Models\HotelPrice;
use App\Models\Hotels;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HotelsPriceController extends Controller
{
    function index($id){
        $data['package'] = HotelPrice::orderBy('id','DESC')->where('hotel_id',$id)->get();
        $data['package_id'] = Hotels::where('id',$id)->first();
        return view('admin/hotelprice/index',$data);
    }

    public function getCitiesByState($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    public function create(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            // Validate the incoming request
            $request->validate([
                'night_cost' => 'required|numeric',
            ]);
    
            // Check if a PackagePrice entry already exists for this package
            // $packagePrice = PackagePrice::where('package_id', $id)->first();
    
            // if ($packagePrice) {
            //     // If the PackagePrice already exists, update it
            //     $packagePrice->standard_cost = $request->standard_cost;
            //     $packagePrice->deluxe_cost = $request->deluxe_cost;
            //     $packagePrice->premium_cost = $request->premium_cost;
            //     $packagePrice->super_deluxe_cost = $request->super_deluxe_cost;
            //     $packagePrice->luxury_cost = $request->luxury_cost;
            //     $packagePrice->nights_cost = $request->nights_cost;
            //     $packagePrice->adults_cost = $request->adults_cost;
            //     $packagePrice->child_with_bed_cost = $request->child_with_bed_cost;
            //     $packagePrice->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
            //     $packagePrice->child_no_bed_child_cost = $request->child_no_bed_child_cost;
            //     $packagePrice->meal_plan_only_room_cost = $request->meal_plan_only_room_cost;
            //     $packagePrice->meal_plan_breakfast_cost = $request->meal_plan_breakfast_cost;
            //     $packagePrice->meal_plan_breakfast_lunch_dinner_cost = $request->meal_plan_breakfast_lunch_dinner_cost;
            //     $packagePrice->meal_plan_all_meals_cost = $request->meal_plan_all_meals_cost;
            //     $packagePrice->hatchback_cost = $request->hatchback_cost;
            //     $packagePrice->sedan_cost = $request->sedan_cost;
            //     $packagePrice->economy_suv_cost = $request->economy_suv_cost;
            //     $packagePrice->luxury_suv_cost = $request->luxury_suv_cost;
            //     $packagePrice->traveller_mini_cost = $request->traveller_mini_cost;
            //     $packagePrice->traveller_big_cost = $request->traveller_big_cost;
            //     $packagePrice->premium_traveller_cost = $request->premium_traveller_cost;
            //     $packagePrice->ac_coach_cost = $request->ac_coach_cost;
            //     $packagePrice->save();
    
            //     $message = 'Package price updated successfully.';
            // } else {
                // If the PackagePrice does not exist, create a new one
                $packagePrice = new HotelPrice();
                $packagePrice->hotel_id = $id;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                $packagePrice->night_cost = $request->night_cost;
              
                $packagePrice->save();
    
                $message = 'Hotel price added successfully.';
            // }

            return redirect()->route('hotel_price', ['id' => $id])
                 ->with('success', $message);

        }
    
        // Fetch the package data for the form
        $data['package'] = Hotels::where('id', $id)->first();
        $data['packageprice'] = HotelPrice::where('hotel_id', $id)->first();
        return view('admin/hotelprice/create', $data);
    }
    public function destroy($id)
    {
        $package = HotelPrice::findOrFail($id);

        $package->delete();
        return redirect()->back()->with('success', 'Hotel Price deleted successfully.');
    }


        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['package'] = HotelPrice::findOrFail($id);
            $data['states'] = State::all();

            // Pass the package data to the edit view
            return view('admin/hotelprice/edit',$data);
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                'night_cost' => 'required|numeric',
               
            ]);
        
            $packagePrice = HotelPrice::findOrFail($id);
        
                $packagePrice->night_cost = $request->night_cost;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                
                $packagePrice->save();
        
            return redirect()->route('hotel_price', ['id' => $packagePrice->hotel_id])->with('success', 'Hotel Price updated successfully.');
        }

}

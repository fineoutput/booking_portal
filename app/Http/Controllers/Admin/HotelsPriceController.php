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
    
                $hotel_price = new HotelPrice();
                $hotel_price->hotel_id = $id;
                $hotel_price->end_date = $request->end_date;
                $hotel_price->start_date = $request->start_date;
                $hotel_price->night_cost = $request->night_cost;
                $hotel_price->room_category = $request->room_category;
                // $hotel_price->room_cost = $request->room_cost;
                $hotel_price->meal_plan_breakfast_cost = $request->meal_plan_breakfast_cost;
                $hotel_price->meal_plan_breakfast_lunch_dinner_cost = $request->meal_plan_breakfast_lunch_dinner_cost;
                $hotel_price->meal_plan_all_meals_cost = $request->meal_plan_all_meals_cost;
                $hotel_price->extra_all_meals_cost = $request->extra_all_meals_cost;
                $hotel_price->extra_breakfast_cost = $request->extra_breakfast_cost;
                $hotel_price->extra_breakfast_lunch_dinner_cost = $request->extra_breakfast_lunch_dinner_cost;
                $hotel_price->extra_bed_cost = $request->extra_bed_cost;
                $hotel_price->child_all_meals_cost = $request->child_all_meals_cost;
                $hotel_price->child_breakfast_cost = $request->child_breakfast_cost;
                $hotel_price->child_breakfast_lunch_dinner_cost = $request->child_breakfast_lunch_dinner_cost;
                $hotel_price->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
              
                $hotel_price->save();
    
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
        
            $hotel_price = HotelPrice::findOrFail($id);
        
                $hotel_price->night_cost = $request->night_cost;
                $hotel_price->end_date = $request->end_date;
                $hotel_price->start_date = $request->start_date;
                $hotel_price->room_category = $request->room_category;
                // $hotel_price->room_cost = $request->room_cost;
                $hotel_price->meal_plan_breakfast_cost = $request->meal_plan_breakfast_cost;
                $hotel_price->meal_plan_breakfast_lunch_dinner_cost = $request->meal_plan_breakfast_lunch_dinner_cost;
                $hotel_price->meal_plan_all_meals_cost = $request->meal_plan_all_meals_cost;
                $hotel_price->extra_all_meals_cost = $request->extra_all_meals_cost;
                $hotel_price->extra_breakfast_cost = $request->extra_breakfast_cost;
                $hotel_price->extra_breakfast_lunch_dinner_cost = $request->extra_breakfast_lunch_dinner_cost;
                $hotel_price->extra_bed_cost = $request->extra_bed_cost;
                $hotel_price->child_all_meals_cost = $request->child_all_meals_cost;
                $hotel_price->child_breakfast_cost = $request->child_breakfast_cost;
                $hotel_price->child_breakfast_lunch_dinner_cost = $request->child_breakfast_lunch_dinner_cost;
                $hotel_price->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
                
                $hotel_price->save();
        
            return redirect()->route('hotel_price', ['id' => $hotel_price->hotel_id])->with('success', 'Hotel Price updated successfully.');
        }

}

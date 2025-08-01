<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\City;
use App\Models\State;
use App\Models\VehicleCost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PackagePriceController extends Controller
{
    function index($id){
        $data['package'] = PackagePrice::orderBy('id','DESC')->where('package_id',$id)->get();
        $data['package_id'] = Package::where('id',$id)->first();
        return view('admin/packageprice/index',$data);
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
                // 'standard_cost' => 'required|numeric',
                // 'deluxe_cost' => 'required|numeric',
                // 'premium_cost' => 'required|numeric',
                // 'super_deluxe_cost' => 'required|numeric',
                // 'luxury_cost' => 'required|numeric',
                // 'category_cost' => 'required|numeric',
                'hotel_category' => 'required',
                // 'nights_cost' => 'required|numeric',
                // 'adults_cost' => 'required|numeric',
                'child_with_bed_cost' => 'required|numeric',
                'child_no_bed_infant_cost' => 'required|numeric',
                // 'child_no_bed_child_cost' => 'required|numeric',
                // 'meal_plan_only_room_cost' => 'required|numeric',
                'meal_plan_breakfast_cost' => 'required|numeric',
                'meal_plan_breakfast_lunch_dinner_cost' => 'required|numeric',
                'meal_plan_all_meals_cost' => 'required|numeric',
                'hatchback_cost' => 'required|numeric',
                'sedan_cost' => 'required|numeric',
                'economy_suv_cost' => 'required|numeric',
                'luxury_suv_cost' => 'required|numeric',
                'traveller_mini_cost' => 'required|numeric',
                'traveller_big_cost' => 'required|numeric',
                'premium_traveller_cost' => 'required|numeric',
                'ac_coach_cost' => 'required|numeric',
                'extra_bed_cost' => 'required|numeric',
                'display_cost' => 'required|numeric',
                'luxury_sedan_cost' => 'required|numeric',
                'suv_cost' => 'required|numeric',
                'muv_cost' => 'required|numeric',
                'bus_nonac_cost' => 'required|numeric',
                'admin_margin' => 'required|numeric',
                // 'hotel_premium_cost' => 'required|numeric',
                // 'hotel_delux_cost' => 'required|numeric',
                'room_cost' => 'required|numeric',
                'children_1_5_cost' => 'required|numeric',
                'children_5_11_cost' => 'required|numeric',
            ]);
       
                $packagePrice = new PackagePrice();
                $packagePrice->package_id = $id;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                $packagePrice->hotel_category = $request->hotel_category;
                // $packagePrice->category_cost = $request->category_cost;
                // $packagePrice->standard_cost = $request->standard_cost;
                // $packagePrice->deluxe_cost = $request->deluxe_cost;
                // $packagePrice->premium_cost = $request->premium_cost;
                // $packagePrice->super_deluxe_cost = $request->super_deluxe_cost;
                // $packagePrice->luxury_cost = $request->luxury_cost;
                // $packagePrice->premium_3_cost = $request->premium_3_cost;
                $packagePrice->nights_cost = $request->nights_cost;
                $packagePrice->adults_cost = $request->adults_cost;
                $packagePrice->child_with_bed_cost = $request->child_with_bed_cost;
                $packagePrice->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
                $packagePrice->child_no_bed_child_cost = $request->child_no_bed_child_cost;
                // $packagePrice->meal_plan_only_room_cost = $request->meal_plan_only_room_cost;
                $packagePrice->meal_plan_breakfast_cost = $request->meal_plan_breakfast_cost;
                $packagePrice->meal_plan_breakfast_lunch_dinner_cost = $request->meal_plan_breakfast_lunch_dinner_cost;
                $packagePrice->meal_plan_all_meals_cost = $request->meal_plan_all_meals_cost;
                $packagePrice->hatchback_cost = $request->hatchback_cost;
                $packagePrice->sedan_cost = $request->sedan_cost;
                $packagePrice->economy_suv_cost = $request->economy_suv_cost;
                $packagePrice->luxury_suv_cost = $request->luxury_suv_cost;
                $packagePrice->traveller_mini_cost = $request->traveller_mini_cost;
                $packagePrice->traveller_big_cost = $request->traveller_big_cost;
                $packagePrice->premium_traveller_cost = $request->premium_traveller_cost;
                $packagePrice->ac_coach_cost = $request->ac_coach_cost;
                 $packagePrice->luxury_sedan_cost = $request->luxury_sedan_cost;
                $packagePrice->suv_cost = $request->suv_cost;
                $packagePrice->muv_cost = $request->muv_cost;
                $packagePrice->bus_nonac_cost = $request->bus_nonac_cost;
                $packagePrice->extra_bed_cost = $request->extra_bed_cost;
                $packagePrice->display_cost = $request->display_cost;
                $packagePrice->admin_margin = $request->admin_margin;
                $packagePrice->room_category = $request->room_category;
                // $packagePrice->hotel_delux_cost = $request->hotel_delux_cost;
                $packagePrice->room_cost = $request->room_cost;
                $packagePrice->children_5_11_cost = $request->children_5_11_cost;
                $packagePrice->children_1_5_cost = $request->children_1_5_cost;
                $packagePrice->save();
    
                $message = 'Package price added successfully.';
       
            return redirect()->route('package_price', ['id' => $id])
                 ->with('success', $message);

        }
    
        $data['package'] = Package::where('id', $id)->first();
        $data['packageprice'] = PackagePrice::where('package_id', $id)->first();
        $data['vehicleprice'] = VehicleCost::where('package_id', $id)->first();
        return view('admin/packageprice/create', $data);
    }
    public function destroy($id)
    {
        $package = PackagePrice::findOrFail($id);

        $package->delete();
        return redirect()->back()->with('success', 'Package Price deleted successfully.');
    }


        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['package'] = PackagePrice::findOrFail($id);
            $data['states'] = State::all();
           $data['vehicleprice'] = VehicleCost::where('package_id',  $data['package']->package_id)->first();


            // Pass the package data to the edit view
            return view('admin/packageprice/edit',$data);
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                //  'category_cost' => 'required|numeric',
                'hotel_category' => 'required',
                // 'standard_cost' => 'required|numeric',
                // 'deluxe_cost' => 'required|numeric',
                // 'premium_cost' => 'required|numeric',
                // 'super_deluxe_cost' => 'required|numeric',
                // 'luxury_cost' => 'required|numeric',
                // 'premium_3_cost' => 'required|numeric',
                // 'nights_cost' => 'required|numeric',
                // 'adults_cost' => 'required|numeric',
                'child_with_bed_cost' => 'required|numeric',
                'child_no_bed_infant_cost' => 'required|numeric',
                // 'child_no_bed_child_cost' => 'required|numeric',
                // 'meal_plan_only_room_cost' => 'required|numeric',
                'meal_plan_breakfast_cost' => 'required|numeric',
                'meal_plan_breakfast_lunch_dinner_cost' => 'required|numeric',
                'meal_plan_all_meals_cost' => 'required|numeric',
                'hatchback_cost' => 'required|numeric',
                'sedan_cost' => 'required|numeric',
                'economy_suv_cost' => 'required|numeric',
                'luxury_suv_cost' => 'required|numeric',
                'traveller_mini_cost' => 'required|numeric',
                'traveller_big_cost' => 'required|numeric',
                'premium_traveller_cost' => 'required|numeric',
                'ac_coach_cost' => 'required|numeric',
                'luxury_sedan_cost' => 'required|numeric',
                'suv_cost' => 'required|numeric',
                'muv_cost' => 'required|numeric',
                'bus_nonac_cost' => 'required|numeric',
                'extra_bed_cost' => 'required|numeric',
                'display_cost' => 'required|numeric',
                'admin_margin' => 'required|numeric',
                // 'hotel_premium_cost' => 'required|numeric',
                // 'hotel_delux_cost' => 'required|numeric',
                'room_cost' => 'required|numeric',
                  'children_1_5_cost' => 'required|numeric',
                'children_5_11_cost' => 'required|numeric',
            ]);
        
            $packagePrice = PackagePrice::findOrFail($id);
        
                // $packagePrice->standard_cost = $request->standard_cost;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                $packagePrice->hotel_category = $request->hotel_category;
                // $packagePrice->category_cost = $request->category_cost;
                // $packagePrice->deluxe_cost = $request->deluxe_cost;
                // $packagePrice->premium_cost = $request->premium_cost;
                // $packagePrice->super_deluxe_cost = $request->super_deluxe_cost;
                // $packagePrice->luxury_cost = $request->luxury_cost;
                // $packagePrice->premium_3_cost = $request->premium_3_cost;
                $packagePrice->nights_cost = $request->nights_cost;
                $packagePrice->adults_cost = $request->adults_cost;
                $packagePrice->child_with_bed_cost = $request->child_with_bed_cost;
                $packagePrice->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
                $packagePrice->child_no_bed_child_cost = $request->child_no_bed_child_cost;
                // $packagePrice->meal_plan_only_room_cost = $request->meal_plan_only_room_cost;
                $packagePrice->meal_plan_breakfast_cost = $request->meal_plan_breakfast_cost;
                $packagePrice->meal_plan_breakfast_lunch_dinner_cost = $request->meal_plan_breakfast_lunch_dinner_cost;
                $packagePrice->meal_plan_all_meals_cost = $request->meal_plan_all_meals_cost;
                $packagePrice->hatchback_cost = $request->hatchback_cost;
                $packagePrice->sedan_cost = $request->sedan_cost;
                $packagePrice->economy_suv_cost = $request->economy_suv_cost;
                $packagePrice->luxury_suv_cost = $request->luxury_suv_cost;
                $packagePrice->traveller_mini_cost = $request->traveller_mini_cost;
                $packagePrice->traveller_big_cost = $request->traveller_big_cost;
                $packagePrice->premium_traveller_cost = $request->premium_traveller_cost;
                $packagePrice->ac_coach_cost = $request->ac_coach_cost;
                $packagePrice->luxury_sedan_cost = $request->luxury_sedan_cost;
                $packagePrice->suv_cost = $request->suv_cost;
                $packagePrice->muv_cost = $request->muv_cost;
                $packagePrice->bus_nonac_cost = $request->bus_nonac_cost;
                $packagePrice->extra_bed_cost = $request->extra_bed_cost;
                $packagePrice->display_cost = $request->display_cost;
                $packagePrice->admin_margin = $request->admin_margin;
                 $packagePrice->room_category = $request->room_category;
                // $packagePrice->hotel_delux_cost = $request->hotel_delux_cost;
                $packagePrice->room_cost = $request->room_cost;
                   $packagePrice->children_5_11_cost = $request->children_5_11_cost;
                $packagePrice->children_1_5_cost = $request->children_1_5_cost;
                $packagePrice->save();
        
            return redirect()->route('package_price', ['id' => $packagePrice->package_id])->with('success', 'Package updated successfully.');
        }

// Helper function to delete files from storage



}

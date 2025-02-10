<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\City;
use App\Models\State;
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
                'standard_cost' => 'required|numeric',
                'deluxe_cost' => 'required|numeric',
                'premium_cost' => 'required|numeric',
                'super_deluxe_cost' => 'required|numeric',
                'luxury_cost' => 'required|numeric',
                'nights_cost' => 'required|numeric',
                'adults_cost' => 'required|numeric',
                'child_with_bed_cost' => 'required|numeric',
                'child_no_bed_infant_cost' => 'required|numeric',
                'child_no_bed_child_cost' => 'required|numeric',
                'meal_plan_only_room_cost' => 'required|numeric',
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
                $packagePrice = new PackagePrice();
                $packagePrice->package_id = $id;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                $packagePrice->standard_cost = $request->standard_cost;
                $packagePrice->deluxe_cost = $request->deluxe_cost;
                $packagePrice->premium_cost = $request->premium_cost;
                $packagePrice->super_deluxe_cost = $request->super_deluxe_cost;
                $packagePrice->luxury_cost = $request->luxury_cost;
                $packagePrice->nights_cost = $request->nights_cost;
                $packagePrice->adults_cost = $request->adults_cost;
                $packagePrice->child_with_bed_cost = $request->child_with_bed_cost;
                $packagePrice->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
                $packagePrice->child_no_bed_child_cost = $request->child_no_bed_child_cost;
                $packagePrice->meal_plan_only_room_cost = $request->meal_plan_only_room_cost;
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
                $packagePrice->save();
    
                $message = 'Package price added successfully.';
            // }
    
            // Redirect with success message
            return redirect()->route('package_price', ['id' => $id])
                 ->with('success', $message);

        }
    
        // Fetch the package data for the form
        $data['package'] = Package::where('id', $id)->first();
        $data['packageprice'] = PackagePrice::where('package_id', $id)->first();
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

            // Pass the package data to the edit view
            return view('admin/packageprice/edit',$data);
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                'standard_cost' => 'required|numeric',
                'deluxe_cost' => 'required|numeric',
                'premium_cost' => 'required|numeric',
                'super_deluxe_cost' => 'required|numeric',
                'luxury_cost' => 'required|numeric',
                'nights_cost' => 'required|numeric',
                'adults_cost' => 'required|numeric',
                'child_with_bed_cost' => 'required|numeric',
                'child_no_bed_infant_cost' => 'required|numeric',
                'child_no_bed_child_cost' => 'required|numeric',
                'meal_plan_only_room_cost' => 'required|numeric',
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
            ]);
        
            // Find the existing package by ID
            $packagePrice = PackagePrice::findOrFail($id);
        
                $packagePrice->standard_cost = $request->standard_cost;
                $packagePrice->end_date = $request->end_date;
                $packagePrice->start_date = $request->start_date;
                $packagePrice->deluxe_cost = $request->deluxe_cost;
                $packagePrice->premium_cost = $request->premium_cost;
                $packagePrice->super_deluxe_cost = $request->super_deluxe_cost;
                $packagePrice->luxury_cost = $request->luxury_cost;
                $packagePrice->nights_cost = $request->nights_cost;
                $packagePrice->adults_cost = $request->adults_cost;
                $packagePrice->child_with_bed_cost = $request->child_with_bed_cost;
                $packagePrice->child_no_bed_infant_cost = $request->child_no_bed_infant_cost;
                $packagePrice->child_no_bed_child_cost = $request->child_no_bed_child_cost;
                $packagePrice->meal_plan_only_room_cost = $request->meal_plan_only_room_cost;
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
                $packagePrice->save();
        
            return redirect()->route('package_price', ['id' => $packagePrice->package_id])->with('success', 'Package updated successfully.');
        }

// Helper function to delete files from storage



}

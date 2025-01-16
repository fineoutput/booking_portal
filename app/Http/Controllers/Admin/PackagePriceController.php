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
    function index() {
        $data['package'] = PackagePrice::orderBy('id','DESC')->get();
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
            $packagePrice = PackagePrice::where('package_id', $id)->first();
    
            if ($packagePrice) {
                // If the PackagePrice already exists, update it
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
    
                $message = 'Package price updated successfully.';
            } else {
                // If the PackagePrice does not exist, create a new one
                $packagePrice = new PackagePrice();
                $packagePrice->package_id = $id;
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
            }
    
            // Redirect with success message
            return redirect()->route('package')
                             ->with('success', $message);
        }
    
        // Fetch the package data for the form
        $data['package'] = Package::where('id', $id)->first();
        $data['packageprice'] = PackagePrice::where('package_id', $id)->first();
        return view('admin/packageprice/create', $data);
    }
    public function destroy($id)
    {
        $package = Package::findOrFail($id);

        $this->deleteFiles($package->image); 
        $this->deleteFiles($package->video); 

        $package->delete();
        return redirect()->route('package')->with('success', 'Package deleted successfully.');
    }


    protected function deleteFiles($filePaths)
    {
        if ($filePaths) {
            $filePaths = is_array($filePaths) ? $filePaths : json_decode($filePaths);

            foreach ($filePaths as $filePath) {
                if (Storage::exists('public/' . $filePath)) {
                    Storage::delete('public/' . $filePath);
                }
            }
        }}

        public function edit($id)
        {
            // Retrieve the package by its ID
            $data['package'] = Package::findOrFail($id);
            $data['states'] = State::all();

            // Pass the package data to the edit view
            return view('admin/package/edit',$data);
        }


        public function update(Request $request, $id)
        {
            // Validate the incoming request
            $validated = $request->validate([
                'package_name' => 'required',
                'state_id' => 'required',
                // 'city_id' => 'required',
                'image' => 'nullable|array', // Images can be null or an array
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|array', // Videos can be null or an array
                'video.*' => 'nullable|mimes:mp4,mkv,avi,webm|max:50000',
                'text_description' => 'required',
                'text_description_2' => 'required',
            ]);
        
            // Find the existing package by ID
            $package = Package::findOrFail($id);
        
            // Handle image upload and update
            if ($request->hasFile('image')) {
                // Delete the old images from storage (if any)
                $this->deleteFiles($package->image);
        
                // Handle new image uploads
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    $imagePaths[] = $image->store('packages/images', 'public');
                }
                $package->image = json_encode($imagePaths);  // Store the new image paths
            }
        
            // Remove the images that the user deleted
            if ($request->has('deleted_images')) {
                $deletedImages = explode(',', $request->deleted_images);  // Get the deleted image paths from the form
                $this->deleteFiles($deletedImages);  // Delete these images from storage
        
                // Update the package images after deletion
                $existingImages = json_decode($package->image, true);
                $updatedImages = array_diff($existingImages, $deletedImages);  // Remove the deleted images from the array
                $package->image = json_encode($updatedImages);  // Store the updated image paths
            }
        
            // Handle video upload and update
            if ($request->hasFile('video')) {
                $videoPaths = [];
                foreach ($request->file('video') as $video) {
                    $videoPaths[] = $video->store('packages/videos', 'public');
                }
                $package->video = json_encode($videoPaths);  // Store the new video paths
            }
        
            if ($request->hasFile('pdf')) {
                if ($package->pdf) {
                    Storage::disk('public')->delete($package->pdf);
                }
                $pdfPath = $request->file('pdf')->store('pdf', 'public');
                $package->pdf = $pdfPath;
            }
        

            // Update the package fields
            $package->package_name = $request->package_name;
            $package->state_id = $request->state_id;
            $package->city_id = $request->city_id ?? $package->city_id ;
            $package->text_description = $request->text_description;
            $package->text_description_2 = $request->text_description_2;
        
            // Save the updated package record to the database
            $package->save();
        
            return redirect()->route('package')->with('success', 'Package updated successfully.');
        }

// Helper function to delete files from storage



}

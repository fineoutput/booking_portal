<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Package;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class HotelsController extends Controller
{
    function index() {
        $data['hotels'] = Hotels::orderBy('id','DESC')->get();
        return view('admin/hotels/index',$data);
    }

    public function getCitiesByStatehotels($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }



    function create(Request $request) {

        if($request->method()=='POST'){
            // $validated = $request->validate([
            //     'name' => 'required',
            //     'images' => 'required', 
            //     'location' => 'required',
            //     'hotel_category' => 'required',
            //     'package_id' => 'required',
            // ]);
          
    
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('hotels/images', 'public');
                }
            } else {
                $imagePaths = null;
            }
    
            $hotel = new Hotels();
            $hotel->name = $request->name;
            $hotel->images = $imagePaths ? json_encode($imagePaths) : null; 
            $hotel->location = $request->location;
            $hotel->state_id = $request->state_id;
            $hotel->city_id = $request->city_id;
            $hotel->hotel_category = $request->hotel_category;
            $hotel->package_id = implode(',', $request->package_id);
    
            $hotel->save();

            return redirect()->route('hotels')->with('success', 'Hotel added successfully.');
        
        }

        $data['package'] = Package::all();
        $data['states'] = State::all();
        return view('admin/hotels/create',$data);
    }

    public function destroy($id)
{
    // Find the hotel by its ID
    $hotel = Hotels::findOrFail($id);

    // Check if there are any associated files (e.g., images) and delete them
    if ($hotel->images) {
        $imagePath = public_path('storage/' . $hotel->images);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file from storage
        }
    }
    $hotel->delete();

    // Redirect with a success message
    return redirect()->route('hotels')->with('success', 'Hotel deleted successfully');
}


public function edit($id)
{
    // Find the hotel by ID
    $data['hotel'] = Hotels::findOrFail($id);
    $data['packages']  = Package::all();
    $data['states'] = State::all();

    // Pass the hotel data to the edit view
    return view('admin/hotels/edit',$data);
}


protected function deleteFiles(array $imagePaths)
{
    foreach ($imagePaths as $imagePath) {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'package_id' => 'required',
    ]);

    // Find the hotel by ID
    $hotel = Hotels::findOrFail($id);

    // Decode existing images into an array
    $imagePaths = json_decode($hotel->images, true) ?? [];

    // Handle new image uploads if any
    if ($request->hasFile('images')) {
        // Only delete old images from storage if new images are being uploaded
        $this->deleteFiles($imagePaths);  

        // Handle new image uploads and add to the array
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('hotels/images', 'public');
        }
    }

    // Handle image deletions if any
    if ($request->has('deleted_images')) {
        $deletedImages = explode(',', $request->deleted_images);  
        // dd($request->deleted_images);
        $this->deleteFiles($deletedImages);  

        $imagePaths = array_diff($imagePaths, $deletedImages);  
    }
    $hotel->name = $request->name;
    $hotel->location = $request->location;
    $hotel->state_id = $request->state_id;
    $hotel->city_id = $request->city_id;
    $hotel->hotel_category = $request->hotel_category;
    $hotel->package_id = implode(',', $request->package_id);

    // Save the updated image paths (only the non-deleted ones)
    $hotel->images = json_encode(array_values($imagePaths));  // Save as a JSON string

    // Save the updated hotel
    $hotel->save();

    // Redirect with a success message
    return redirect()->route('hotels')->with('success', 'Hotel updated successfully');
}


}

  // if ($request->hasFile('images')) {
    //     $imagePaths = [];
        
    //     foreach ($request->file('images') as $image) {
    //         $imagePaths[] = $image->store('hotels/images', 'public');
    //     }

    //     $hotelImages = json_decode($hotel->images, true);
    //     if ($hotelImages) {

    //         foreach ($hotelImages as $oldImage) {
    //             if (Storage::disk('public')->exists($oldImage)) {
    //                 Storage::disk('public')->delete($oldImage);
    //             }
    //         }
    //     }
    //     $hotel->images = json_encode($imagePaths);  // Encode the new image paths into a JSON string
    // } else {
    //     // If no new images were uploaded, keep the old images
    //     $imagePaths = json_decode($hotel->images, true);  // Get current images
    //     $hotel->images = json_encode($imagePaths);  // Save the existing images (if any) as a JSON string
    // }

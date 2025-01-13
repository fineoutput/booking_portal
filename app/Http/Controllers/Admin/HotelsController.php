<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;

class HotelsController extends Controller
{
    function index() {
        $data['hotels'] = Hotels::orderBy('id','DESC')->get();
        return view('admin/hotels/index',$data);
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
            $hotel->hotel_category = $request->hotel_category;
            $hotel->package_id = implode(',', $request->package_id);
    
            $hotel->save();

            return redirect()->route('hotels')->with('success', 'Hotel added successfully.');
        
        }

        $data['package'] = Package::all();
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

    // Pass the hotel data to the edit view
    return view('admin/hotels/edit',$data);
}

// Method to handle the update logic
public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'package_id' => 'required',
    ]);

    // Find the hotel by ID
    $hotel = Hotels::findOrFail($id);

    // Update hotel details
    $hotel->name = $request->name;
    $hotel->location = $request->location;
    $hotel->hotel_category = $request->hotel_category;
    $hotel->package_id = implode(',', $request->package_id);  // Save selected packages as a comma-separated string

    // Check if new images were uploaded
    if ($request->hasFile('images')) {
        $imagePaths = [];
        // Store new uploaded images
        foreach ($request->file('images') as $image) {
            // Store image in 'hotels/images' directory and get the stored file path
            $imagePaths[] = $image->store('hotels/images', 'public');
        }

        // If the hotel already has images, delete the old ones from storage
        $hotelImages = json_decode($hotel->images, true);  // Decode the old image paths into an array
        if ($hotelImages) {
            // Delete old images from the 'public' disk
            foreach ($hotelImages as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }

        // Update the 'images' column with the new image paths
        $hotel->images = json_encode($imagePaths);  // Encode the new image paths into a JSON string
    } else {
        // If no new images were uploaded, keep the old images
        $imagePaths = json_decode($hotel->images, true);  // Get current images
        $hotel->images = json_encode($imagePaths);  // Save the existing images (if any) as a JSON string
    }

    // Save the hotel model with the updated data
    $hotel->save();
        // Redirect to a page with a success message
        return redirect()->route('hotels')->with('success', 'Hotel updated successfully');
    }


}

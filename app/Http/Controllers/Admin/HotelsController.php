<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Package;

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
                $imagePath = $request->file('images')->store('hotels/images', 'public'); // Store the image and get the file path
            } else {
                $imagePath = null; // If no image is uploaded
            }
    
            $hotel = new Hotels();
            $hotel->name = $request->name;
            $hotel->images = $imagePath; 
            $hotel->location = $request->location;
            $hotel->hotel_category = $request->hotel_category;
            $hotel->package_id = $request->package_id;
    
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

    // Delete the hotel record from the database
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
    // $validated = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'location' => 'required|string|max:255',
    // ]);

    // Find the hotel by ID
    $hotel = Hotels::findOrFail($id);

        // Update hotel details
        $hotel->name = $request->name;
        $hotel->location = $request->location;
        $hotel->hotel_category = $request->hotel_category;
        $hotel->package_id = $request->package_id;

        // Handle the image upload if new image is provided
        if ($request->hasFile('images')) {
            // Delete the old image if it exists
            if ($hotel->images && file_exists(storage_path('app/public/' . $hotel->images))) {
                unlink(storage_path('app/public/' . $hotel->images)); // Remove the old image file
            }

            // Store the new image
            $imagePath = $request->file('images')->store('hotels/images', 'public');
            $hotel->images = $imagePath; // Update the image field
        }

        // Save the updated hotel record
        $hotel->save();

        // Redirect to a page with a success message
        return redirect()->route('hotels')->with('success', 'Hotel updated successfully');
    }


}

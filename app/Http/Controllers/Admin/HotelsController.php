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
          
    
            // if ($request->hasFile('images')) {
            //     $imagePaths = [];
            //     foreach ($request->file('images') as $image) {
            //         $imagePaths[] = $image->store('hotels/images', 'public');
            //     }
            // } else {
            //     $imagePaths = null;
            // }

            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    // Define the custom folder inside the public directory (you can change 'public/images')
                    $destinationPath = public_path('hotels/images');
            
                    // Ensure the destination directory exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
            
                    // Get the original file name and store the image with the new name
                    $filename = time() . '_' . $image->getClientOriginalName();
                    
                    // Move the file to the destination
                    $image->move($destinationPath, $filename);
            
                    // Store the relative path of the image (to access via URL later)
                    $imagePaths[] = 'hotels/images/' . $filename;
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
            $hotel->package_id = !empty($request->package_id) ? implode(',', $request->package_id) : null;
            $hotel->meal_plan = !empty($request->meal_plan) ? implode(',', $request->meal_plan) : null;
            $hotel->nearby = !empty($request->nearby) ? implode(',', $request->nearby) : null;
            $hotel->locality = !empty($request->locality) ? implode(',', $request->locality) : null;
            $hotel->chains = !empty($request->chains) ? implode(',', $request->chains) : null;
            $hotel->hotel_amenities = !empty($request->hotel_amenities) ? implode(',', $request->hotel_amenities) : null;
            $hotel->room_amenities = !empty($request->room_amenities) ? implode(',', $request->room_amenities) : null;
            $hotel->house_rules = !empty($request->house_rules) ? implode(',', $request->house_rules) : null;
            
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


// protected function deleteFiles(array $imagePaths)
// {
//     foreach ($imagePaths as $imagePath) {
//         if (Storage::disk('public')->exists($imagePath)) {
//             Storage::disk('public')->delete($imagePath);
//         }
//     }
// }



public function showFronthotel($id, Request $request)
{
    // Validate input
    $validated = $request->validate([
        'show_front_value' => 'required|in:0,1',  // Ensure it's either 0 or 1
    ]);

    // Find the hotel by ID
    $hotel = Hotels::findOrFail($id); // Use 'Hotel' model (not 'Hotels') unless that's a typo

    // Update the 'show_front' field based on the request
    $hotel->show_front = $request->input('show_front_value'); // Store 0 or 1
    $hotel->save(); // Save the updated value to the database

    // Return a JSON response (success message)
    return response()->json([
        'success' => true,
        'message' => 'Hotel visibility updated successfully!',
        'show_front_value' => $hotel->show_front // Return updated show_front value
    ]);
}


public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validated = $request->validate([
        // 'package_id' => 'required',
        'name' => 'required',
    ]);

    $hotel = Hotels::findOrFail($id);

    $imagePaths = json_decode($hotel->images, true) ?? [];

    if ($request->has('deleted_images')) {
        $deletedImages = explode(',', $request->deleted_images);

        $this->deleteFiles($deletedImages);

        $imagePaths = array_diff($imagePaths, $deletedImages);
    }

    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {
            
            $destinationPath = public_path('hotels/images');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);  
            }
    
            $filename = time() . '_' . $image->getClientOriginalName();
            
            $image->move($destinationPath, $filename);
            
            $imagePaths[] = 'hotels/images/' . $filename;
        }
    }

    $hotel->name = $request->name;
    $hotel->location = $request->location;
    $hotel->state_id = $request->state_id;
    $hotel->city_id = $request->city_id ?? $hotel->city_id;  
    $hotel->hotel_category = $request->hotel_category;
    $hotel->package_id = is_array($request->package_id) ? implode(',', $request->package_id) : null;
    $hotel->meal_plan = is_array($request->meal_plan) ? implode(',', $request->meal_plan) : null;

    $hotel->images = json_encode(array_values($imagePaths)); 
    $hotel->save();

    return redirect()->route('hotels')->with('success', 'Hotel updated successfully');
}

// public function update(Request $request, $id)
// {
//     // Validate the incoming request data
//     $validated = $request->validate([
//         'package_id' => 'required|array',
//         'name' => 'required|string|max:255',
//         'location' => 'required|string|max:255',
//         'state_id' => 'required',
//         'city_id' => 'nullable',
//         'hotel_category' => 'required|string',
//         'images' => 'nullable|array',
//         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         'deleted_images' => 'nullable|string', // Comma-separated list of deleted images
//     ]);

//     // Find the hotel by ID
//     $hotel = Hotels::findOrFail($id);

//     // Decode existing images into an array
//     $imagePaths = json_decode($hotel->images, true) ?? [];

//     // Handle image deletions if any
//     if ($request->has('deleted_images')) {
//         $deletedImages = explode(',', $request->deleted_images);
//         // Delete the images that were marked for deletion
//         $this->deleteFiles($deletedImages);

//         // Remove deleted images from the array
//         $imagePaths = array_diff($imagePaths, $deletedImages);
//     }


//     if ($request->hasFile('images')) {
//         // Handle new image uploads and add to the array
//         $imagePaths = []; // Initialize an array to store file paths
//         foreach ($request->file('images') as $image) {
//             // Define the destination directory within the public directory (you can change this path)
//             $destinationPath = public_path('hotels/images');
    
//             // Ensure the destination directory exists, if not, create it
//             if (!file_exists($destinationPath)) {
//                 mkdir($destinationPath, 0777, true);  // Create the directory with full permissions
//             }
    
//             // Get the original filename and optionally generate a unique name (optional)
//             $filename = time() . '_' . $image->getClientOriginalName();
            
//             // Move the image to the destination directory
//             $image->move($destinationPath, $filename);
            
//             // Store the relative path of the image in the array (for use in views or database)
//             $imagePaths[] = 'hotels/images/' . $filename;
//         }
//     }

    
//     // if ($request->hasFile('images')) {
//     //     // Handle new image uploads and add to the array
//     //     foreach ($request->file('images') as $image) {
//     //         $imagePaths[] = $image->store('hotels/images', 'public');
//     //     }
//     // }

//     // Update the hotel details
//     $hotel->name = $request->name;
//     $hotel->location = $request->location;
//     $hotel->state_id = $request->state_id;
//     $hotel->city_id = $request->city_id ?? $hotel->city_id;  // Use current city_id if not provided
//     $hotel->hotel_category = $request->hotel_category;
//     $hotel->package_id = implode(',', $request->package_id);  // Store package_ids as comma-separated values

//     // Save the updated image paths (only the non-deleted ones)
//     $hotel->images = json_encode(array_values($imagePaths));  // Save as a JSON string

//     // Save the updated hotel record
//     $hotel->save();

//     // Redirect with a success message
//     return redirect()->route('hotels')->with('success', 'Hotel updated successfully');
// }



protected function deleteFiles($files)
{
    // Define the base directory where files are stored (e.g., public/hotels/images)
    $basePath = public_path('hotels/images');

    if (is_array($files)) {
        foreach ($files as $file) {
            $filePath = $basePath . '/' . $file;

            // Check if it's a file and delete it, otherwise skip
            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);  // Delete the file
            }
        }
    } elseif ($files) {
        $filePath = $basePath . '/' . $files;

        // Check if it's a file and delete it, otherwise skip
        if (file_exists($filePath) && !is_dir($filePath)) {
            unlink($filePath);  // Delete a single file
        }
    }
}



// protected function deleteFiles($files)
// {
//     if (is_array($files)) {
//         foreach ($files as $file) {
//             if (Storage::disk('public')->exists($file)) {
//                 Storage::disk('public')->delete($file);  // Delete each file
//             }
//         }
//     } elseif ($files) {
//         if (Storage::disk('public')->exists($files)) {
//             Storage::disk('public')->delete($files);  // Delete a single file
//         }
//     }
// }


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

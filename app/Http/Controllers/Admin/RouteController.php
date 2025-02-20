<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotels;
use App\Models\Package;
use App\Models\City;
use App\Models\State;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;

class RouteController extends Controller
{
    function index() {
        $data['hotels'] = Route::orderBy('id','DESC')->get();
        return view('admin/route/index',$data);
    }

    public function getCitiesByStatehotels($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }



    function create(Request $request) {

        if($request->method()=='POST'){
            $validated = $request->validate([
                'from_destination' => 'required',
                'to_destination' => 'required', 
                'city_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $hotel = new Route();
            $hotel->from_destination = $request->from_destination;
            $hotel->to_destination  = $request->to_destination;

            if ($request->hasFile('city_image')) {
                $imagePath = $request->file('city_image')->store('city_images', 'public');
                $hotel->city_image = $imagePath;
            }
            $hotel->save();

            return redirect()->route('route')->with('success', 'Route added successfully.');
        
        }

        $data['package'] = Package::all();
        $data['states'] = State::all();
        return view('admin/route/create',$data);
    }

    public function destroy($id)
{
    // Find the hotel by its ID
    $hotel = Route::findOrFail($id);
    $hotel->delete();

    // Redirect with a success message
    return redirect()->route('route')->with('success', 'Hotel deleted successfully');
}


public function edit($id)
{
    // Find the hotel by ID
    $data['route'] = Route::findOrFail($id);
    $data['packages']  = Package::all();
    $data['states'] = State::all();

    // Pass the hotel data to the edit view
    return view('admin/route/edit',$data);
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

    $validated = $request->validate([
        'from_destination' => 'required',
        'to_destination' => 'required',
        'city_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $hotel = Route::findOrFail($id);

    $hotel->from_destination = $request->from_destination;
    $hotel->to_destination  = $request->to_destination;

    if ($request->hasFile('city_image')) {
        // Delete old image if it exists
        if ($hotel->city_image && Storage::disk('public')->exists($hotel->city_image)) {
            Storage::disk('public')->delete($hotel->city_image);
        }
        $imagePath = $request->file('city_image')->store('city_images', 'public');
        $hotel->city_image = $imagePath;
    }

    $hotel->save();

    // Redirect with a success message
    return redirect()->route('route')->with('success', 'Route updated successfully');
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

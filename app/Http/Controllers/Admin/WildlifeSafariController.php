<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\State;
use App\Models\City;


class WildlifeSafariController extends Controller
{
    function index() {
        $data['WildlifeSafari'] = WildlifeSafari::orderBy('id','DESC')->get();
        return view('admin/wildlifesafari/index',$data);
    }


    
    public function getCitiesByStatesafari($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    protected function deleteFiles($files)
{
    // Define the base directory where files are stored (e.g., public/hotels/images)
    $basePath = public_path('uploads/image/Safari/');

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


    function create(Request $request) {
        if($request->method()=='POST'){
            // $validated = $request->validate([           
            //     'cost' => 'required',
            //     'date	' => 'required',
            //     'vehicle' => 'required',
            //     'national_park' => 'required',
            //     'city_id' => 'required',
            //     'state_id' => 'required',
            //     'timing' => 'required',
            // ]);
            if ($request->hasFile('image')) {
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    // Define the custom folder inside the public directory (you can change 'public/images')
                    $destinationPath = public_path('uploads/image/Safari/');
            
                    // Ensure the destination directory exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
            
                    // Get the original file name and store the image with the new name
                    $filename = time() . '_' . $image->getClientOriginalName();
                    
                    // Move the file to the destination
                    $image->move($destinationPath, $filename);
            
                    // Store the relative path of the image (to access via URL later)
                    $imagePaths[] = 'uploads/image/Safari/' . $filename;
                }
            } else {
                $imagePaths = null;
            }

            $agentCall = new WildlifeSafari();
            // $agentCall->cost = $request->cost;
            $agentCall->date = $request->date;
            $agentCall->vehicle = $request->vehicle;
            $agentCall->national_park = $request->national_park;
            $agentCall->city_id = $request->city_id;
            $agentCall->state_id = $request->state_id;
            $agentCall->center_price = $request->center_price;
            $agentCall->jeep_price = $request->jeep_price;
            $agentCall->cost = $request->cost;
            $agentCall->description = $request->description;
            $agentCall->image = $imagePaths ? json_encode($imagePaths) : null; 
            $agentCall->timings = implode(',', $request->timings);
            // $agentCall->image= $fullimagepath;

            $agentCall->save(); 

            return redirect()->route('wild_life_safari')->with('success', 'Wild life Safari added successfully!');
        }
        // $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['states'] = State::all();
        return view('admin/wildlifesafari/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = WildlifeSafari::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Wild life Safari deleted successfully!');
    }


    public function edit($id)
    {
        $data['wildlifeSafari'] = WildlifeSafari::findOrFail($id);
        $data['states'] = State::all(); 
        $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/wildlifesafari/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // dd($request->image);
        $request->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'national_park' => 'required|string',
            // 'vehicle' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'timings' => 'nullable|array',
            'timings.*' => 'in:morning,evening',
            'image' => 'nullable',
        ]);
        $wildlifeSafari = WildlifeSafari::findOrFail($id);

        $imagePaths = json_decode($wildlifeSafari->image, true) ?? [];

        if ($request->has('deleted_images')) {
            $deletedImages = explode(',', $request->deleted_images);
    
            $this->deleteFiles($deletedImages);
    
            $imagePaths = array_diff($imagePaths, $deletedImages);
        }
    
        if ($request->hasFile('image')) {
    
            foreach ($request->file('image') as $image) {
                
                $destinationPath = public_path('uploads/image/Safari/');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);  
                }
        
                $filename = time() . '_' . $image->getClientOriginalName();
                
                $image->move($destinationPath, $filename);
                
                $imagePaths[] = 'uploads/image/Safari/' . $filename;
            }
        }
        // Find the WildlifeSafari entry
        
    
        // Update the record
        $wildlifeSafari->state_id = $request->state_id;
        $wildlifeSafari->city_id = $request->city_id;
        $wildlifeSafari->national_park = $request->national_park;
        $wildlifeSafari->vehicle = $request->vehicle;
        $wildlifeSafari->center_price = $request->center_price;
        $wildlifeSafari->jeep_price = $request->jeep_price;
        $wildlifeSafari->date = $request->date;
        $wildlifeSafari->cost = $request->cost;
        $wildlifeSafari->description = $request->description;
        $wildlifeSafari->timings = implode(',', $request->timings);  
        $wildlifeSafari->image = json_encode(array_values($imagePaths)); 
        $wildlifeSafari->save();

        return redirect()->route('wild_life_safari')->with('success', 'Wild life Safari updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('wild_life_safari')->with('success', 'Outstation status updated successfully!');
    }

}

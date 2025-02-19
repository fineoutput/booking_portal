<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;


class VehicleController extends Controller
{
    function index() {
        $data['agent'] = Vehicle::orderBy('id','DESC')->get();
        return view('admin/vehicle/index',$data);
    }

    // function create(Request $request) {
    //     if($request->method()=='POST'){
    //         $validated = $request->validate([
    //             'vehicle_type' => 'required',
    //             // 'description' => 'required',
    //         ]);

    //         $agentCall = new Vehicle();
    //         $agentCall->vehicle_type = $request->vehicle_type;
    //         // $agentCall->description = $request->description;
    //         $agentCall->status = '1';
    
    //         $agentCall->save(); 

    //         return redirect()->route('vehicle')->with('success', 'Vehicle added successfully!');
    //     }
    //     return view('admin/vehicle/create');
    // }

    function create(Request $request) {
        if($request->method() == 'POST') {
            // Validate the form fields
            $validated = $request->validate([
                'vehicle_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            ]);
    
            // Create a new Vehicle instance
            $agentCall = new Vehicle();
            $agentCall->vehicle_type = $request->vehicle_type;
            $agentCall->status = '1';
    
            // Handle the image upload if there is an image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                // Define the folder name and path (uploads/vehicleimage)
                $folderName = 'vehicleimage';
                $uploadPath = public_path('uploads/' . $folderName);
    
                // Create the folder if it doesn't exist
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
    
                // Generate a unique name for the image
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
    
                // Move the image to the folder
                $image->move($uploadPath, $imageName);
    
                // Save the image path to the database (relative to public folder)
                $agentCall->image = 'uploads/' . $folderName . '/' . $imageName;
            }
    
            // Save the Vehicle record
            $agentCall->save();
    
            // Redirect with success message
            return redirect()->route('vehicle')->with('success', 'Vehicle added successfully!');
        }
        
        return view('admin/vehicle/create');
    }
    


    public function destroy($id)
    {
        $agentCall = Vehicle::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('vehicle')->with('success', 'Vehicle deleted successfully!');
    }


    public function edit($id)
    {
        $agent = Vehicle::findOrFail($id);  // Find the agent call by ID

        return view('admin/vehicle/edit', compact('agent'));  // Pass the data to the edit view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_type' => 'required',
        ]);
    
        $agentCall = Vehicle::findOrFail($id);
    
        $agentCall->vehicle_type = $request->vehicle_type;

        if ($request->hasFile('image')) {

            if ($agentCall->vehicle_image && file_exists(public_path($agentCall->vehicle_image))) {
                unlink(public_path($agentCall->vehicle_image)); 
            }
    
            $image = $request->file('image');
            $folderName = 'vehicleimage';
            $uploadPath = public_path('uploads/' . $folderName);

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move($uploadPath, $imageName);
    
            $agentCall->image = 'uploads/' . $folderName . '/' . $imageName;
        }

        $agentCall->save();
    
        return redirect()->route('vehicle')->with('success', 'Vehicle updated successfully!');
    }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'vehicle_type' => 'required',
    //         // 'description' => 'required',
    //     ]);

    //     $agentCall = Vehicle::findOrFail($id);  // Find the agent call by ID

    //     // Update the agent call with the new data
    //     $agentCall->vehicle_type = $request->vehicle_type;
    //     // $agentCall->description = $request->description;
    //     // $agentCall->status = '1';

    //     $agentCall->save();

    //     return redirect()->route('vehicle')->with('success', 'Vehicle updated successfully!');
    // }

    public function updateStatus($id)
    {

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle status updated successfully!');
    }

}

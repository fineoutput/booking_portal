<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCity;
use App\Models\Airport;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\LocalVehiclePrice;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 

class SliderController extends Controller
{
    function index() {
        $data['VehiclePrice'] = Slider::orderBy('id','DESC')->get();
        return view('admin/slider/index',$data);
    }


    function create(Request $request) {
        if($request->method() == 'POST') {
            $validated = $request->validate([
                'type' => 'required',
                'image' => 'required',
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                // Generate a unique filename for the image to avoid conflicts
                $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
    
                // Move the uploaded image to the 'public/uploads/slider' directory
                $image->move(public_path('uploads/slider'), $imageName);
            } else {
                // Handle cases where no image is provided or invalid
                return back()->with('error', 'Invalid image file');
            }
    
            // Create a new Slider entry
            $agentCall = new Slider();
            $agentCall->type = $request->type;
            $agentCall->image = 'uploads/slider/' . $imageName;
            $agentCall->save();
    
            return redirect()->route('slider')->with('success', 'Slider added successfully!');
        }
    
        return view('admin/slider/create');
    }


    public function destroy($id)
    {
        $agentCall = Slider::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }


    public function edit($id)
    {
        $data['slider'] = Slider::orderBy('id','DESC')->where('id',$id)->first();
        $data['city'] = AdminCity::orderBy('id', 'DESC')->get();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['VehiclePrice'] = LocalVehiclePrice::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/slider/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
    
        // Validate input
        $request->validate([
            'type' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Optional image validation
        ]);
    
        // Update the slider's type
        $slider->type = $request->type;
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $imageName);
            $slider->image = 'uploads/slider/' . $imageName;
        }
    
        // Save the updated slider
        $slider->save();
    
        return redirect()->route('slider')->with('success', 'Slider updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = LocalVehiclePrice::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle status updated successfully!');
    }

}

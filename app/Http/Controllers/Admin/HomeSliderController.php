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
use App\Models\HomeSlider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 

class HomeSliderController extends Controller
{
    function index() {
        $data['VehiclePrice'] = HomeSlider::orderBy('id','DESC')->get();
        return view('admin/homeslider/index',$data);
    }


    function create(Request $request) {
        if($request->method() == 'POST') {
            $validated = $request->validate([
                'type' => 'required',
                'image' => 'required',
                'Appimage' => 'required',
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                // Generate a unique filename for the image to avoid conflicts
                $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
    
                // Move the uploaded image to the 'public/uploads/slider' directory
                $image->move(public_path('uploads/homeslider'), $imageName);
            } else {
                // Handle cases where no image is provided or invalid
                return back()->with('error', 'Invalid image file');
            }
            
            if ($request->hasFile('Appimage') && $request->file('Appimage')->isValid()) {
                $appImage = $request->file('Appimage');
                // Generate a unique filename for the image to avoid conflicts
                $appImageName = Str::random(20) . '.' . $appImage->getClientOriginalExtension();
    
                // Move the uploaded image to the 'public/uploads/slider' directory
                $appImage->move(public_path('uploads/homeslider'), $appImageName);
            } else {
                // Handle cases where no image is provided or invalid
                return back()->with('error', 'Invalid image file');
            }
            
    
            // Create a new Slider entry
            $agentCall = new HomeSlider();
            $agentCall->type = $request->type;
            $agentCall->image = 'uploads/homeslider/' . $imageName;
            $agentCall->Appimage = 'uploads/homeslider/' . $appImageName;
            $agentCall->save();
    
            return redirect()->route('home_slider')->with('success', 'Slider added successfully!');
        }
    
        return view('admin/homeslider/create');
    }


    public function destroy($id)
    {
        $agentCall = HomeSlider::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }


    public function edit($id)
    {
        $data['slider'] = HomeSlider::orderBy('id','DESC')->where('id',$id)->first();
        $data['city'] = AdminCity::orderBy('id', 'DESC')->get();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['VehiclePrice'] = LocalVehiclePrice::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/homeslider/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);
    
        // Validate input
        $request->validate([
            'type' => 'required',
            'image' => 'nullable', 
            'Appimage' => 'nullable', 
        ]);

        $slider->type = $request->type;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/homeslider'), $imageName);
            $slider->image = 'uploads/homeslider/' . $imageName;
        }
        
        if ($request->hasFile('Appimage')) {
            $appImage = $request->file('Appimage');
            $appImageName = Str::random(20) . '.' . $appImage->getClientOriginalExtension();
            $appImage->move(public_path('uploads/homeslider'), $appImageName);
            $slider->appImage = 'uploads/homeslider/' . $appImageName;
        }
        
    
        // Save the updated slider
        $slider->save();
    
        return redirect()->route('home_slider')->with('success', 'Slider updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = LocalVehiclePrice::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('home_slider')->with('success', 'Vehicle status updated successfully!');
    }

}

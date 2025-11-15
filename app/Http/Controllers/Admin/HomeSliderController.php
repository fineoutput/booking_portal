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
        if ($request->method() == 'POST') {
            $validated = $request->validate([
                'type' => 'required',
                'type_2' => 'required',
                'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
                'Appimage' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
                'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200', 
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/homeslider'), $imageName);
            } else {
                return back()->with('error', 'Invalid image file');
            }

            if ($request->hasFile('Appimage') && $request->file('Appimage')->isValid()) {
                $appImage = $request->file('Appimage');
                $appImageName = Str::random(20) . '.' . $appImage->getClientOriginalExtension();
                $appImage->move(public_path('uploads/homeslider'), $appImageName);
            } else {
                return back()->with('error', 'Invalid app image file');
            }

            $videoName = null;
            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                $video = $request->file('video');
                $videoName = Str::random(20) . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('uploads/homeslider'), $videoName);
            }

            $agentCall = new HomeSlider();
            $agentCall->type = $request->type;
            $agentCall->type_2 = $request->type_2;
            $agentCall->image = 'uploads/homeslider/' . $imageName;
            $agentCall->Appimage = 'uploads/homeslider/' . $appImageName;
            $agentCall->video = $videoName ? 'uploads/homeslider/' . $videoName : null;
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



   public function update(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);

        $request->validate([
            'type' => 'required',
            'type_2' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'Appimage' => 'nullable|file|mimes:jpeg,png,jpg,webp',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:51200', 
        ]);

        $slider->type = $request->type;
        $slider->type_2 = $request->type_2;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/homeslider'), $imageName);
            $slider->image = 'uploads/homeslider/' . $imageName;
        }

        if ($request->hasFile('Appimage') && $request->file('Appimage')->isValid()) {
            $appImage = $request->file('Appimage');
            $appImageName = Str::random(20) . '.' . $appImage->getClientOriginalExtension();
            $appImage->move(public_path('uploads/homeslider'), $appImageName);
            $slider->Appimage = 'uploads/homeslider/' . $appImageName;
        }

        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $video = $request->file('video');
            $videoName = Str::random(20) . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/homeslider'), $videoName);
            $slider->video = 'uploads/homeslider/' . $videoName;
        }

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

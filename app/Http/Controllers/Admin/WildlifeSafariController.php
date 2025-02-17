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
            if (!empty($request->image)) {

				$extension = strtolower($request->image->getClientOriginalExtension());

				$file = time() . '.' . $extension;

				$request->image->move(public_path('uploads/image/Safari/'), $file);

				$fullimagepath = 'uploads/image/Safari/' . $file;
				
			} else {
				return redirect()->back()->with('error', 'No image was uploaded. Please provide a valid image.');
			}
            $agentCall = new WildlifeSafari();
            // $agentCall->cost = $request->cost;
            $agentCall->date = $request->date;
            $agentCall->vehicle = $request->vehicle;
            $agentCall->national_park = $request->national_park;
            $agentCall->city_id = $request->city_id;
            $agentCall->state_id = $request->state_id;
            $agentCall->cost = $request->cost;
            $agentCall->timings = implode(',', $request->timings);
            $agentCall->image= $fullimagepath;

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
            'vehicle' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'timings' => 'nullable|array',
            'timings.*' => 'in:morning,evening',
            'image' => 'nullable',
        ]);
        $wildlifeSafari = WildlifeSafari::findOrFail($id);

        if ($request->hasFile('image')) {
            
            // Delete old image if exists
            if (!empty($wildlifeSafari->image) && file_exists(public_path($wildlifeSafari->image))) {
                unlink(public_path($wildlifeSafari->image));
            }
    
            // Upload new image
            $extension = strtolower($request->image->getClientOriginalExtension());
            $file = time() . '.' . $extension;
            $request->image->move(public_path('uploads/image/Safari/'), $file);
            $wildlifeSafari->image = 'uploads/image/Safari/' . $file;
        }
        else {
            return redirect()->back()->with('error', 'No image was uploaded. Please provide a valid image.');
        }
        // Find the WildlifeSafari entry
        
    
        // Update the record
        $wildlifeSafari->state_id = $request->state_id;
        $wildlifeSafari->city_id = $request->city_id;
        $wildlifeSafari->national_park = $request->national_park;
        $wildlifeSafari->vehicle = $request->vehicle;
        $wildlifeSafari->date = $request->date;
        $wildlifeSafari->cost = $request->cost;
        $wildlifeSafari->timings = implode(',', $request->timings);  // Save the timings as a comma-separated string
        $wildlifeSafari->image= $wildlifeSafari->image;
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

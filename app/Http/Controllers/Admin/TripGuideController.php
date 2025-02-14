<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\Languages;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\TripGuide;
use App\Models\State;
use App\Models\City;


class TripGuideController extends Controller
{
    function index() {
        $data['WildlifeSafari'] = TripGuide::orderBy('id','DESC')->get();
        return view('admin/tripguide/index',$data);
    }
    
    public function getCitiesByStatetripguide($stateId)
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

            $agentCall = new TripGuide();
            $agentCall->location = $request->location;
            $agentCall->out_station_guide = $request->out_station_guide;
            $agentCall->languages_id = $request->languages_id;
            $agentCall->local_guide = $request->local_guide;
            $agentCall->city_id = $request->city_id;
            $agentCall->state_id = $request->state_id;
            $agentCall->cost = $request->cost;

            $agentCall->save(); 

            return redirect()->route('tripguide')->with('success', 'Trip Guide added successfully!');
        }
        // $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['states'] = State::all();
        $data['languages'] = Languages::all();
        return view('admin/tripguide/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = TripGuide::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Trip Guide deleted successfully!');
    }


    public function edit($id)
    {
        $data['wildlifeSafari'] = TripGuide::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 

        return view('admin/tripguide/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'cost' => 'required|numeric',
        ]);
    
        // Find the WildlifeSafari entry
        $wildlifeSafari = TripGuide::findOrFail($id);
    
        // Update the record
        $wildlifeSafari->location = $request->location;
        $wildlifeSafari->out_station_guide = $request->out_station_guide;
        $wildlifeSafari->languages_id = $request->languages_id;
        $wildlifeSafari->local_guide = $request->local_guide;
        $wildlifeSafari->city_id = $request->city_id;
        $wildlifeSafari->state_id = $request->state_id;
        $wildlifeSafari->cost = $request->cost;

        $wildlifeSafari->save();

        return redirect()->route('tripguide')->with('success', 'Trip Guide updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = TripGuide::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('tripguide   ')->with('success', 'Outstation status updated successfully!');
    }

}

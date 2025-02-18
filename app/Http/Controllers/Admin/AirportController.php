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
use App\Models\Airport;
use App\Models\State;
use App\Models\City;


class AirportController extends Controller
{
    function index() {
        $data['WildlifeSafari'] = Airport::orderBy('id','DESC')->get();
        return view('admin/airport/index',$data);
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

            $agentCall = new Airport();
            $agentCall->airport = $request->airport;
            $agentCall->railway = $request->railway;
            $agentCall->vehicle_id = $request->vehicle_id;
            $agentCall->description = $request->description;

            $agentCall->vehicle_id = implode(',', $request->vehicle_id); 
            $agentCall->save(); 

            return redirect()->route('airport.index')->with('success', 'Airport List added successfully!');
        }
        $data['vehicle'] = Vehicle::orderBy('id','DESC')->get();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['states'] = State::all();
        $data['languages'] = Languages::all();
        return view('admin/airport/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = Airport::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Airport List deleted successfully!');
    }


    public function edit($id)
    {
        $data['wildlifeSafari'] = Airport::findOrFail($id);
        $data['states'] = State::all(); 
        $data['languages'] = Languages::all();
        $data['cities'] = City::where('state_id', $data['wildlifeSafari']->state_id)->get(); 
        $data['vehicle'] = Vehicle::orderBy('id','DESC')->get();
        return view('admin/airport/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'state_id' => 'required',
            // 'city_id' => 'required',
            // 'cost' => 'required|numeric',
        ]);
    
        // Find the WildlifeSafari entry
        $agentCall = Airport::findOrFail($id);

        $agentCall->airport = $request->airport;
        $agentCall->railway = $request->railway;
        $agentCall->vehicle_id = $request->vehicle_id;
        $agentCall->description = $request->description;
        // $agentCall->city_id = $request->city_id;
        // $agentCall->state_id = $request->state_id;
        // $agentCall->cost = $request->cost;
        // $agentCall->text_description = $request->text_description;
        $agentCall->vehicle_id = implode(',', $request->vehicle_id); 

        $agentCall->save();

        return redirect()->route('airport.index')->with('success', 'Airport List updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = TripGuide::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('airport.index')->with('success', 'Airport List status updated successfully!');
    }

}

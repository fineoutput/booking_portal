<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;


class RoundTripController extends Controller
{
    function index() {
        $data['Outstation'] = RoundTrip::orderBy('id','DESC')->get();
        return view('admin/roundtrip/index',$data);
    }

    function create(Request $request) {
        if($request->method()=='POST'){
            // $validated = $request->validate([           
            //     'car_type_id' => 'required',
            //     'per_km_charge	' => 'required',
            //     'description' => 'required',
            // ]);

            $agentCall = new RoundTrip();
            $agentCall->car_type_id = $request->car_type_id;
            $agentCall->per_km_charge = $request->per_km_charge;
            $agentCall->cost = $request->cost;
            $agentCall->description = $request->description;

            $agentCall->save(); 

            return redirect()->route('roundtrip')->with('success', 'Round Trip added successfully!');
        }
        // $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        return view('admin/roundtrip/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = RoundTrip::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Round Trip deleted successfully!');
    }


    public function edit($id)
    {
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['RoundTrip'] = RoundTrip::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/roundtrip/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'car_type_id' => 'required',
            //     'per_km_charge	' => 'required',
            //     'description' => 'required',
        ]);

        $vehiclePrice = RoundTrip::findOrFail($id);
        $vehicle = Vehicle::orderBy('id','DESC')->where('id',$vehiclePrice->vehicle_id)->first();

        $vehiclePrice->car_type_id = $request->car_type_id;
        $vehiclePrice->per_km_charge = $request->per_km_charge;
        $vehiclePrice->cost = $request->cost;
        $vehiclePrice->description = $request->description;

        $vehiclePrice->save();

        return redirect()->route('roundtrip')->with('success', 'Round Trip updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Outstation status updated successfully!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\VehiclePrice;
use App\Models\Outstation;


class OutstationController extends Controller
{
    function index() {
        $data['Outstation'] = Outstation::orderBy('id','DESC')->get();
        return view('admin/outstation/index',$data);
    }

    function create(Request $request) {
        if($request->method()=='POST'){
            $validated = $request->validate([           
                'drop_point' => 'required',
                'description' => 'required',
                'available_km' => 'required',
                'extra_km_charge' => 'required',
                'vehicle_type' => 'required',
                'trip_type' => 'required',
                'cost' => 'required',
            ]);

            $agentCall = new Outstation();
            $agentCall->drop_point = $request->drop_point;
            $agentCall->available_km = $request->available_km;
            $agentCall->extra_km_charge = $request->extra_km_charge;
            $agentCall->vehicle_type = $request->vehicle_type;
            $agentCall->trip_type = $request->trip_type;
            $agentCall->cost = $request->cost;
            $agentCall->description = $request->description;

            $agentCall->save(); 

            return redirect()->route('outstation')->with('success', 'Outstation added successfully!');
        }
        // $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['Route'] = Route::orderBy('id','DESC')->get();
        return view('admin/outstation/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = Outstation::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Outstation deleted successfully!');
    }


    public function edit($id)
    {
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['Route'] = Route::orderBy('id','DESC')->get();
        $data['Outstation'] = Outstation::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/outstation/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
                'drop_point' => 'required',
                'description' => 'required',
                'available_km' => 'required',
                'extra_km_charge' => 'required',
                'vehicle_type' => 'required',
                'trip_type' => 'required',
                'cost' => 'required',
        ]);

        $vehiclePrice = Outstation::findOrFail($id);
        $vehicle = Vehicle::orderBy('id','DESC')->where('id',$vehiclePrice->vehicle_id)->first();

        $vehiclePrice->drop_point = $request->drop_point;
            $vehiclePrice->available_km = $request->available_km;
            $vehiclePrice->extra_km_charge = $request->extra_km_charge;
            $vehiclePrice->vehicle_type = $request->vehicle_type;
            $vehiclePrice->trip_type = $request->trip_type;
            $vehiclePrice->cost = $request->cost;
            $vehiclePrice->description = $request->description;

        $vehiclePrice->save();

        return redirect()->route('outstation')->with('success', 'Outstation updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Outstation status updated successfully!');
    }

}

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

    function create(Request $request) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'vehicle_type' => 'required',
                'description' => 'required',
            ]);

            $agentCall = new Vehicle();
            $agentCall->vehicle_type = $request->vehicle_type;
            $agentCall->description = $request->description;
            $agentCall->status = '1';
    
            $agentCall->save(); 

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

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_type' => 'required',
            'description' => 'required',
        ]);

        $agentCall = Vehicle::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->vehicle_type = $request->vehicle_type;
        $agentCall->description = $request->description;
        // $agentCall->status = '1';

        $agentCall->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle updated successfully!');
    }

    public function updateStatus($id)
    {

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle status updated successfully!');
    }

}

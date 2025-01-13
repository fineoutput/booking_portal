<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;


class VehiclePriceController extends Controller
{
    function vehicleprice($id) {
        $data['agent'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['VehiclePrice'] = VehiclePrice::orderBy('id','DESC')->where('vehicle_id',$id)->get();
        return view('admin/vehicleprice/index',$data);
    }

    function vehiclepricecreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([           
                'type' => 'required',
                // 'description' => 'required',
            ]);

            $agentCall = new VehiclePrice();
            $agentCall->type = $request->type;
            $agentCall->price = $request->price;
            $agentCall->city = $request->city;
            $agentCall->vehicle_id = $request->vehicle_id;
            $agentCall->description = $request->description;
            // $agentCall->status = '1';

            $agentCall->save(); 

            return redirect()->route('vehicleprice',$request->vehicle_id)->with('success', 'Vehicle price added successfully!');
        }
        $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        return view('admin/vehicleprice/create',$data);
    }


    public function vehiclepricedelete($id)
    {
        $agentCall = VehiclePrice::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Vehicle Price deleted successfully!');
    }


    public function vehiclepriceedit($id)
    {
        $data['vehicle'] = Vehicle::orderBy('id','DESC')->where('id',$id)->first();
        $data['VehiclePrice'] = VehiclePrice::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/vehicleprice/edit',$data);
    }

    // Update the specified resource in storage
    public function vehiclepriceupdate(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric',   
            'city' => 'required',
            'description' => 'required',  
        ]);


        $vehiclePrice = VehiclePrice::findOrFail($id);
        $vehicle = Vehicle::orderBy('id','DESC')->where('id',$vehiclePrice->vehicle_id)->first();

        $vehiclePrice->type = $request->type;
        $vehiclePrice->price = $request->price;
        $vehiclePrice->city = $request->city;
        // $vehiclePrice->vehicle_id = $vehicle->id;
        $vehiclePrice->description = $request->description;

        $vehiclePrice->save();

        return redirect()->route('vehicleprice',$vehiclePrice->id)->with('success', 'Vehicle price updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle status updated successfully!');
    }

}

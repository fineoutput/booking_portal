<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCity;
use App\Models\Airport;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\LocalVehiclePrice;


class LocalTourPriceController extends Controller
{
    function index() {
        $data['VehiclePrice'] = LocalVehiclePrice::orderBy('id','DESC')->get();
        return view('admin/localtourprice/index',$data);
    }

    function create(Request $request) {
        if($request->method()=='POST'){
            $validated = $request->validate([           
                'price' => 'required',
                // 'description' => 'required',
            ]);

            $agentCall = new LocalVehiclePrice();
            $agentCall->price = $request->price;
            $agentCall->city_id = $request->city_id;
            $agentCall->vehicle_id = implode(',', $request->vehicle_id);
            $agentCall->description = $request->description;
            // $agentCall->status = '1';

            $agentCall->save(); 

            return redirect()->route('localvehicle')->with('success', 'Vehicle price added successfully!');
        }

        $data['vehicleselect'] = Vehicle::orderBy('id', 'DESC')->get();
        $data['city'] = AdminCity::orderBy('id', 'DESC')->get();


        return view('admin/localtourprice/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = LocalVehiclePrice::findOrFail($id); // Find the agent call by ID
        $agentCall->delete(); 

        return redirect()->back()->with('success', 'Vehicle Price deleted successfully!');
    }


    public function edit($id)
    {
        $data['vehicle'] = Airport::orderBy('id','DESC')->where('id',$id)->first();
        $data['city'] = AdminCity::orderBy('id', 'DESC')->get();
        $data['vehicleselect'] = Vehicle::orderBy('id','DESC')->get();
        $data['VehiclePrice'] = LocalVehiclePrice::orderBy('id','DESC')->where('id',$id)->first();

        return view('admin/localtourprice/edit',$data);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'type' => 'required',
            'price' => 'required|numeric',   
            // 'city' => 'required',
            'description' => 'required',  
        ]);


        $vehiclePrice = LocalVehiclePrice::findOrFail($id);
        $vehicle = Vehicle::orderBy('id','DESC')->where('id',$vehiclePrice->vehicle_id)->first();

        $vehiclePrice->price = $request->price;
        $vehiclePrice->city_id = $request->city_id;
        $vehiclePrice->vehicle_id = implode(',', $request->vehicle_id);
        $vehiclePrice->description = $request->description;

        $vehiclePrice->save();

        return redirect()->route('localvehicle')->with('success', 'Vehicle price updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = LocalVehiclePrice::findOrFail($id);
        $vehicle->status = ($vehicle->status == 1) ? 2 : 1;
        $vehicle->save();

        return redirect()->route('vehicle')->with('success', 'Vehicle status updated successfully!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\HotelBooking;
use App\Models\WildlifeSafariOrder;
use App\Models\State;
use App\Models\City;
use App\Models\HotelBooking2;


class HotelBookingController extends Controller
{
    function index() {
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',0)->get();
        return view('admin/hotelbooking/index',$data);
    }

    function completeorders() {
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',1)->get();
        return view('admin/hotelbooking/index',$data);
    }

    function acceptorders() {
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',3)->get();
        return view('admin/hotelbooking/index',$data);
    }

    function rejectorders() {
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',2)->get();
        return view('admin/hotelbooking/index',$data);
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

            $agentCall = new WildlifeSafari();
            // $agentCall->cost = $request->cost;
            $agentCall->date = $request->date;
            $agentCall->vehicle = $request->vehicle;
            $agentCall->national_park = $request->national_park;
            $agentCall->city_id = $request->city_id;
            $agentCall->state_id = $request->state_id;
            $agentCall->cost = $request->cost;
            $agentCall->timings = implode(',', $request->timings);

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
        $request->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'national_park' => 'required|string',
            'vehicle' => 'required|string',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'timings' => 'nullable|array',
            'timings.*' => 'in:morning,evening',
        ]);
    
        // Find the WildlifeSafari entry
        $wildlifeSafari = WildlifeSafari::findOrFail($id);
    
        // Update the record
        $wildlifeSafari->state_id = $request->state_id;
        $wildlifeSafari->city_id = $request->city_id;
        $wildlifeSafari->national_park = $request->national_park;
        $wildlifeSafari->vehicle = $request->vehicle;
        $wildlifeSafari->date = $request->date;
        $wildlifeSafari->cost = $request->cost;
        $wildlifeSafari->timings = implode(',', $request->timings);  // Save the timings as a comma-separated string
        $wildlifeSafari->save();

        return redirect()->route('wild_life_safari')->with('success', 'Wild life Safari updated successfully!');
    }

    public function updateStatus($id)
    {
        $vehicle = HotelBooking2::findOrFail($id);
    
        // Check the action from the form
        $action = request()->input('status_action');
    
        if ($action == 'complete') {
            // Change status to 1 (Confirmed)
            $vehicle->status = 1;
        } elseif ($action == 'cancel') {
            // Change status to 2 (Canceled)
            $vehicle->status = 2;
        } elseif ($action == 'accept') {
            // Change status to 2 (Canceled)
            $vehicle->status = 3;
        } else {
            // Default case, no action (status might not change)
            return redirect()->back()->with('error', 'Invalid status update action.');
        }
    
        // Save the changes
        $vehicle->save();
    
        return redirect()->back()->with('success', 'Hotel Booking status updated successfully!');
    }
    

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelCalls;
use App\Models\City;
use App\Models\State;
use Carbon\Carbon;

class HotelCallsController extends Controller
{
    public function index(Request $request)
    {
        // Get the start_date and end_date from the query parameters
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Start the query
        $query = HotelCalls::orderBy('id', 'DESC');
    
        // Apply the date filters if both start_date and end_date are provided
        if ($startDate && $endDate) {
            // Convert both dates to Carbon instances
            $startDate = Carbon::parse($startDate)->startOfDay(); // Start of the day
            $endDate = Carbon::parse($endDate)->endOfDay(); // End of the day
    
            // Filter by the created_at field
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        // If only start_date is provided
        elseif ($startDate) {
            $query->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }
        // If only end_date is provided
        elseif ($endDate) {
            $query->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }
    
        // Get the filtered data
        $data['agent'] = $query->get();
    
        // Return the view with filtered data
        return view('admin.hotelCalls.index', $data);
    }
    
    
    public function getCitiesByStatehotelcalls($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    function create(Request $request) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'state_id' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'contact_person_name' => 'required',
                'room_details' => 'required',
                'cost_of_rooms' => 'required',
                'location' => 'required',
            ]);
    
            // Insert the data into the database
            $agentCall = new HotelCalls();
            $agentCall->name = $request->name;
            $agentCall->phone = $request->phone;
            $agentCall->state_id = $request->state_id;
            $agentCall->location = $request->location;
            $agentCall->city = $request->city;
            $agentCall->contact_person_name = $request->contact_person_name;
            $agentCall->room_details = $request->room_details;
            $agentCall->cost_of_rooms = $request->cost_of_rooms;
            $agentCall->date = Carbon::now()->toDateString();
    
            $agentCall->save();  // Save the record in the database
    
            // Optionally, return a response or redirect
            
            return redirect()->route('hotelsCalls')->with('success', 'Hotels Call added successfully!');
        }
        $data['states'] = State::all();
        return view('admin/hotelCalls/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = HotelCalls::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('hotelsCalls')->with('success', 'Hotels call deleted successfully!');
    }


    public function edit($id)
    {
        $agent = HotelCalls::findOrFail($id);  // Find the agent call by ID
        $states = State::all();

        return view('admin/hotelCalls/edit', compact('agent','states'));  // Pass the data to the edit view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'state_id' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'contact_person_name' => 'required',
                'room_details' => 'required',
                'cost_of_rooms' => 'required',
                'location' => 'required',
        ]);

        $agentCall = HotelCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state_id = $request->state_id;
        $agentCall->location = $request->location;
        $agentCall->city = $request->city;
        $agentCall->contact_person_name = $request->contact_person_name;
        $agentCall->room_details = $request->room_details;
        $agentCall->cost_of_rooms = $request->cost_of_rooms;

        $agentCall->save();  // Save the updated record

        return redirect()->route('hotelsCalls')->with('success', 'Hotels call updated successfully!');
    }
}

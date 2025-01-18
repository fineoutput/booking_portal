<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentCalls;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;

class AgentCallsController extends Controller
{
    public function index(Request $request)
{
    // Get the start_date and end_date from the query parameters (optional)
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Start the query
    $query = AgentCalls::orderBy('id', 'DESC');

    // If both start_date and end_date are provided
    if ($startDate && $endDate) {
        $startDate = Carbon::parse($startDate)->startOfDay(); // Start of the start date
        $endDate = Carbon::parse($endDate)->endOfDay(); // End of the end date

        // Filter by created_at field using whereBetween
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

    // Execute the query and get the filtered data
    $data['agent'] = $query->get();

    // Return the view with the filtered data
    return view('admin.agentcalls.index', $data);
}


    public function getCitiesByStateagent($stateId)
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
                'remarks' => 'nullable|string|max:500',
            ]);
    
            // Insert the data into the database
            $agentCall = new AgentCalls();
            $agentCall->name = $request->name;
            $agentCall->phone = $request->phone;
            $agentCall->state_id = $request->state_id;
            $agentCall->city = $request->city;
            $agentCall->remarks = $request->remarks ?? null; // If no remarks, set it to null
            $agentCall->date = Carbon::now()->toDateString();
    
            $agentCall->save();  // Save the record in the database
    
            // Optionally, return a response or redirect
            return redirect()->route('AgentCalls')->with('success', 'Agent Call added successfully!');
        }
        $data['states'] = State::all();
        return view('admin/agentcalls/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = AgentCalls::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('AgentCalls')->with('success', 'Agent call deleted successfully!');
    }


    public function edit($id)
    {
        $agent = AgentCalls::findOrFail($id);  // Find the agent call by ID
        $states = State::all();
        return view('admin/agentcalls/edit', compact('agent','states'));  // Pass the data to the edit view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'state_id' => 'required',
            'city' => 'required',
            'remarks' => 'nullable',
        ]);

        $agentCall = AgentCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state_id = $request->state_id;
        $agentCall->city = $request->city;
        $agentCall->remarks = $request->remarks;

        $agentCall->save();  // Save the updated record

        return redirect()->route('AgentCalls')->with('success', 'Agent call updated successfully!');
    }
}







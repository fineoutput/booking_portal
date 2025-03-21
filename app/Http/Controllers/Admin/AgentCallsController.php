<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentCalls;
use App\Models\State;
use App\Models\City;
use App\Models\TransferAgentCalls;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AgentCallsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        Log::debug('Start Date:', ['start_date' => $startDate]);
        Log::debug('End Date:', ['end_date' => $endDate]);
    
        $user = Auth::user();
        $query = AgentCalls::orderBy('id', 'DESC');
    
        if ($user->power == 4) {
            // Get the IDs of the agent calls related to the current user
            $agentCallIds = TransferAgentCalls::where('caller_id', $user->id)->pluck('agentcalls_id');
            
            // Check if there are any agent call IDs to apply the whereIn filter
            if ($agentCallIds->isNotEmpty()) {
                // Apply the whereIn filter with the retrieved IDs
                $query->whereIn('id', $agentCallIds);
            }
        }
    
        // Apply date filters if present
        if ($startDate && $endDate) {
            Log::debug('Filtering with both start_date and end_date');
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            Log::debug('Filtering with start_date only');
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            Log::debug('Filtering with end_date only');
            $query->where('created_at', '<=', $endDate);
        }
    
        // Execute the query to get the agent calls data
        $agentCalls = $query->get();
    
        // Return the data to the view
        return view('admin.agentcalls.index', compact('agentCalls'));
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







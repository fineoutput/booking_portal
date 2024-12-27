<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentCalls;

class AgentCallsController extends Controller
{
    function index() {
        $data['agent'] = AgentCalls::orderBy('id','DESC')->get();
        return view('admin/agentcalls/index',$data);
    }

    function create(Request $request) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'state' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'remarks' => 'nullable|string|max:500',
            ]);
    
            // Insert the data into the database
            $agentCall = new AgentCalls();
            $agentCall->name = $request->name;
            $agentCall->phone = $request->phone;
            $agentCall->state = $request->state;
            $agentCall->city = $request->city;
            $agentCall->remarks = $request->remarks ?? null; // If no remarks, set it to null
    
            $agentCall->save();  // Save the record in the database
    
            // Optionally, return a response or redirect
            return redirect()->route('AgentCalls')->with('success', 'Agent Call added successfully!');
        }
        return view('admin/agentcalls/create');
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

        return view('admin/agentcalls/edit', compact('agent'));  // Pass the data to the edit view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'remarks' => 'nullable',
        ]);

        $agentCall = AgentCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state = $request->state;
        $agentCall->city = $request->city;
        $agentCall->remarks = $request->remarks;

        $agentCall->save();  // Save the updated record

        return redirect()->route('AgentCalls')->with('success', 'Agent call updated successfully!');
    }
}







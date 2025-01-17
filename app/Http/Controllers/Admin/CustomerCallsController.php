<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerCalls;
use App\Models\State;
use App\Models\City;

class CustomerCallsController extends Controller
{
    function index() {
        $agent = CustomerCalls::with('state')->orderBy('id','DESC')->get();
        $states = [];

        foreach ($agent as $value) {
            $state = State::where('id', $value->state)->select('state_name')->first();
            $states[$value->id] = $state ? $state->state_name : null;
        }
    
    
        return view('admin/CustomerCalls/index',compact('agent','states'));
    }

    function Ongoing() {
        $data['agent'] = CustomerCalls::orderBy('id','DESC')->where('mark_lead','1')->get();
        return view('admin/CustomerCalls/ongoing',$data);
    }

    function Cancelled() {
        $data['agent'] = CustomerCalls::orderBy('id','DESC')->where('mark_lead','2')->get();
        return view('admin/CustomerCalls/cancelled',$data);
    }

    function Converted() {
        $data['agent'] = CustomerCalls::orderBy('id','DESC')->where('mark_lead','3')->get();
        return view('admin/CustomerCalls/converted',$data);
    }

    public function getCitiesByStatecustomer($stateId)
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
                'package_enquiry_details' => 'required',
                'interest_details' => 'required',
                'mark_lead' => 'required',
            ]);
    
            // Insert the data into the database
            $agentCall = new CustomerCalls();
            $agentCall->name = $request->name;
            $agentCall->phone = $request->phone;
            $agentCall->state_id = $request->state_id;
            $agentCall->package_enquiry_details = $request->package_enquiry_details;
            $agentCall->city = $request->city;
            $agentCall->interest_details = $request->interest_details;
            $agentCall->mark_lead = $request->mark_lead;
    
            $agentCall->save();  // Save the record in the database
    
            // Optionally, return a response or redirect
            return redirect()->route('customerCalls')->with('success', 'Customer Calls Call added successfully!');
        }
        $data['states'] = State::all();
        return view('admin/CustomerCalls/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = CustomerCalls::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('customerCalls')->with('success', 'Customer call deleted successfully!');
    }


    public function edit($id)
    {
        $agent = CustomerCalls::findOrFail($id);  // Find the agent call by ID
        $states = State::all();
        return view('admin/CustomerCalls/edit', compact('agent','states'));  // Pass the data to the edit view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'state_id' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'package_enquiry_details' => 'required',
                'interest_details' => 'required',
                'mark_lead' => 'required',
        ]);

        $agentCall = CustomerCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state_id = $request->state_id;
        $agentCall->package_enquiry_details = $request->package_enquiry_details;
        $agentCall->city = $request->city;
        $agentCall->interest_details = $request->interest_details;
        $agentCall->mark_lead = $request->mark_lead;

        $agentCall->save();  // Save the updated record

        return redirect()->route('customerCalls')->with('success', 'Customer call updated successfully!');
    }

}

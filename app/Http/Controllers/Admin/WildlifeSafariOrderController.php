<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\WildlifeSafariOrder;
use App\Models\State;
use App\Models\City;
use App\Models\WildlifeSafariOrder2;
use App\adminmodel\Team;
use App\Models\RemarkSafariOrder;
use App\Models\TransferSafariOrder;
use Illuminate\Support\Facades\Auth;

class WildlifeSafariOrderController extends Controller
{

    function transfercreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
            ]);

            $agentCall = new TransferSafariOrder();
            $agentCall->order_id = $id;
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('wild_life_safari_orders')->with('success', 'Order Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = WildlifeSafariOrder2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/wildlifesafariorders/transfercreate',$data);
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkSafariOrder();
            $agentCall->order_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->route('wild_life_safari_orders')->with('success', 'Agent Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = WildlifeSafariOrder2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/wildlifesafariorders/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkSafariOrder::where('order_id',$id)->orderBy('id','DESC')->get();
        return view('admin.wildlifesafariorders.viewremark', compact('agentCalls'));
    }




    function index() {

        $user = Auth::user();
        if($user->power == 4){
        $data['order_id'] = TransferSafariOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['WildlifeSafari'] = WildlifeSafariOrder2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->get();
    }else{
        $data['WildlifeSafari'] = WildlifeSafariOrder2::orderBy('id','DESC')->where('status',0)->get();
    }
        return view('admin/wildlifesafariorders/index',$data);
    }

    function completeorders() {
        $user = Auth::user();

        $data['order_id'] = TransferSafariOrder::where('caller_id', $user->id)->pluck('order_id');

        $data['WildlifeSafari'] = WildlifeSafariOrder2::orderBy('id','DESC')->where('id',$data['order_id'])->where('status',1)->get();
        return view('admin/wildlifesafariorders/index',$data);
    }
    function acceptorders() {
        $data['WildlifeSafari'] = WildlifeSafariOrder2::orderBy('id','DESC')->where('status',3)->get();
        return view('admin/wildlifesafariorders/index',$data);
    }

    function rejectorders() {
        $data['WildlifeSafari'] = WildlifeSafariOrder2::orderBy('id','DESC')->where('status',2)->get();
        return view('admin/wildlifesafariorders/index',$data);
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

    // public function updateStatus($id)
    // {
    //     $vehicle = WildlifeSafariOrder::findOrFail($id);
    //     $vehicle->status = ($vehicle->status == 0) ? 1 : 0;
    //     $vehicle->save();

    //     return redirect()->back()->with('success', 'Outstation status updated successfully!');
    // }

    public function updateStatus($id)
    {
        $vehicle = WildlifeSafariOrder2::findOrFail($id);
    
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
    
        return redirect()->back()->with('success', 'Safari Order status updated successfully!');
    }

}

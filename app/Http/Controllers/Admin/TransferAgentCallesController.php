<?php

namespace App\Http\Controllers\Admin;

use App\adminmodel\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentCalls;
use App\Models\RemarkAgentCalls;
use App\Models\State;
use App\Models\City;
use App\Models\TransferAgentCalls;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransferAgentCallesController extends Controller
{
    public function index(Request $request)
    {
        $agentCalls = TransferAgentCalls::get();
        return view('admin.transferagentcalls.index', compact('agentCalls'));
    }


    public function getCitiesByStateagent($stateId)
    {
    $cities = City::where('state_id', $stateId)->get(['id', 'city_name']);
    return response()->json(['cities' => $cities]);
    }


    function create(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new TransferAgentCalls();
            $agentCall->agentcalls_id = $id;
            // $agentCall->agentcalls_id = implode(',', $request->agentcalls_id);
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('AgentCalls')->with('success', 'Agent Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = AgentCalls::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transferagentcalls/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = TransferAgentCalls::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('transferagentcalls')->with('success', 'Agent call deleted successfully!');
    }


    public function edit($id)
    {
        $agent = TransferAgentCalls::findOrFail($id);  // Find the agent call by ID
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

        $agentCall = TransferAgentCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state_id = $request->state_id;
        $agentCall->city = $request->city;
        $agentCall->remarks = $request->remarks;

        $agentCall->save();  // Save the updated record

        return redirect()->route('AgentCalls')->with('success', 'Agent call updated successfully!');
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkAgentCalls();
            $agentCall->agentcalls_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->route('AgentCalls')->with('success', 'Agent Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = AgentCalls::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transferagentcalls/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkAgentCalls::where('agentcalls_id',$id)->get();
        return view('admin.transferagentcalls.viewremark', compact('agentCalls'));
    }


}







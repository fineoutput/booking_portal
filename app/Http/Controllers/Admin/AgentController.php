<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    function index(){
        $data['agent'] = Agent::orderBy('id','DESC')->get();
        return view('admin/agent/index',$data);
    }

    function pandingagent(){
        $data['agent'] = Agent::orderBy('id','DESC')->where('approved',0)->get();
        return view('admin/agent/pandingagent',$data);
    }

    function completeagent(){
        $data['agent'] = Agent::orderBy('id','DESC')->where('approved',1)->get();
        return view('admin/agent/pandingagent',$data);
    }



     public function setLimit(Request $request, $id)
    {
        $request->validate([
            'set_limit_amount' => 'required|numeric'
        ]);

        Agent::findOrFail($id)->update([
            'set_limit_amount' => $request->set_limit_amount
        ]);

        return back()->with('success', 'Set Limit Amount Updated');
    }

    public function setNegativeLimit(Request $request, $id)
    {
        $request->validate([
            'negative_limit_amount' => 'required|numeric'
        ]);

        Agent::findOrFail($id)->update([
            'negative_limit_amount' => $request->negative_limit_amount
        ]);

        return back()->with('success', 'Negative Limit Updated');
    }


    public function updateStatus($id)
    {
        $vehicle = Agent::findOrFail($id);
        $vehicle->approved = ($vehicle->status == 0) ? 1 : 0;
        $vehicle->save();

        return redirect()->back()->with('success', 'Agent status updated successfully!');
    }

    public function changeStatus($id)
    {
        $agent = Agent::findOrFail($id);
    
 
            $agent->status = $agent->status == 1 ? 0 : 1; // Toggle status
            $agent->save();
    
            return redirect()->back()->with('success', 'Agent status updated successfully!');

    
    }

}

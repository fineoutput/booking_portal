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


    public function updateStatus($id)
    {
        $vehicle = Agent::findOrFail($id);
        $vehicle->approved = ($vehicle->status == 0) ? 1 : 0;
        $vehicle->save();

        return redirect()->back()->with('success', 'Hotel Booking status updated successfully!');
    }

}

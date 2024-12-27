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
}

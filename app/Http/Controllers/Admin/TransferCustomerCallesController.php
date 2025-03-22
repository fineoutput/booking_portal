<?php

namespace App\Http\Controllers\Admin;

use App\adminmodel\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelCalls;
use App\Models\RemarkHotelCalls;
use App\Models\RemarkCustomerCalls;
use App\Models\State;
use App\Models\City;
use App\Models\TransferCustomerCalls;
use App\Models\CustomerCalls;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransferCustomerCallesController extends Controller
{
    public function index(Request $request)
    {
        $agentCalls = TransferCustomerCalls::orderBy('id','DESC')->get();
        return view('admin.transfercustomercalls.index', compact('agentCalls'));
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
            $CustomerCalls = CustomerCalls::where('id',$id)->first();
            // return $CustomerCalls;
            $agentCall = new TransferCustomerCalls();
            $agentCall->agentcalls_id = $id;
            $agentCall->status = $CustomerCalls->mark_lead;
            // $agentCall->agentcalls_id = implode(',', $request->agentcalls_id);
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('customerCalls')->with('success', 'Hotel Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = CustomerCalls::where('id',$id)->first();
        // $data['agentCalls'] = HotelCalls::whereNotIn('id', TransferCustomerCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transfercustomercalls/create',$data);
    }

    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);
            $CustomerCalls = CustomerCalls::where('id',$id)->first();
            $agentCall = new RemarkCustomerCalls();
            $agentCall->agentcalls_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->status = $request->status;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  
            $CustomerCalls->mark_lead = $request->status;
           $CustomerCalls->save();

            return redirect()->route('customerCalls')->with('success', 'Remark add successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = CustomerCalls::where('id',$id)->first();
        // $data['agentCalls'] = HotelCalls::whereNotIn('id', TransferCustomerCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transfercustomercalls/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkHotelCalls::where('agentcalls_id',$id)->orderBy('id','DESC')->get();
        return view('admin.transfercustomercalls.viewremark', compact('agentCalls'));
    }


}







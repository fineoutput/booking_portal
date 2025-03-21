<?php

namespace App\Http\Controllers\Admin;

use App\adminmodel\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelCalls;
use App\Models\RemarkHotelCalls;
use App\Models\State;
use App\Models\City;
use App\Models\TransferHotelCalls;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransferHotelCallesController extends Controller
{
    public function index(Request $request)
    {
        $agentCalls = TransferHotelCalls::orderBy('id','DESC')->get();
        return view('admin.transferhotelcalls.index', compact('agentCalls'));
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

            $agentCall = new TransferHotelCalls();
            $agentCall->agentcalls_id = $id;
            // $agentCall->agentcalls_id = implode(',', $request->agentcalls_id);
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('hotelsCalls')->with('success', 'Hotel Call Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = HotelCalls::where('id',$id)->first();
        // $data['agentCalls'] = HotelCalls::whereNotIn('id', TransferHotelCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transferhotelcalls/create',$data);
    }


    public function destroy($id)
    {
        $agentCall = TransferHotelCalls::findOrFail($id); // Find the agent call by ID
        $agentCall->delete();  // Delete the record

        return redirect()->route('transferhotelcalls')->with('success', 'Agent call deleted successfully!');
    }


    public function edit($id)
    {
        $agent = TransferHotelCalls::findOrFail($id);  // Find the agent call by ID
        $states = State::all();
        return view('admin/transferhotelcalls/edit', compact('agent','states'));  // Pass the data to the edit view
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

        $agentCall = TransferHotelCalls::findOrFail($id);  // Find the agent call by ID

        // Update the agent call with the new data
        $agentCall->name = $request->name;
        $agentCall->phone = $request->phone;
        $agentCall->state_id = $request->state_id;
        $agentCall->city = $request->city;
        $agentCall->remarks = $request->remarks;

        $agentCall->save();  // Save the updated record

        return redirect()->route('hotelsCalls')->with('success', 'Remark add successfully!');
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkHotelCalls();
            $agentCall->agentcalls_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->route('hotelsCalls')->with('success', 'Remark add successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = HotelCalls::where('id',$id)->first();
        // $data['agentCalls'] = HotelCalls::whereNotIn('id', TransferHotelCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/transferhotelcalls/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkHotelCalls::where('agentcalls_id',$id)->get();
        return view('admin.transferhotelcalls.viewremark', compact('agentCalls'));
    }


}







<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\HotelBooking;
use App\Models\WildlifeSafariOrder;
use App\Models\State;
use App\Models\City;
use App\Models\HotelBooking2;
use App\Models\RemarkHotelOrder;
use App\Models\TransferHotelOrder;
use App\adminmodel\Team;
use App\Models\Agent;
use App\Models\Tourist;
use App\Models\UpgradeRequest;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\Auth;


class HotelBookingController extends Controller
{
    

    function customer(Request $request ,$id){

        $data['tourist'] = Tourist::where('booking_id', $id)->where('type','hotel')->get();

       return view('admin.hotelbooking.customer', $data);
    }

    function transfercreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
            ]);

            $agentCall = new TransferHotelOrder();
            $agentCall->order_id = $id;
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->route('pandinghotelsbooking')->with('success', 'Order Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = HotelBooking2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/hotelbooking/transfercreate',$data);
    }


    
    public function upgradeupdateStatus($id)
    {
        $vehicle = UpgradeRequest::findOrFail($id);

        $action = request()->input('status_action');

      if ($action == 'cancel') {
            $vehicle->status = 1;
        } elseif ($action == 'accept') {

            $vehicle->status = 2;
        } elseif ($action == 'process') {

            $vehicle->status = 2;

        } else {

            return redirect()->back()->with('error', 'Invalid status update action.');
            
        }
    
        $vehicle->save();
    
        return redirect()->back()->with('success', 'status updated successfully!');
    }

    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkHotelOrder();
            $agentCall->order_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->back()->with('success', 'Remark add successfully!')->with('javascript', 'window.history.go(-2);');

        }
        $data['states'] = State::all();
        $data['agentCalls'] = HotelBooking2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/hotelbooking/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkHotelOrder::where('order_id',$id)->orderBy('id','DESC')->get();
        return view('admin.hotelbooking.viewremark', compact('agentCalls'));
    }


    function index() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferHotelOrder::where('caller_id', $user->id)->pluck('order_id');
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->get();
        }else{
            $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',0)->get();
        }
        return view('admin/hotelbooking/index',$data);
    }

    function completeorders() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferHotelOrder::where('caller_id', $user->id)->pluck('order_id');
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->get();
        }else{
            $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',1)->get();
        }
        return view('admin/hotelbooking/index',$data);
    }

    function processorders() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferHotelOrder::where('caller_id', $user->id)->pluck('order_id');
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->get();
        }else{
            $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',4)->get();
        }
        return view('admin/hotelbooking/index',$data);
    }

    function acceptorders() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferHotelOrder::where('caller_id', $user->id)->pluck('order_id');
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->get();
        }else{
            $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',3)->get();
        }
        return view('admin/hotelbooking/index',$data);
    }

     function upgradeorders($id) {
            $data['UpgradeRequest'] = UpgradeRequest::orderBy('id','DESC')->where('type','hotel')->where('booking_id',$id)->get();
            return view('admin/hotelbooking/upgrade',$data);
    }

    function rejectorders() {
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferHotelOrder::where('caller_id', $user->id)->pluck('order_id');
        $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->get();
        }else{
            $data['WildlifeSafari'] = HotelBooking2::orderBy('id','DESC')->where('status',2)->get();
        }
        return view('admin/hotelbooking/index',$data);
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
            'timings.*' => 'in:morning,evening,afternoon',
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

    public function updateStatus($id)
    {
        $vehicle = HotelBooking2::findOrFail($id);
    
        // Check the action from the form
        $action = request()->input('status_action');
    
        if ($action == 'complete') {
            // Change status to 1 (Confirmed)
            $vehicle->status = 1;
        } elseif ($action == 'cancel') {

            if($vehicle->status == 3 || $vehicle->status == 4){
            $user = Agent::where('id', $vehicle->user_id)->first();
           $wallet = Wallet::where('user_id', $vehicle->user_id)->first();

            $addAmount = floatval($vehicle->fetched_price);

            $newBalance = $wallet->balance + $addAmount;

            $wallet->balance = $newBalance;
            $wallet->save();
              $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'booking_id'          => $vehicle->id,
                    'booking_type'          => $vehicle->hotel->name ?? 'Hotel',
                    'transaction_type' => 'credit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The refund for your hotel booking cancellation has been processed. #'.$vehicle->id,
                    'status'           => 1,
                ]);
            }
            $vehicle->status = 2;
        } elseif ($action == 'accept') {

            $user = Agent::where('id', $vehicle->user_id)->first();
        $wallet = Wallet::where('user_id', $vehicle->user_id)->first();

        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet not found!');
        }

        $deductAmount = floatval($vehicle->fetched_price); 

        $newBalance = $wallet->balance - $deductAmount;

        if ($newBalance < -$user->negative_limit_amount) {
            return redirect()->back()->with('error', 'Wallet limit exceeded! You cannot go beyond negative limit of ₹' . $user->negative_limit_amount);
        }

        $wallet->balance = $newBalance;
        $wallet->save();

        $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'booking_id'          => $vehicle->id,
                    'booking_type'          => $vehicle->hotel->name ?? 'Hotel',
                    'transaction_type' => 'debit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The amount for your hotel booking has been deducted. #'.$vehicle->id,
                    'status'           => 1,
                ]);

            $vehicle->status = 3;
        } elseif ($action == 'process') {
            $vehicle->status = 4;
        } else {
            // Default case, no action (status might not change)
            return redirect()->back()->with('error', 'Invalid status update action.');
        }
    
        // Save the changes
        $vehicle->save();
    
        return redirect()->back()->with('success', 'Hotel Booking status updated successfully!');
    }
    

}

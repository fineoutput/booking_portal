<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxiBooking;
use App\Models\TaxiBooking2;
use App\Models\TransferTaxiOrder;
use App\Models\RemarkTaxiOrder;

use App\adminmodel\Team;
use App\Models\Agent;
use App\Models\State;
use App\Models\City;
use App\Models\Tourist;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\Auth;

class TaxiBookingController extends Controller
{

      
    function customer(Request $request ,$id){

        $data['tourist'] = Tourist::where('booking_id', $id)->where('type','Taxi')->get();

       return view('admin.textbooking.customer', $data);
    }

    function transfercreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'caller_id' => 'required',
            ]);

            $agentCall = new TransferTaxiOrder();
            $agentCall->order_id = $id;
            $agentCall->caller_id = $request->caller_id;
            $agentCall->save();  

            return redirect()->back()->with('success', 'Order Transfer successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = TaxiBooking2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/textbooking/transfercreate',$data);
    }


    function remarkcreate(Request $request,$id) {
        if($request->method()=='POST'){
            $validated = $request->validate([
                'remark' => 'required',
                // 'agentcalls_id' => 'required',
            ]);

            $agentCall = new RemarkTaxiOrder();
            $agentCall->order_id = $id;
            $agentCall->remark = $request->remark;
            $agentCall->caller_id = Auth::id();
            $agentCall->save();  

            return redirect()->back()->with('success', 'Remark Add successfully!');
        }
        $data['states'] = State::all();
        $data['agentCalls'] = TaxiBooking2::where('id',$id)->first();
        // $data['agentCalls'] = AgentCalls::whereNotIn('id', TransferAgentCalls::pluck('agentcalls_id'))->get();
        $data['team'] = Team::where('power',4)->get();
        return view('admin/textbooking/remarkcreate',$data);
    }

    public function viewremark(Request $request,$id)
    {
        $agentCalls = RemarkTaxiOrder::where('order_id',$id)->orderBy('id','DESC')->get();
        return view('admin.textbooking.viewremark', compact('agentCalls'));
    }


    function index(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->where('tour_type','Airport/Railway station')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Airport/Railway station')->get();
        }
        return view('admin/textbooking/index',$data);
    }

    function rejectindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->where('tour_type','Airport/Railway station')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Airport/Railway station')->get();
        }
        return view('admin/textbooking/index',$data);
    }
    function processindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->where('tour_type','Airport/Railway station')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',4)->where('tour_type','Airport/Railway station')->get();
        }
        return view('admin/textbooking/index',$data);
    }

    function acceptindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->where('tour_type','Airport/Railway station')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',3)->where('tour_type','Airport/Railway station')->get();
        }
        return view('admin/textbooking/index',$data);
    }

    function completeindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->where('tour_type','Airport/Railway station')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Airport/Railway station')->get();
        }
        return view('admin/textbooking/index',$data);
    }

    public function updateStatus($id)
    {
        $vehicle = TaxiBooking2::findOrFail($id);
    
        // Check the action from the form
        $action = request()->input('status_action');
    
        if ($action == 'complete') {

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
                    'transaction_type' => 'credit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The refund for your Taxi booking cancellation has been processed. #'.$vehicle->id,
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
                    'transaction_type' => 'debit',
                    'amount'           => $vehicle->fetched_price,
                    'note'             => 'The amount for your Taxi booking has been deducted. #'.$vehicle->id,
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
    
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    function localtourindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->where('tour_type','Local Tour')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Local Tour')->get();
        }

        return view('admin/textbooking/localtour',$data);
    }

    function completelocaltourindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->where('tour_type','Local Tour')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Local Tour')->get();
        }
        return view('admin/textbooking/localtour',$data);
    }

    function processlocaltourindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->where('tour_type','Local Tour')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',4)->where('tour_type','Local Tour')->get();
        }
        return view('admin/textbooking/localtour',$data);
    }

    function acceptlocaltourindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->where('tour_type','Local Tour')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',3)->where('tour_type','Local Tour')->get();
        }
        return view('admin/textbooking/localtour',$data);
    }

    function rejectlocaltourindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->where('tour_type','Local Tour')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Local Tour')->get();
        }
        return view('admin/textbooking/localtour',$data);
    }


    function outstationindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',0)->where('tour_type','Outstation')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',0)->where('tour_type','Outstation')->get();
        }

        return view('admin/textbooking/outstation',$data);
    }

    function rejectoutstationindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',2)->where('tour_type','Outstation')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',2)->where('tour_type','Outstation')->get();
        }
        return view('admin/textbooking/outstation',$data);
    }
    
    function acceptoutstationindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',3)->where('tour_type','Outstation')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',3)->where('tour_type','Outstation')->get();
        }
        return view('admin/textbooking/outstation',$data);
    }

    function processoutstationindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',4)->where('tour_type','Outstation')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',4)->where('tour_type','Outstation')->get();
        }
        return view('admin/textbooking/outstation',$data);
    }

    function completeoutstationindex(){
        $user = Auth::user();
        if($user->power == 4){
            $data['order_id'] = TransferTaxiOrder::where('caller_id', $user->id)->pluck('order_id');
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->whereIn('id',$data['order_id'])->where('status',1)->where('tour_type','Outstation')->get();
        }else{
            $data['agent'] = TaxiBooking2::orderBy('id','DESC')->where('status',1)->where('tour_type','Outstation')->get();
        }
        return view('admin/textbooking/outstation',$data);
    }

}

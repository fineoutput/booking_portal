<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehiclePrice;
use App\Models\Outstation;
use App\Models\RoundTrip;
use App\Models\WildlifeSafari;
use App\Models\Wallet;
use App\Models\State;
use App\Models\City;


class WalletController extends Controller
{
    function rechargewallet() {
        $data['wallet'] = Wallet::orderBy('id','DESC')->where('transaction_type','recharge')->get();

        $data['title'] = 'Recharge';
        return view('admin/wallet/index',$data);
    }

    function index() {
        $data['wallet'] = Wallet::orderBy('id','DESC')->where('transaction_type','refund')
        ->where('status',0)->get();

        $data['title'] = 'Panding';
        return view('admin/wallet/index',$data);
    }

    function accept() {
        $data['wallet'] = Wallet::orderBy('id','DESC')->where('transaction_type','refund')
        ->where('status',1)->get();

        $data['title'] = 'Accept';

        return view('admin/wallet/index',$data);
    }
    function reject() {
        $data['wallet'] = Wallet::orderBy('id','DESC')->where('transaction_type','refund')
        ->where('status',2)->get();

        $data['title'] = 'Reject';

        return view('admin/wallet/index',$data);
    }

    public function updateStatus($id, Request $request)
    {
        // Find the wallet transaction by its ID
        $vehicle = Wallet::findOrFail($id);
        
        // Check the value of 'status_action' and update the status accordingly
        if ($request->status_action == 'complete') {
            $vehicle->status = 1; // Accept the refund (status 1)
        } elseif ($request->status_action == 'cancel') {
            $vehicle->status = 2; // Reject the refund (status 2)
        }
    
        // Save the updated status
        $vehicle->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    


}

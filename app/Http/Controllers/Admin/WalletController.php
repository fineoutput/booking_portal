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
use App\Models\WalletTransactions;

class WalletController extends Controller
{
    function rechargewallet() {
        $data['wallet'] = WalletTransactions::orderBy('id','DESC')->where('transaction_type','credit')->get();

        $data['title'] = 'Recharge';
        return view('admin/wallet/index',$data);
    }

    function index() {
        $data['wallet'] = WalletTransactions::orderBy('id','DESC')->where('transaction_type','debit')
        ->where('status',0)->get();

        $data['title'] = 'Panding';
        return view('admin/wallet/index',$data);
    }

    function accept() {
        $data['wallet'] = WalletTransactions::orderBy('id','DESC')->where('transaction_type','debit')
        ->where('status',1)->get();

        $data['title'] = 'Accept';

        return view('admin/wallet/index',$data);
    }
    function reject() {
        $data['wallet'] = WalletTransactions::orderBy('id','DESC')->where('transaction_type','debit')
        ->where('status',2)->get();

        $data['title'] = 'Reject';

        return view('admin/wallet/index',$data);
    }

   public function updateStatus(Request $request, $id)
    {
        // 1️⃣ Get the transaction from WalletTransactions
        $transaction = WalletTransactions::findOrFail($id);

        $userId = $transaction->user_id;
        $amountToDeduct = $transaction->amount; // Use transaction's amount, not request

        // 2️⃣ Get or create the user's wallet
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $userId],
            ['balance' => 0]
        );

        // 3️⃣ Handle status actions
        if ($request->status_action == 'complete') {

            // Check if balance is sufficient
            if ($wallet->balance < $amountToDeduct) {
                return redirect()->back()->with('error', 'Insufficient wallet balance!');
            }

            // Deduct from wallet
            $wallet->balance -= $amountToDeduct;
            $wallet->save();

            // Update transaction status to complete
            $transaction->status = 1;

        } elseif ($request->status_action == 'cancel') {
            // Mark transaction as canceled
            $transaction->status = 2;
        }

        $transaction->save();

        return redirect()->route('panding.wallet')->with('success', 'Status updated successfully!');
    }


    


}

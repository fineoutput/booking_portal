<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Wallet;
use App\Models\WalletTransactions;

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


    public function updateWallet(Request $request, $userId)
    {
        $request->validate([
            'transaction_type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $user = Agent::findOrFail($userId);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        if ($request->transaction_type == 'credit') {
            $wallet->balance += $request->amount;
             $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'transaction_type' => 'credit',
                    'amount'           => $request->amount,
                    'note'             => 'Admin credited ' . $request->amount . ' in your Wallet',
                    'status'           => 1,
                ]);
        } else { 
             $transaction = WalletTransactions::create([
                    'user_id'          => $user->id,
                    'transaction_type' => 'debit',
                    'amount'           => $request->amount,
                    'note'             => 'Admin debited ' . $request->amount . ' in your Wallet',
                    'status'           => 1,
                ]);
            $wallet->balance -= $request->amount;
        }

        $wallet->save();

        // Optionally: save a log or transaction record here for history

        return redirect()->back()->with('success', 'Wallet updated successfully!');
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
        $agent = Agent::findOrFail($id);

        $agent->approved = ($agent->approved == 0) ? 1 : 0;
        $agent->save();

        if ($agent->approved == 1) {
            $walletExists = Wallet::where('user_id', $agent->id)->exists();

            if (!$walletExists) {
                Wallet::create([
                    'user_id' => $agent->id,
                    'balance' => 0,
                ]);
            }
        }

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

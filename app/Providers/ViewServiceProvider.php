<?php

namespace App\Providers;

use App\Models\Wallet;
use Illuminate\Support\ServiceProvider;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $user_id = Auth::guard('agent')->id();
                  $lastRecharge = WalletTransactions::where('user_id', $user_id)
                ->where('transaction_type', 'credit')
                ->latest('created_at')
                ->first();

                
            $wallet = Wallet::where('user_id', $user_id)
                ->select('balance')
                ->first() ?? null;

            $view->with([
            'lastRecharge' => $lastRecharge,
            'wallet' => $wallet
        ]);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransactions extends Model
{
    use HasFactory;

    protected $table = 'wallet_transactions';
    protected $fillable = [
        'user_id',
        'transaction_type',
        'amount',
        'note',
        'status',
    ];


    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); 
    }

    
    public function user()
    {
        return $this->belongsTo(Agent::class, 'user_id'); 
    }


}

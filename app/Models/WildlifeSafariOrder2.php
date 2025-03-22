<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WildlifeSafariOrder2 extends Model
{
    use HasFactory;
    protected $table = 'wildlife_safari_order_2';
    protected $fillable = [
        'user_id',
        'safari_id',
        'safari_order_id',
        'fetched_price',
        'agent_margin',
        'final_price',
        'salesman_name',
        'salesman_mobile',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

    public function safari()
    {
        return $this->belongsTo(WildlifeSafari::class, 'safari_id'); 
    }

    public function safari_se()
    {
        return $this->belongsTo(WildlifeSafariOrder::class, 'safari_order_id'); 
    }

    public function user()
    {
        return $this->belongsTo(Agent::class, 'user_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function transfer()
    {
        return $this->hasOne(TransferSafariOrder::class, 'order_id', 'id');
    }


}

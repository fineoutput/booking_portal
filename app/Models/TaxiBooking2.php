<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiBooking2 extends Model
{
    use HasFactory;
    protected $table = 'taxi_booking_2';
    protected $fillable = [
        'user_id',
        'taxi_order_id',
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

    public function taxi()
    {
        return $this->belongsTo(TripGuide::class, 'taxi_id'); 
    }

    public function taxi_se()
    {
        return $this->belongsTo(TaxiBooking::class, 'taxi_order_id'); 
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
        return $this->hasOne(TransferTaxiOrder::class, 'order_id', 'id');
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGuideBook2 extends Model
{
    use HasFactory;
    protected $table = 'tripguide_booking_2';
    protected $fillable = [
        'user_id',
        'guide_id',
        'tour_type',
        'guide_order_id',
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

    public function guide()
    {
        return $this->belongsTo(TripGuide::class, 'guide_id'); 
    }

    public function guide_se()
    {
        return $this->belongsTo(TripGuideBook::class, 'guide_order_id'); 
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
        return $this->hasOne(TransferGuideOrder::class, 'order_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking2 extends Model
{
    use HasFactory;
    protected $table = 'hotel_booking_2';
    protected $fillable = [
        'user_id',
        'hotel_id',
        'hotel_order_id',
        'fetched_price',
        'agent_margin',
        'final_price',
        'salesman_name',
        'salesman_mobile',
        'status',
    ];

       public function tourists()
    {
        return $this->hasMany(Tourist::class,'booking_id','id');
    }

    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

    public function safari()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id'); 
    }

    public function hotel_se()
    {
        return $this->belongsTo(HotelBooking::class, 'hotel_order_id'); 
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
        return $this->hasOne(TransferHotelOrder::class, 'order_id', 'id');
    }



}

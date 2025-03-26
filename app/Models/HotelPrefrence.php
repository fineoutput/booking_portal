<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelPrefrence extends Model
{
    use HasFactory;

    protected $table = 'hotel_prefrence';
    protected $fillable = [
        'user_id',
        'hotel_id',
        'booking_id',
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

    public function booking()
    {
        return $this->hasOne(PackageBooking::class,'id','booking_id');
    }
    public function hotels()
    {
        return $this->hasOne(Hotels::class,'id','hotel_id');
    }



}

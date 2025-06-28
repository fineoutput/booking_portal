<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    protected $table = 'hotel_booking';
    protected $fillable = [
        'hotel_id',
        'city_id',
        'check_in_date',
        'check_out_date',
        'no_occupants',
        'user_id',
        'night_count',
        'room_count',
        'cost',
        'status',
    ];

    
    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id'); 
    }

    public function user()
    {
        return $this->belongsTo(Agent::class, 'user_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); 
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCalls extends Model
{
    use HasFactory;
    protected $table = 'hotels_calls';
    protected $fillable = [
        'name',
        'contact_person_name',
        'room_details',
        'cost_of_rooms',
        'phone',
        'state_id',
        'city',
        'date',
        'location',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

    public function transfer()
    {
        return $this->hasOne(TransferHotelCalls::class, 'agentcalls_id', 'id');
    }


    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }
}

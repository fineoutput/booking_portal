<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelPrice extends Model
{
    use HasFactory;

    protected $table = 'hotel_price';
    protected $fillable = [
        'hotel_id',
        'night_cost',
        'start_date',
        'end_date',
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

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); 
    }


}

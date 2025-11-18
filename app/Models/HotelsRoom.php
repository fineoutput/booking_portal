<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelsRoom extends Model
{
    use HasFactory;

    protected $table = 'hotels_rooms';
    protected $fillable = [
        'title',
        'show_front',
        'images',
        'hotel_id',
        'meal_plan',
        'nearby',
        'locality',
        'chains',
        'hotel_amenities',
        'room_amenities',
        'house_rules',
        'description',
    ];

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    
    // Hotel model
    public function prices()
    {
        return $this->hasMany(HotelPrice::class, 'hotel_id');
    }


}

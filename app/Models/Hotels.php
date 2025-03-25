<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'images',
        'state_id',
        'city_id',
        'location',
        'location',
        'hotel_category',
        'package_id',
        'show_front',
        'meal_plan',
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

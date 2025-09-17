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
        'room_id',
        'night_cost',
        'start_date',
        'end_date',
        'room_category',
        'room_cost',
        'meal_plan_breakfast_cost',
        'meal_plan_breakfast_lunch_dinner_cost',
        'meal_plan_all_meals_cost',
        'extra_all_meals_cost',
        'extra_breakfast_cost',
        'extra_breakfast_lunch_dinner_cost',
        'extra_bed_cost',
        'child_all_meals_cost',
        'child_breakfast_cost',
        'child_breakfast_lunch_dinner_cost',
        'child_no_bed_infant_cost',
    ];

    public function prices()
    {
        return $this->hasMany(HotelPrice::class, 'room_id');
    }
    
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

    public function room()
    {
        return $this->belongsTo(HotelsRoom::class, 'room_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); 
    }


}

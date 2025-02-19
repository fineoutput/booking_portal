<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    use HasFactory;

    protected $table = 'package_booking';
    protected $fillable = [
        'user_id',
        'package_id',
        'end_date',
        'start_date',
        'standard_count',
        'premium_count',
        'deluxe_count',
        'super_deluxe_count',
        'luxury_count',
        'nights_count',
        'adults_count',
        'child_with_bed_count',
        'child_no_bed_infant_count',
        'child_no_bed_child_count',
        'meal_plan_only_room_count',
        'meal_plan_breakfast_count',
        'meal_plan_breakfast_lunch_dinner_count',
        'meal_plan_all_meals_count',
        'hatchback_count',
        'sedan_count',
        'economy_suv_count',
        'luxury_suv_count',
        'traveller_mini_count',
        'traveller_big_count',
        'premium_traveller_count',
        'ac_coach_count',
    ];

    
    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); // State's foreign key is 'state_id'
    }

    // A package belongs to a city
    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); // City's foreign key is 'city_id'
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    use HasFactory;

    protected $table = 'package_price';
    protected $fillable = [
        'package_id',
        'hotel_category',
        'category_cost',
        'standard_cost',
        'deluxe_cost',
        'premium_cost',
        'super_deluxe_cost',
        'luxury_cost',
        'nights_cost',
        'adults_cost',
        'child_with_bed_cost',
        'child_no_bed_infant_cost',
        'child_no_bed_child_cost',
        'meal_plan_only_room_cost',
        'meal_plan_breakfast_cost',
        'meal_plan_breakfast_lunch_dinner_cost',
        'meal_plan_all_meals_cost',
        'hatchback_cost',
        'sedan_cost',
        'economy_suv_cost',
        'luxury_suv_cost',
        'traveller_mini_cost',
        'traveller_big_cost',
        'premium_traveller_cost',
        'ac_coach_cost',
        'extra_bed_cost',
        'premium_3_cost',
        'start_date',
        'end_date',
        'display_cost',

        'luxury_sedan_cost',
        'suv_cost',
        'muv_cost',
        'bus_nonac_cost',
    ];

    
    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); // State's foreign key is 'state_id'
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id'); // State's foreign key is 'state_id'
    }

    // A package belongs to a city
    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); // City's foreign key is 'city_id'
    }


}

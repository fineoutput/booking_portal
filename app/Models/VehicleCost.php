<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCost extends Model
{
    use HasFactory;

    protected $table = 'vehicle_cost';
    protected $fillable = [
        'package_id',
        'hatchback_cost',
        'sedan_cost',
        'economy_suv_cost',
        'luxury_sedan_cost',
        'suv_cost',
        'luxury_suv_cost',
        'traveller_mini_cost',
        'traveller_big_cost',
        'premium_traveller_cost',
        'muv_cost',
        'bus_nonac_cost',
        'ac_coach_cost',
       
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

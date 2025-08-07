<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCost extends Model
{
    use HasFactory;

    protected $table = 'location_cost';
    protected $fillable = [
        'package_id',
        'location',
        'vehicle',
        'cost',
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

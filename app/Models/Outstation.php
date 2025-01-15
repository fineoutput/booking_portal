<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outstation extends Model
{
    use HasFactory;
    protected $table = 'outstation';
    protected $fillable = [
        'drop_point',
        'available_km',
        'extra_km_charge',
        'vehicle_type',
        'trip_type',
        'cost',
        'description',
    ];

       
    public function Vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_type');
    }

    public function Route()
    {
        return $this->hasOne(Route::class, 'id', 'trip_type');
    }

}

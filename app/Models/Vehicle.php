<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicle';
    protected $fillable = [
        'name',
        'phone',
        'vehicle_type',
        'description',
        'state',
        'status',
        'image',
        'city',
        'remarks',
    ];

    public function vehiclePrices()
    {
        return $this->hasMany(VehiclePrice::class, 'vehicle_id');
    }

    public function outstation()
    {
        return $this->hasOne(Outstation::class, 'vehicle_type', 'id');
    }


}


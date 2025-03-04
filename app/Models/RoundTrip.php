<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundTrip extends Model
{
    use HasFactory;
    protected $table = 'round_trip';
    protected $fillable = [
        'car_type_id',
        'per_km_charge',
        'description',
        'cost',
        'ip',
        'date',
        'added_by',
        'is_active',
    ];

    
    public function Vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'car_type_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutstationVehiclePrice extends Model
{
    use HasFactory;
    protected $table = 'outstation_vehicleprice';
    protected $fillable = [
        'vehicle_id',
        'outstation_id',
        'price',
        'city',
        'description',
        'type',
        'status',
    ];

    public function local()
    {
        return $this->belongsTo(Airport::class, 'airport_id'); 
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id'); 
    }

}

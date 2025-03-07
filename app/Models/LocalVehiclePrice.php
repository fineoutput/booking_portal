<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalVehiclePrice extends Model
{
    use HasFactory;
    protected $table = 'local_vehicleprice';
    protected $fillable = [
        'vehicle_id',
        'city_id',
        'price',
        'description',
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

    public function city()
    {
        return $this->belongsTo(AdminCity::class, 'city_id'); 
    }


}

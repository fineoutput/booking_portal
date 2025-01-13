<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclePrice extends Model
{
    use HasFactory;
    protected $table = 'vehicleprice';
    protected $fillable = [
        'vehicle_id',
        'price',
        'city',
        'description',
        'type',
        'status',
    ];
}

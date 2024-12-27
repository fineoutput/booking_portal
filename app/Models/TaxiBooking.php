<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiBooking extends Model
{
    use HasFactory;
    protected $table = 'taxi_booking';
    protected $fillable = [
        'location',
        'vehicle_id',
        'trip_type',
        'cost',
        'image',
        'state',
        'city',
        'one_way',
        'description',
    ];
}

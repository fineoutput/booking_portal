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
        'tour_type',
        'id',
        'cost',
        'city_image',
        'state',
        'city',
        'one_way',
        'description',
        'trip',
        'start_date',
        'end_date',
        'end_time',
        'start_time',
        'pickup_address',
        'one_way_location',
        'round_start_location',
        'round_end_location',
    ];
}

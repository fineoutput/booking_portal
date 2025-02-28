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
        'departure_location',
        'destination_location',
        'destination_city',
        'vehicle_id',
        'vehicle_id_1',
        'trip_type',
        'tour_type',
        'cost',
        'city_image',
        'airport_id',
        'state',
        'city',
        'one_way',
        'description',
        'trip',
        'start_date',
        'end_date',
        'end_time',
        'start_time',
        'pickup_date',
        'pickup_date_1',
        'pickup_time',
        'drop_date',
        'drop_time',
        'pickup_address',
        'drop_pickup_address',
        'one_way_location',
        'round_start_location',
        'round_end_location',
        'status',
    ];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
    public function vehicle_1()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id_1');
    }
    public function airport()
    {
        return $this->hasOne(Airport::class, 'id', 'airport_id');
    }
    public function routes()
    {
        return $this->hasOne(Route::class, 'id', 'destination_city');
    }

}

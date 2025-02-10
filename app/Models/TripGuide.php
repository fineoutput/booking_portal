<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGuide extends Model
{
    use HasFactory;
    protected $table = 'trip_guide';
    protected $fillable = [
        'state_id',
        'city_id',
        'location',
        'language',
        'local_guide',
        'out_station_guide',
        'cost',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}

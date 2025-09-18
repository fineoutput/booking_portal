<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGuidePrice extends Model
{
    use HasFactory;
    protected $table = 'trip_guide_price';
    protected $fillable = [
        'trip_id',
        'price_1_to_4',
        'price_5',
        'price_6',
        'price_6_to_10',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

     public function trip()
    {
        return $this->belongsTo(TripGuide::class, 'trip_id', 'id');
    }


    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}

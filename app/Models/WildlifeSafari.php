<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WildlifeSafari extends Model
{
    use HasFactory;
    protected $table = 'wildlife_safari';
    protected $fillable = [
        'state_id',
        'city_id',
        'national_park',
        'date',
        'timings',
        'no_persons',
        'no_adults',
        'no_kids',
        'vehicle',
        'jeep_price',
        'center_price',
        'image',
        'cost',
        'description',
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

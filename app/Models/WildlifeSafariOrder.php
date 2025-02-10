<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WildlifeSafariOrder extends Model
{
    use HasFactory;
    protected $table = 'wildlife_safari_order';
    protected $fillable = [
        'state_id',
        'city_id',
        'safari_id',
        'national_park',
        'date',
        'timings',
        'no_persons',
        'no_adults',
        'no_kids',
        'vehicle',
        'cost',
        'status',
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

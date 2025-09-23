<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafariPrices extends Model
{
    use HasFactory;
    protected $table = 'safari_prices';
    protected $fillable = [
        'safari_id',
        'start_month',
        'end_month',
        'visitor_type',
        'day_type',
        'price_type',
        'price',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }

     public function safari()
    {
        return $this->belongsTo(WildlifeSafari::class, 'safari_id', 'id');
    }


    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}

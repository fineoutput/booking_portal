<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    protected $table = 'airport';
    protected $fillable = [
        'city_id',
        'airport',
        'railway',
        'description',
        'vehichle_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }
    public function languages()
    {
        return $this->belongsTo(Languages::class, 'languages_id'); 
    }
    public function city()
    {
        return $this->belongsTo(AdminCity::class, 'city_id'); 
    }

    // public function cities()
    // {
    //     return $this->belongsTo(City::class, 'city_id');
    // }

}

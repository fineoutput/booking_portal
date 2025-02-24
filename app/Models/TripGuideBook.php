<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGuideBook extends Model
{
    use HasFactory;
    protected $table = 'tripguide_booking';
    protected $fillable = [
        'state_id',
        'tour_guide_id',
        'user_id',
        'location',
        'guide_type',
        'languages_id',
        'cost',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }
    public function languages()
    {
        return $this->belongsTo(Languages::class, 'languages_id'); 
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function user()
    {
        return $this->belongsTo(Agent::class, 'user_id'); 
    }


}

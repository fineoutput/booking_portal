<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCalls extends Model
{
    use HasFactory;
    protected $table = 'package_agent_calls';
    protected $fillable = [
        'name',
        'phone',
        'state_id',
        'city',
        'date',
        'remarks',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }
    // public function state()
    // {
    //     return $this->hasOne(State::class, 'id', 'state');
    // }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }

}


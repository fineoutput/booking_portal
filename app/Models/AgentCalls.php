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

    public function transfer()
    {
        return $this->hasOne(TransferAgentCalls::class, 'agentcalls_id', 'id');
    }


    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }

}


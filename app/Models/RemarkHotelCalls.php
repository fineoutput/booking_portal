<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\adminmodel\Team;
class RemarkHotelCalls extends Model
{
    use HasFactory;
    protected $table = 'remark_hotelcalls';
    protected $fillable = [
        'caller_id',
        'remark',
        'agentcalls_id',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function Package()
    {
        return $this->hasMany(Package::class, 'city_id', 'id');
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'caller_id');
    }

    public function transfer()
    {
        return $this->hasOne(AgentCalls::class, 'id', 'agentcalls_id');
    }
    
}


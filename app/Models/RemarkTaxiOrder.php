<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\adminmodel\Team;
class RemarkTaxiOrder extends Model
{
    use HasFactory;
    protected $table = 'remark_taxi_order';
    protected $fillable = [
        'caller_id',
        'remark',
        'order_id',
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
        return $this->hasOne(AgentCalls::class, 'id', 'order_id');
    }
    
}


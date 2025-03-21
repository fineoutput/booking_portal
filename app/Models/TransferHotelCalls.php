<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\adminmodel\Team;
class TransferHotelCalls extends Model
{
    use HasFactory;
    protected $table = 'transfer_hotelcalls';
    protected $fillable = [
        'caller_id',
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


    
}


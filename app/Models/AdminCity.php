<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCity extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $fillable = [
        'city_name',
        'state_id',
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
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;
    protected $table = 'home_slider';
    protected $fillable = [
        'type',
        'image',
        'Appimage',
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


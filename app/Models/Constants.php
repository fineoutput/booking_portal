<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constants extends Model
{
    use HasFactory;
    protected $table = 'constants';
    protected $fillable = [
        'agent_fees',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function Package()
    {
        return $this->hasMany(Package::class, 'state_id', 'id');
    }
}

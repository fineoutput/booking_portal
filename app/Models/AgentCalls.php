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
        'state',
        'city',
        'remarks',
    ];
}


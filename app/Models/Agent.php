<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $table = 'agent';
    protected $fillable = [
        'name',
        'business_name',
        'state',
        'city',
        'aadhar_image',
        'pan_image',
        'GST_number',
        'email',
        'password',
        'logo',
        'registration_charge',
    ];
}

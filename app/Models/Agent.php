<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Notifications\Notifiable;
class Agent extends Authenticatable
{
    use Notifiable , HasApiTokens;
    use HasFactory;
    protected $table = 'agent';
    protected $fillable = [
        'name',
        'business_name',
        'auth',
        'state',
        'city',
        'aadhar_image',
        'aadhar_image_back',
        'number',
        'pan_image',
        'GST_number',
        'email',
        'password',
        'logo',
        'registration_charge',
        'approved',
    ];
}

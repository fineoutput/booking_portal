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
        'state_id',
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
        'set_limit_amount',
        'negative_limit_amount',
        'status',
        'fcm_token',
    ];

    public function state()
{
    return $this->belongsTo(State::class);
}
    // public function state()
    // {
    //     return $this->hasOne(State::class, 'id', 'state');
    // }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }

}

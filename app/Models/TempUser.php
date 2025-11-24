<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Notifications\Notifiable;

class TempUser extends Model
{
    use HasFactory;

    protected $table = 'temp_users';

    protected $fillable = [
        'number',
        'email',
        'name',
        'password',
        'business_name',
        'state',
        'city',
        'registration_charge',
        'GST_number',
        'aadhar_image',
        'aadhar_image_back',
        'logo',
        'pan_image',
        'razorpay_order_id'
    ];

    protected $hidden = [
        'password'
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

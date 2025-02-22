<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $table = 'tourist';
    protected $fillable = [
        'user_id',
        'package_id',
        'booking_id',
        'name',
        'age',
        'phone',
        'aadhar_front',
        'aadhar_back',
        'additional_info',
        'status',
    ];

    
    // public function state()
    // {
    //     return $this->belongsTo(State::class);
    // }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); // State's foreign key is 'state_id'
    }

    // A package belongs to a city
    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id'); // City's foreign key is 'city_id'
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id'); // State's foreign key is 'state_id'
    }

   
    public function packagetemp()
    {
        return $this->belongsTo(PackageBookingTemp::class,'id' ,'package_temp_id'); 
    }
    
    public function user()
    {
        return $this->belongsTo(Agent::class, 'user_id'); 
    }


}

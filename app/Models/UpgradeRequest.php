<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpgradeRequest extends Model
{
    use HasFactory;

    protected $table = 'upgrade_request';
    protected $fillable = [
        'user_id',
        'booking_id',
        'upgrade_details',
        'notes',
        'type',
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

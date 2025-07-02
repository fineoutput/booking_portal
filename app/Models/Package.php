<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'package';
    protected $fillable = [
        'package_name',
        'state_id',
        'pdf',
        'city_id',
        'image',
        'service_charge',
        'video',
        'text_description',
        'text_description_2',
        'show_front',
        'holidaypackage',
        'travelpackage',
        'night_count',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotels::class, 'package_id', 'id');
    }
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

    public function packagePrices()
{
    return $this->hasMany(PackagePrice::class);
}



}

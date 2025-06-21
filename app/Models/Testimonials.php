<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    use HasFactory;
    protected $table = 'testimonials';
    protected $fillable = [
        'type',
        'title',
        'description',
        'image',
        'status',
    ];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
    public function vehicle_1()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id_1');
    }
    public function airport()
    {
        return $this->hasOne(Airport::class, 'id', 'airport_id');
    }
    public function routes()
    {
        return $this->hasOne(Route::class, 'id', 'destination_city');
    }
    public function admincity()
    {
        return $this->hasOne(AdminCity::class, 'id', 'city_id');
    }

}

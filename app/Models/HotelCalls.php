<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCalls extends Model
{
    use HasFactory;
    protected $table = 'hotels_calls';
    protected $fillable = [
        'name',
        'contact_person_name',
        'room_details',
        'cost_of_rooms',
        'phone',
        'state',
        'city',
        'location',
    ];
}

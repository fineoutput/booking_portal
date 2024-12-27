<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = [
        'start_date',
        'end_date',
        'adults_no',
        'kids_with_bed',
        'kids_without_bed',
        'extra_bed',
        'hotel_preference',
        'room_preference',
        'meal_plan',
        'vehicle',
        'booking_source',
        'add_travel_insurance',
        'special_remarks',
    ];
}

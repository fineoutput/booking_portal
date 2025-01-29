<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifyUser extends Model
{
    use HasFactory;

    protected $table = 'unverify_user';

    protected $fillable = [
        'number_verify', 
        'name',
        'business_name',
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
    ];
    // protected $hidden = [
    //     'password',
    //     'id',
    // ];

    // Optionally, you can define casts for certain fields (e.g., dates or JSON fields)
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}


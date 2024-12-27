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
        'city_id',
        'image',
        'video',
        'text_description',
        'text_description_2',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'images',
        'location',
        'hotel_category',
        'package_id',
    ];

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }


}

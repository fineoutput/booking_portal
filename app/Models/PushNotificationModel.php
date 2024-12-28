<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotificationModel extends Model
{

    use HasFactory;
    protected $table = 'push_notifications';
    protected $fillable = [
        'title', 
        'description', 
        'image', 
        'ip', 
        'added_by', 
        'is_active', 
        'date'
    ];
}

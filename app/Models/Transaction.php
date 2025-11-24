<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
     protected $table = 'transaction';
    protected $fillable = [
        'order_id',
        'payment_id',
        'status',
        'amount',
        'agent_id',
    ];
}

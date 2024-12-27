<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCalls extends Model
{
    use HasFactory;
    protected $table = 'customer_calls';
    protected $fillable = [
        'name',
        'state',
        'city',
        'phone',
        'package_enquiry_details',
        'interest_details',
        'mark_lead',
    ];
}

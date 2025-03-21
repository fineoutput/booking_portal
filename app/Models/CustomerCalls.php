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
        'state_id',
        'city',
        'date',
        'phone',
        'package_enquiry_details',
        'interest_details',
        'mark_lead',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id'); 
    }
    
    public function transfer()
    {
        return $this->hasOne(TransferCustomerCalls::class, 'agentcalls_id', 'id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }
    
}

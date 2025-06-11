<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = [
        'start_date',
        'service_type',
        'monthly_fee',
        'billing_cycle',
        'billing_months',
    ];
}

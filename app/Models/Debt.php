<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    //
    protected $fillable = [
        'project_id',
        'debt_code',
        'amount',
        'debt_type',
        'warranty_id',
        'device_payment_id',
        'service_id',
        'status',
        'note',
        'due_date'
    ];
    protected $dates = ['due_date'];


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }

    public function devicePayment()
    {
        return $this->belongsTo(DevicePayment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

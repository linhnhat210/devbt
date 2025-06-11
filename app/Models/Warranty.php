<?php

namespace App\Models;

use App\Models\User;
use App\Models\Device;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'warranties';

    protected $fillable = [
        'code',
        'imei',
        'device_id',
        'start_date',
        'expired_at',
        'warranty_user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'error_description',
        'note',
        'status',
    ];

    protected $dates = [
        'expired_at',
        'start_date',
        'created_at',
        'updated_at',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function warrantyUser()
    {
        return $this->belongsTo(User::class, 'warranty_user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

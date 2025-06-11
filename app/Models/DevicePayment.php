<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePayment extends Model
{
    //
    protected $table = "device_payments";

    protected $fillable = [
        'start_date',
        'note',
        'attachment',
    ];
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

}

<?php

namespace App\Models;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    // Quan hệ với Device
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}

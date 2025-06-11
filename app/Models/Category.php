<?php

namespace App\Models;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    //
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'code',
        'internal_price',
        'warranty_period',
        'description',
    ];
    // Quan hệ với Device
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}

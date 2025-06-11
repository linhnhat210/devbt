<?php

namespace App\Models;

use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesUnit extends Model
{
    //
    use HasFactory;

    protected $table = 'sales_units';

    protected $fillable = [
        'name',
        'description',
    ];
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}

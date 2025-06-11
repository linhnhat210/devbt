<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Category;
use App\Models\SalesUnit;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'imei',
        'project_id',
        'name',
        'category_id',
        'warehouse_id',
        'sales_unit_id',
        'serial',
        'manufactured_at',
        'expired_at',
    ];

    // Mối quan hệ
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function salesUnit()
    {
        return $this->belongsTo(SalesUnit::class);
    }
    public function warranties()
    {
        return $this->hasMany(Warranty::class);
    }
}
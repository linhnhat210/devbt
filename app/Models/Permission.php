<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    // Nhiều role có permission này
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}

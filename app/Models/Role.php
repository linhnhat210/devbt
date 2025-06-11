<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    // Nhiều user có role này
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    // Role có nhiều quyền
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}

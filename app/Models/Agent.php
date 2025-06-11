<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'tax_code',
        'phone',
        'email',
        'contact_person',
    ];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

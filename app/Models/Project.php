<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agent;
use App\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'sales_user_id',
        'accountant_user_id',
        'address',
        'warranty_start_date',
        'status',
        'agent_id',
    ];

    // Quan hệ với User (kinh doanh phụ trách)
    public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }
    // Quan hệ với User ( Kế toán)
    public function accountant()
    {
        return $this->belongsTo(User::class, 'accountant_user_id');
    }


    // Quan hệ với Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
    // Quan hệ với Device
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}

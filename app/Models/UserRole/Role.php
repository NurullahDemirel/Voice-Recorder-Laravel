<?php

namespace App\Models\UserRole;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_roles','role_id');
    }
}

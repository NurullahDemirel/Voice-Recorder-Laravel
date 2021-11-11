<?php

namespace App\Models;

use App\Models\Image\Image;
use App\Models\User\UserProfile;
use App\Models\UserDetail\UserDetail;
use App\Models\UserPost\Post;
use App\Models\UserRole\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(UserDetail::class,'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles','user_id');
    }

    public function profileImage()
    {
        return $this->hasOne(UserProfile::class,'user_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }


    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->roles()->where('name','Admin')->exists();
    }
}

<?php

namespace App\Models\User;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function imageable()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}

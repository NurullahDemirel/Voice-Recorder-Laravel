<?php

namespace App\Models\Post;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCoverImage extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}

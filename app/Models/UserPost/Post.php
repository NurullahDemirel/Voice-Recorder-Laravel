<?php

namespace App\Models\UserPost;

use App\Models\Comment\Comment;
use App\Models\Image\Image;
use App\Models\Tag\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Post extends Model implements Auditable
{
    use HasFactory,\OwenIt\Auditing\Auditable;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
    public function comments()
    {
        return $this->morphToMany(Comment::class,'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
}

<?php

namespace App\Models\Video;

use App\Models\Comment\Comment;
use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function comments()
    {
        return $this->morphToMany(Comment::class,'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Video::class,'taggable');
    }
}

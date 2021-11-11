<?php

namespace App\Models\Reviewer;

use App\Models\Activity\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function activity()
    {
        return $this->hasManyThrough(Activity::class,User::class,
            'reviewer_id','user_id',
                    'id','id');
    }
}

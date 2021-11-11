<?php


namespace App\Http\Transforms;


use App\Models\User;
use App\Models\UserDetail\UserDetail;
use App\Transformers\User\UserDetailTransformer;
use League\Fractal\TransformerAbstract;

class UserTransform extends TransformerAbstract
{
    protected $availableIncludes = ['posts','detail'];

    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'posts_count'=>$user->posts_count
        ];
    }

    public function includePosts(User $user)
    {
        $posts = $user->posts;
        return $this->collection($posts, new PostTransformer());
    }

    public function includeDetail(User $user)
    {
        $detail= $user->detail;
        return $this->item($detail,new UserDetailTransformer());
    }
}

<?php

namespace App\Transformers;

use App\Http\Transforms\PostTransformer;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class TransformerUser extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'posts'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'=>$user->id,
            'name'=>$user->name
        ];
    }

    public function includePosts(User $user)
    {
        return $this->collection($user->posts,new PostTransformer());
    }
}

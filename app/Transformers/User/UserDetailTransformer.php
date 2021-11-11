<?php

namespace App\Transformers\User;

use App\Models\UserDetail\UserDetail;
use League\Fractal\TransformerAbstract;

class UserDetailTransformer extends TransformerAbstract
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
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(UserDetail $userDetail = null)
    {
        if(is_null($userDetail)){
            return [];
        }
        else{
            return [
                'id' => $userDetail->id,
                'phone' => $userDetail->phone,
                'address' => $userDetail->address,
            ];
        }
    }
}

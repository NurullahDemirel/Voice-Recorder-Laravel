<?php

namespace App\Models\Traits;

use App\Models\SubPermission;

trait PermissionCheckTrait
{


//
//    public function check($permissionName, $crud = SubPermission::OP_READ)
//    {
//        $permisson = Permission::whereName($permissionName)->first();
//
//        if (!$permisson) {
//            return false;
//        }
//
//        return $permission->permissionSub()->where($crud)->exists();
//
//    }
}

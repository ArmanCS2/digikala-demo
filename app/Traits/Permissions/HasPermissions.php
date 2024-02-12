<?php

namespace App\Traits\Permissions;

trait HasPermissions{


    public function hasPermission($permission){
        return (bool) $this->permissions()->where('name',$permission->name)->count();
    }

    public function hasPermissionTo($permission){
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }


    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if ($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionName($permissionName){
        return (bool) $this->permissions()->where('name',$permissionName)->count();
    }

    public function hasRole(...$roles){
        foreach ($roles as $role){
            if ($this->roles->contains('name',$role)){
                return true;
            }
        }
        return false;
    }
}

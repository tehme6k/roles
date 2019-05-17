<?php

namespace  App\Permissions;

use App\{Role, Permission};
use Illuminate\Support\Arr;

trait HasPermissionsTrait
{
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getPermissions(Arr::flatten($permissions));

        if($permissions === null){
            return $this;
        }

        $this->permissions()->saveMany($permissions);

        return $this;
    }

    public function withdrawPermissionsTo(...$permissions)
    {
        $permissions = $this->getPermissions(Arr::flatten($permissions));

        $this->permissions()->detach($permissions);

        return $this;
    }

    public function updatePermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionsTo($permissions);
    }

    public function hasRole(...$roles)
    {
        foreach($roles as $role){
            if($this->roles->contains('name', $role)){
                return true;
            }
        }

        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    protected function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role) {
            if($this->roles->contains($role)){
                return true;
            }
        }
    }

    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    protected  function getPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    public function  roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }
}
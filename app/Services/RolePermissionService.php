<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionService
{
    public function index()
    {
        return Role::with('permissions')->orderBy('id')->get();
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getPermissions()
    {
        return Permission::all();
    }

}

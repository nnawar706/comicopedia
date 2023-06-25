<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $role = Role::create([
            'name'       => $request->role,
            'guard_name' => 'admin'
        ]);

        $role->syncPermissions($request->permissions);

        notifyAdmins(1, 'A new role has been created.', 'role', 0, 'success');
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);

        $role->syncPermissions($request->permissions);

        notifyAdmins($id, 'Your permissions have been updated.', 'permission', 0, 'warning');
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            'Role-list',
            'Role-create/update',
            'Role-delete',
            'User-list',
            'User-create/update',
            'User-delete',
            'Product-list',
            'Product-create/update',
            'Product-delete',
            'Order-list',
            'Order-update',
            'Order-delete',
            'Order-status',
            'Admin-list',
            'Admin-create/update',
            'Admin-delete',
            'Admin-role',
            'Permission-list',
        ];

        foreach ($permission as $value) 
        {
            Permission::create([
                'name' => $value,
                'guard_name' => 'admin'
            ]);
        }

        $role = ['Super admin', 'Admin', 'Manager'];

        foreach ($role as $value) 
        {
            $role = Role::create([
                'name' => $value,
                'guard_name' => 'admin'
            ]);

            if ($value == 'Super admin') 
            {
                $user = Admin::where('email', 'admin@admin.com')->first();
                $user->assignRole($role);
                $role->givePermissionTo(Permission::all());
            }
        }
    }
}

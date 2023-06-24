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
            'access role list',
            'add role',
            'delete role',
            'assign role to user',
            'access permission list',
            'assign permissions to role',
            'access website information',
            'update website information',
            'access banner list',
            'add banner',
            'update banner',
            'delete banner',
            'access user list',
            'export user',
            'access user information',
            'add user',
            'update user',
            'assign role to user',
            'activate/deactivate user',
            'delete user',
            'access customer list',
            'export customer',
            'access customer information',
            'access series list',
            'export series',
            'add series',
            'import series',
            'update series',
            'delete series',
            'access series report',
            'access volume list',
            'export volume',
            'add volume',
            'import volume',
            'update volume',
            'delete volume',
            'access volume report',
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

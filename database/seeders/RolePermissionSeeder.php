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
            'role list','add role','delete role','assign role to user','permission list','assign permissions to role',
            'website information','update website information','general setting','update general setting',
            'banner list','add banner','update banner','delete banner',
            'user list','export user','user information','add user','update user','assign role to user','activate/deactivate user','delete user',
            'customer list','export customer','customer information',
            'genre list','reshuffle genre',
            'series list','export series','add series','import series','update series','delete series','series report',
            'volume list','export volume','add volume','import volume','update volume','delete volume','volume report',
            'promo-code list','add promo-code','update promo-code','delete promo-code',
            'order list','export order',
            'pending order list','update order status',
            'order status list'
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

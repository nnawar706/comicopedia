<?php

namespace App\Services;

use App\Models\Admin;
use App\Notifications\AdminRegistrationNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminService
{

    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getInfo($id)
    {
        return $this->admin->newQuery()->with('roles.permissions')->findOrFail($id);
    }

    public function changeStatus($id)
    {
        $admin = $this->admin->newQuery()->find($id);

        if($admin->is_active ==1)
        {
            $admin->is_active = 0;
        }
        else{
            $admin->is_active = 1;
        }
        $admin->save();
    }

    public function createAdmin(Request $request)
    {

        $admin = $this->admin->newQuery()->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'contact'   => $request->contact,
            'password'  => bcrypt('123456')
        ]);

        $admin->assignRole($request->role_id);

        saveFile($request->file('image'), 'uploads/admins/', $admin, 'profile_photo_path');

        $data = array(
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => '123456'
        );

        $admin->notify(new AdminRegistrationNotification($data));
    }
}

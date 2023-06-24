<?php

namespace App\Services;

use App\Models\Admin;
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
}

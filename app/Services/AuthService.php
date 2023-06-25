<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthService{

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function login($credentials)
    {
        if(auth()->guard('admin')->attempt($credentials))
        {

            return redirect()->route('admin-dashboard');
        }
        else {
            return redirect()->route('login-form')->with('message','These credentials do not match our records.');
        }
    }

    public function getPermissionData()
    {
        $admin = $this->admin->newQuery()->find(auth()->guard('admin')->user()->id);

        $role = $admin->getRoleNames()->first();

        return Role::with('permissions')->where('name' , $admin->getRoleNames()->first())->first();
    }

    public function updateInfo(Request $request)
    {
        $this->admin->newQuery()->find(auth()->guard('admin')->user()->id)
        ->update([
            'email' => $request->email,
            'name' => $request->name,
            'contact' => $request->contact,
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $admin = $this->admin->newQuery()->find(auth()->guard('admin')->user()->id);

        if($admin->profile_photo_path != null)
        {
            deleteFile($admin->profile_photo_path);
        }
        saveFile($request->file('image'), '/uploads/admins/', $admin, 'profile_photo_path');
    }

    public function matchPassword(Request $request)
    {
        if(!Hash::check($request->current_password, auth()->guard('admin')->user()->password)) {
            return false;
        }
        return true;
    }

    public function updatePassword(Request $request)
    {
        $this->admin->newQuery()->find(auth()->guard('admin')->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);
    }
}

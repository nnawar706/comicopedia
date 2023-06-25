<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\AuthService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ChangeInfoRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $service1;

    public function __construct(AuthService $service1)
    {
        $this->service1 = $service1;
    }

    public function loginForm()
    {
        return view('admin.pages.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email','password']);

        return $this->service1->login($credentials);
    }

    public function dashboard()
    {
        $data = array(
            'notifications' => auth()->guard('admin')->user()->notifications
        );

        return view('admin.pages.dashboard')->with('data', $data);
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function getPermissions()
    {
        $data = $this->service1->getPermissionData();

        return view('admin.pages.permissions')->with('data', $data);
    }

    public function changeInfo(ChangeInfoRequest $request)
    {
        $this->service1->updateInfo($request);

        return redirect()->back()->with('message', 'Profile information is updated successfully.');
    }

    public function changePhoto(ImageRequest $request)
    {
        $this->service1->updatePhoto($request);

        return redirect()->back()->with('message', 'Profile photo is updated successfully.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if(!$this->service1->matchPassword($request))
        {
            return redirect()->back()->with('message', 'The current password does not match.');
        }

        $this->service1->updatePassword($request);

        Auth::logout();

        return redirect()->route('login-form')->with('message','You need to login again.');

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login-form')->with('message','You have logged out.');
    }
}

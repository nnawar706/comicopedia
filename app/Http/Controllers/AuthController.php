<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ChangeInfoRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function loginForm()
    {
        return view('admin.pages.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email','password']);

        return $this->service->login($credentials);
    }

    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function getPermissions()
    {
        $data = $this->service->getPermissionData();

        return view('admin.pages.permissions')->with('data', $data);
    }

    public function changeInfo(ChangeInfoRequest $request)
    {
        $this->service->updateInfo($request);

        return redirect()->back()->with('message', 'Profile information is updated successfully.');
    }

    public function changePhoto(ImageRequest $request)
    {
        $this->service->updatePhoto($request);

        return redirect()->back()->with('message', 'Profile photo is updated successfully.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if(!$this->service->matchPassword($request))
        {
            return redirect()->back()->with('message', 'The current password does not match.');
        }

        $this->service->updatePassword($request);

        Auth::logout();

        return redirect()->route('login-form')->with('message','You need to login again.');

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login-form')->with('message','You have logged out.');
    }
}

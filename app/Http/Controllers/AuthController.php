<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login-form')->with('message','You have logged out.');
    }
}
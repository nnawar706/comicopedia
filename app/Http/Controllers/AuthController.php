<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email','password']);

        return $this->service->login($credentials);
    }
}
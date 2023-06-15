<?php

namespace App\Services;

use Illuminate\Http\Request;

class AuthService{

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
}

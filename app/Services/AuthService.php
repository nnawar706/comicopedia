<?php

namespace App\Services;

use Illuminate\Http\Request;

class AuthService{

    public function login($credentials)
    {
        if(auth()->guard('admin')->attempt($credentials))
        {
//            $user = auth()->guard('admin')->user();

            $data = array(
//                'user' => $user
            );

            return redirect()->route('admin-dashboard')->with('data',$data);
        }

        else {
            return redirect()->route('login-form')->with('message','These credentials do not match our records.');
        }
    }
}

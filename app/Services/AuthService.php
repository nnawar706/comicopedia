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
            // return response()->json(auth()->guard('admin')->user());
        }

        else {
            return redirect()->route('login-form')->withErrors(['error' => 'Invalid credentials']);
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Request;

class AuthService{

    public function login($credentials)
    {
        if(auth()->guard('admin')->attempt($credentials))
        {
            $user = auth()->guard('admin')->user();

            return redirect()->route('admin-dashboard');
            // return response()->json(auth()->guard('admin')->user());
        }

        else {
            return response()->json($credentials);
        }
    }
}
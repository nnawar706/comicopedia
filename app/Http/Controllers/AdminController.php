<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createView()
    {
        return view('admins.pages.create-admin');
    }
}

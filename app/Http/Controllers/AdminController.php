<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{

    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function createView()
    {
        return view('admin.pages.create-admin');
    }

    public function getAll()
    {
        return view('admin.pages.admins');
    }

    public function read($id)
    {
        $user = $this->service->getInfo($id);

        $permissions = Permission::all();

        $data = array(
            'user' => $user,
            'permissions' => $permissions
        );

        // return response()->json(array('data' => $data));
        return view('admin.pages.admin-read')->with('data', $data);
    }

    public function updateStatus($id)
    {
        $this->service->changeStatus($id);

        return redirect()->back();
    }
}


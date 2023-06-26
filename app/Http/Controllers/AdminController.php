<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\ImageRequest;
use App\Services\AdminService;
use App\Services\RolePermissionService;

class AdminController extends Controller
{

    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function createView()
    {
        $roles = (new RolePermissionService)->getRoles();

        return view('admin.pages.create-admin')->with('data', $roles);
    }

    public function getAll()
    {
        return view('admin.pages.admins');
    }

    public function read($id)
    {
        $data = array(
            'user' => $this->service->getInfo($id),
            'permissions' => (new RolePermissionService)->getPermissions()
        );

        return view('admin.pages.admin-read')->with('data', $data);
    }

    public function store(AdminCreateRequest $request1, ImageRequest $request2)
    {
        $this->service->createAdmin($request1);

        return redirect()->route('create-admin-view')->with('message', 'A new user has been created successfully.');
    }

    public function updateStatus($id)
    {
        $this->service->changeStatus($id);

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->service->destroy($id);
        return redirect()->back();
    }
}


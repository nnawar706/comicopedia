<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\RolePermissionService;

class RolePermissionController extends Controller
{
    private $service;

    public function __construct(RolePermissionService $service)
    {
        $this->service = $service;
    }

    public function getRoles()
    {
        $data = array(
            'roles'       => $this->service->index(),
            'permissions' => $this->service->getPermissions()
        );

        // return response()->json(['data' => $data]);

        return view('admin.pages.role-permission')->with('data', $data);
    }

    public function updateRole(RoleUpdateRequest $request, $id)
    {
        $this->service->updateRole($request, $id);

        return redirect()->route('role-list')->with('message','Permissions have been updated successfully.');
    }

    public function createView()
    {
        $data = $this->service->getPermissions();

        return view('admin.pages.create-role')->with('data', $data);
    }

    public function store(RoleStoreRequest $request)
    {
        $this->service->store($request);

        redirect()->redirect()->route('create-role-view')->with('message', 'A new role has been created successfully.');
    }
}

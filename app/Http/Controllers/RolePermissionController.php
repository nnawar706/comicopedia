<?php

namespace App\Http\Controllers;

use App\Services\RolePermissionService;
use Illuminate\Http\Request;

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

    public function updateRole(Request $request)
    {
        return response()->json($request);
    }

    public function createView()
    {
        $data = $this->service->getPermissions();

        return view('admin.pages.create-role')->with('data', $data);
    }
}

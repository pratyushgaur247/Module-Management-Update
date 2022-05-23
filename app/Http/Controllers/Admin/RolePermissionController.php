<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{RolesAndPermissionRequest};
use Spatie\Permission\Models\Role;
use DB;
use App\Services\Admin\RoleAndPermissionServices;
class RolePermissionController extends Controller
{
    protected $RoleAndPermissionServices;
    public function __construct(RoleAndPermissionServices $RoleAndPermissionServices)
    {
       $this->middleware('permission:role-section');
       $this->middleware('permission:role-index', ['only'=>['index']]);   
       $this->middleware('permission:role-create', ['only'=>['create','store']]);
       $this->middleware('permission:role-edit', ['only'=>['edit', 'update']]);
       $this->RoleAndPermissionServices  = $RoleAndPermissionServices;
    }

    public function index()
    {
        $roles = $this->RoleAndPermissionServices->rolePermissionIndex();
        return view('dashboard.admin.role.index',compact('roles'));
    }

    public function create(Role $role)
    {
        $allPermission = $this->RoleAndPermissionServices->getAllPermission();
        return view('dashboard.admin.role.create', compact('role','allPermission'));
    }

    public function store(RolesAndPermissionRequest $request)
    {
        $this->RoleAndPermissionServices->storeRolesAndPermission($request);
        session()->flash('success',__('roleInserted'));
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $result = $this->RoleAndPermissionServices->editRolesAndPermission($id);
        $role = $result['role'];
        $allPermission = $result['allPermission'];
        $rolePermissions = $result['allPermission'];
        if($role == ''){
            return view('error.404');
        }
        return view('dashboard.admin.role.create', compact('role','allPermission','rolePermissions'));
    }

    public function update(RolesAndPermissionRequest $request, $id)
    {
        $this->RoleAndPermissionServices->updateRolesAndPermission($request, $id);
        session()->flash('success',__('roleUpdated'));
        return redirect()->route('role.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{RolesAndPermissionRequest};
use Spatie\Permission\Models\Role;
use DB;
use App\Services\AdminServices;
class RolePermissionController extends Controller
{
    protected $adminServices;
    public function __construct(AdminServices $adminServices)
    {
       $this->middleware('permission:role-section');
       $this->middleware('permission:role-index', ['only'=>['index']]);   
       $this->middleware('permission:role-create', ['only'=>['create','store']]);
       $this->middleware('permission:role-edit', ['only'=>['edit', 'update']]);
       $this->adminServices  = $adminServices;
    }

    public function index()
    {
        $roles = $this->adminServices->rolePermissionIndex();
        return view('dashboard.admin.role.index',compact('roles'));
    }

    public function create(Role $role)
    {
        $allPermission = $this->adminServices->getAllPermission();
        return view('dashboard.admin.role.create', compact('role','allPermission'));
    }

    public function store(RolesAndPermissionRequest $request)
    {
        $this->adminServices->storeRolesAndPermission($request);
        session()->flash('success','Role Inserted Successfully!');
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $result = $this->adminServices->editRolesAndPermission($id);
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
        $this->adminServices->updateRolesAndPermission($request, $id);
        session()->flash('success','Role Updated Successfully!');
        return redirect()->route('role.index');
    }

}

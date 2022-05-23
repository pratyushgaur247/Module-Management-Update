<?php
/*
    16.12.2019
    RolesService.php
*/

namespace App\Services\Admin;
use Hash;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{User};

class RoleAndPermissionServices{
    
    public function rolePermissionIndex()
    {
        return Role::with('permissions')->paginate(5);
    }
    public function getAllPermission()
    {
        return Permission::where('guard_name','web')->get();
    }
    public function storeRolesAndPermission($request)
    {
        $role = Role::create(['name' => $request['name'],'guard_name'=>'web']);
        $role->givePermissionTo($request->input('permission'));
    }
    public function editRolesAndPermission($id)
    {
        $role = Role::with('permissions')->find($id);
        $allPermission = Permission::get();
        $rolePermissions = \DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return array('role'=>$role,'allPermission'=>$allPermission,'rolePermissions'=>$rolePermissions);
    }
    public function updateRolesAndPermission($request,$id){
        $role = Role::find($id);
        $permissions =  \DB::table('role_has_permissions')->where('role_id',$id);
        if($permissions != null ){
            $role->syncPermissions([]);
        }
        if($request['permission'] != null ){
            $role->givePermissionTo($request->input('permission'));
        }
    }
}
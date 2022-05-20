<?php
/*
    16.12.2019
    RolesService.php
*/

namespace App\Services;
use Hash;
use Auth;
use App\Models\{Admin,User};
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminServices{

    public function __construct(){

    }
    
    public function getAdminDashboard()
    {
        $users = User::get();
        $businessOwners = $users->where('menuroles', 'user')->count();
        $businessOwnersActive = $users->where('menuroles', 'user')->where('status', '1')->count();
        return array('businessOwners'=>$businessOwners,'businessOwnersActive'=>$businessOwnersActive);
    }

    public function getAdminUserIndex($request)
    {
        $userModal = new User;
        return $userModal->getAdminUserIndex($request);
    }
    public function getRolesName()
    {
        return $roles = Role::select('name')->where('guard_name','!=','admin')->get();
    }
    public function storeUser($request)
    {
        $user = new User;
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->status = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request['role']);
    }
    function getUserById($id){
        return User::find($id);
    }
    function getUserEdit($id){
        $user = User::with('roles')->find($id);
        $roles = Role::select('name')->where('guard_name','!=','admin')->get();
        return array('user'=>$user,'roles'=>$roles);
    }
    public function getUserUpdate($request,$id)
    {
        $user = User::with('roles')->find($id);
        $user->name = $request->name;
        // $user->email = $request->email;
        $user->update();
        if ( $user['roles'] != '' && $user['roles'][0]['name'] != $request->role ) {
            $user->removeRole($user['roles'][0]['name']);
            $user->assignRole($request->role);
        }
    }
    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        if($user){
            $user->delete();
            return true;
        }else{
            return false;
        }
    }
    public function changeStatus($id)
    {
        $user = $this->getUserById($id);
        if($user->status == '1') {
            $user->status = '0';
            $user->update();
            return 0;
        } else {
            $user->status = '1';
            $user->update();
            return 1;
        }
    }
    // user controller manage
    // ***** roles and permission controller manage ****//
    
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
    public function changePassword($request)
    {
        //dd($request->all());
        $user = Admin::find(auth::id());
        $check = Hash::check($request->old_password, $user->password);
        if($check){
            $user->password = Hash::make($request->password);
            $user->update();
            return true;
        }else{
            return false;
        }
    }
    // ***** roles and permission controller manage ****//
    
}
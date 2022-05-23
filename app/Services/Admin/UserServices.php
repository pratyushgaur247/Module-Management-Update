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
class UserServices{
    
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
        $user = User::find($id);
        if($user){
            $user->delete();
            return true;
        }else{
            return false;
        }
    }
    public function changeStatus($id)
    {
        $user = User::find($id);
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
}
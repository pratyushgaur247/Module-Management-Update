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
    function getUserById($id){
        return User::find($id);
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
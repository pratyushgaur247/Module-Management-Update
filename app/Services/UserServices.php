<?php
/*
    16.12.2019
    RolesService.php
*/

namespace App\Services;
use Hash;
use Auth;
use App\Models\{User};
class UserServices{
    
   
    
    

    public function logoutUser()
    {
        Auth::logout();
        if(Auth::guard('admin')->check()){
            return true;
        }
        return false;
    }

    
}
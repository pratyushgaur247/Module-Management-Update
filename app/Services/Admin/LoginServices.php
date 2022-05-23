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

use App\Models\{Admin};
class LoginServices{
    function login($request){
        return  Admin::where('email', $request->email)->where('menuroles','admin')->first();
    }
    

}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Services\UserServices;
class UserLogoutController extends Controller
{
    protected $userServices;
    
    public function __construct(UserServices $userServices){
        //$this->middleware('auth:web');
        $this->userServices  = $userServices;
    }

    public function userLogout(){
        
        if ($this->userServices->logoutUser()){
            return redirect('/admin/dashboard');
        }
        return redirect('/login');
        
    }
}

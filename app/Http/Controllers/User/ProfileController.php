<?php

namespace App\Http\Controllers\User;

use Auth;
use Hash;
use File;
use App\Models\{User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\{ChangePasswordRequest,UserRegistrationUpdateRequest};
use App\Services\ProfileServices;
use DB;

class ProfileController extends Controller{
    
    protected $ProfileServices;

    public function __construct(ProfileServices $ProfileServices){
        $this->ProfileServices  = $ProfileServices;
    }
    public function profile(){
        $user = $this->ProfileServices->getProfile(auth()->id());
        return view('dashboard.user.owner-profile.index', compact('user'));
    }
   
    public function profileUpdate(UserRegistrationUpdateRequest $request, $id){
        /* ========== User Table ========== */
        $this->ProfileServices->profileUpdate($request, $id);
        
        return redirect()->back()->with('success', __('userProfileUpdate'));
    }

    public function changePassword(){
        return view('dashboard.admin.change-password.index');
    }

    public function passwordUpdate(ChangePasswordRequest $request){
        if ($this->ProfileServices->userChangePassword($request,Auth::id())) {
            redirect()->route('user.changePassword')->with('success', __('userpassowrdchanged'));
        } else {
            redirect()->route('user.changePassword')->with('danger', __('oldPasswordMatchError'));
            
        }
        //return redirect()->route('user.changePassword');
        
    }
}
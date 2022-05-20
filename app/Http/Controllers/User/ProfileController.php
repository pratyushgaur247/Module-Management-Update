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

use App\Services\UserServices;
use DB;

class ProfileController extends Controller{
    
    protected $userServices;

    public function __construct(UserServices $userServices){
        $this->userServices  = $userServices;
    }
    public function profile(){
        $user = $this->userServices->getProfile(auth()->id());
        return view('dashboard.user.owner-profile.index', compact('user'));
    }
   
    public function profileUpdate(UserRegistrationUpdateRequest $request, $id){
        /* ========== User Table ========== */
        $this->userServices->profileUpdate($request, $id);
        $request->session()->flash('success', 'Your profile has been updated successfully.');
        return redirect()->back();
    }

    public function changePassword(){
        return view('dashboard.admin.change-password.index');
    }

    public function passwordUpdate(ChangePasswordRequest $request){
        if ($this->userServices->userChangePassword($request,Auth::id())) {
            $request->session()->flash('success', 'Password Changed Successfully.');
        } else {
            $request->session()->flash('danger', 'Old Password does not match.');
        }
        return redirect()->route('user.changePassword');
        
    }
}
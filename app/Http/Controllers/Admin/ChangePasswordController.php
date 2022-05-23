<?php

namespace App\Http\Controllers\admin;
use App\Models\{Admin,User};
use Illuminate\Http\Request;
use App\Http\Requests\{ChangePasswordRequest};

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\AdminServices;
class ChangePasswordController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $adminServices;
    public function __construct(AdminServices $adminServices)
    {
       $this->adminServices  = $adminServices;
    }
    public function index(){
        return view('dashboard.admin.change-password.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChangePasswordRequest $request){
        // $this->validate($request, [
        //     'old_password' => 'required|string|min:8',
        //     'password' => 'required|string|min:8|confirmed'
        // ]);
        
        if ($this->adminServices->changePassword($request)) {
            $request->session()->flash('success', __('adminPassowrdChanged'));
        } else {
            $request->session()->flash('danger', __('oldPasswordMatchError'));
        }
        return redirect()->route('change-password.index'); 
        
    }
}

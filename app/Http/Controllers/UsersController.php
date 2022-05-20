<?php

namespace App\Http\Controllers;

use Auth; 
Use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\{UserRegistrationRequest, UserRegistrationUpdateRequest};
use App\Services\AdminServices;
class UsersController extends Controller
{
    protected $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->middleware('permission:user-section');
        $this->middleware('permission:user-index', ['only'=>['index']]);   
        $this->middleware('permission:user-create', ['only'=>['create','store']]);
        $this->middleware('permission:user-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:user-destroy', ['only'=>['destroy']]);
        $this->middleware('permission:user-proxy',  ['only'=>['proxyLogin']]);
        $this->adminServices  = $adminServices;
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $users = $this->adminServices->getAdminUserIndex($request);
        return view('dashboard.admin.usersList', compact('users'));
    }
    
    public function create(){
        $roles = $this->adminServices->getRolesName();
        return view('dashboard.admin.userAdd',compact('roles'));
    }

    public function store(UserRegistrationRequest $request){
        /* ========== User Table ========== */
        $this->adminServices->storeUser($request);
        $request->session()->flash('success', 'User has been registered successfully.');
        if(auth()->guard('admin')->check()){
            return redirect()->route('users.index');
        }else{
            return redirect()->to('/users');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $user = $this->adminServices->getUserById($id);
        return view('dashboard.admin.userShow', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if($id > 0){
            $data = $this->adminServices->getUserEdit($id);
            $user = $data['user'];
            $roles = $data['roles'];
            return view('dashboard.admin.userEditForm', compact('user','roles'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegistrationUpdateRequest $request, $id){
        /* ========== User Table ========== */
        $this->adminServices->getUserUpdate($request,$id);
        $request->session()->flash('success', 'User profile updated successfully.');
        if(auth()->guard('admin')->check()){
            return redirect()->route('users.index');
        }else{
            return redirect()->to('/users');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if($id > 0){
            if($this->adminServices->deleteUser($id)){
                session()->flash('danger', 'User profile has been deleted successfully.');
            }else{
                session()->flash('danger', 'User Not Found to Delete');
            }
            if(auth()->guard('admin')->check()){
                return redirect()->route('users.index');
            }else{
                return redirect()->to('/users');   
            }
        }
    }

    public function status($id) {
        if($user = $this->adminServices->changeStatus($id)){
            return response()->json(['status'=>'success','message'=>'User Rejected','type'=>'deactivate']);
        }else{
            return response()->json(['status'=>'success','message'=>'User Approved','type'=>'activate']);
        }
    }
}

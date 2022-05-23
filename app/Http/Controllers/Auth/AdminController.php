<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;
use Redirect;
use App\Services\Admin\LoginServices;
class AdminController extends Controller
{
       /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected $LoginServices ;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginServices $LoginServices){
        $this->middleware('guest')->except('logout');
        $this->LoginServices = $LoginServices;
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $userData =$this->LoginServices->login($request);
        if(isset($userData)){
            $credentials = $request->only('email', 'password');
            if(Auth::guard('admin')->attempt($credentials)){
                
                return redirect('/admin/dashboard')->with('success', __('successfullyLogin'));
            }else{
                return Redirect::back()->withErrors( [ 'email' => __('credentialsError') ] );
            }
        }else{
            return Redirect::back()->withErrors( [ 'status' => __('accountStatusError') ] );
        }   
        Redirect::back()->withErrors( [ 'status' => __('credentialsOrAccount') ] ); 
    }

    public function logout(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            Auth::guard('web')->logout();
            return redirect('admin/login');
        }else{
            Auth::guard('web')->logout();
            return redirect('/login');
        }
    }
}

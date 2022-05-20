<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Auth;
use Redirect;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $userData = Admin::where('email', $request->email)->where('menuroles','admin')->first();
        if(isset($userData)){
            $credentials = $request->only('email', 'password');
            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->flash('success', 'You have logged in successfully.');
                return redirect('/admin/dashboard');
            }else{
                return Redirect::back()->withErrors( [ 'email' => 'Your credentials does not match.' ] );
            }
        }else{
            return Redirect::back()->withErrors( [ 'status' => 'Your account is not activated yet, Admin will activate your account soon.' ] );
        }   
        Redirect::back()->withErrors( [ 'status' => 'Your credentials does not match. or Your account is not activated.' ] ); 
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

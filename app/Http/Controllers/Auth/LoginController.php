<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Redirect;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller{
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

    public function login(Request $request){
        $checkout = false;
        $url = url()->previous();
        $end = (explode('?', $url));
        $endUrl = end($end);
        $last = substr($endUrl, strpos($endUrl, "=") + 1);
        if($last == 'checkout'){
            $checkout = true;
        }
        
        $userData = User::where('email', $request->email)->where('menuroles','user')->first();
        if($userData != ''){
            if(isset($userData->status) && $userData->status == 1){
                $credentials = $request->only('email', 'password');
                if(Auth::attempt($credentials)){
                    // if(\Session::has('product_id')){
                    if($checkout == true){
                        return redirect()->route('checkout');
                    }else{
                        $request->session()->flash('success', 'You have logged in successfully.');
                        return redirect('/dashboard');
                    }
                }else{
                    return Redirect::back()->withErrors( [ 'email' => 'Invalid email or password.' ] )->withInput();
                }
            }else{
                return Redirect::back()->withErrors( [ 'status' => 'Seems your account is deactivate, Contact admin to reactivate your account.' ] )->withInput();
            }   
        }else{
            return Redirect::back()->withErrors( [ 'status' => 'Invalid email or password.' ] )->withInput();
        }
    }

}

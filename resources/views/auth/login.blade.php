@extends('dashboard.authBase')
@section('content')

@if(url()->current() != url('/admin/login'))
<section class="login-signup-page signup-sec bgimg" style="background-image: url(frontend/assets/images/bg1.jpg);">
@else
<section class="login-signup-page signup-sec bgimg" style="background-image: url(../frontend/assets/images/bg1.jpg);">
@endif
    <div class="container">
        <div class="row">
            <div class="col-md-7 align-self-center m-auto">
                <div class="login-box">
                    <h1 class="heading-medium text-white text-center">Sign in</h1>
                    <!-- <p class="text-muted">Sign In to your account</p> -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{url()->current() == url('/admin/login') ? route('admin.login.submit') : route('login') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="label-font-weight">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="fa fa-user c-icon" aria-hidden="true"></i>
                                <input class="form-control" type="text" placeholder="" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="label-font-weight">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="fa fa-eye c-icon cursor-pointer toggle-password"></i>
                                <input class="form-control" id="password" type="password" placeholder="" name="password" required>
                            </div>
                        </div>
                        @if(url()->current() != url('/admin/login'))
                            <p class="text-right mb-0"><a href="{{ route('password.request') }}" class="text-white text-underline p-0">{{ __('Forgot Your Password?') }}</a></p>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <button class="btn submit px-4 w-100 mt-3 mb-2" type="submit">{{ __('Login') }}</button>
                                @if(url()->current() != url('/admin/login'))
                                    <p class="dont text-center text-white mt-2 mb-0">Don't have an account yet?
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('register') }}" class="text-white text-underline">{{ __('Sign Up') }}</a>
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(url()->current() != url('/admin/login'))
    <p class="text-center text-white mt-4 mb-0 login-admin-link">
        <a href="{{ url('/admin/login') }}" class="text-white">Click here to login as an <strong>Admin</strong></a> 
    </p>
    @endif
</section>
@endsection
@section('javascript')
<script type="text/javascript">
    $( document ).ready(function() {
        setTimeout(function(){
            $('.alert-danger').css('display', 'none')
        }, 4000);
    });
</script>
@endsection

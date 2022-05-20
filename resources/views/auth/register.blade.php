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
                    <form method="POST" action="{{ route('register') }}" autocomplete="off">
                        @csrf
                        <fieldset class="step3">
                            <div class="form-content text-left">
                                <div class="form-header">
                                    <h3 class="heading-medium text-white">Signup</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" maxlength="250" id="name" value="{{ old('name') }}" placeholder="" class="form-control">
                                            @error('name')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Email Address <span class="text-danger">*</span></label>
                                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="">
                                            @error('email')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" maxlength="250" id="password" value="{{ old('password') }}" placeholder="" class="form-control">
                                            @error('password')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" maxlength="250" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="" class="form-control">
                                            @error('password_confirmation')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button name="register" class="btn submit px-4 w-100 mt-3 mb-2" type="submit">{{ __('Register') }}</button>
                        </fieldset>
                    </form>
                    <p class="text-center text-white mt-4 mb-0">Go to <a href="{{ route('login') }}" class="text-white text-underline">Sign in</a></p>
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

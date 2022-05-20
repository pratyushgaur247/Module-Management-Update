@extends('dashboard.authBase')
@section('content')
<style>
body {
    background: #dcdcdc !important;
}
</style>
<section class="login-signup-page signup-sec bgimg" style="background-image: url(../frontend/assets/images/bg1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 align-self-center m-auto">
                <div class="login-box">
                        <h1 class="heading-medium text-white text-center">{{ __('Reset Password') }}</h1>
                    
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn submit px-4 w-100 mt-3 mb-2">
                                        {{ __('Send Reset Link') }}
                                    </button>
                                </div>
                            </div>
                            <p class="dont text-white text-center mt-2 mb-0">Already have an account ? <a href="{{ route('login') }}" class="text-white text-underline">Sign in</a></p>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

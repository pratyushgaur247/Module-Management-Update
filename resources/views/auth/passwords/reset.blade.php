@extends('dashboard.authBase')
@section('content')
<section class="login-signup-page signup-sec bgimg" style="background-image: url(../../frontend/assets/images/bg1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 align-self-center m-auto">
                <div class="login-box">
                    <h1 class="heading-medium text-white text-center">{{ __('Reset Password') }}</h1>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="fa fa-user c-icon" aria-hidden="true"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="fa fa-eye c-icon cursor-pointer toggle-password"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>

                            <div class="input-group">
                                <i class="fa fa-eye c-icon cursor-pointer toggle-password"></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn submit px-4 w-100 mt-3 mb-2">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

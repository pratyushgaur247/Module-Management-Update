@extends('dashboard.base')
@section('content')
<section class="change-pass-sec">
    <div class="container-fluid">
        <form action="{{auth()->guard('admin')->check() && request()->segment(1) == 'admin' ? url('/admin/change-password') : url('/change-password') }}" id="wizard" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @include('flash') {{--session message--}}
            <div class="card db-table">
                <div class="card-header">
                    <h5 class="title font-bold"> Change Password </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="firstName1">Old Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="old_password">
                                        @error('old_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1">New Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phone">Confirm New Password</label>
                                        <input class="form-control" type="password" name="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pt-3 text-right">
                                        <button type="submit" class="btn-gray">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('javascript')
@endsection



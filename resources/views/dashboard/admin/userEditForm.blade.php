@extends('dashboard.base')
@section('content')
<style>
label.error{
    color: red;
}
</style>
<div class="container-fluid">
    <div class="fade-in">
        @include('flash')
        <div class="row">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-7">
                                <h5 class="card-title mb-0">Edit User</h5>
                            </div>
                            <div class="col-md-6 col-5">
                                <div class="text-right">
                                    <a href="{{ url('/admin/users') }}" class="btn addbtn">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{auth()->guard('admin')->check() && Request::segment(1) == 'admin' ? url('/admin/users/'.$user->id) : url('/users'.'/'.$user->id) }}" id="wizard" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf        
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" maxlength="250" id="name" value="{{ $user->name ?? old('name') }}" placeholder="" class="form-control">
                                        @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>                                    
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" value="{{ $user->email ?? old('email') }}" class="form-control" placeholder="" readonly>
                                        @error('email')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Role')}}<span class="text-danger">*</span></label>
                                        <select name="role" class="form-control">
                                            <option selected disabled>{{ __('Select Role') }}</option>
                                            @if ( isset($roles) )
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}" {{ isset($user['roles'][0]['name']) && $role->name == $user['roles'][0]['name'] ? 'selected' :'' }}>{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('role')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button name="register" class="btn addbtn" type="submit">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

@endsection

@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    @include('flash') {{--session message--}}
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Profile</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/profile'.'/'.$user->id) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $user->name ?? '' }}" placeholder="" class="form-control">
                                        @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="text" name="email" value="{{ $user->email ?? '' }}" disabled="disabled" class="form-control" placeholder="">
                                        @error('email')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profile Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- @if($user->getFirstMediaUrl('image', 'thumb') != null)
                                           <img src="{{$user->getFirstMediaUrl('image', 'thumb')}}"  width="75" height="75">
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn addbtn" type="submit">Submit</button>
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
<script type="text/javascript">
    $( document ).ready(function() {
        setTimeout(function(){
            $('.alert-success').css('display', 'none')
        }, 4000);
    });
</script>
@endsection
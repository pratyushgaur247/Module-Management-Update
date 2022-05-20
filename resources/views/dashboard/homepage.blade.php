@if(auth()->guard('web')->check() || auth()->guard('admin')->check())
@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    @include('flash') {{--session message--}}
    <div class="db-item-list">
        <div class="row">
            @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                <div class="col-md-4">
                    <a href="{{url('/admin/users')}}">
                        <div class="custom-card">
                            <div class="db-icon mr-3">
                                <img src="{{ asset('images/icon4.png') }}" alt="icon">
                            </div>
                            <div class="db-content">
                                <p>User Management</p>
                                <h4>{{ number_format($businessOwners) ?? '' }}</h4>
                                <h6>Active: {{ number_format($businessOwnersActive) ?? '' }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
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
@endif
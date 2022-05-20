<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span>
        </button>
        <a class="c-header-brand d-sm-none" href="#">
            <img class="c-header-brand" src="{{ url('/assets/brand/coreui-base.svg') }}" width="97" height="46" alt="CoreUI Logo">
        </a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <span class="c-header-toggler-icon"></span>
        </button>

        <ul class="c-header-nav ml-auto">
            <li class="c-header-nav-item dropdown mr-3">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar dropdown-profile user-name">
                        <span class="mr-2 text-capitalize"> 
                            @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                                {{auth()->guard('admin')->user()->name}}
                            @else
                                {{auth()->guard('web')->user()->name ?? 'unknown'}}
                            @endif
                        </span>
                        @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                            <img class="c-avatar-img" src="{{ url('/assets/img/user.png') }}" alt="user@email.com"> <span class="d-flex align-items-center"> <i class="fa fa-caret-down ml-1" aria-hidden="true"></i></span>
                        @else
                            @if(auth()->guard('web')->user()->getFirstMediaUrl('image'))
                                <img class="c-avatar-img" src="{{ auth()->guard('web')->user()->getFirstMediaUrl('image') }}" alt="user@email.com"> <span class="d-flex align-items-center"> <i class="fa fa-caret-down ml-1" aria-hidden="true"></i></span>
                            @else 
                                <img class="c-avatar-img" src="{{  url('/assets/img/user.png') }}" alt="user@email.com"> <span class="d-flex align-items-center"> <i class="fa fa-caret-down ml-1" aria-hidden="true"></i></span>
                            @endif
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pb-0 pt-0">
                    <div class="dropdown-header py-2">
                        <strong>Account</strong>
                    </div>
                    <ul class="db-header-right">
                        @if(Auth::guard('admin')->check() && Request::segment(1) == 'admin')
                        @if(Request::segment(1) == 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ url('/admin/change-password') }}">
                                <i class="fa fa-lock"></i> Change Password
                            </a>
                        </li>
                        @endif
                        @elseif(Request::segment(1) != 'admin')
                            <li>
                                @if(Request::segment(1) != 'admin')
                                    <a class="dropdown-item" href="{{ url('/change-password') }}">
                                        <i class="fa fa-lock" aria-hidden="true"></i> Change Password
                                    </a>
                                @endif
                            </li>
                        @endif

                        @if(Auth::guard('web')->check() && Request::segment(1) != 'admin')
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> Profile
                                </a>
                            </li>
                        @endif
                        {{------------------ START GO TO WebSite ---------------------}}
                        <li>
                            <a class="dropdown-item" href="{{url('/')}}" target="_blank">
                                <i class="fa fa-tachometer" aria-hidden="true"></i> Go To Website
                            </a>
                        </li>
                        {{------------------ END GO TO WebSite -----------------------}}
                        <li>
                            @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                                <a class="dropdown-item" href="{{route('admin.logout')}}" class="btn p-0"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a> 
                            @else
                                <a class="dropdown-item" href="{{route('user.logout')}}" class="btn p-0"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a> 
                            @endif

                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item">
                    <a href="/">Dashboard</a>
                </li>
                <?php $segments = ''; ?>
                
                @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin' &&  Request::segment(2) != 'dashboard' || auth()->guard('web')->check() && Request::segment(1) != 'dashboard' && Request::segment(1) != 'admin')
                    @if( Request::segment(1) != 'message-center' || Request::segment(1) == 'admin' &&  Request::segment(2) != 'message-center' )
                        @if(auth()->guard('admin')->check() &&  Request::segment(1) == 'admin')
                            @if(Request::segment(2) == 'users' )
                                <li class="breadcrumb-item active">{{ 'Users' }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ str_replace('-', ' ', Request::segment(2)) }}</li>
                            @endif
                        @elseif(auth()->guard('web')->check() && Request::segment(1) != 'admin')
                            @if(Request::segment(1) == 'users' )
                                <li class="breadcrumb-item active">{{ 'Users' }}</li>
                            @elseif(Request::segment(1) == 'buyer' )
                                <li class="breadcrumb-item active">{{ 'Purchase' }}</li>
                            @elseif(Request::segment(1) == 'seller' )
                                <li class="breadcrumb-item active">{{ 'Sell' }}</li>
                            @elseif(Request::segment(1) == 'buyer-details' )
                                <li class="breadcrumb-item active">{{ 'Purchase Detail' }}</li>
                            @elseif(Request::segment(1) == 'seller-details' )
                                <li class="breadcrumb-item active">{{ 'Sell Detail' }}</li>
                            @else
                                <li class="breadcrumb-item active">{{ str_replace('-', ' ', Request::segment(1)) }}</li>
                            @endif
                        @endif
                    @else
                        <li class="breadcrumb-item active">{{ str_replace('-', ' ', Request::segment(1)) }}</li>
                    @endif
                @endif
            </ol>
        </div>
    </header>

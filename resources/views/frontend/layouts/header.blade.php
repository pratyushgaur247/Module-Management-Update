<header class="header_sec header-home">
	<nav class="navbar navbar-expand-md header_nav">
		<div class="container navbar-container">
			@if(auth()->guard('web')->check())
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
			</button>
			@elseif(auth()->guard('admin')->check())
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
			</button>
			@endif
			<a class="navbar-brand" href="{{ url('/home') }}"> 
				<img class="logo" style="height:50px; width: 50px;" src="{{ asset('frontend/assets/images/logo-white-1.png') }}">
			</a>
			@if(!auth()->guard('web')->check() && !auth()->guard('admin')->check())
			<button class="navbar-toggler text-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
			</button>
			@endif
			@if(!auth()->guard('web')->check())
				@if(url()->current() != url('/login') && url()->current() != url('/register') && url()->current() != url('/password/reset') && url()->current() != url('/admin/login'))
					<div class="collapse navbar-collapse" id="navbarCollapse" style="display: none;">
				@else
					<div class="collapse navbar-collapse notlogin" id="navbarCollapse">
				@endif
			@endif
			@if(auth()->guard('web')->check())
			<div class="collapse navbar-collapse" id="navbarCollapse" style="display: none;">
			@endif
			    <ul class="navbar-nav ml-auto"> 
					{{-- INSERT DYNAMIC PAGES START --}}
					@forelse($allPage as $page)
						<li class="nav-item"><a class="nav-link" href="{{ url('page', [$page->slug]) }}">{{ $page->title }}</a></li>
					@empty
						<li></li>
					@endforelse
					{{-- INSERT DYNAMIC PAGES END --}}
					@if(!auth()->guard('web')->check())
						@if(!auth()->guard('admin')->check())
							@if(url()->current() != url('/login') && url()->current() != url('/register') && url()->current() != url('/password/reset') && url()->current() != url('/admin/login'))
								<li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Sign In</a></li>
								<li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Sign Up</a></li>
							@endif
						@endif
					@endif 
				</ul>
		  	</div>

		  	@if(auth()->guard('admin')->check())
				<div class="profile-right">
					<div>
					<div class="profile-menu">
						<div class="profile-name d-flex align-items-center">
							<span class="mr-2 text-capitalize" >{{auth()->guard('admin')->user()->name}}</span>
							<img src="{{asset('frontend/assets/images/user-white.png')}}"> <i class="fa fa-caret-down ml-1" aria-hidden="true"></i>
						</div>
					</div>
					<ul class="profile-dropdown mt-2 hide">
						<li><span class="mr-2 text-capitalize" >{{auth()->guard('admin')->user()->name}}</span></li>
						<li><a href="{{url('/admin/change-password')}}" class="dropdown-list"><i class="fa fa-lock" aria-hidden="true"></i>Change Password </a></li>
						<li><a href="{{url('/admin/dashboard')}}" class="dropdown-list"><i class="fa fa-tachometer" aria-hidden="true"></i> Go To Dashboard</a></li>
						<li><a href="{{url('/admin/logout')}}" class="dropdown-list"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
					</ul>
					</div>
				</div>
			@elseif(auth()->guard('web')->check())
				<div class="profile-right">
					<div>
					<div class="profile-menu">
						<div class="profile-name d-flex align-items-center">
							<span class="mr-2 text-capitalize" >{{auth()->guard('web')->user()->name}}</span>
							<img src="{{asset('frontend/assets/images/user-white.png')}}"> <i class="fa fa-caret-down ml-1" aria-hidden="true"></i>
						</div>
					</div>
					<ul class="profile-dropdown mt-2 hide">
						<li><span class="mr-2 text-capitalize" >{{auth()->guard('web')->user()->name}}</span></li>
						<li><a href="{{url('/change-password')}}" class="dropdown-list"><i class="fa fa-lock" aria-hidden="true"></i>Change Password </a></li>
						<li><a href="{{url('/profile')}}" class="dropdown-list"><i class="fa fa-user" aria-hidden="true"></i>profile </a></li>
						<li><a  href="{{url('/dashboard')}}" class="dropdown-list"><i class="fa fa-tachometer" aria-hidden="true"></i> Go To Dashboard</a></li>
						<li><a  class="dropdown-list" href="{{url('/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
					</ul>
					</div>
				</div>
			@else
			@endif
	  	</div>
	</nav>
</header>
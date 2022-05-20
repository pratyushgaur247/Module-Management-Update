<!DOCTYPE html>
<html>
<head>
	<head>
    <title>User Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'> 
	<meta http-equiv='expires' content='0'> 
	<meta http-equiv='pragma' content='no-cache'>
    <link rel="icon" href="{{ asset('assets/favicon/favicon-red.png') }}" type="image/png">
    <!-- bootstrape-min-css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" media="all">
    <!-- font-awsome-min-css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}" media="all">
    <!-- Price range slider css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}" media="all">

    <!-- Font family link -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- defuelt-css -->
    <link href="{{ asset('frontend/assets/css/header.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css?5234') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

  </head>
</head>
<body>
	@include('frontend.layouts.header')
	@yield('content')
    @include('frontend.layouts.footer')
    @yield('javascript')

    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <script>
    	$(".profile-menu").click(function(){
	       $(".profile-dropdown").toggleClass("hide");
		});
    </script>
</body>
</html>
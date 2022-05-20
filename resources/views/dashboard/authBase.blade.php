<!DOCTYPE html>
<!--
* CoreUI Free Laravel Bootstrap Admin Template
* @version v2.0.1
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Resin Trader</title>

    <link rel="icon" href="{{ asset('assets/favicon/favicon-red.png') }}" type="image/png">
    <!-- <link rel="icon" href="{{ url('/favicon/favicon-red.png') }}" type="image/png" sizes="16x16"> -->
    <!-- Icons-->
    
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> -->
    <!-- Main styles for this application-->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-design-iconic-font.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form-style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/header.css') }}" rel="stylesheet">
</head>
<!-- <body class="c-app flex-row align-items-center"> -->
<body>
<!-- <div class="page-loader">
    <div class="loading-img mb-3">
        <img src="{{ asset('frontend/assets/images/loading-buffering.gif') }}" style="width: 60px;">
    </div>
    <h5 class="txt">Loading... Please Wait</h5>
</div> -->
@include('frontend.layouts.header')

    @yield('content') 
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.js') }}"></script>
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <!-- <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script> -->
    @yield('javascript')


    <script>
        $(window).on('load',function(){
            setTimeout(function(){ // allowing 3 secs to fade out loader
            $('.page-loader').fadeOut('slow');
            },1000);
        });
    </script>

    <!-- Show password -->
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <!-- Show password js end -->
</body>
</html>
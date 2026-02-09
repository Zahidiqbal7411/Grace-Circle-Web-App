
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Grace Circle</title>

    <!-- Icon css link -->
    <link href="{{ asset('vendors/material-icon/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/linears-icon/style.css') }}" rel="stylesheet">

    <!-- RS5.0 Layers and Navigation Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/revolution/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/revolution/css/settings.css') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/image-dropdown/dd.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/image-dropdown/flags.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/image-dropdown/skin2.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-selector/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/owl-carousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/animate-css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bs-tooltip/jquery.webui-popover.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">




    <style>
        /* Enhanced Navbar Styling with transparency */
        .header_menu_area {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(25, 25, 45, 0.6) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
        .header_menu_area .navbar-default {
            background: transparent !important;
            border: none !important;
        }
        
        /* Navbar Brand/Logo Enhancement */
        .header_menu_area .navbar-brand img {
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        
        .header_menu_area .navbar-brand:hover img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
        
        /* Navigation Links Enhancement */
        .header_menu_area .navbar-nav > li > a {
            color: #fff !important;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 13px !important;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .header_menu_area .navbar-nav > li > a:hover {
            color: #e74c3c !important;
            text-shadow: 0 0 10px rgba(231, 76, 60, 0.5);
        }
        
        .header_menu_area .navbar-nav > li > a::after {
            display: none !important;
        }
        
        .header_menu_area .navbar-nav > li:hover > a::after,
        .header_menu_area .navbar-nav > li.active > a::after {
            display: none !important;
        }
        
        /* Login/Registration Buttons Enhancement */
        .header_menu_area .navbar-right {
            display: flex !important;
            align-items: center !important;
            float: right !important;
            margin-top: 20px;
        }
        
        .header_menu_area .navbar-right li {
            display: inline-block !important;
            float: none !important;
        }
        
        .header_menu_area .navbar-right li a {
            padding: 10px 20px !important;
            border-radius: 25px;
            margin: 0 8px;
            transition: all 0.3s ease;
            display: inline-block !important;
            line-height: 1.5 !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .header_menu_area .navbar-right li:last-child a {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
            color: #fff !important;
        }
        
        .header_menu_area .navbar-right li a:hover {
            background: rgba(231, 76, 60, 0.3);
            transform: translateY(-2px);
            border-color: #e74c3c;
        }
        
        .header_menu_area .navbar-right li:last-child a:hover {
            background: linear-gradient(135deg, #ff6b5b, #e74c3c);
        }
        
        /* Dropdown Menu Enhancement */
        .header_menu_area .dropdown-menu {
            background: rgba(30, 30, 50, 0.98) !important;
            border: 1px solid rgba(231, 76, 60, 0.3) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
        
        .header_menu_area .dropdown-menu li a {
            color: #fff !important;
            transition: all 0.3s ease;
        }
        
        .header_menu_area .dropdown-menu li a:hover {
            background: rgba(231, 76, 60, 0.3) !important;
            padding-left: 20px !important;
        }
        
        /* Fix: Slider covers full area - starts from top, extends behind navbar */
        .slider_area {
            margin-top: 0 !important;
            padding-top: 0 !important;
            position: relative;
            z-index: 1;
            width: 100%;
            overflow: hidden;
        }
        
        /* Make slider images cover the full slider area */
        .slider_area .slider_inner,
        .slider_area .rev_slider,
        .slider_area .tp-revslider-mainul,
        .slider_area .tp-revslider-mainul li {
            width: 100% !important;
        }
        
        .slider_area #home-slider ul li .tp-bgimg,
        .slider_area .rev_slider .tp-bgimg,
        .slider_area .rev-slidebg {
            background-size: cover !important;
            background-position: center center !important;
            object-fit: cover !important;
            object-position: center center !important;
            width: 100% !important;
            height: 100% !important;
        }
        
        /* Affix state styling */
        .header_menu_area.affix {
            background: linear-gradient(135deg, rgba(35, 35, 55, 0.98) 0%, rgba(20, 20, 40, 0.99) 100%) !important;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        }
        
        .registration-image {
            margin-left: 15px !important;
            margin-top: -20px !important;
        }

        .item img {
            border-radius: 10px !important;
        }

        /* HD Slider Image Quality Fix for Large Screens */
        .slider_area .rev_slider,
        .slider_area .slider_inner {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            -ms-interpolation-mode: bicubic;
            width: 100% !important;
        }

        .slider_area .rev_slider .rev-slidebg,
        .slider_area .tp-bgimg,
        .slider_area #home-slider img,
        .slider_area .slider_inner img {
            image-rendering: -webkit-optimize-contrast !important;
            image-rendering: high-quality !important;
            image-rendering: crisp-edges !important;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
            will-change: transform;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
        }

        /* Ensure full-width coverage */
        .slider_area,
        .slider_area .slider_inner,
        .slider_area .rev_slider {
            width: 100% !important;
            max-width: 100% !important;
            overflow: hidden;
        }

        .slider_area .tp-revslider-mainul,
        .slider_area .tp-revslider-mainul li {
            width: 100% !important;
        }

        /* Ensure full-width HD coverage on large screens */
        @media (min-width: 1200px) {
            .slider_area .rev_slider .tp-bgimg,
            .slider_area .slider_inner .rev-slidebg {
                background-size: cover !important;
                background-position: center center !important;
                min-width: 100vw;
                min-height: 100%;
                object-fit: cover;
                object-position: center;
            }
        }
            
            .slider_area .rev_slider .tp-bgimg,
            .slider_area .slider_inner .rev-slidebg {
                transform: scale(1.02) translateZ(0);
                -webkit-transform: scale(1.02) translateZ(0);
            }
        }

        /* 4K screens fix */
        @media (min-width: 2560px) {
            .slider_area .rev_slider .tp-bgimg,
            .slider_area .slider_inner .rev-slidebg {
                transform: scale(1.05) translateZ(0);
                -webkit-transform: scale(1.05) translateZ(0);
            }
        }
    </style>




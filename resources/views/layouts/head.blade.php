
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

        /* Ultra-wide screens HD fix */
        @media (min-width: 1600px) {
            .slider_area .rev_slider,
            .slider_area .slider_inner {
                max-height: 700px;
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




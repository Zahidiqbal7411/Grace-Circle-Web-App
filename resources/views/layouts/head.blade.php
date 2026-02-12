
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

        /* Awesome Profile Completion Styles */
        .profile-alert-bar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 12px 0;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 10000;
            border-bottom: 2px solid #764ba2;
            animation: slideDown 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .profile-alert-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 25px;
        }
        .profile-alert-text {
            color: #2f3c44;
            font-weight: 500;
            font-size: 15px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .profile-alert-text i {
            color: #764ba2;
            font-size: 20px;
        }
        .btn-complete-profile {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 10px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            animation: pulse-glow 2s infinite;
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(118, 75, 162, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(118, 75, 162, 0); }
            100% { box-shadow: 0 0 0 0 rgba(118, 75, 162, 0); }
        }
        .btn-complete-profile:hover {
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
        }
        
        /* Premium Modal Design */
        #completeProfileModal .modal-dialog {
            max-width: 1100px;
            width: 95%;
            margin: 30px auto;
        }
        #completeProfileModal .modal-content {
            border-radius: 30px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background: #fff;
        }
        #completeProfileModal .modal-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 35px 40px;
            border: none;
            position: relative;
        }
        #completeProfileModal .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #ff9a9e);
        }
        #completeProfileModal .modal-title {
            font-weight: 800;
            font-size: 28px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        #completeProfileModal .modal-title i {
            color: #667eea;
        }
        
        /* Progress Indicator */
        .profile-progress-wrapper {
            padding: 0 40px;
            margin-top: -15px;
            position: relative;
            z-index: 10;
        }
        .profile-progress-container {
            background: #f0f2f5;
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }
        .profile-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            border-radius: 10px;
        }
        .progress-text {
            font-size: 13px;
            font-weight: 700;
            color: #764ba2;
            margin-top: 8px;
            display: block;
            text-align: right;
        }

        #completeProfileModal .questions-container {
            max-height: 550px;
            overflow-y: auto;
            padding: 40px;
            scrollbar-width: thin;
            scrollbar-color: #764ba2 #f8f9fa;
        }
        #completeProfileModal .questions-container::-webkit-scrollbar {
            width: 8px;
        }
        #completeProfileModal .questions-container::-webkit-scrollbar-track {
            background: #f8f9fa;
        }
        #completeProfileModal .questions-container::-webkit-scrollbar-thumb {
            background: #764ba2;
            border-radius: 10px;
            border: 2px solid #f8f9fa;
        }
        
        #completeProfileModal .question-group {
            margin-bottom: 40px;
        }
        #completeProfileModal .category-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        #completeProfileModal .category-icon {
            width: 45px;
            height: 45px;
            background: rgba(118, 75, 162, 0.1);
            color: #764ba2;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        #completeProfileModal .category-title {
            color: #1a1a2e;
            font-weight: 800;
            font-size: 20px;
            margin: 0;
            flex-grow: 1;
        }
        
        #completeProfileModal .questions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        @media (max-width: 1050px) {
            #completeProfileModal .questions-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 700px) {
            #completeProfileModal .questions-grid {
                grid-template-columns: 1fr;
            }
        }
        
        #completeProfileModal .question-card {
            background: #fff;
            padding: 25px;
            border-radius: 20px;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        #completeProfileModal .question-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(102, 126, 234, 0.1);
        }
        #completeProfileModal .question-label {
            font-weight: 700;
            color: #2d3748;
            font-size: 16px;
            line-height: 1.6;
            min-height: 50px;
        }
        #completeProfileModal .question-options {
            display: flex;
            gap: 12px;
        }
        #completeProfileModal .option-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #edf2f7;
            border-radius: 12px;
            background: #fff;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            text-align: center;
            font-weight: 700;
            color: #718096;
            font-size: 14px;
        }
        #completeProfileModal .option-btn[data-value="Yes"]:hover {
            border-color: #48bb78;
            color: #48bb78;
            background: rgba(72, 187, 120, 0.05);
        }
        #completeProfileModal .option-btn[data-value="No"]:hover {
            border-color: #f56565;
            color: #f56565;
            background: rgba(245, 101, 101, 0.05);
        }
        #completeProfileModal .option-btn.active[data-value="Yes"] {
            background: #48bb78;
            color: white;
            border-color: #48bb78;
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
        }
        #completeProfileModal .option-btn.active[data-value="No"] {
            background: #f56565;
            color: white;
            border-color: #f56565;
            box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
        }
        
        #completeProfileModal .modal-footer {
            padding: 30px 40px;
            border-top: 1px solid #edf2f7;
            background: #f8fafc;
        }
        #completeProfileModal .btn-save-profile {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 18px 40px;
            border-radius: 18px;
            font-weight: 800;
            border: none;
            width: 100%;
            font-size: 18px;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(118, 75, 162, 0.3);
            transition: all 0.3s;
        }
        #completeProfileModal .btn-save-profile:active {
            transform: scale(0.98);
        }
        #completeProfileModal .btn-save-profile:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            background: #cbd5e0;
            box-shadow: none;
        }
    </style>




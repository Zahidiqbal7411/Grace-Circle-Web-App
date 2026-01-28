<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Muslim wa Muslima Rishta Social Network Website</title>

    <!-- Icon css link -->
    <link href="vendors/material-icon/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/linears-icon/style.css" rel="stylesheet">

    <!-- RS5.0 Layers and Navigation Styles -->
    <link rel="stylesheet" type="text/css" href="vendors/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="vendors/revolution/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="vendors/revolution/css/settings.css">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/image-dropdown/dd.css" rel="stylesheet">
    <link href="vendors/image-dropdown/flags.css" rel="stylesheet">
    <link href="vendors/image-dropdown/skin2.css" rel="stylesheet">
    <link href="vendors/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="vendors/bootstrap-selector/bootstrap-select.css" rel="stylesheet">
    <link href="vendors/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="vendors/owl-carousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="vendors/animate-css/animate.css" rel="stylesheet">
    <link href="vendors/bs-tooltip/jquery.webui-popover.css" rel="stylesheet">
    <link href="vendors/jquery-ui/jquery-ui.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">


    <style>
        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }

        .chat-app .people-list {
            width: 280px;
            position: absolute;
            height: 640px;
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7;
            overflow-y: auto;
            overflow-x: hidden;
            /* Prevent horizontal scroll */

        }

        .chat-app .people-list::-webkit-scrollbar {
            width: 6px;
        }

        .chat-app .people-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-app .people-list::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 3px;
        }


        .chat-app .chat {
            margin-left: 280px;
            border-left: 1px solid #eaeaea
        }

        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }

        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }

        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }

        .people-list .chat-list li.active {
            background: #efefef
        }

        .people-list .chat-list li .name {
            font-size: 15px
        }

        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }

        .people-list img {
            float: left;
            border-radius: 50%
        }

        .people-list .about {
            float: left;
            padding-left: 8px
        }

        .people-list .status {
            color: #999;
            font-size: 13px
        }

        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            height: 500px;
            /* or calc(100vh - header/footer height) */
            /* overflow-y: auto; */
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-right {
            float: right
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        .chat-list li.active {
            background-color: #2c2c2c;
            color: white;
        }




        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }

            .chat-app .people-list.open {
                left: 0
            }

            .chat-app .chat {
                margin: 0
            }

            .chat-app .chat .chat-header {
                border-radius: 0.55rem 0.55rem 0 0
            }

            .chat-app .chat-history {
                height: 300px;
                overflow-x: auto
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: calc(100vh - 350px);
                overflow-x: auto
            }
        }
    </style>



</head>

<body>
    <!-- login modal -->
    <div class="login_form_inner zoom-anim-dialog mfp-hide" id="small-dialog">
        <h4>User Login</h4>
        <form>
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <div class="login_btn_area">
                <button type="submit" value="LogIn" class="btn form-control login_btn">LogIn</button>
                <div class="login_social">
                    <h5>Login With</h5>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </form>
        <img class="mfp-close" src="img/close-btn.png" alt="">
    </div>
    <!-- registration modal -->
    <div class="register_form_inner zoom-anim-dialog mfp-hide" id="register_form">
        <div class="row">
            <div class="col-md-6">
                <div class="registration_man">
                    <img src="img/Registration_man.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="registration_form_s">
                    <h4>Registration</h4>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="reg_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="reg_first" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="reg_user" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="reg_pass" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span data-bind="label">Gender</span>&nbsp;<span class="arrow_carrot-down"><i class="fa fa-sort-asc" aria-hidden="true"></i><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Male</a></li>
                                    <li><a href="#">Female</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="datepicker">
                                <input type='text' class="form-control datetimepicker4" placeholder="Birthday" />
                                <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="reg_chose form-group">
                            <div class="reg_check_box">
                                <input type="radio" id="s-option" name="selector">
                                <label for="s-option">I`m Not Robot</label>
                                <div class="check">
                                    <div class="inside"></div>
                                </div>
                            </div>
                            <button type="submit" value="LogIn" class="btn form-control login_btn">Register</button>
                        </div>
                    </form>
                    <img class="mfp-close" src="img/close-btn.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <!--================Frist Main hader Area =================-->
    <header class="header_menu_area">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="./img/web-logo1.png" alt="" width="70" height="70"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown submenu active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Home 01</a></li>
                                <li><a href="index-2.html">Home 02</a></li>
                                <li><a href="index-3.html">Home 03</a></li>
                            </ul>
                        </li>
                        <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                                <li><a href="blog-right-sidebar.html">Blog right sidebar</a></li>
                                <li><a href="single-blog-fullwidth.html">Blog Single Fullwidth</a></li>
                                <li><a href="single-blog-left-sidebar.html">Blog Single left sidebar</a></li>
                                <li><a href="single-blog-right-sidebar.html">Blog Single right sidebar</a></li>
                            </ul>
                        </li>

                        <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="stories.html">Stories</a></li>
                                <li><a href="why-us.html">Why us</a></li>
                                <li><a href="404.html">Error</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="popup-with-zoom-anim" href="#small-dialog"><i class="mdi mdi-key-variant"></i>Login</a></li>
                        <li><a href="#register_form" class="popup-with-zoom-anim"><i class="fa fa-user-plus"></i>Registration</a></li>
                        <li class="flag_drop d-flex align-items-center">
                            <div class="selector">
                                <select class="language_drop" name="select-action" id="select-action">
                                    <option value=""> Select Action</option>
                                    <option value="#find-match"> Find Match </option>
                                    <option value="#inbox"> Inbox </option>
                                    <option value="#profile"> Profile </option>
                                    <option value="#signout"> Sign Out </option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="panel panel-default chat-app">
                    <div class="row">
                        <!-- User List -->
                        <div class="col-sm-4 people-list">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <ul class="list-unstyled chat-list mt-2 mb-0" id="user-list">
                                <li class="clearfix" data-user="vincent">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Vincent Porter</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> </div>
                                    </div>
                                </li>
                                <li class="clearfix active" data-user="aiden">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Aiden Chavez</div>
                                        <div class="status"><i class="fa fa-circle online"></i> online</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="mike">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Mike Thomas</div>
                                        <div class="status"><i class="fa fa-circle online"></i> online</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="christian">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Christian Kelly</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> left 10 hours ago</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="monica">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Monica Ward</div>
                                        <div class="status"><i class="fa fa-circle online"></i> online</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Muneeb Khan</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                                <li class="clearfix" data-user="Dean">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Dean Henry</div>
                                        <div class="status"><i class="fa fa-circle offline"></i> offline since Oct 28</div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Chat Area -->
                        <div class="col-sm-8 chat">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                        </a>
                                        <div class="chat-about">
                                            <h6 class="m-b-0" id="chat-user-name">Aiden Chavez</h6>
                                            <small>Last seen: 2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 text-right hidden-sm">
                                        <!-- <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-camera"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-image"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-cogs"></i></a>
                                        <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-question"></i></a> -->
                                    </div>
                                </div>
                            </div>

                            <div class="chat-history" id="chat-box">
                                <ul class="m-b-0 list-unstyled">
                                    <li class="clearfix">
                                        <div class="message-data text-right">
                                            <span class="message-data-time">10:10 AM, Today</span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                        </div>
                                        <div class="message other-message pull-right">
                                            Hi Aiden, how are you? How is the project coming along?
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time">10:12 AM, Today</span>
                                        </div>
                                        <div class="message my-message">Are we meeting today?</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time">10:15 AM, Today</span>
                                        </div>
                                        <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time">11:11 pm, Today</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="chat-message clearfix">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-send"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter text here...">
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.panel -->
            </div>
        </div>
    </div>


    <!--================Footer Area =================-->
    <footer class="footer_area">
        <div class="footer_widgets_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <aside class="f_widget">
                            <div class="vero_widget">
                                <h4><span>Vero</span>Date</h4>
                                <p>There are many variations of passag-es of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything .</p>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3">
                        <aside class="f_widget">
                            <div class="f_widget_title">
                                <h3>Information</h3>
                            </div>
                            <div class="information_widget">
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Contact us</a></li>
                                    <li><a href="#">Membership</a></li>
                                    <li><a href="#">Private Policy</a></li>
                                    <li><a href="#">Forum Support</a></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3">
                        <aside class="f_widget">
                            <div class="f_widget_title">
                                <h3>Recent posts</h3>
                            </div>
                            <div class="recent_post_widget">
                                <ul>
                                    <li><a href="#">Blog Standard Post <span>14 Sep, 2016</span></a></li>
                                    <li><a href="#">Blog Image Post <span>12 Sep, 2016</span></a></li>
                                    <li><a href="#">BlogVideo Post <span>08 Sep, 2016</span></a></li>
                                    <li><a href="#">Blog Audio Post <span>03 Sep, 2016</span></a></li>
                                    <li><a href="#">Blog Standard Post <span>16 Aug, 2016</span></a></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3">
                        <aside class="f_widget">
                            <div class="f_widget_title">
                                <h3>Newsletter Signup</h3>
                            </div>
                            <div class="newsletter_widget">
                                <p>Get Alert Directly Into Your Inbox After Each Post.</p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter your email">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="copyright_left">
                <div class="copyright_text">
                    <h4>Copyright © 2017. <a href="#">VeroDate</a> . all rights reserved</h4>
                </div>
            </div>
            <div class="copyright_right">
                <div class="copyright_social">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--================End Footer Area =================-->




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <!--RS5.0 Extensions-->
    <script src="vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="vendors/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="vendors/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>

    <!-- Extra plugin js -->
    <script src="vendors/image-dropdown/jquery.dd.min.js"></script>
    <script src="vendors/animate-css/wow.min.js"></script>
    <script src="vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="vendors/bootstrap-selector/bootstrap-select.js"></script>
    <script src="vendors/bootstrap-datepicker/js/moment-with-locales.js"></script>
    <script src="vendors/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="vendors/counter-up/waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/tooltip/tooltip.js"></script>
    <script src="vendors/bs-tooltip/jquery.webui-popover.min.js"></script>
    <script src="vendors/progress-circle/circle-progress.min.js"></script>
    <script src="vendors/jquery-ui/jquery-ui.js"></script>


    <script src="js/video_player.js"></script>
    <script src="js/costome-circle.js"></script>
    <script src="js/theme.js"></script>



    <!-- hidden input js -->
    <script>
        function showFileInput(imgElement) {
            const fileInput = imgElement.nextElementSibling;
            if (fileInput && fileInput.type === "file") {
                fileInput.click(); // Triggers the file picker
            }
        }
    </script>




    <!-- user chat dynamically -->
    <script>
        const chatData = {
            aiden: [{
                    from: 'self',
                    text: 'Hi Aiden, how are you? How is the project coming along?',
                    time: '10:10 AM'
                },
                {
                    from: 'aiden',
                    text: 'Are we meeting today?',
                    time: '10:12 AM'
                },
                {
                    from: 'aiden',
                    text: 'Project has been already finished and I have results to show you.',
                    time: '10:15 AM'
                }
            ],
            mike: [{
                    from: 'self',
                    text: 'Hey Mike!',
                    time: '9:00 AM'
                },
                {
                    from: 'mike',
                    text: 'Good morning!',
                    time: '9:01 AM'
                }
            ],
            christian: [{
                from: 'christian',
                text: 'Ping me later today.',
                time: 'Yesterday'
            }],
            muneeb: [{
                from: 'muneeb',
                text: 'How are You dude',
                time: 'yesterday'
            }]


        };

        const chatBox = document.getElementById('chat-box');
        const chatUserName = document.getElementById('chat-user-name');
        const userList = document.getElementById('user-list');

        // Load chat on user click
        userList.addEventListener('click', function(e) {
            const li = e.target.closest('li[data-user]');
            if (!li) return;

            // Remove active from all, add to clicked
            userList.querySelectorAll('li').forEach(el => el.classList.remove('active'));
            li.classList.add('active');

            const userKey = li.getAttribute('data-user');
            loadChat(userKey);
        });

        function loadChat(user) {
            chatBox.innerHTML = ''; // clear old chat
            chatUserName.innerText = capitalize(user); // update name

            if (!chatData[user]) return;

            chatData[user].forEach(msg => {
                const div = document.createElement('div');
                div.className = 'message ' + (msg.from === 'self' ? 'other-message pull-right' : 'my-message');
                div.innerHTML = `
                <div class="message-data ${msg.from === 'self' ? 'text-right' : ''}">
                    <span class="message-data-time">${msg.time}</span>
                </div>
                ${msg.text}
            `;
                chatBox.appendChild(div);
            });
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        // Load initial chat
        loadChat('aiden');
        loadChat('christian');
        loadChat('muneeb')



        function loadChat(user) {
            chatUserName.innerText = capitalize(user);

            const ul = document.createElement('ul');
            ul.className = 'm-b-0 list-unstyled';
            ul.className = 'overflow-x:hidden'

            if (chatData[user]) {
                chatData[user].forEach(msg => {
                    const li = document.createElement('li');
                    li.className = 'clearfix';

                    const isSelf = msg.from === 'self';

                    li.innerHTML = `
                <div class="message-data ${isSelf ? 'text-right' : ''}">
                    <span class="message-data-time">${msg.time}</span>
                    ${isSelf ? '<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">' : ''}
                </div>
                <div class="message ${isSelf ? 'other-message pull-right' : 'my-message'}">
                    ${msg.text}
                </div>
            `;
                    ul.appendChild(li);
                });
            }

            chatBox.innerHTML = ''; // Clear old messages
            chatBox.appendChild(ul);
        }
    </script>

    <!-- user search quickly -->

    <script>
        // Get the input field and user list
        const searchInput = document.querySelector('.input-group input');
        const userLists = document.querySelector('#user-list');

        // Function to filter users
        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase(); // Get the search term
            const users = userLists.querySelectorAll('li'); // Get all the user list items
            let userFound = false; // Flag to check if any user is found

            // Loop through each user
            users.forEach(user => {
                const userName = user.querySelector('.name').textContent.toLowerCase(); // Get the user's name

                if (userName.includes(searchTerm)) {
                    user.style.display = ''; // Show the user
                    userFound = true;
                } else {
                    user.style.display = 'none'; // Hide the user if it doesn't match
                }
            });

            // If no user is found, show a "No users found" message
            if (!userFound && searchTerm !== '') {
                if (!document.querySelector('#no-user-found')) {
                    const noUserFoundMessage = document.createElement('li');
                    noUserFoundMessage.id = 'no-user-found';
                    noUserFoundMessage.textContent = 'No users found 😔';
                    noUserFoundMessage.style.color = 'red';


                    userLists.appendChild(noUserFoundMessage);
                }
            } else {
                const noUserFoundMessage = document.querySelector('#no-user-found');
                if (noUserFoundMessage) {
                    noUserFoundMessage.remove(); // Remove the "No users found" message if a user is found

                }
            }
        });
    </script>



</body>

</html>

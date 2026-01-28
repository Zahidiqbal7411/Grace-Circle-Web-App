<!-- navbar user login modal  -->
<div class="login_form_inner zoom-anim-dialog mfp-hide" id="small-dialog">
    <h4>User Login</h4>
    {{-- @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif --}}
    <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <div class="login_btn_area">
            <button type="submit" value="LogIn" class="btn form-control login_btn">LogIn</button>
            {{-- <div class="login_social">
                <h5>Login With</h5>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div> --}}
        </div>
    </form>
    <img class="mfp-close" src="{{ asset('img/close-btn.png') }}" alt="">
</div>


<!-- navbar Registration modal -->
<div class="register_form_inner zoom-anim-dialog mfp-hide" id="register_form">
    <div class="row">
        <div class="col-md-6">
            <div class="registration_man">
                <img class="registration-image" src="{{ asset('img/modal-registration-image.png') }}"
                    alt="image not found">
            </div>
        </div>
        <div class="col-md-6">
            <div class="registration_form_s">
                <h4>Registration</h4>












                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control" id="reg_email" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="reg_first" name="name" placeholder="Full Name"
                            value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="reg_user" name="country" placeholder="Country"
                            value="{{ old('country') }}">
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="reg_pass" name="password"
                            placeholder="Password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm Password">
                    </div>


                    <div style="padding: 10px; margin-bottom:15px; background-color:#f4f4f4;">
                        <label for="male" style="padding-right: 10px;">Gender</label>
                        <input type="radio" name="gender" value="male" id="male" style="margin-right: 5px;"
                            {{ old('gender') == 'male' ? 'checked' : '' }}>
                        <label for="male" style="padding-right: 10px;">Male</label>

                        <input type="radio" name="gender" value="female" id="female"
                            style="margin-left:15px; margin-right: 5px;"
                            {{ old('gender') == 'female' ? 'checked' : '' }}>
                        <label for="female" style="padding-right: 10px;">Female</label>

                        @error('gender')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="datepicker">
                            <input type='text' class="form-control datetimepicker4" name="birthday"
                                placeholder="Birthday" value="{{ old('birthday') }}">
                            <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        @error('birthday')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="reg_chose form-group">
                        {{-- <div class="reg_check_box">
                            <input type="radio" id="s-option" name="selector">
                            <label for="s-option">I`m Not Robot</label>
                            <div class="check">
                                <div class="inside"></div>
                            </div>
                        </div> --}}
                        <button type="submit" value="LogIn" class="btn form-control login_btn">Register</button>
                    </div>

                </form>
                <img class="mfp-close" src="{{ asset('img/close-btn.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
    <script>
        $(document).ready(function() {
            $.magnificPopup.open({
                items: {
                    src: '#register_form'
                },
                type: 'inline',
                closeOnBgClick: false
            });
        });
    </script>
@endif

<!--================First Main header Area =================-->
<header class="header_menu_area">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/grace_circle_logo.svg') }}"
                        alt="Grace Circle Logo" width="70" height="70"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown submenu active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Home</a>
                        <ul class="dropdown-menu">
                            <li><a href="index.html">Home 01</a></li>
                            <li><a href="index-2.html">Home 02</a></li>
                            <li><a href="index-3.html">Home 03</a></li>
                        </ul>
                    </li>
                    <li class="dropdown submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Blog</a>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Pages</a>
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
                <ul class="nav navbar-nav navbar-right" id="people_dropdown">
                    @guest
                        <li><a class="popup-with-zoom-anim" href="#small-dialog"><i class="mdi mdi-key-variant"></i>
                                Login</a></li>
                        <li><a href="#register_form" class="popup-with-zoom-anim"><i class="fa fa-user-plus"></i>
                                Registration</a></li>
                    @endguest

                    @auth
                        <li class="flag_drop d-flex align-items-center">
                            <div class="selector">
                                <select class="language_drop" name="select-action" id="select-action"
                                    onChange="handleAction(this)" style="height: 0px !important">
                                    <option value="" selected disabled>{{ Auth::user()->name }}</option>
                                    <option value="{{ route('members') }}">Find Match</option>
                                    <option value="">Inbox</option>
                                    <option value="{{ route('user.profile.edit', Auth::user()->id) }}">Profile</option>
                                    <option value="logout">Sign Out</option>
                                </select>

                                <!-- Hidden logout form -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth


                    <script>
                        function handleAction(selectElement) {
                            const value = selectElement.value;

                            if (value === 'logout') {
                                document.getElementById('logout-form').submit();
                            } else if (value) {
                                window.location.href = value;
                            }
                        }
                    </script>


                    <script>
                        // Handle dropdown change event
                        function handleAction(selectElement) {
                            const value = selectElement.value;

                            if (value === 'logout') {
                                document.getElementById('logout-form').submit();
                            } else if (value) {
                                window.location.href = value;
                            }
                        }

                        // Custom logout function (update user before logging out)
                        function customLogoutFunction() {
                            console.log('Logging out...');

                            // Make an AJAX request to update the user before logging out
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '/update-user-before-logout', true);
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content); // CSRF token

                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    console.log('User updated before logout');
                                    // Proceed with the logout process after the user is updated
                                }
                            };

                            // Send the request
                            xhr.send(JSON.stringify({
                                last_seen: new Date().toISOString()
                            }));
                        }

                        // Add onClick event to "Sign Out" option
                        document.getElementById('logout-option').addEventListener('click', function(event) {
                            // Prevent the default behavior (which is to change the dropdown selection)
                            event.preventDefault();

                            // Run custom logout function
                            customLogoutFunction();

                            // Submit the logout form
                            document.getElementById('logout-form').submit();
                        });
                    </script>

                </ul>
                @auth
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const peopleDropdown = document.getElementById('people_dropdown');
                            if (peopleDropdown) {
                                peopleDropdown.style.display = 'flex';
                                peopleDropdown.style.alignItems = 'center';
                                peopleDropdown.style.marginTop = '25px';
                            }
                        });
                    </script>
                @endauth

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
@if ($errors->has('email') || $errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Okay'
            });

            $.magnificPopup.open({
                items: {
                    src: '#small-dialog'
                },
                type: 'inline'
            });
        });
    </script>
@endif

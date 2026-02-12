@if(auth()->check() && !auth()->user()->hasVerifiedEmail() && !request()->routeIs('verification.notice'))
<div class="profile-alert-bar" style="background: #f39c12; border-bottom: 2px solid #e67e22; z-index: 10001;">
    <div class="container">
        <div class="profile-alert-content">
            <p class="profile-alert-text" style="color: white;">
                <i class="fa fa-envelope" style="color: white;"></i>
                📧 <strong>Verification Required!</strong> Please check your email to verify your account and unlock all features.
            </p>
            <a href="{{ route('verification.notice') }}" target="_blank" class="btn-complete-profile" style="background: white; color: #e67e22 !important; box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);">
                Resend Key <i class="fa fa-paper-plane ml-2"></i>
            </a>
        </div>
    </div>
</div>
@endif

@if(auth()->check() && auth()->user()->profile_status == 0 && auth()->user()->hasVerifiedEmail() && !request()->routeIs('verification.notice'))
<div class="profile-alert-bar">
    <div class="container">
        <div class="profile-alert-content">
            <p class="profile-alert-text">
                <i class="fa fa-sparkles text-warning"></i>
                ✨ <strong>Your profile is incomplete!</strong> Answer a few spiritual questions to unlock your full potential.
            </p>
            <button class="btn-complete-profile" data-toggle="modal" data-target="#completeProfileModal">
                Complete Now <i class="fa fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</div>

<!-- Complete Profile Modal -->
<div class="modal fade" id="completeProfileModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 100001;" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-heart"></i>
                    Complete Your Spiritual Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1; font-size: 30px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="profile-progress-wrapper">
                <div class="profile-progress-container">
                    <div class="profile-progress-bar" id="profileProgressBar"></div>
                </div>
                <span class="progress-text" id="progressText">0% Completed</span>
            </div>

            <form id="completeProfileForm">
                @csrf
                <div class="questions-container">
                    <div id="questionsList">
                        <!-- Questions will be loaded here via AJAX -->
                        <div class="text-center p-5">
                            <i class="fa fa-circle-notch fa-spin fa-3x" style="color: #667eea;"></i>
                            <h4 class="mt-4" style="color: #718096; font-weight: 600;">Preparing your spiritual journey...</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-save-profile" id="saveProfileBtn">
                        <span id="saveBtnText">Finalize & Unlock Profile <i class="fa fa-unlock-alt ml-2"></i></span>
                        <i class="fa fa-spinner fa-spin d-none" id="saveBtnLoader"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- navbar user login modal  -->
<div class="login_form_inner zoom-anim-dialog mfp-hide" id="small-dialog">
    <h4>User Login</h4>
    {{-- @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif --}}
    <form id="loginForm" action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_id" value="login">
        <input type="text" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <div class="login_btn_area">
            <button type="submit" id="loginBtn" class="btn form-control login_btn">
                <span id="loginBtnText">LogIn</span>
                <span id="loginBtnLoader" style="display:none;">
                    <i class="fa fa-spinner fa-spin"></i>
                </span>
            </button>
        </div>
    </form>
    <img class="mfp-close" src="{{ asset('img/close-btn.png') }}" alt="">
</div>


<!-- navbar Registration modal -->
<div class="register_form_inner zoom-anim-dialog mfp-hide" id="register_form">
    <div class="row">
        <div class="col-md-6">
            <div class="registration_man">
                <img class="registration-image" src="{{ asset('img/profile.png') }}"
                    alt="image not found">
            </div>
        </div>
        <div class="col-md-6">
            <div class="registration_form_s">
                <h4>Registration <small style="font-size: 10px; color: #ccc;">V2.0</small></h4>












                <form id="registrationForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form_id" value="register">

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

                        <input type="radio" name="gender" value="other" id="other"
                            style="margin-left:15px; margin-right: 5px;"
                            {{ old('gender') == 'other' ? 'checked' : '' }}>
                        <label for="other" style="padding-right: 10px;">Other</label>

                        @error('gender')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthday" style="color: #2f3c44; font-weight: bold; margin-bottom: 5px; display: block;">Birthday</label>

                        <input type='date' class="form-control" name="birthday" id="birthday"
                            placeholder="Birthday" value="{{ old('birthday') }}" 
                            max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                            style="background-color: #fff; line-height: 1.5; padding: 10px;">
                        @error('birthday')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <style>
                        .bootstrap-datetimepicker-widget {
                            z-index: 99999999 !important;
                            display: block !important; /* Ensure it's not hidden by some other CSS */
                        }
                    </style>


                    <div class="reg_chose form-group">
                        {{-- <div class="reg_check_box">
                            <input type="radio" id="s-option" name="selector">
                            <label for="s-option">I`m Not Robot</label>
                            <div class="check">
                                <div class="inside"></div>
                            </div>
                        </div> --}}

                        <!-- Dynamic Questions Section -->
                        <!-- @if(isset($questions) && $questions->count() > 0)
                            <div class="questions-section" style="margin-bottom: 20px; max-height: 250px; overflow-y: auto; padding: 15px; padding-bottom: 15px; background-color: #f9f9f9; border-radius: 5px; border: 1px solid #eee;">
                                <h5 style="margin-bottom: 15px; color: #2f3c44; font-weight: bold; font-size: 16px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">Profile Questions</h5>
                                @foreach($questions as $question)
                                    <div class="form-group" style="margin-bottom: 12px;">
                                        <label style="font-size: 13px; color: #555; margin-bottom: 5px; display: block;">
                                            {{ $question->question_text }}
                                            @if($question->is_required)
                                                <span style="color: red;">*</span>
                                            @endif
                                        </label>
                                        
                                        @if($question->question_type === 'select' && $question->options)
                                            <select name="questions[{{ $question->id }}]" class="form-control" {{ $question->is_required ? 'required' : '' }}>
                                                <option value="">Select an option</option>
                                                @foreach($question->options as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @elseif($question->question_type === 'textarea')
                                            <textarea name="questions[{{ $question->id }}]" class="form-control" rows="3" placeholder="Enter your answer..." {{ $question->is_required ? 'required' : '' }}></textarea>
                                        @elseif($question->question_type === 'radio' && $question->options)
                                            <div style="padding: 5px 0;">
                                                @foreach($question->options as $option)
                                                    <label style="margin-right: 15px; font-weight: normal; font-size: 13px;">
                                                        <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option }}" {{ $question->is_required ? 'required' : '' }}> {{ $option }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        @else
                                            <input type="text" name="questions[{{ $question->id }}]" class="form-control" placeholder="Enter your answer..." {{ $question->is_required ? 'required' : '' }}>
                                        @endif
                                        
                                        @error("questions.{$question->id}")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @endif -->

                        <button type="submit" id="registerBtn" class="btn form-control login_btn">
                            <span id="registerBtnText">Register</span>
                            <span id="registerBtnLoader" style="display:none;">
                                <i class="fa fa-spinner fa-spin"></i> Processing...
                            </span>
                        </button>
                    </div>

                </form>

                
                <img class="mfp-close" src="{{ asset('img/close-btn.png') }}" alt="">
            </div>
        </div>
    </div>
</div>


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
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formId = "{{ old('form_id', 'register') }}";
            var title = (formId === 'login') ? 'Login Failed' : 'Registration Failed';
            
            Swal.fire({
                icon: 'error',
                title: title,
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Okay',
                confirmButtonColor: '#e74c3c'
            });

            if (formId === 'login') {
                $.magnificPopup.open({
                    items: { src: '#small-dialog' },
                    type: 'inline'
                });
            } else {
                $.magnificPopup.open({
                    items: { src: '#register_form' },
                    type: 'inline',
                    closeOnBgClick: false
                });
            }
        });
    </script>
@endif

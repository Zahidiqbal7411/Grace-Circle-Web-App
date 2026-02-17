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
                        <li class="dropdown notifications-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" 
                               style="padding: 0 15px; position: relative; display: flex; align-items: center; height: 100%; transition: all 0.3s;">
                                <div style="position: relative;">
                                    <i class="fa fa-bell" style="font-size: 24px; color: #6C63FF; transition: transform 0.3s;"></i>
                                    @if(count($notifications) > 0)
                                        <span class="notification-badge" style="position: absolute; top: -8px; right: -8px; background: #FF4D4D; color: white; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; border: 2.5px solid white; box-shadow: 0 4px 10px rgba(255,77,77,0.4); animation: pulse 2s infinite;">{{ count($notifications) }}</span>
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu notification-list" style="width: 420px !important; padding: 0 !important; border-radius: 24px !important; overflow: hidden !important; box-shadow: 0 25px 60px rgba(0,0,0,0.2) !important; border: 1px solid rgba(108,99,255,0.1) !important; margin-top: 20px !important; left: auto !important; right: -50px !important; background: #ffffff !important;">
                                <li class="notification-header" style="background: #ffffff !important; padding: 22px 28px !important; border-bottom: 1px solid #f0f2f5 !important; display: flex !important; align-items: center !important; justify-content: space-between !important;">
                                    <span style="font-weight: 900 !important; color: #1a202c !important; font-size: 22px !important; letter-spacing: -0.7px !important;">Notifications</span>
                                    @if(count($notifications) > 0)
                                        <a href="{{ route('notifications.clear') }}" style="color: #6C63FF !important; font-size: 13px !important; font-weight: 700 !important; text-decoration: none !important; padding: 8px 16px !important; background: rgba(108,99,255,0.06) !important; border-radius: 30px !important; transition: all 0.3s !important;">Mark all as read</a>
                                    @endif
                                </li>
                                <div class="notification-scroll-area" style="max-height: 520px !important; overflow-y: auto !important; min-height: 300px !important;">
                                    @forelse($notifications as $notif)
                                        @php
                                            $sender = $notif->sender;
                                            $senderImg = $sender ? $sender->profile_image_url : asset('img/photo/photo-1.jpg');
                                        @endphp
                                        <li class="notification-item" style="transition: all 0.25s !important; border-bottom: 1px solid #f8f9fa !important;">
                                            <a href="{{ route('member.details', $notif->sender_id) }}" style="padding: 20px 28px !important; display: block !important; white-space: normal !important; color: #4a5568 !important; text-decoration: none !important; background: transparent !important;">
                                                <div style="display: flex !important; align-items: center !important; gap: 18px !important;">
                                                    <div style="position: relative !important; flex-shrink: 0 !important;">
                                                        <img src="{{ $senderImg }}" style="width: 60px !important; height: 60px !important; border-radius: 20px !important; object-fit: cover !important; box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important; border: 2px solid #fff !important;">
                                                        <div style="position: absolute !important; bottom: -4px !important; right: -4px !important; width: 24px !important; height: 24px !important; background: #6C63FF !important; border: 2.5px solid #fff !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 4px 8px rgba(108,99,255,0.3) !important;">
                                                            <i class="fa fa-user-plus" style="color: white !important; font-size: 11px !important;"></i>
                                                        </div>
                                                    </div>
                                                    <div style="flex: 1 !important;">
                                                        <p style="margin: 0 !important; font-size: 15px !important; line-height: 1.5 !important; color: #2d3748 !important; font-weight: 500 !important;">
                                                            <strong style="color: #1a202c !important; font-weight: 800 !important;">{{ $sender ? $sender->name : 'Someone' }}</strong> sent you a match request.
                                                        </p>
                                                        <span style="display: block !important; font-size: 12px !important; color: #a0aec0 !important; margin-top: 8px !important; font-weight: 600 !important; text-transform: uppercase; letter-spacing: 0.5px !important;">
                                                            <i class="fa fa-clock-o" style="margin-right: 5px !important; opacity: 0.7 !important;"></i>{{ $notif->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <div style="width: 12px !important; height: 12px !important; background: #6C63FF !important; border-radius: 50% !important; flex-shrink: 0 !important; box-shadow: 0 0 12px rgba(108,99,255,0.4) !important;"></div>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <div style="padding: 100px 40px !important; text-align: center !important;">
                                            <div style="width: 100px !important; height: 100px !important; background: #f8f9fb !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; margin: 0 auto 24px !important;">
                                                <i class="fa fa-bell-slash-o" style="font-size: 40px !important; color: #cbd5e0 !important;"></i>
                                            </div>
                                            <h4 style="margin: 0 !important; font-weight: 900 !important; color: #1a202c !important; font-size: 19px !important;">Perfectly caught up!</h4>
                                            <p style="margin: 10px 0 0 !important; color: #a0aec0 !important; font-size: 14px !important; line-height: 1.6 !important;">No new match requests or updates right now. Check back later!</p>
                                        </div>
                                    @endforelse
                                </div>
                                <li style="border-top: 1px solid #f0f2f5 !important; background: #fafbfc !important;">
                                    <a href="#" style="padding: 18px !important; display: block !important; color: #6C63FF !important; font-weight: 800 !important; font-size: 14px !important; text-align: center !important; text-decoration: none !important; transition: all 0.3s !important;">See all notifications</a>
                                </li>
                                <style>
                                    @keyframes pulse {
                                        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.7); }
                                        70% { transform: scale(1.1); box-shadow: 0 0 0 12px rgba(255, 77, 77, 0); }
                                        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 77, 77, 0); }
                                    }
                                    .notification-item:hover { background: #f8faff !important; transform: scale(0.99); }
                                    .notification-scroll-area::-webkit-scrollbar { width: 6px; }
                                    .notification-scroll-area::-webkit-scrollbar-track { background: #f1f1f1; }
                                    .notification-scroll-area::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 10px; }
                                    .notification-scroll-area::-webkit-scrollbar-thumb:hover { background: #a0aec0; }
                                    .notifications-dropdown:hover .fa-bell { animation: bellShake 0.5s ease; }
                                    @keyframes bellShake {
                                        0% { transform: rotate(0); }
                                        25% { transform: rotate(15deg); }
                                        50% { transform: rotate(-15deg); }
                                        75% { transform: rotate(10deg); }
                                        100% { transform: rotate(0); }
                                    }
                                </style>
                            </ul>
                        </li>

                        <li class="flag_drop d-flex align-items-center">
                            <div class="selector">
                                <select class="language_drop" name="select-action" id="select-action"
                                    onChange="handleAction(this)" style="height: 0px !important">
                                    <option value="" selected disabled>{{ Auth::user()->name }}</option>
                                    <option value="{{ route('members') }}">Find Match</option>
                                    <option value="{{ route('chat') }}">Inbox</option>
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

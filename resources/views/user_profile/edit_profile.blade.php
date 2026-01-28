@extends('layouts.app')

@section('styles')
    <style>
        .members_profile_inners .profile_list ul:nth-child(2) {
            display: inline-block;
            padding-left: 0px;
        }

        .user-tabcontent {
            font-size: 13px;
        }

        .members_profile_inners .profile_list ul:last-child {
            padding-left: 0px;
        }

        #user_img img {
            width: 100% !important;
            object-fit: cover !important;

        }

        #members_about_box {
            margin-top: 40px;
        }

        .blog-left-side-images ul {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 0;
            list-style: none;
            padding: 10px 0px 10px 0px;
        }

        .blog-left-side-images li {
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 6px;
            width: 80px !important;
            text-align: center;
        }

        .blog-left-side-images img {
            width: 100%;
            height: auto;
            cursor: pointer;
            border-radius: 8px;
        }

        .profile_list ul input {
            border: none !important;
            font-weight: bold;
        }

        .gender-cat label,
        input {
            font-weight: bold !important;
            font-size: 16px;
            margin-top: 1px;
        }

        .profile_list label {
            font-weight: normal;
            font-size: 16px;
        }


        .info-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-list label {
            width: 150px;
            margin-right: 10px;
        }

        .info-list input[type="text"] {
            flex: 1;
            padding: 5px;
        }



        /* media queries  */
        .login-btn {
            width: 160px;
            height: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 25px;
            color: #fff;
            font-size: 16px;
            font-family: "Ubuntu", sans-serif;
            font-weight: 500;
            position: relative;
            z-index: 2;
            outline: none !important;
            box-shadow: none !important;
            border: none;
            background: transparent;
            vertical-align: middle;
        }

        .login-btn:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .login-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: #e74c3c;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            border-radius: 25px;
        }

        .login-btn:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            border: 1px solid #e74c3c;
            -webkit-transform: scale(1.2, 1.2);
            -ms-transform: scale(1.2, 1.2);
            transform: scale(1.2, 1.2);
            border-radius: 25px;
        }

        .login-btn:hover {
            color: #e74c3c;
        }

        .login-btn:hover:before {
            opacity: 0;
            -webkit-transform: scale(0.5, 0.5);
            -ms-transform: scale(0.5, 0.5);
            transform: scale(0.5, 0.5);
        }

        .login-btn:hover:after {
            opacity: 1;
            -webkit-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            transform: scale(1, 1);
        }


        @media (max-width: 768px) {
            .info-list {
                width: 100% !important;
            }

            .profile_list>div {
                flex-direction: column !important;
                gap: 20px;
            }

            .right-sideInfo {
                width: 100% !important;
            }

            .info-list input[type="text"],
            .info-list input[type="date"],
            .info-list input[type="radio"] {
                width: 100%;
                max-width: 100%;
                padding: 8px;
                margin-top: 4px;
                box-sizing: border-box;
            }

            /* Ensure label does not overlap input */
            .info-list label {
                display: block;
                margin-bottom: 4px;
                font-weight: 500;
            }

            /* Adjust radio buttons layout */
            .gender-cat input[type="radio"] {
                width: auto;
                font-weight: bold !important;
            }

            /* Optional: Reset form spacing */
            .info-list li {
                margin-bottom: 15px;
            }

        }
    </style>
@endsection



@section('content')
    @php
        $profileImage = $user->galleries->where('image_type', 'profile')->first();
        $coverImage = $user->galleries->where('image_type', 'cover')->first();
        $galleryImages = $user->galleries->where('image_type', 'gallery');
    @endphp
    <section class="banner_area profile_banner"
        style="background: url('{{ $coverImage ? asset($coverImage->image_path) : asset('img/videoera-bg.jpg') }}') no-repeat scroll top center ; background-size:cover; ">


        <div class="profiles_inners">
            <div class="container">
                <div class="profile_content">
                    <div class="user_img">
                        <img class="img-circle"
                            src="{{ $profileImage ? asset($profileImage->image_path) : asset('img/videoera-bg.jpg') }}"
                            alt="image not found" width="200px" height="200px" style="margin-top: 40px;">

                    </div>
                    <div class="user_name">
                        <h3 id="user_full_name">{{ $user->name }}</h3>

                        <h4 id="response_age">{{ $user->age }} Years Old</h4>
                        <ul>
                            <li><a href="#"><span id="user_country">{{ $user->country }}</span>, <span
                                        id="user_city">{{ $user->city }}</span></a></li>
                            <li class="dropdown extara">
                                {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">80% Match</a>
                                <ul class="dropdown-menu">
                                    <li>Match</li>
                                    <li>
                                        <div class="circle1">
                                            <strong></strong>
                                        </div>
                                        <h4>Match</h4>
                                    </li>
                                    <li>
                                        <div class="circle2">
                                            <strong></strong>
                                        </div>
                                        <h4>Enemy</h4>
                                    </li>
                                </ul> --}}
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="right_side_content">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Another action</a></li>
                                </ul>
                            </li>
                        </ul>
                         <button type="submit" value="LogIn" class="btn form-control login_btn">Add Friend <img
                                src="{{ asset('img/user.png') }}" alt=""></button>
                        <button type="submit" value="LogIn" class="btn form-control login_btn">Chat Now <img
                                src="{{ asset('img/comment.png') }}" alt=""></button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <!--================Blog grid Area =================-->
    <section class="blog_grid_area">
        <div class="container">
            <div class="row">
                <!-- right side data -->
                <div class="col-md-9">
                    <div class="members_profile_inners  " style="margin-top: 10px;">

                        <div class="tab-content user-tabcontent">
                            <!-- Profile Tab -->





















                            <div role="tabpanel" class="tab-pane active fade in" id="profile">
                                <form class="profile_list">
                                    <div style="display: flex; gap: 35px;">
                                        <div class="right-sideInfo d-flex align-items-center">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <ul class="info-list">
                                                        <li>
                                                            <label for="age2">Full Name</label>
                                                            <input type="text" id="name2" name="name"
                                                                value="{{ $user->name }}" />
                                                        </li>
                                                        <li>
                                                            <label for="age2">Email</label>
                                                            <input type="email" id="email2" name="email"
                                                                value="{{ $user->email }}" />
                                                        </li>
                                                        <li class="gender-cat">
                                                            <label for="gender2">Gender</label>
                                                            <input type="radio" name="gender" value="male"
                                                                {{ $user->gender == 'male' ? 'checked' : '' }} /> Male
                                                            <input type="radio" name="gender" value="female"
                                                                {{ $user->gender == 'female' ? 'checked' : '' }}
                                                                style="margin-left: 20px;" /> Female
                                                        </li>
                                                        <li>
                                                            <label for="age2">Age</label>
                                                            <input type="text" id="age2" name="age"
                                                                value="{{ $user->age }}" />
                                                        </li>


                                                        <li>
                                                            <label for="country2">Country</label>
                                                            <input type="text" id="country2" name="country"
                                                                value="{{ $user->country }}" />
                                                        </li>

                                                        <li>
                                                            <label for="city2">City</label>
                                                            <input type="text" id="city2" name="city"
                                                                value="{{ $user->city ?: 'Peshawar' }}" />
                                                        </li>

                                                        <li>
                                                            <label for="birthday2">Birthday</label>
                                                            <input type="date" id="birthday2" name="birthday"
                                                                value="{{ \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}" />
                                                        </li>

                                                        <li>
                                                            <label for="relationship2">Relationship</label>
                                                            <input type="text" id="relationship2"
                                                                name="relationship_status"
                                                                value="{{ $user->relationship_status ?: 'Single' }}" />

                                                        </li>

                                                        <li>
                                                            <label for="looking_for2">Looking for a</label>
                                                            <input type="text" id="looking_for2" name="looking_for"
                                                                value="{{ $user->gender == 'male' ? 'female' : 'male' }}"
                                                                readonly />
                                                        </li>



                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="right-sideInfo d-flex align-items-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="info-list">
                                                        <li>
                                                            <label for="work_as2">Work as</label>
                                                            <input type="text" id="work_as2" name="work_as"
                                                                value="{{ $user->work_as ?: 'Developer' }}" />
                                                        </li>
                                                        <li>
                                                            <label for="education2">Education</label>
                                                            <input type="text" id="education2" name="education"
                                                                value="{{ $user->education ?: 'Graduate Degree' }}" />
                                                        </li>
                                                        <li>
                                                            <label for="know2">Languages</label>
                                                            @php
                                                                $languages_array = json_decode($user->languages, true); // Decode JSON into array
                                                                $languages_imploded = is_array($languages_array)
                                                                    ? implode(', ', $languages_array)
                                                                    : '';
                                                            @endphp

                                                            <input type="text" id="know2" name="languages"
                                                                value="{{ $languages_imploded }}" />
                                                        </li>
                                                        <li>
                                                            <label for="interests2">Interests</label>
                                                            <input type="text" id="interests2" name="interests"
                                                                value="{{ $user->interests }}" />
                                                        </li>
                                                        <li>
                                                            <label for="smoking2">Smoking</label>
                                                            <input type="text" id="smoking2" name="smoking"
                                                                value="{{ $user->smoking }}" />
                                                        </li>
                                                        <li>
                                                            <label for="eye_color2">Eye Color</label>
                                                            <input type="text" id="eyecolor2" name="eye_color"
                                                                value="{{ $user->eye_color }}" />
                                                        </li>
                                                        <li>
                                                            <label for="eye_color2">Religion</label>
                                                            <input type="text" id="eyecolor2" name="religion"
                                                                value="{{ $user->religion ?: 'Islam' }}" />
                                                        </li>
                                                        <li>
                                                            <label for="marital_status2">Cast</label>
                                                            <select name="cast" class="form-control"
                                                                style="border: transparent;">
                                                                <option value="" disabled selected>Select your
                                                                    caste/sect
                                                                </option>
                                                                @foreach (get_islamic_casts() as $cast)
                                                                    <option value="{{ $cast }}">
                                                                        {{ $cast }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

































                        </div>

                    </div>
                </div>


                <!-- left side items -->
                <div class="col-md-3">
                    <div class="right_sidebar_area">
                        <aside class="s_widget photo_widget">
                            <div class="s_title">
                                <h4>Photo</h4>
                                <img src="{{ asset('img/widget-title-border.png') }}" alt="">
                            </div>


                            <div class="blog-left-side-images">
                                <ul>
                                    {{-- Profile image --}}
                                    <li>
                                        <img src="{{ $profileImage ? asset($profileImage->image_path) : asset('img/photo/photo-1.jpg') }}"
                                            alt="Profile" onclick="showFileInput(this)">
                                        <input type="file" class="photo-hidden-input" id="profile"
                                            style="display: none;">
                                    </li>

                                    {{-- Cover image --}}
                                    <li>
                                        <img src="{{ $coverImage ? asset($coverImage->image_path) : asset('img/photo/photo-2.jpg') }}"
                                            alt="Cover" onclick="showFileInput(this)">
                                        <input type="file" class="photo-hidden-input" id="cover"
                                            style="display: none;">
                                    </li>

                                    {{-- Gallery images (up to 7 slots) --}}
                                    @foreach ($galleryImages->take(7) as $gallery)
                                        <li>
                                            <img src="{{ asset($gallery->image_path) }}" alt="Gallery"
                                                onclick="showFileInput(this)">
                                            <input type="file" class="photo-hidden-input gallery"
                                                style="display: none;">
                                        </li>
                                    @endforeach

                                    {{-- Fill empty gallery slots (if less than 7 images) --}}
                                    @for ($i = $galleryImages->count(); $i < 7; $i++)
                                        <li>
                                            <img src="{{ asset('img/photo/photo-3.jpg') }}" alt="Gallery"
                                                onclick="showFileInput(this)">
                                            <input type="file" class="photo-hidden-input gallery"
                                                style="display: none;">
                                        </li>
                                    @endfor
                                </ul>
                            </div>


                        </aside>
                    </div>
                </div>


            </div>
            <!-- about contents -->
            <div class="row profile_list">
                <div class="col-12 members_about_box" id="members_about_box" style="max-width: 1160px;">
                    <label for="about" class="form-label" style="margin-left: 10px;">About me</label>
                    <textarea rows="6"
                        style="width: 100%; white-space: pre-wrap; border: 4px solid #e0e0e0;
                 border-radius: 8px; margin-left:8px;padding:6px;"
                        placeholder="Enter Your Description" name="about_us">{{ $user->about_us }}</textarea>
                </div>
            </div>

        </div>
    </section>
@endsection


<!-- hidden input js -->
@section('scripts')
    <script>
        function showFileInput(imgElement) {
            const fileInput = imgElement.nextElementSibling;
            if (fileInput && fileInput.type === "file") {
                fileInput.click(); // Triggers the file picker

                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        uploadImage(fileInput, file);
                    }
                }, {
                    once: true
                }); // `once:true` ensures single listener
            }
        }

        function uploadImage(fileInput, file) {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('image', file);

            let imageType = '';
            if (fileInput.id === 'profile') {
                imageType = 'profile';
            } else if (fileInput.id === 'cover') {
                imageType = 'cover';
            } else if (fileInput.classList.contains('gallery')) {
                imageType = 'gallery';
            }

            formData.append('image_type', imageType);
            formData.append('user_id', '{{ auth()->id() }}');

            $.ajax({
                url: "{{ route('gallery.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {


                    // Optional preview update
                    fileInput.previousElementSibling.src = response.new_image_url;
                    if (imageType === 'profile') {
                        document.querySelector('.user_img img').src = response.new_image_url;
                    }
                    if (imageType === 'cover') {
                        document.querySelector('.banner_area.profile_banner').style.background =
                            `url('${response.new_image_url}') no-repeat scroll top center `;
                        document.querySelector('.banner_area.profile_banner').style.backgroundSize = 'cover';
                    }

                },
                error: function(xhr) {
                    console.error('Upload error:', xhr.responseText);
                    alert('Upload failed!');
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            function autoSave(fieldName, fieldValue) {
                $.ajax({
                    url: "{{ route('user.profile.autosave') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        field: fieldName,
                        value: fieldValue
                    },
                    success: function(response) {
                        if (response.data.name) {
                            $('#user_full_name').text(response.data.name);
                        }

                        if (response.data.age) {
                            $('#response_age').text(response.data.age + ' Years Old');
                        }
                        if (response.data.country) {
                            $('#user_country').text(response.data.country); // Update country
                        }

                        if (response.data.city) {
                            $('#user_city').text(response.data.city); // Update city
                        }
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }

            // On input blur - normal fields
            $('.profile_list input, .profile_list textarea').on('blur', function() {
                var input = $(this);
                var fieldName = input.attr('name');
                var fieldValue = input.val();

                // If field is age, filter only numbers
                if (fieldName === 'age') {
                    // Remove any non-numeric characters
                    fieldValue = fieldValue.replace(/\D/g, '');
                    input.val(fieldValue); // Update the input value to cleaned version
                }

                autoSave(fieldName, fieldValue);
            });

            // On gender radio change
            $('input[name="gender"]').on('change', function() {
                var genderValue = $(this).val();
                var lookingForValue = (genderValue === 'male') ? 'female' : 'male';

                // Set looking_for input
                $('#looking_for2').val(lookingForValue);

                // Auto-save both gender + looking_for
                autoSave('gender', genderValue);
                autoSave('looking_for', lookingForValue);
            });

            // On cast dropdown change
            $('select[name="cast"]').on('change', function() {
                var castValue = $(this).val(); // Get the selected value
                autoSave('cast', castValue); // Auto-save the selected caste/sect
            });

        });
    </script>
@endsection

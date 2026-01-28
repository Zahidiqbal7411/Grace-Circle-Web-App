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



        .gender-cat label,
        input {
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
            width: 230px;
            margin-right: 10px;
        }

        .info-list span {
            width: 100%;
            font-weight: bold;
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

            #add_friend {
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

            #add_friend:focus {
                outline: none !important;
                box-shadow: none !important;
            }

            #add_friend:before {
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

            #add_friend:after {
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

            #add_friend:hover {
                color: #e74c3c;
            }

            #add_friend:hover:before {
                opacity: 0;
                -webkit-transform: scale(0.5, 0.5);
                -ms-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
            }

            #add_friend:hover:after {
                opacity: 1;
                -webkit-transform: scale(1, 1);
                -ms-transform: scale(1, 1);
                transform: scale(1, 1);
            }














            #cancel_friend {
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

            #cancel_friend:focus {
                outline: none !important;
                box-shadow: none !important;
            }

            #cancel_friend:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                background-color: #4ae73c !important;
                -webkit-transition: all 0.3s;
                -moz-transition: all 0.3s;
                -o-transition: all 0.3s;
                transition: all 0.3s;
                border-radius: 25px;
            }

            #cancel_friend:after {
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
                border: 1px solid #4ae73c !important;
                -webkit-transform: scale(1.2, 1.2);
                -ms-transform: scale(1.2, 1.2);
                transform: scale(1.2, 1.2);
                border-radius: 25px;
            }

            #cancel_friend:hover {
                color: #4ae73c !important;
            }

            #cancel_friend:hover:before {
                opacity: 0;
                -webkit-transform: scale(0.5, 0.5);
                -ms-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
            }

            #cancel_friend:hover:after {
                opacity: 1;
                -webkit-transform: scale(1, 1);
                -ms-transform: scale(1, 1);
                transform: scale(1, 1);
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
                        <h3>{{ $user->name }}</h3>
                        <h4>{{ $user->age }} years old</h4>
                        <ul>
                            <li><a href="#">{{ $user->country }}, {{ $user->city }}</a></li>
                            <!-- <li class="dropdown extara">
                                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">80% Match</a>
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
                                                                                                </ul>
                                                                                            </li> -->
                        </ul>
                    </div>
                    <div class="right_side_content">
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

















                        @php
                            use App\Models\Friend;
                            use Illuminate\Support\Facades\Auth;
                            $authId = Auth::id();
                            $userId = $user->id;

                            $requestSent = Friend::where('request_from', $authId)
                                ->where('request_to', $userId)
                                ->where('accept', 0)
                                ->first();

                            $requestReceived = Friend::where('request_from', $userId)
                                ->where('request_to', $authId)
                                ->where('accept', 0)
                                ->first();

                            $isFriend = Friend::where('accept', 1)
                                ->where(function ($query) use ($authId, $userId) {
                                    $query
                                        ->where(function ($q) use ($authId, $userId) {
                                            $q->where('request_from', $authId)->where('request_to', $userId);
                                        })
                                        ->orWhere(function ($q) use ($authId, $userId) {
                                            $q->where('request_from', $userId)->where('request_to', $authId);
                                        });
                                })
                                ->first();
                        @endphp

                        @if ($isFriend)
                            <a href="{{ route('chat.create') }}" class="btn login-btn">Chat Now <img src="img/comment.png"
                                    alt=""></a>
                            <a href="{{ route('user.block', $user->id) }}" class="btn login-btn">Block <img
                                    src="img/comment.png" alt=""></a>
                        @elseif ($requestSent)
                            <a href="{{ route('cancel.request', ['id' => $requestSent->id, 'user_id' => $user->id]) }}"
                                class="btn form-control login-btn">Cancel Request</a>
                        @elseif ($requestReceived)
                            <a href="{{ route('accept.request', ['id' => $requestReceived->id, 'user_id' => $user->id]) }}"
                                class="btn form-control login-btn">Accept Request</a>

                            <a href="{{ route('cancel.request', ['id' => $requestReceived->id, 'user_id' => $user->id]) }}"
                                class="btn form-control login-btn">Reject Request</a>
                        @else
                            <a href="{{ route('add.friend', $user->id) }}" class="btn form-control login-btn">Add
                                Friend</a>
                        @endif





                    </div>
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
                                    <div style="display: flex; gap: 80px;">
                                        <div class="right-sideInfo d-flex align-items-center">
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <ul class="info-list">
                                                        <li>
                                                            <label for="name">Full name</label>
                                                            <span>{{ $user->name }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="email">Email</label>
                                                            <span>{{ $user->email }}</span>
                                                        </li>

                                                        <li class="gender-cat">
                                                            <label for="gender2">Gender</label>
                                                            <span>{{ $user->gender }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="age2">Age</label>
                                                            <span>{{ $user->age }} Years Old</span>
                                                        </li>

                                                        <li>
                                                            <label for="country2">Country</label>
                                                            <span>{{ $user->country }}</span>
                                                        </li>

                                                        <li>
                                                            <label for="city2">City</label>
                                                            <span>{{ $user->city }}</span>
                                                        </li>

                                                        <li>
                                                            <label for="birthday2">Birthday</label>
                                                            <span>{{ $user->birthday }}</span>
                                                        </li>

                                                        <li>
                                                            <label for="relationship2">Relationship</label>
                                                            <span>{{ $user->relationship_status }}</span>

                                                        </li>

                                                        <li>
                                                            <label for="looking_for2">Looking for a</label>
                                                            <span>Man</span>
                                                        </li>

                                                        <li>
                                                            <label for="work_as2">Work as</label>
                                                            <span>{{ $user->work_as }}</span>
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
                                                            <label for="education2">Education</label>
                                                            <span>{{ $user->education }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="know2">Languages</label>
                                                            <span>{{ $user->languages }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="interests2">Interests</label>
                                                            <span>{{ $user->interests }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="smoking2">Smoking</label>
                                                            <span>{{ $user->smoking }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="eye_color2">Eye Color</label>
                                                            <span>{{ $user->eye_color }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="eye_color2">Religion</label>
                                                            <span>{{ $user->religion }}</span>
                                                        </li>
                                                        <li>
                                                            <label for="eye_color2">Cast</label>
                                                            <span>{{ $user->cast }}</span>
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
                                            alt="Profile">

                                    </li>

                                    {{-- Cover image --}}
                                    <li>
                                        <img src="{{ $coverImage ? asset($coverImage->image_path) : asset('img/photo/photo-2.jpg') }}"
                                            alt="Cover">

                                    </li>

                                    {{-- Gallery images (up to 7 slots) --}}
                                    @foreach ($galleryImages->take(7) as $gallery)
                                        <li>
                                            <img src="{{ asset($gallery->image_path) }}" alt="Gallery">

                                        </li>
                                    @endforeach

                                    {{-- Fill empty gallery slots (if less than 7 images) --}}
                                    @for ($i = $galleryImages->count(); $i < 7; $i++)
                                        <li>
                                            <img src="{{ asset('img/photo/photo-3.jpg') }}" alt="Gallery">

                                        </li>
                                    @endfor
                                </ul>
                            </div>


                        </aside>
                    </div>
                </div>

            </div>
            <!-- about contents -->
            <div class="row">
                <div class="col-12 members_about_box" id="members_about_box" style="max-width: 1160px;">
                    <label for="about" class="form-label" style="margin-left: 10px;">About me</label>
                    <textarea rows="6" readonly
                        style="width: 100%; white-space: pre-wrap; border: 4px solid #e0e0e0;
                 border-radius: 8px; margin-left:8px;padding:6px;"
                        placeholder="Enter Your Description">{{ $user->about_us }}</textarea>
                </div>
            </div>

        </div>



    </section>
@endsection


@section('scripts')
@endsection

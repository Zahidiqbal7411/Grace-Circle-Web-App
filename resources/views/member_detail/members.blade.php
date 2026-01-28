@extends('layouts.app')

@section('styles')
    <style>
        .search_items {
            display: flex;
            align-items: center;
            gap: 10px;
            /* space between label and input */
        }

        .search_items h5 {
            margin-bottom: 0;
            font-size: 14px;
            color: #333;
        }

        .styled-input {
            /* width: 200px; */
            height: 50px;
            padding: 0 12px;
            border: none;
            border-radius: 999px;
            /* fully rounded */
            background-color: #f5f5f5;
            text-align: center;
            font-size: 16px;
            outline: none;
            appearance: none;
            /* removes default arrows (optional) */
        }

        /* Optional: Show number arrows only on hover (optional aesthetic) */
        .styled-input::-webkit-outer-spin-button,
        .styled-input::-webkit-inner-spin-button {
            opacity: 1;
        }

        /* Remove number input arrows for cleaner look — optional */
        .styled-input.no-arrows::-webkit-outer-spin-button,
        .styled-input.no-arrows::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .styled-input.no-arrows {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>
@endsection

@section('content')
    <section class="banner_area banner_area2"
            style="
        background-image: url({{ asset('img/member_header.jpeg') }});
        background-repeat: no-repeat;
        background-position: top center;
        background-size: cover;">

        <div class="container">
            <div class="banner_content">
                <h3 title="Members"><img class="left_img" src="img/banner/t-left-img.png" alt="">Members<img
                        class="right_img" src="img/banner/t-right-img.png" alt=""></h3>
                <a href="index.html">Home</a>
                <a href="">Community</a>
                <a href="blog.html">Members</a>
                <div class="advanced_search">
                    <div class="search_inner">
                        <div class="search_item">
                            <h5>I am a</h5>
                            <select class="selectpicker" id="i_am" name="i_am">
                                <option>{{ Auth::user()->gender }}</option>
                            </select>
                        </div>

                        <div class="search_item">
                            <h5>Seeking a</h5>
                            <select class="selectpicker" id="seeking" name="seeking">
                                @if (Auth::user()->gender == 'male')
                                    <option value="female">Women</option>
                                @else
                                    <option value="male">Male</option>
                                @endif
                            </select>
                        </div>

                        <div class="search_items" style="display: inline-flex; align-items: center;">
                            <h5 style="margin: 0; white-space: nowrap;">From</h5>
                            <input type="number" class="styled-input form-control" id="from_age" name="from_age"
                                placeholder="Age" style="width:140px !important; ">
                        </div>



                        <div class="search_items" style="display: inline-flex; align-items: center;">
                            <h5 style="margin: 0; white-space: nowrap;">To</h5>
                            <input type="number" class="styled-input form-control" id="to_age" name="to_age"
                                placeholder="Age" style="width:140px !important; ">
                        </div>






                        <div class="search_item">
                            <button type="button" id="searchBtn" class="btn form-control login_btn">Search</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <!--================Active Memebers Area =================-->




    <!--================All Members Area =================-->
    <section class="all_members_area">
        <div class="container">
            <div class="welcome_title">
                <h3>All Members</h3>
                <img src="img/w-title-b.png" alt="">
            </div>
            {{-- <div class="row" id="serach_members">
                @if ($users->isNotEmpty())
                    @foreach ($users as $user)
                        <a href="{{ route('member.details', $user->id) }}">
                            <div class="col-sm-2 col-xs-6">
                                <div class="all_members_item">
                                    @php
                                        $profileImage = $user->galleries->where('image_type', 'profile')->first();
                                    @endphp

                                    <img height="170px" width="170px"
                                        src="{{ $profileImage ? asset($profileImage->image_path) : asset('img/photo/photo-1.jpg') }}"
                                        alt="Profile">

                                    <h4>{{ $user->name }}</h4>
                                    <h5>{{ $user->age }} years old</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h1 class="text-center mb-3">No match found.</h1>
                @endif




            </div> --}}



            <div class="row" id="serach_members">
                @if ($users->isNotEmpty())
                    @foreach ($users as $user)
                        @php
                            $blockedByMe = \App\Models\Block::where('block_by', Auth::id())
                                ->where('block_user', $user->id)
                                ->exists();

                            $blockedMe = \App\Models\Block::where('block_by', $user->id)
                                ->where('block_user', Auth::id())
                                ->exists();
                        @endphp

                        <a href="{{ route('member.details', $user->id) }}"
                            @if ($blockedByMe || $blockedMe) onclick="handleBlockedClick(event, {{ $blockedByMe ? 1 : 0 }}, {{ $blockedMe ? 1 : 0 }}, '{{ $user->name }}', '{{ route('unblock.user', $user->id) }}')" @endif>
                            <div class="col-sm-2 col-xs-6">
                                <div class="all_members_item text-center">
                                    @php
                                        $profileImage = $user->galleries->where('image_type', 'profile')->first();
                                    @endphp

                                    <img height="170px" width="170px"
                                        src="{{ $profileImage ? asset($profileImage->image_path) : asset('img/photo/photo-1.jpg') }}"
                                        alt="Profile">

                                    <h4>{{ $user->name }}</h4>
                                    <h5>{{ $user->age }} years old</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h1 class="text-center mb-3">No match found.</h1>
                @endif
            </div>

            {{-- Global script to handle block clicks --}}
            <script>
                function handleBlockedClick(event, blockedByMe, blockedMe, userName, unblockUrl) {
                    event.preventDefault(); // Stop link

                    if (blockedByMe) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'User Blocked',
                            html: 'You have blocked <b>' + userName + '</b>.<br><a href="' + unblockUrl +
                                '" class="btn btn-sm btn-primary mt-2">Click here to unblock</a>',
                            showConfirmButton: false,
                            allowOutsideClick: true
                        });
                    } else if (blockedMe) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Access Restricted',
                            text: 'This page is restricted or blocked.',
                            showConfirmButton: false,
                            allowOutsideClick: true
                        });
                    }
                }
            </script>


            <a href="#" class="register_angkar_btn" style="margin-top: 15px;">View More</a>
        </div>
    </section>
    <!--================End All Members Area =================-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#searchBtn').click(function(e) {
                e.preventDefault();
                $('.register_angkar_btn').text('Reset'); // clear text — OR put desired text inside quotes
                $('.register_angkar_btn').attr('href', '{{ route('members') }}');
                // Get all input values
                var i_am = $('#i_am').val();
                var seeking = $('#seeking').val();
                var from_age = $('#from_age').val();
                var to_age = $('#to_age').val();

                // Send AJAX to Laravel route
                $.ajax({
                    url: '{{ route('search.members') }}', // using the route name here
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        i_am: i_am,
                        seeking: seeking,
                        from_age: from_age,
                        to_age: to_age
                    },
                    success: function(response) {
                        // Clear the previous search results
                        $('#serach_members').html('');

                        // Check if the response contains users
                        if (response.length > 0) {
                            // Loop through the response (array of users)
                            response.forEach(function(user) {
                                // Get the first profile image, if available
                                var profileImage = user.galleries && user.galleries
                                    .length > 0 ?
                                    user.galleries.find(gallery => gallery
                                        .image_type === 'profile')?.image_path :
                                    'img/photo/photo-1.jpg';

                                // Construct the user item HTML
                                var userHtml = `
                                <a href="{{ route('member.details', '') }}/${user.id}">
                                    <div class="col-sm-2 col-xs-6">
                                        <div class="all_members_item">
                                            <img height="170px" width="170px" src="{{ asset('${profileImage}') }}" alt="Profile">
                                            <h4>${user.name}</h4>
                                            <h5>${user.age} years old</h5>
                                        </div>
                                    </div>
                                </a>
                            `;

                                // Append the user HTML to the results container
                                $('#serach_members').append(userHtml);
                            });
                        } else {
                            // If no users found, show the "No match found" message
                            $('#serach_members').html(
                                '<h1 class="text-center mb-3">No match found.</h1>');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',

                timerProgressBar: true
            });
        </script>
    @endif
@endsection

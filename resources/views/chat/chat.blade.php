@extends('layouts.app')



@section('styles')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .chat {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .chat .chat-history {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .chat .chat-message {
            padding: 20px;
            background-color: #fff;
        }

        .chat-header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #fff;
            padding: 15px 20px;
        }

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
            width: 903px;
            margin-left: 280px;
            border-left: 1px solid #eaeaea;
            height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .chat-app .chat::-webkit-scrollbar {
            width: 6px;
        }

        .chat-app .chat::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-app .chat::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 3px;
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

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            height: auto !important;
            height: calc(100vh - 120px);

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


        .other-message {
            background: #e8f1f3;
            text-align: right;
            word-wrap: break-word;
            white-space: normal;
            overflow-wrap: break-word;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            position: relative;
            max-width: 50%;
        }


        .chat .chat-history .message-data {
            margin-bottom: 15px;
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px;
            margin-top: -10px !important;
            display: block;
            font-size: 10px;
        }

        .chat .chat-history .message {
            color: #444;
            padding: 3px 16px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative;
            height: auto !important;
            word-wrap: break-word !important;
            white-space: normal !important;

            max-width: 50%;

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
            margin-left: -10px;
        }

        .chat .chat-history .my-message {
            background: #efefef;
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
            margin-left: -10px;

        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right;
            height: auto;
            word-wrap: break-word;
            white-space: normal;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            position: relative;
        }


        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 86%;
        }



        .chat .chat-message {
            padding: 20px;
            height: auto;
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
            height: 0;

        }

        .chat-list li.active {
            background-color: #2c2c2c;
            color: white;
        }

        #chat-box {
            max-height: 650px;
            overflow-y: auto;
        }

        .chat-app #chat-box::-webkit-scrollbar {
            width: 6px;
        }

        .chat-app #chat-box::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-app #chat-box::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 3px;
        }

        .input-group input:focus {
            box-shadow: none;
            outline: none;
        }



        /* media queries for different screen */
        @media screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                display: none;
            }

            .chat {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
            }

            .chat .chat-message {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
                margin-top: 10px !important;
            }

            .input-group {
                margin-bottom: 5px !important;
            }

            .chat-history {
                width: 100% !important;
                left: 0px !important;
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

            .chat-history {
                overflow-x: hidden;
            }

            .input-group {
                padding: 10px 0px 10px 0px !important;
            }

            .user-detail {
                width: 100%;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                display: none;
            }

            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
            }

            .chat .chat-message {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
                margin-top: 10px !important;
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto;
            }
        }

        @media screen and (min-device-width: 768px) and (max-device-width: 1080px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
            }

            .chat .chat-message {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
                margin-top: 10px !important;
            }

            .chat-app .chat-history {
                height: calc(100vh - 700px);
                overflow-x: auto
            }
        }

        @media screen and (min-width: 1000px) and (max-width: 1200px) {
            .chat-message {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-sizing: border-box;
            }

            .chat-message input {
                width: 100%;
                margin: 0 !important;
                padding: 10px !important;
                margin-top: 10px;
                overflow-x: hidden;
                box-sizing: border-box;
            }

            .input-group {
                margin-bottom: 5px !important;
                width: 100%;
            }

            #send-btn {
                margin-top: 10px !important;
            }

            .chat {
                margin: 0px !important;
                padding: 0px !important;
                overflow-x: hidden !important;
                width: 100% !important;
            }

            .input-group {
                margin-bottom: 5px !important;
            }

            .chat-history {
                width: 100% !important;
                left: 0px !important;
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

            .chat-history {
                overflow-x: hidden;
            }

            .input-group {
                padding: 10px 0px 10px 0px !important;
            }
        }


        /* here control the scroll sidebar  */
        @media (max-width: 1200px) {
            #people-list {
                position: fixed;
                top: 15%;
                left: 0;
                width: 65%;
                height: 100%;
                background: #fff;
                z-index: 1050;
                padding: 15px;
                display: none;
                overflow-y: auto;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
                /* Transition and initial hidden state */
                transform: translateX(-100%);
                opacity: 0;
                transition: transform 0.5s ease, opacity 0.3s ease;
                pointer-events: none;
            }

            /* When toggled on */
            #people-list.show {
                transform: translateX(0);
                opacity: 1;
                pointer-events: auto;
            }

            #people-list.show {
                display: block;
            }

            /* Optional: Dim the chat area when sidebar is open */
            #chat-area.dimmed {
                opacity: 0.3;
                pointer-events: none;
            }
        }
    </style>
@endsection


@section('content')
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="panel panel-default chat-app">
                    <div class="row">
                        <!-- User List -->

                        <button class="btn btn-primary visible-xs visible-sm visible-md" id="togglePeopleList"
                            style="margin-top: 10px; margin: left 10px;">
                            Online User
                        </button>
                        <div class="col-sm-4 people-list" id="people-list" style="height: 400px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." id="search-users">
                            </div>

                            <ul class="list-unstyled chat-list mt-2 mb-0" id="user-list">
                                @forelse ($users as $user)
                                    @php
                                        $profileImage = $user->galleries->where('image_type', 'profile')->first();
                                        $imageUrl = $profileImage
                                            ? asset($profileImage->image_path)
                                            : 'https://bootdey.com/img/Content/avatar/avatar1.png';
                                    @endphp
                                    <li class="clearfix user-item" data-user-id="{{ $user->id }}"
                                        data-user-name="{{ $user->name }}" data-user-image="{{ $imageUrl }}"
                                        data-friend-id="{{ $user->friend_id }}"
                                        data-last-message-time="{{ $user->last_message_time }}">
                                        <img src="{{ $imageUrl }}" alt="avatar" class="rounded-circle" width="50"
                                            height="50">
                                        <div class="about">
                                            <div class="name">{{ $user->name }}</div>
                                            <div class="status">
                                                {{-- <i class="fa fa-circle offline"></i>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($user->last_message_time)->diffForHumans() }}
                                                </small> --}}
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="no-users">No users found.</li>
                                @endforelse
                            </ul>
                        </div>





                        <!-- Chat Area -->
                        <div class="col-sm-8 chat" style="height: 500px;  display: flex; flex-direction: column;">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <div class="col-xs-6 user-detail">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                        </a>
                                        <div class="chat-about">
                                            <h6 class="m-b-0" id="chat-user-name">Aiden Chavez</h6>
                                            <small>Last seen: 2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 text-right hidden-sm">

                                    </div>
                                </div>
                            </div>
                            {{-- data comeing dynamically --}}
                            <div class="chat-history" id="chat-box"
                                style="margin-top: 18px,flex: 1; overflow-y: auto; margin-top: 10px; overflow-x:hidden;">
                                <ul class="m-b-0 list-unstyled">
                                    {{-- <li class="clearfix">
                                        <div class="message-data text-right">
                                            <span class="message-data-time">

                                            </span>

                                        </div>
                                        <div class="message other-message pull-right">

                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time"></span>
                                        </div>
                                        <div class="message my-message"></div>
                                    </li> --}}

                                </ul>
                            </div>
                            <p style="display: none" id="auth_id">{{ Auth::user()->id }}</p>
                            <div class="chat-message clearfix" style="padding-top: 10px; ">
                                <form id="chatForm">
                                    <div class="input-group">
                                        <input type="hidden" id="friend_id" name="friend_id">
                                        <input type="hidden" id="sender_id" name="sender_id"
                                            value="{{ Auth::user()->id }}">
                                        <input type="hidden" id="receiver_id" name="receiver_id">
                                        <input type="text" class="form-control" id="message" name="message"
                                            placeholder="Enter text here...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" id="send-btn" type="submit">
                                                <i class="fa fa-send"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                        </div>


                    </div> <!-- /.row -->
                </div> <!-- /.panel -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- control the active user sidebar -->
    <script>
        document.getElementById('togglePeopleList').addEventListener('click', function(e) {
            const peopleList = document.getElementById('people-list');
            const chatArea = document.getElementById('chat-area');

            peopleList.classList.toggle('show');
            chatArea.classList.toggle('dimmed');
        });

        // Close sidebar on outside click
        document.addEventListener('mousedown', function(e) {
            const peopleList = document.getElementById('people-list');
            const toggleBtn = document.getElementById('togglePeopleList');

            if (
                peopleList.classList.contains('show') &&
                !peopleList.contains(e.target) &&
                !toggleBtn.contains(e.target)
            ) {
                peopleList.classList.remove('show');
                document.getElementById('chat-area').classList.remove('dimmed');
            }
        });
    </script>

    <!-- Optional: Trigger first user click on page load -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const firstUserItem = document.querySelector('.user-item');
            if (firstUserItem) {
                firstUserItem.click();
            }
        });
    </script>

    <!-- Firebase & chat logic -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>

    {{-- <script>
        // Get authenticated user ID from hidden element
        const authUserId = document.getElementById('auth_id').innerText.trim();

        // Firebase configuration (replace with your actual config if needed)
        const firebaseConfig = {
            apiKey: "AIzaSyBrwgArxFsZcugO_ocjqhlksOm7V_25wb8",
            authDomain: "muslimwamuslimachat.firebaseapp.com",
            databaseURL: "https://muslimwamuslimachat-default-rtdb.firebaseio.com",
            projectId: "muslimwamuslimachat",
            storageBucket: "muslimwamuslimachat.firebasestorage.app",
            messagingSenderId: "638699867457",
            appId: "1:638699867457:web:62726f86253854e411a5c0"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const dbRef = firebase.database().ref();

        // Global variables for selected IDs
        let selectedFriendId = null; // Friend relationship id (e.g. grouping id if using a pivot table)
        let selectedUserId = null; // The ID of the friend user you're chatting with

        // Add click listeners for all user items (chat friends)
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                // Use the global variable, not a new local one.
                selectedFriendId = this.dataset.friendId;
                selectedUserId = this.dataset.userId;

                const userName = this.dataset.userName;
                const userImage = this.dataset.userImage;

                // Load chat header and start Firebase listener for messages
                loadheaderChat(authUserId, userName, userImage, selectedFriendId, selectedUserId);
            });
        });

        function loadheaderChat(authUserId, userName, userImage, friendId, selectedUserId) {
            if (!friendId) return;

            document.getElementById('chat-user-name').innerText = userName;
            document.querySelector('.chat-header img').src = userImage;
            document.getElementById('friend_id').value = friendId;
            document.getElementById('receiver_id').value = selectedUserId;

            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';
            let ul = document.createElement('ul');
            ul.className = 'm-b-0 list-unstyled';
            chatBox.appendChild(ul);

            // Load existing chat messages from DB
            $.ajax({
                url: '{{ route('chat.fetch') }}',
                method: 'POST',
                data: {
                    friend_id: friendId,
                    auth_user_id: authUserId,
                    selected_user_id: selectedUserId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    response.chats.forEach(msg => {
                        const isSenderAuth = String(msg.sender_id) === String(authUserId);
                        const date = new Date(msg.sent_at);

                        const formattedTime = date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });

                        const formattedDate = date.toLocaleDateString([], {
                            month: 'short', // e.g., "May"
                            day: 'numeric' // e.g., "23"
                        });

                        const time = `${formattedDate}, ${formattedTime}`;


                        const li = document.createElement('li');
                        li.className = 'clearfix';
                        li.innerHTML = isSenderAuth ?
                            `<div class="message-data text-right">
                        <span class="message-data-time">${time}</span>
                     </div>
                     <div class="message other-message pull-right">${escapeHtml(msg.message)}</div>` :
                            `<div class="message-data">
                        <span class="message-data-time">${time}</span>
                     </div>
                     <div class="message my-message">${escapeHtml(msg.message)}</div>`;

                        ul.appendChild(li);
                    });

                    // Scroll to bottom
                    chatBox.scrollTop = chatBox.scrollHeight;

                    // Now start Firebase real-time listener
                    if (window.messagesListener) {
                        window.messagesListener.off();
                    }

                    window.messagesListener = dbRef.child('pusher').orderByChild('timestamp');
                    window.messagesListener.on('child_added', snapshot => {
                        const msg = snapshot.val();
                        const senderId = String(msg.sender_id);
                        const receiverId = String(msg.receiver_id);
                        const authIdStr = String(authUserId);

                        if (!((senderId === authIdStr && receiverId === String(selectedUserId)) ||
                                (senderId === String(selectedUserId) && receiverId === authIdStr))) {
                            return;
                        }

                        const isSenderAuth = (senderId === authIdStr);
                        const date = new Date(msg.timestamp);
                        const formattedTime = date.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });
                        const formattedDate = date.toLocaleDateString([], {
                            month: 'short', // 'May'
                            day: 'numeric' // '23'
                        });
                        const time = `${formattedDate}, ${formattedTime}`;


                        const li = document.createElement('li');
                        li.className = 'clearfix';
                        li.innerHTML = isSenderAuth ?
                            `<div class="message-data text-right">
                        <span class="message-data-time">${time}</span>
                     </div>
                     <div class="message other-message pull-right">${escapeHtml(msg.message)}</div>` :
                            `<div class="message-data">
                        <span class="message-data-time">${time}</span>
                     </div>
                     <div class="message my-message">${escapeHtml(msg.message)}</div>`;



                        ul.appendChild(li);
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
                },
                error: function(err) {
                    console.error('Error loading messages from DB:', err.responseText);
                }
            });
        }


        // Escape HTML for security
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }

        // Handle message sending (submission)
        $('#chatForm').on('submit', function(e) {
            e.preventDefault();

            if (!selectedFriendId || !selectedUserId) {
                alert('Please select a user to chat with.');
                return;
            }

            const message = $('#message').val().trim();
            if (message === '') {
                alert('Please enter a message');
                return;
            }

            // Use the globally set selectedUserId and selectedFriendId
            const formData = {
                friend_id: selectedFriendId,
                user_id: selectedUserId, // This is our receiver's user id
                sender_id: authUserId, // Authenticated user is the sender
                message: message,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token from meta tag
            };

            // 1. Send message to Laravel backend (store in your DB)
            $.ajax({
                url: '{{ route('chat.send') }}', // Your Laravel route for saving the chat message
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Message saved to DB:', response.chat);

                    // 2. Then push message to Firebase for real-time display
                    const newMessage = {
                        sender_id: authUserId, // Authenticated user sending the message
                        receiver_id: formData.user_id, // The selected friend's user id
                        friend_id: formData.friend_id, // Friend relationship id if needed
                        message: formData.message,
                        timestamp: Date.now()
                    };

                    const firebasePushRef = dbRef.child('pusher').push();
                    firebasePushRef
                        .set(newMessage)
                        .then(() => {
                            $('#message').val('');
                            // Immediately delete after pushing
                            return firebasePushRef.remove();
                        })
                        .catch(err => {
                            console.error('Firebase push/remove failed:', err);
                        });

                },
                error: function(xhr) {
                    console.error('Message not saved:', xhr.responseText);
                }
            });
        });
    </script> --}}



    <script>
        const authUserId = document.getElementById('auth_id').innerText.trim();
        const userList = document.getElementById('user-list');

        const firebaseConfig = {
            apiKey: "AIzaSyBrwgArxFsZcugO_ocjqhlksOm7V_25wb8",
            authDomain: "muslimwamuslimachat.firebaseapp.com",
            databaseURL: "https://muslimwamuslimachat-default-rtdb.firebaseio.com",
            projectId: "muslimwamuslimachat",
            storageBucket: "muslimwamuslimachat.appspot.com",
            messagingSenderId: "638699867457",
            appId: "1:638699867457:web:62726f86253854e411a5c0"
        };
        firebase.initializeApp(firebaseConfig);
        const dbRef = firebase.database().ref();

        let selectedFriendId = null;
        let selectedUserId = null;

        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                selectedFriendId = this.dataset.friendId;
                selectedUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                const userImage = this.dataset.userImage;
                loadHeaderChat(authUserId, userName, userImage, selectedFriendId, selectedUserId);
            });
        });

        function loadHeaderChat(authUserId, userName, userImage, friendId, selectedUserId) {
            if (!friendId) return;

            document.getElementById('chat-user-name').innerText = userName;
            document.querySelector('.chat-header img').src = userImage;
            document.getElementById('friend_id').value = friendId;
            document.getElementById('receiver_id').value = selectedUserId;

            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';
            let ul = document.createElement('ul');
            ul.className = 'm-b-0 list-unstyled';
            chatBox.appendChild(ul);

            $.ajax({
                url: '{{ route('chat.fetch') }}',
                method: 'POST',
                data: {
                    friend_id: friendId,
                    auth_user_id: authUserId,
                    selected_user_id: selectedUserId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    response.chats.forEach(msg => addMessageToChatBox(msg, authUserId, ul));
                    chatBox.scrollTop = chatBox.scrollHeight;

                    // Remove previous listener if any
                    if (window.messagesListener) window.messagesListener.off();

                    window.messagesListener = dbRef.child('pusher').orderByChild('timestamp');
                    window.messagesListener.on('child_added', snapshot => {
                        const msg = snapshot.val();
                        const senderId = String(msg.sender_id);
                        const receiverId = String(msg.receiver_id);

                        if (
                            (senderId === authUserId && receiverId === selectedUserId) ||
                            (receiverId === authUserId && senderId === selectedUserId)
                        ) {
                            addMessageToChatBox(msg, authUserId, ul);
                            chatBox.scrollTop = chatBox.scrollHeight;
                            const chatUserId = senderId === authUserId ? receiverId : senderId;
                            reorderUserItem(chatUserId, msg.timestamp);
                        }
                    });
                }
            });
        }

        function addMessageToChatBox(msg, authUserId, ul) {
            const isSenderAuth = String(msg.sender_id) === String(authUserId);
            const date = new Date(msg.timestamp || msg.sent_at);
            const formattedTime = date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            const formattedDate = date.toLocaleDateString([], {
                month: 'short',
                day: 'numeric'
            });
            const time = `${formattedDate}, ${formattedTime}`;

            const li = document.createElement('li');
            li.className = 'clearfix';
            li.innerHTML = isSenderAuth ?
                `<div class="message-data text-right"><span class="message-data-time">${time}</span></div>
               <div class="message other-message pull-right">${escapeHtml(msg.message)}</div>` :
                `<div class="message-data"><span class="message-data-time">${time}</span></div>
               <div class="message my-message">${escapeHtml(msg.message)}</div>`;

            ul.appendChild(li);
        }

        function reorderUserItem(chatUserId, timestamp) {
            const newTime = parseInt(timestamp) || Date.now();
            const userItems = Array.from(document.querySelectorAll('.user-item'));
            const matchedItem = userItems.find(item => item.dataset.userId === chatUserId);

            if (matchedItem) {
                matchedItem.dataset.lastMessageTime = newTime;
                userList.removeChild(matchedItem);

                let inserted = false;
                for (const item of userList.children) {
                    if (parseInt(item.dataset.lastMessageTime || 0) < newTime) {
                        userList.insertBefore(matchedItem, item);
                        inserted = true;
                        break;
                    }
                }

                if (!inserted) {
                    userList.appendChild(matchedItem);
                }
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }

        $('#chatForm').on('submit', function(e) {
            e.preventDefault();

            if (!selectedFriendId || !selectedUserId) {
                alert('Please select a user to chat with.');
                return;
            }

            const message = $('#message').val().trim();
            if (message === '') {
                alert('Please enter a message');
                return;
            }

            const formData = {
                friend_id: selectedFriendId,
                user_id: selectedUserId,
                sender_id: authUserId,
                message: message,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: '{{ route('chat.send') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    const newMessage = {
                        sender_id: authUserId,
                        receiver_id: formData.user_id,
                        friend_id: formData.friend_id,
                        message: formData.message,
                        timestamp: Date.now()
                    };

                    const firebasePushRef = dbRef.child('pusher').push();
                    firebasePushRef.set(newMessage)
                        .then(() => {
                            $('#message').val('');
                            // Clear Firebase after broadcasting
                            return firebasePushRef.remove();
                        })
                        .catch(err => console.error('Firebase push/remove failed:', err));
                },
                error: function(xhr) {
                    console.error('Message not saved:', xhr.responseText);
                }
            });
        });
    </script>



    <!-- control the chat box text width -->
    <script>
        function addMessage(text, isSelf) {
            const wordCount = text.trim().split(/\s+/).length;

            const messageDiv = document.createElement("div");
            messageDiv.classList.add("message", isSelf ? "my-message" : "other-message");

            messageDiv.style.wordWrap = "break-word";
            messageDiv.style.whiteSpace = "normal";
            messageDiv.style.overflowWrap = "break-word";
            messageDiv.style.display = "inline-block";

            if (wordCount <= 20) {
                messageDiv.style.width = "auto";
            } else {
                messageDiv.style.width = "300px";
            }

            messageDiv.innerText = text;

            document.getElementById("chat-box").appendChild(messageDiv);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#search-users').on('keyup', function() {
                const query = $(this).val().toLowerCase();
                let visibleCount = 0;

                $('#user-list .user-item').each(function() {
                    const name = $(this).find('.name').text().toLowerCase();
                    if (name.includes(query)) {
                        $(this).show();
                        visibleCount++;
                    } else {
                        $(this).hide();
                    }
                });

                if (visibleCount === 0) {
                    $('#no-users-found').show();
                } else {
                    $('#no-users-found').hide();
                }
            });
        });
    </script>
@endsection

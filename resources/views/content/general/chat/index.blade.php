@extends('content/general/layouts/horizontalLayout')

@section('title', 'Percakapan')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
@endsection

@section('content')
    <div class="app-chat card overflow-hidden">
        <div class="row g-0">
            <!-- Chat & Contacts -->
            <div class="col  app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                <div class="sidebar-header">
                    <div class="d-flex align-items-center me-3 me-lg-0">
                        <div class="flex-shrink-0 avatar me-3" style="cursor: default;">
                            <img class="user-avatar rounded-circle"
                                src="{{ Auth::user()->photo_profile != null ? Auth::user()->photo_profile : asset('assets/img/avatars/blank.png') }}"
                                alt="Avatar">
                        </div>
                        <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                aria-label="Search..." aria-describedby="basic-addon-search31">
                        </div>
                    </div>
                    <i class="ti ti-x cursor-pointer close-sidebar mt-2 me-1 d-lg-none d-block position-absolute top-0 end-0"
                        data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                </div>
                <hr class="container-m-nx m-0">
                <div class="sidebar-body">

                    <div class="chat-contact-list-item-title">
                        <h5 class="text-primary mb-0 px-4 pt-3 pb-2">Pesan</h5>
                    </div>
                    <!-- Chats -->
                    <ul class="list-unstyled chat-contact-list" id="chat-list">
                        @if ($chats->count() == 0)
                            <li class="chat-list-item-0 px-4 py-2" style="cursor: default;">
                                <h6 class="text-muted mb-0">Tidak terdapat pesan ditemukan.</h6>
                            </li>
                        @else
                            @foreach ($chats as $chat)
                                <li class="chat-contact-list-item" onclick="getChat({{ $chat->id }})">
                                    <a class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar" style="cursor: default;">
                                            <img src="{{ $chat->photo_profile != null ? $chat->photo_profile : asset('assets/img/avatars/blank.png') }}"
                                                alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-2">
                                            <h6 class="chat-contact-name text-truncate m-0">{{ $chat->name }}</h6>
                                            <p class="chat-contact-status text-muted text-truncate mb-0">
                                                {{ $chat->last_chat }}
                                            </p>
                                        </div>
                                        <small class="text-muted mb-auto">{{ $chat->chat_diff }}</small>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- Contacts -->
                    <ul class="list-unstyled chat-contact-list mb-0" id="contact-list">
                        <li class="chat-contact-list-item chat-contact-list-item-title">
                            <h5 class="text-primary mb-0">Kontak</h5>
                        </li>
                        <li class="chat-contact-list-item contact-list-item-0 d-none">
                            <h6 class="text-muted mb-0">Tidak terdapat kontak ditemukan.</h6>
                        </li>
                        @if ($users->count() == 0)
                            <li class="chat-contact-list-item contact-list-item-0">
                                <h6 class="text-muted mb-0">Tidak terdapat kontak ditemukan.</h6>
                            </li>
                        @else
                            @foreach ($users as $user)
                                <li class="chat-contact-list-item" onclick="getChat({{ $user->id }})">
                                    <a class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar">
                                            <img src="{{ $user->photo_profile != null ? $user->photo_profile : asset('assets/img/avatars/blank.png') }}"
                                                alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-2">
                                            <h6 class="chat-contact-name text-truncate m-0">{{ $user->name }}</h6>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /Chat contacts -->

            <!-- Chat History -->
            <!-- If there is no active chat -->
            {{-- <div class="col app-chat-history bg-body d-none" id="chat-not-exist">
                <div class="d-flex align-items-center h-100">
                    <h4 class="text-center mx-auto">Yuk mulai percakapanmu sekarang juga!</h4>
                </div>
                <!-- If there is no active chat -->
            </div> --}}
            <!-- If there is active chat -->
            <div class="col app-chat-history bg-body">
                <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex overflow-hidden align-items-center" id="chat-profile"
                                style="min-height: 42px">
                                <i class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar"
                                    data-overlay data-target="#app-chat-contacts"></i>
                                <div id="chat-not-exist"></div>
                                <div class="d-flex flex-row overflow-hidden align-items-center d-none" id="chat-exist">
                                    <div class="flex-shrink-0 avatar">
                                        <img id="chat_image" src="${photo}" alt="Avatar" class="rounded-circle"
                                            data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-2">
                                        <h6 class="m-0" id="chat_username">USERNAME</h6>
                                    </div>
                                </div>
                                <!-- Chat Profile from Javascript -->
                            </div>
                            <div id="chat_refresh"></div>
                        </div>
                    </div>
                    <div class="chat-history-body bg-body">
                        <ul class="list-unstyled chat-history" id="chat-history">
                            <!-- Chat messages -->
                            <h4 class="text-center mx-auto">Yuk mulai percakapanmu sekarang juga!</h4>
                        </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer shadow-sm">
                        <div class="form-send-message d-flex justify-content-between align-items-center">
                            <form class="w-100">
                                <input class="form-control message-input border-0 me-3 shadow-none" id="message-input"
                                    placeholder="Masukkan pesan anda disini...">
                            </form>
                            <div class="message-actions d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary d-flex" id="send-msg-btn" onclick="postChat()">
                                    <i class="ti ti-send me-md-1 me-0"></i>
                                    <span class="align-middle d-md-inline-block d-none">Send</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /If there is active chat -->
            <!-- /Chat History -->
            <div class="app-overlay"></div>
        </div>
    </div>
@endsection

<script script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function getChat(id) {
        document.getElementById("chat-not-exist").classList.add("d-none");
        document.getElementById("chat-exist").classList.remove("d-none");

        var token = '{{ session('auth_token') }}';
        // Make an AJAX call to fetch the comments for the post
        $.ajax({
            url: '/api/chats/' + id,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                var chat = response.data;
                var userName = response.user.name;
                var photo = '';
                if (response.user.photo_profile != null) {
                    photo = response.user.photo_profile;
                } else {
                    photo = "{{ asset('assets/img/avatars/blank.png') }}";
                }

                //Set send message button data-id attribute
                var sendMsgBtn = document.getElementById("send-msg-btn");
                sendMsgBtn.setAttribute("data-id", id);

                //Get Profile
                var chatRefreshButton = document.getElementById("chat_refresh");
                var chatImage = document.getElementById("chat_image");
                var chatUsername = document.getElementById("chat_username");
                // Append chat profile HTML to chatRefreshButton element
                chatRefreshButton.innerHTML = `
                <div class="ms-2 cursor-pointer text-primary" onclick="getChat(${id})">
                    Refresh pesan
                    <i class="ti ti-rotate-clockwise rotate-180 scaleX-n1-rtl"></i>
                </div>
                `;
                chatImage.src = photo;
                chatUsername.innerHTML = userName;


                var chatHistory = document.getElementById("chat-history");
                chatHistory.innerHTML = "";

                chat.forEach(function(item, index) {
                    var chatMessage = document.createElement("li");
                    chatMessage.classList.add("chat-message");
                    if (item.user_id == {{ Auth::user()->id }}) {
                        chatMessage.classList.add("chat-message-right");
                    }

                    var chatMessageWrapper = document.createElement("div");
                    chatMessageWrapper.classList.add("d-flex");
                    chatMessageWrapper.classList.add("overflow-hidden");

                    var chatMessageWrapper2 = document.createElement("div");
                    chatMessageWrapper2.classList.add("chat-message-wrapper");
                    chatMessageWrapper2.classList.add("flex-grow-1");
                    chatMessageWrapper2.classList.add("w-50");

                    var chatMessageText = document.createElement("div");
                    chatMessageText.classList.add("chat-message-text");

                    var chatMessageTextP = document.createElement("p");
                    chatMessageTextP.classList.add("mb-0");
                    chatMessageTextP.innerHTML = item.body;

                    var chatMessageTextTime = document.createElement("div");
                    chatMessageTextTime.classList.add("text-end");
                    chatMessageTextTime.classList.add("text-muted");
                    chatMessageTextTime.classList.add("mt-1");

                    var chatMessageTextTimeSmall = document.createElement("small");
                    chatMessageTextTimeSmall.innerHTML = item.time;

                    chatMessageTextTime.appendChild(chatMessageTextTimeSmall);
                    chatMessageText.appendChild(chatMessageTextP);
                    chatMessageWrapper2.appendChild(chatMessageText);
                    chatMessageWrapper2.appendChild(chatMessageTextTime);
                    chatMessageWrapper.appendChild(chatMessageWrapper2);
                    chatMessage.appendChild(chatMessageWrapper);

                    chatHistory.appendChild(chatMessage);
                    if (index === chat.length - 1) {
                        chatMessage.scrollIntoView({
                            block: "end"
                        });
                    }
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function postChat() {
        var token = '{{ session('auth_token') }}';

        // Get the comment text and post ID
        var messageText = document.getElementById("message-input").value;
        var id = document.getElementById("send-msg-btn").getAttribute("data-id");

        // Send a POST request to the server to save the comment
        axios.post('/api/chats/' + id, {
                body: messageText,
            }, {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                // Clear the comment text area
                document.getElementById("message-input").value = "";

                // Refresh the comment list
                getChat(id);
            })
            .catch(function(error) {
                // Handle errors
                console.log(error);
            });
    }
</script>

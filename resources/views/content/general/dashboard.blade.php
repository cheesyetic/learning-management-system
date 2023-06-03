@php
    Helper::auth_token_helpers();
@endphp

@extends('content/general/layouts/horizontalLayout')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.1.0/css/chocolat.css"
        integrity="sha512-SZKIFMKtGWhRWJJ5ZEWJmKRXK/EDpYU5dKMWrF2cky8nS+KA4pwer86EIJPwuJKKFzP1bhjyL3yj5cGChmcd9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.1.0/js/chocolat.min.js"
        integrity="sha512-f0RyyfsrXaAqNTCqDXt0A7GDr5YauTMYj42P7Y6DNNQ+KjU7cYZpxqLzqncnWMXPZy9h4XtpKPcvsQ/3C2PA1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        Chocolat(document.querySelectorAll('.chocolat-image'), {
            // options here
        })
    </script>
@endsection

@section('content')
    <!-- If Art is empty -->
    @if (count($arts) == 0)
        <div class="d-flex align-items-center justify-content-center flex-column" style="height: 75vh;">
            <h4 class="text-center">Belum ada karya yang diunggah.</h4>
            <h4 class="text-center">Yuk, unggah karyamu sekarang!</h4>
        </div>
    @endif
    <!-- End of If Art is empty -->

    <!-- Content -->
    <div class="container" style="max-width: 700px;">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <div class="text-center">{!! Session::get('success') !!}</div>
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        @if (Session::has('errors'))
            <div class="alert alert-danger">
                <div class="text-center">{{ Session::get('errors') }}</div>
                @php
                    Session::forget('errors');
                @endphp
            </div>
        @endif

        <div class="modal fade" style="z-index: 99999" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Unggah Karyamu Sekarang!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('art.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Judul</label>
                                <input required type="text" class="form-control" name="title" id="postTitle">
                            </div>
                            <div class="mb-3">
                                <label for="postContent" class="form-label">Caption</label>
                                <textarea required class="form-control" id="postContent" name="caption" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="postCategory" class="form-label">Kategori</label>
                                <select required class="form-select" id="postCategory" name="category">
                                    <option value="1">Karya Gambar</option>
                                    <option value="2">Karya Video</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="postImage" class="form-label">Karya (Berupa gambar atau video)</label>
                                <input required type="file" class="form-control" id="postImage" name="file"
                                    accept="image/*,video/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Art -->
        {{-- Delete form submitted when user click delete on a delete button --}}
        <form id="delete-form" action="#" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        @foreach ($arts as $art)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($art->category == 1)
                            <a class="chocolat-image" href="{{ $art->file }}" title="image">
                                <img class="card-img card-img-left" style="height: 100%" src="{{ $art->file }}"
                                    alt="Card image" />
                            </a>
                        @else
                            <video controls class="card-img card-img-left" style="height: 100%" src="{{ $art->file }}">
                            </video>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            @if ($art->user_id == Auth::user()->id)
                                <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                                    <button class="btn bg-transparent" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#editArtModal"
                                            onclick="edit_modal({{ $art }})">Ubah</a>
                                        <a class="dropdown-item" href="{{ route('art.destroy', $art->id) }}"
                                            onclick="event.preventDefault();
                                                    if(confirm('Apa kamu yakin ingin menghapus karyamu?')){
                                                    document.getElementById('delete-form').action = '{{ route('art.destroy', $art->id) }}';
                                                    document.getElementById('delete-form').submit();
                                                    }">
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <h5 class="card-title mb-1">{{ $art->title }}</h5>
                            <p class="card-text"><small class="text-muted">Diunggah {{ $art->diff }}</small></p>
                            <p class="card-text">
                                {{ $art->caption }}
                            </p>
                            @if ($art->is_liked)
                                <button type="button" id="btnUnlike-{{ $art->id }}" class="btn btn-primary btn-sm"
                                    onclick="unlike({{ $art->id }})">
                                    <span data-art-id="like-{{ $art->id }}">{{ $art->like }}</span>
                                    <i class="ms-2 fas fa-thumbs-down" id="thumbs-down-{{ $art->id }}"></i></button>
                            @else
                                <button type="button" id="btnLike-{{ $art->id }}" class="btn btn-primary btn-sm"
                                    onclick="like({{ $art->id }})">
                                    <span data-art-id="like-{{ $art->id }}">{{ $art->like }}</span>
                                    <i class="ms-2 fas fa-thumbs-up" id="thumbs-up-{{ $art->id }}"></i></button>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#commentModal" onclick="showComments({{ $art->id }})">
                                <span data-art-id="comment-{{ $art->id }}">{{ $art->comment }}</span>
                                <i class="ms-2 fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div id="cardContainer"></div>
        <button class="btn btn-primary" id="loadMoreButton" onclick="load_more()">Load More</button>

        <div class="modal fade" style="z-index: 99999" id="commentModal" tabindex="-1"
            aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Berikan komentarmu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="comment-list mb-2 p-4" id="comment-list">
                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="commentText" class="form-label">Comment</label>
                                <textarea class="form-control" id="commentText" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="post_comment_btn" class="btn btn-primary" onclick="postComment()"
                            data-post-id="">Add
                            Comment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" style="z-index: 99999" id="editArtModal" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Ubah Informasi Karya</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editArtForm" action="#" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="editTitle" name="title"
                                    value="">
                            </div>
                            <div class="mb-3">
                                <label for="editCaption" class="form-label">Caption</label>
                                <textarea class="form-control" id="editCaption" name="caption"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Art -->
        <button type="button"
            class="btn btn-icon btn-outline-primary rounded-circle btn-lg position-fixed bottom-0 end-0 m-4"
            data-bs-toggle="modal" data-bs-target="#uploadModal"><i class="fas fa-plus"></i></button>
        {{-- @if ($arts->isNotEmpty())
            <div class="d-flex justify-content-center mt-4">
                {!! $arts->links('pagination.custom') !!}
            </div>
        @endif --}}
    </div>
    <!-- End of Content -->
@endsection

<script script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@push('scripts')
    <script>
        // Global variables
        let pageNumber = 2; // Initial page number
        const apiUrl = '/api/art'; // Replace with your API endpoint URL

        // Function to fetch data from the API
        async function fetchData() {
            const response = await fetch(`${apiUrl}?page=${pageNumber}`);
            const data = await response.json();
            return data;
        }

        // Function to create a new card element
        function createCardElement(cardData) {
            const cardElement = document.createElement('div');

            const art_asset = cardData.category == 1 ?
                `<img class="card-img card-img-left" style="height: 100%" src="{{ $art->file }}" alt="Card image" />` :
                ` <video controls class="card-img card-img-left" style="height: 100%" src="{{ $art->file }}"></video>`;
            const art_crud = cardData.user_id == {{ auth()->user()->id }} ?
                `<div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                    <button class="btn bg-transparent" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#editArtModal"
                            onclick='edit_modal(${JSON.stringify(cardData)})''>Ubah</a>
                        <a class="dropdown-item"
                            onclick="event.preventDefault();
                                    if(confirm('Apa kamu yakin ingin menghapus karyamu?')){
                                    document.getElementById('delete-form').action = '{{ route('art.destroy', '') }} + '/' + ${cardData.id}';
                                    document.getElementById('delete-form').submit();
                                    }">
                            Hapus
                        </a>
                    </div>
                </div>` : ``;
            const art_like = cardData.is_liked ?
                `<button type="button" id="btnUnlike-${cardData.id}" class="btn btn-primary btn-sm"
                onclick="unlike(${cardData.id})">
                <span data-art-id="like-${cardData.id}">${cardData.like}</span>
                <i class="ms-2 fas fa-thumbs-down" id="thumbs-down-${cardData.id}"></i></button>` :
                `<button type="button" id="btnLike-${cardData.id}" class="btn btn-primary btn-sm"
                onclick="like(${cardData.id})">
                <span data-art-id="like-${cardData.id}">${cardData.like}</span>
                <i class="ms-2 fas fa-thumbs-up" id="thumbs-up-${cardData.id}"></i></button>`;

            cardElement.innerHTML = `
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        ${art_asset}
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            ${art_crud}
                            <h5 class="card-title">${cardData.title}</h5>
                            <p class="card-text">
                                ${cardData.caption}
                            </p>
                            <p class="card-text"><small class="text-muted">Diunggah ${cardData.diff}</small></p>
                            ${art_like}
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#commentModal" onclick="showComments(${cardData.id})">
                                <span data-art-id="comment-${cardData.id}">${cardData.comment}</span>
                                <i class="ms-2 fas fa-comment"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            `;

            return cardElement;
        }

        function load_more() {
            // disable this button
            const btn_load = document.getElementById('loadMoreButton')
            btn_load.disabled = true;
            fetchData().then((data) => {
                data.data.forEach((cardData) => {
                    const cardElement = createCardElement(cardData);
                    document.getElementById('cardContainer').appendChild(cardElement);
                });
                btn_load.disabled = false;
                if (data.last_page == pageNumber || data.next_page_url) {
                    btn_load.style.setProperty('display', 'none', 'important');
                }
                pageNumber++; // Increment the page number for the next request
            });
        }
    </script>
@endpush

<script>
    function edit_modal(art) {
        console.log(art);
        document.getElementById('editTitle').value = art.title;
        document.getElementById('editCaption').innerHTML = art.caption;
        document.getElementById('editArtForm').action = "{{ route('art.update', '') }}" + '/' + art.id;
    }

    function showComments(id) {
        var token = '{{ session('auth_token') }}';
        // Make an AJAX call to fetch the comments for the post
        $.ajax({
            url: '/api/art/' + id + '/comments',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                // Clear the existing comments
                $('.comment-list').empty();
                $('#post_comment_btn').attr('data-post-id', id);

                if (response.data.length) {
                    // Append each comment to the list
                    $.each(response.data, function(index, comment) {
                        var deleteIcon = '';
                        var html = '';
                        if (comment.user.id == '{{ Auth::user()->id }}') {
                            html =
                                `
                              <div class="chat-log d-flex justify-content-end">
                                  <div class="chat-body mb-1 d-inline-flex flex-column align-start">
                                    <p class="chat-content py-2 px-4 elevation-1 bg-primary text-white chat-right mb-1 d-flex flex-row justify-content-between ">
                                      <span>${comment.comment}</span>
                                      <i class="p-1 ms-2 fa fa-trash cursor-pointer" onclick="deleteComment(${comment.id})"></i>
                                    </p>
                                    </div>
                                </div>
                              `
                        } else {
                            html =
                                `
                              <div class="chat-log d-flex justify-content-start">
                                  <div class="chat-body mb-1 d-inline-flex flex-column align-start">
                                      <p class="chat-content py-2 px-4 elevation-1 bg-white chat-left mb-1">
                                          <span class="text-sm fw-bold text-disabled">
                                              <i class="me-2 fas fa-user"></i>${comment.user.name}
                                          </span><br>
                                          ${comment.comment}
                                      </p>
                                  </div>
                              </div>
                          `
                        }
                        $('.comment-list').append(html);
                    });
                } else {
                    var html =
                        `
                              <div class="chat-log d-flex justify-content-center">
                                         Belum ada komentar
                              </div>
                          `
                    $('.comment-list').append(html);

                }
            }
        });
    }

    function postComment() {
        var token = '{{ session('auth_token') }}';

        // Get the comment text and post ID
        var commentText = document.getElementById("commentText").value;
        $('#post_comment_btn').prop('disabled', true);
        var id = document.querySelector("#post_comment_btn").getAttribute("data-post-id");

        // Send a POST request to the server to save the comment
        axios.post('/api/art/' + id + '/comments', {
                comment: commentText,
            }, {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                // Clear the comment text area
                document.getElementById("commentText").value = "";
                $('[data-art-id="comment-' + id + '"]').text(response.data.count);

                // Refresh the comment list
                showComments(id);
            })
            .catch(function(error) {
                // Handle errors
                console.log(error);
            })
            .then(function() {
                $('#post_comment_btn').prop('disabled', false);
            })
    }

    function deleteComment(commentId) {
        var token = '{{ session('auth_token') }}';
        $('[onclick="deleteComment(' + commentId + ')"]').attr("class", "p-1 ms-2 fa fa-spinner cursor-pointer");

        // Make an AJAX call to delete the comment
        $.ajax({
            url: '/api/art/comments/' + commentId,
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                console.log(response);
                console.log('id', response.data.art_id);
                showComments(response.data.art_id);
                $('[data-art-id="comment-' + response.data.art_id + '"]').text(response.count);
            },
            complete: function() {
                $('[onclick="deleteComment(' + commentId + ')"]').attr("class",
                    "p-1 ms-2 fa fa-trash cursor-pointer");
            }
        });
    }

    function like(id) {
        var token = '{{ session('auth_token') }}';
        $.ajax({
            type: 'GET',
            url: '/api/art/' + id + '/like',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                // Update the like count
                var count = response.data.like;
                // $('.like-count[data-art-id=' + id + ']').text(count);
                $('[data-art-id=like-' + id + ']').text(count);
                $('#thumbs-up-' + id + '').removeClass('fas fa-thumbs-up').addClass(
                    'fas fa-thumbs-down');
                $('#btnLike-' + id + '').removeAttr('onclick');
                $('#btnLike-' + id + '').off('click').on('click', function() {
                    unlikeAfter(id);
                });
            }
        });
        console.log('sini-like');
    }

    function likeAfter(id) {
        var token = '{{ session('auth_token') }}';
        $.ajax({
            type: 'GET',
            url: '/api/art/' + id + '/like',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                // Update the like count
                var count = response.data.like;
                // $('.like-count[data-art-id=' + id + ']').text(count);
                $('[data-art-id=like-' + id + ']').text(count);
                $('#thumbs-down-' + id + '').removeClass('fas fa-thumbs-up').addClass(
                    'fas fa-thumbs-down');
                $('#btnUnlike-' + id + '').removeAttr('onclick');
                $('#btnUnlike-' + id + '').off('click').on('click', function() {
                    unlike(id);
                });
            }
        });
        console.log('sini-likeaft');
    }

    function unlike(id) {
        var token = '{{ session('auth_token') }}';
        $.ajax({
            type: 'GET',
            url: '/api/art/' + id + '/unlike',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                // Update the like count
                var count = response.data.like;
                $('[data-art-id=like-' + id + ']').text(count);
                $('#thumbs-down-' + id + '').removeClass('fas fa-thumbs-down').addClass(
                    'fas fa-thumbs-up');
                $('#btnUnlike-' + id + '').removeAttr('onclick');
                $('#btnUnlike-' + id + '').off('click').on('click', function() {
                    likeAfter(id);
                });
            }
        });
        console.log('sini-unlike');
    }

    function unlikeAfter(id) {
        var token = '{{ session('auth_token') }}';
        $.ajax({
            type: 'GET',
            url: '/api/art/' + id + '/unlike',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                // Update the like count
                var count = response.data.like;
                $('[data-art-id=like-' + id + ']').text(count);
                $('#thumbs-up-' + id + '').removeClass('fas fa-thumbs-down').addClass(
                    'fas fa-thumbs-up');
                $('#btnLike-' + id + '').removeAttr('onclick');
                $('#btnLike-' + id + '').off('click').on('click', function() {
                    like(id);
                });
            }
        });
        console.log('sini-unlikeafter');
    }
</script>


@push('styles')
    <style>
        @charset "UTF-8";

        .comment-list {
            background-color: #f8f7fa !important;
            max-height: 500px;
            overflow: auto;
        }

        .chat-contact {
            border-radius: 6px;
            padding-block: 8px;
            padding-inline: 12px;
            position: relative
        }

        .chat-contact:before {
            position: absolute;
            border-radius: inherit;
            background: currentcolor;
            block-size: 100%;
            content: "";
            inline-size: 100%;
            inset: 0;
            opacity: 0;
            pointer-events: none
        }

        .chat-contact:hover:before {
            opacity: calc(var(--v-hover-opacity) * var(--v-theme-overlay-multiplier))
        }

        .chat-contact:focus-visible:before {
            opacity: calc(var(--v-focus-opacity) * var(--v-theme-overlay-multiplier))
        }

        @supports not selector(:focus-visible) {
            .chat-contact:focus:before {
                opacity: calc(var(--v-focus-opacity) * var(--v-theme-overlay-multiplier))
            }
        }

        .chat-contact.chat-contact-active {
            background: linear-gradient(72.47deg, rgb(var(--v-theme-primary)) 0%, #fff 300%);
            color: #fff;
            --v-theme-on-background: #fff
        }

        .chat-contact.chat-contact-active .v-avatar {
            background: #fff;
            outline: 2px solid #fff
        }

        .chat-contact .v-badge--bordered .v-badge__badge:after {
            color: #fff
        }

        .chat-contacts-list {
            --chat-content-spacing-x: 16px;
            padding-block-end: .75rem
        }

        .chat-contacts-list .chat-contact-header {
            margin-block-end: .625rem;
            margin-block-start: 1.25rem
        }

        .chat-contacts-list .chat-contact-header,
        .chat-contacts-list .no-chat-items-text {
            margin-inline: var(--chat-content-spacing-x)
        }

        .chat-list-search .v-field--focused {
            box-shadow: none !important
        }

        .chat-log .chat-content {
            /* background-color: red !important; */
            border-end-end-radius: 6px;
            border-end-start-radius: 6px
        }

        .chat-log .chat-content.chat-left {
            border-start-end-radius: 6px
        }

        .chat-log .chat-content.chat-right {
            border-start-start-radius: 6px
        }

        .chat-app-layout .chat-list-header,
        .chat-app-layout .active-chat-header {
            display: flex;
            align-items: center;
            min-block-size: 62px;
            padding-inline: 1rem
        }

        .chat-app-layout {
            border-radius: 6px;
            box-shadow: 0 4px 18px rgba(var(--v-shadow-key-umbra-color), .1), 0 0 transparent, 0 0 transparent
        }

        .skin--bordered .chat-app-layout {
            box-shadow: none !important;
            border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity))
        }

        .chat-app-layout .active-chat-user-profile-sidebar .v-navigation-drawer__content,
        .chat-app-layout .user-profile-sidebar .v-navigation-drawer__content {
            display: flex;
            flex-direction: column
        }

        .chat-app-layout .chat-list-search .v-field__outline__start {
            flex-basis: 20px !important;
            border-radius: 28px 0 0 28px !important
        }

        .chat-app-layout .chat-list-search .v-field__outline__end {
            border-radius: 0 28px 28px 0 !important
        }

        [dir=rtl] .chat-app-layout .chat-list-search .v-field__outline__start {
            flex-basis: 20px !important;
            border-radius: 0 28px 28px 0 !important
        }

        [dir=rtl] .chat-app-layout .chat-list-search .v-field__outline__end {
            border-radius: 28px 0 0 28px !important
        }

        .chat-app-layout .chat-list-sidebar .v-navigation-drawer__content {
            display: flex;
            flex-direction: column
        }

        .chat-content-container {
            background-color: var(--23750bbc)
        }

        .chat-content-container .chat-message-input .v-field__append-inner {
            align-items: center;
            padding-block-start: 0
        }

        .chat-content-container .chat-message-input .v-field--appended {
            padding-inline-end: 9px
        }

        .chat-user-profile-badge .v-badge__badge {
            min-width: 12px !important;
            height: .75rem
        }
    </style>
@endpush

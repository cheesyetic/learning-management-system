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
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
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
                        <form action="{{ route('teacher.art.store') }}" method="POST" enctype="multipart/form-data">
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
        @foreach ($arts as $art)
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($art->category == 1)
                                <img class="card-img card-img-left" style="height: 100%" src="{{ $art->file }}"
                                    alt="Card image" />
                            @else
                                <video controls class="card-img card-img-left" style="height: 100%"
                                    src="{{ $art->file }}">
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
                                                data-bs-target="#editArtModal-{{ $art->id }}">Ubah</a>
                                            <a class="dropdown-item" href="{{ route('teacher.art.destroy', $art->id) }}"
                                                onclick="event.preventDefault();
                                                    if(confirm('Apa kamu yakin ingin menghapus karyamu?')){
                                                    document.getElementById('delete-form').submit();
                                                    }">
                                                Hapus
                                            </a>

                                            <form id="delete-form" action="{{ route('teacher.art.destroy', $art->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </div>
                                    </div>
                                @endif
                                <h5 class="card-title">{{ $art->title }}</h5>
                                <p class="card-text">
                                    {{ $art->caption }}
                                </p>
                                <p class="card-text"><small class="text-muted">Diunggah {{ $art->diff }}</small></p>
                                @if ($art->is_liked)
                                    <button type="button" id="btnUnlike-{{ $art->id }}"
                                        class="btn btn-primary btn-sm" onclick="unlike({{ $art->id }})"><i
                                            class="fas fa-thumbs-down" id="thumbs-down-{{ $art->id }}"></i></button>
                                @else
                                    <button type="button" id="btnLike-{{ $art->id }}"
                                        class="btn btn-primary btn-sm" onclick="like({{ $art->id }})"><i
                                            class="fas fa-thumbs-up" id="thumbs-up-{{ $art->id }}"></i></button>
                                @endif
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#commentModal" onclick="showComments({{ $art->id }})"><i
                                        class="fas fa-comment"></i></button>
                                <br>
                                <br>
                                <span class="like-count" data-art-id="{{ $art->id }}">{{ $art->like }}</span>
                                Suka
                                <span class="like-count ms-1"
                                    data-art-id="comment-{{ $art->id }}">{{ $art->comment }}</span>
                                Komentar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" style="z-index: 99999" id="commentModal" tabindex="-1"
                aria-labelledby="commentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel">Berikan komentarmu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="comment-list" id="comment-list">
                                <!-- The list of comments will be displayed here -->
                            </div>
                            <hr>
                            <form>
                                <div class="mb-3">
                                    <label for="commentText" class="form-label">Comment</label>
                                    <textarea class="form-control" id="commentText" rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="postComment()"
                                data-post-id="{{ $art->id }}">Add Comment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" style="z-index: 99999" id="editArtModal-{{ $art->id }}" tabindex="-1"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Ubah Informasi Karya</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editArtForm" action="{{ route('teacher.art.update', $art->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="editTitle" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="editTitle" name="title"
                                        value="{{ $art->title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="editCaption" class="form-label">Caption</label>
                                    <textarea class="form-control" id="editCaption" name="caption">{{ $art->caption }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- End of Art -->
        <button type="button"
            class="btn btn-icon btn-outline-primary rounded-circle btn-lg position-fixed bottom-0 end-0 m-4"
            data-bs-toggle="modal" data-bs-target="#uploadModal"><i class="fas fa-plus"></i></button>
        @if ($arts->isNotEmpty())
            <div class="d-flex justify-content-center mt-4">
                {!! $arts->links('pagination.custom') !!}
            </div>
        @endif
    </div>
    <!-- End of Content -->
@endsection

<script script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
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

                // Append each comment to the list
                $.each(response.data, function(index, comment) {
                    console.log(comment);

                    var deleteIcon = '';
                    if (comment.user.id == '{{ Auth::user()->id }}') {
                        // Display the delete icon if the comment belongs to the current user
                        deleteIcon = '<i class="fa fa-trash" onclick="deleteComment(' + comment.id +
                            ')"></i>';
                    }

                    var html =
                        '<div class="card mb-3">' +
                        '<div class="card-header d-flex justify-content-between">' +
                        '<h5 class="card-title">' + comment.user.name + '</h5>' +
                        '<div class="ml-auto">' + deleteIcon + '</div>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p class="card-text">' + comment.comment + '</p>' +
                        '</div>' +
                        '</div>';

                    $('.comment-list').append(html);
                });
            }
        });
    }

    function postComment() {
        var token = '{{ session('auth_token') }}';

        // Get the comment text and post ID
        var commentText = document.getElementById("commentText").value;
        var id = document.querySelector("#commentModal .btn-primary").getAttribute("data-post-id");

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

                // Refresh the comment list
                showComments(id);
            })
            .catch(function(error) {
                // Handle errors
                console.log(error);
            });
    }

    function deleteComment(commentId) {
        var token = '{{ session('auth_token') }}';

        // Make an AJAX call to delete the comment
        $.ajax({
            url: '/api/art/comments/' + commentId,
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                showComments(response.data.art_id);
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
                $('.like-count[data-art-id=' + id + ']').text(count);
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
                $('.like-count[data-art-id=' + id + ']').text(count);
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
                $('.like-count[data-art-id=' + id + ']').text(count);
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
                $('.like-count[data-art-id=' + id + ']').text(count);
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

@extends('content/general/layouts/horizontalLayout')

@section('title', 'Modifikasi Profil')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan Akun /</span> Informasi
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class="ti-xs ti ti-users me-1"></i> Informasi</a></li>
                @if (Auth::user()->role == 'student')
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.profile.security') }}"><i
                                class="ti-xs ti ti-lock me-1"></i> Keamanan</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('teacher.profile.security') }}"><i
                                class="ti-xs ti ti-lock me-1"></i> Keamanan</a></li>
                @endif
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Detil Profil</h5>
                @if (Session::has('success'))
                    <div class="alert alert-success col-lg-6 ms-3">
                        {!! Session::get('success') !!}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif
                @if (Session::has('errors'))
                    <div class="alert alert-danger col-lg-6 ms-3">
                        {{ Session::get('errors') }}
                        @php
                            Session::forget('errors');
                        @endphp
                    </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{ route('teacher.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img @if (Auth::user()->photo_profile == null) src="{{ asset('assets/img/avatars/blank.png') }}" @else src="{{ Auth::user()->photo_profile }}" @endif
                                alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" id="photo_profile" name="photo_profile"
                                        class="account-file-input" hidden accept="image/png, image/jpeg"
                                        onchange="changeImage(this);" />
                                </label>
                                <button type="button" class="btn btn-label-secondary account-image-reset mb-3"
                                    onclick="deleteImage();">
                                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div class="text-muted">Pilih file dengan ekstensi JPG atau PNG dengan ukuran maksimal 5 MB
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ Auth::user()->email }}" />
                            </div>
                            @if (Auth::user()->role == 'student')
                                <div class="mb-3 col-md-6">
                                    <label for="class" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="class" name="class"
                                        value="{{ Auth::user()->class }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="absence_number">Nomor Absen</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="absence_number" name="absence_number" class="form-control"
                                            value="{{ Auth::user()->absence_number }}" />
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary">Batal</button>
                        </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadedAvatar').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteImage() {
            $('#uploadedAvatar').attr('src', '{{ asset('assets/img/avatars/blank.png') }}');
            $('#photo_profile').val('');
        }
    </script>
@endpush

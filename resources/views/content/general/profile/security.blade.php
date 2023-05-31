@php
    $configData = Helper::appClasses();
@endphp

@extends('content/general/layouts/horizontalLayout')

@section('title', 'Modifikasi Kata Sandi')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-account-settings.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-security.js') }}"></script>
    <script src="{{ asset('assets/js/modal-enable-otp.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan Akun /</span> Keamanan
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                @if (Auth::user()->role == 'student')
                    <li class="nav-item"><a class="nav-link" href="{{ route('student.profile.index') }}"><i
                                class="ti-xs ti ti-users me-1"></i> Informasi</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('teacher.profile.index') }}"><i
                                class="ti-xs ti ti-users me-1"></i> Informasi</a></li>
                @endif
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                            class="ti-xs ti ti-lock me-1"></i>
                        Keamanan</a></li>
            </ul>
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Ubah Kata Sandi</h5>
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
                <div class="card-body">
                    <form method="POST"
                        @if (Auth::user()->role == 'teacher') action="{{ route('teacher.profile.change_password') }}" 
                        @else action="{{ route('student.profile.change_password') }}" @endif>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="currentPassword">Kata Sandi Saat Ini</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="old_password" id="currentPassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="newPassword">Kata Sandi Baru</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="newPassword" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label class="form-label" for="confirmPassword">Konfirmasi Kata Sandi Baru</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="confirm_password" id="confirmPassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h6>Contoh Kata Sandi yang Baik:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Mengandung 8 kata - semakin banyak, semakin baik</li>
                                    <li class="mb-1">Terdiri dari minimal satu huruf kecil dan satu huruf besar</li>
                                    <li>Terdiri dari minimal satu angka dan satu simbol</li>
                                </ul>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-label-secondary">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->
        </div>
    </div>

@endsection

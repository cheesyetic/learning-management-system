@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('content/auth/layouts/layout')

@section('title', 'Register')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
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
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('register.show') }}" class="app-brand-link gap-2">
                                <img class="app-brand-logo demo"
                                    src="https://cdn-icons-png.flaticon.com/512/2021/2021397.png" />
                                <span
                                    class="app-brand-text demo text-body fw-bold ms-1">{{ config('variables.templateName') }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 pt-2 text-center">Daftar sebagai</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary w-100 mb-3" onclick="showStudentForm()">Siswa</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary w-100 mb-3" onclick="showTeacherForm()">Guru</button>
                            </div>
                        </div>
                        <form id="formStudent" class="mb-3" action="{{ route('register') }}" method="POST"
                            style="display:block" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="role" value="student">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama lengkap" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email aktif anda disini" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="class" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="class" name="class"
                                    placeholder="Masukkan kelas anda" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="absence_number" class="form-label">Nomor Absen</label>
                                <input type="number" class="form-control" id="absence_number" name="absence_number"
                                    placeholder="Masukkan nomor absen" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm_password" class="form-control"
                                        name="confirm_password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="confirm_password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Daftar
                            </button>
                        </form>
                        <form id="formTeacher" class="mb-3" action="{{ route('register') }}" method="POST"
                            style="display:none" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="role" value="teacher">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama lengkap" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email aktif anda disini" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm_password" class="form-control"
                                        name="confirm_password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="confirm_password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">
                                Daftar
                            </button>
                        </form>
                        <p class="text-center">
                            <span>Sudah memiliki akun?</span>
                            <a href="{{ route('login.show') }}">
                                <span>Masuk disini</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function showStudentForm() {
        // hide the teacher form fields
        document.getElementById('formTeacher').style.display = 'none';

        // show the student form fields
        document.getElementById('formStudent').style.display = 'block';
    }

    function showTeacherForm() {
        // hide the student form fields
        document.getElementById('formStudent').style.display = 'none';

        // show the teacher form fields
        document.getElementById('formTeacher').style.display = 'block';
    }
</script>

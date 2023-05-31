@extends('content/general/layouts/horizontalLayout')

@section('title', 'Lihat Tugas')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success col-lg-6 mx-auto">
                {!! Session::get('success') !!}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        @if (Session::has('errors'))
            <div class="alert alert-danger col-lg-6 mx-auto">
                {{ Session::get('errors') }}
                @php
                    Session::forget('errors');
                @endphp
            </div>
        @endif
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <span class="card-text d-flex align-items-center mb-3">
                        <span class="badge rounded-pill bg-label-danger">
                            {{ $task->deadline }}</span>
                    </span>
                    @if ($task->file == null)
                        <p class="card-text">Tidak ada file yang dapat diunduh</p>
                    @else
                        <a href="{{ route('student.task.download', $task->file) }}"
                            class="btn btn-primary waves-effect waves-light">Unduh Dokumen
                            Tugas</a>
                    @endif
                    <a href="{{ route('student.task.index') }}" class="btn btn-danger waves-effect waves-light">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Kumpulkan Pekerjaanmu Disini</h5>
                    <form method="POST" action="{{ route('student.task.store') }}" enctype="multipart/form-data"
                        class="dropzone needsclick" id="dropzone-basic">
                        @csrf
                        <div class="dz-message needsclick">
                            Tarik file kesini atau klik untuk mengunggah (Maksimal 5 MB)
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                        <button type="submit" class="btn btn-primary">Unggah Tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

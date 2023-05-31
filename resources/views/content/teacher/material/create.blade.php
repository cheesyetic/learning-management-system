@extends('content/general/layouts/horizontalLayout')

@section('title', 'Buat Materi')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
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
        <div class="col text-center">
            <h2>Buat Materi Baru</h2>
        </div>
        <form action="{{ route('teacher.material.store') }}" class="form mx-auto" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group col-lg-6 mx-auto">
                <label for="title">Judul Materi</label>
                <input type="text" required class="form form-control" name="title" id="title"
                    value="{{ old('title') }}">
            </div>
            <div class="form-group col-lg-6 mx-auto mt-2">
                <label for="description">Deskripsi Materi</label>
                <textarea class="form form-control" required rows="5" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group col-lg-6 mx-auto mt-2">
                <label for="file">Upload Dokumen Materi (Maksimal 5 Mb)</label>
                <input type="file" id="file" accept=".doc,.docx,.pdf,.xls,.xlsx,.csv,.ppt,.pptx"
                    class="form form-control" name="file">
            </div>
            <div class="col-lg-6 mx-auto mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('teacher.material.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection

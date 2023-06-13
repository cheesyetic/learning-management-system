@extends('content/general/layouts/horizontalLayout')

@section('title', 'Menilai Tugas')

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
            <h2>Periksa Penugasan</h2>
        </div>
        <form action="{{ route('teacher.assignment.update', $assignment->id) }}" class="form mx-auto" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-lg-6 mx-auto">
                <label for="status-keterangan">Status</label>
                <input type="text" readonly class="form form-control" name="status-keterangan" id="status-keterangan"
                    value="@if ($assignment->type == 1) Tepat Waktu @else Terlambat @endif">
            </div>
            <div class="form-group col-lg-6 mx-auto mt-2">
                <label for="score">Nilai</label>
                <input type="number" required class="form form-control" min="0" max="100" name="score"
                    id="score" value="{{ old('score') }}">
            </div>
            <div class="form-group col-lg-6 mx-auto mt-2">
                <label for="note">Catatan</label>
                <textarea class="form form-control" required rows="5" id="note" name="note">{{ old('note') }}</textarea>
            </div>
            <div class="col-lg-6 mx-auto mt-3">
                @if ($assignment->file == null)
                    <p class="text-danger">Tidak ada hasil pekerjaan</p>
                @else
                    <a id="file" class="btn btn-primary me-2"
                        href="{{ route('teacher.assignment.download', $assignment->file) }}">Unduh
                        Hasil Pekerjaan</a>
                @endif
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('teacher.assignment.index', $assignment->task_id) }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection

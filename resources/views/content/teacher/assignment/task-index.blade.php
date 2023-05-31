@extends('content/general/layouts/horizontalLayout')

@section('title', 'Hasil Penugasan')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
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
                <h4 class="mb-3 mt-3">Daftar Tugas</h4>
                <div class="table-responsive">
                    <table id="tugas" class="table table-bordred table-striped">
                        <thead>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Judul</th>
                            <th style="text-align: center">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $task->title }}</td>
                                    <td class="" style="text-align: center">
                                        <a href="{{ route('teacher.assignment.index', $task->id) }}"
                                            class="btn btn-sm m-1 btn-info" role="button" data-bs-toggle="Lihat"
                                            data-bs-placement="top" title="Lihat">
                                            <i class="fa-solid fa-chevron-right p-0"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tugas').DataTable();
    });
</script>

@extends('content/general/layouts/horizontalLayout')

@section('title', 'Lihat Materi')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $material->title }}</h5>
            <p class="card-text">{{ $material->description }}</p>
            <a href="{{ route('student.material.download', $material->file) }}"
                class="btn btn-primary waves-effect waves-light">Unduh Materi</a>
            <a href="{{ route('student.material.index') }}" class="btn btn-danger waves-effect waves-light">Kembali</a>
        </div>
    </div>
    </div>
@endsection

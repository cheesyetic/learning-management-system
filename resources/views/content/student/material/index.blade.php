@extends('content/general/layouts/horizontalLayout')

@section('title', 'Materi')

@section('content')
    @if ($materials->isEmpty())
        <div class="d-flex align-items-center justify-content-center flex-column" style="height: 75vh;">
            <h4 class="text-center">Belum ada materi yang tersedia nih :(</h4>
        </div>
    @endif
    <div class="row">
        @foreach ($materials as $material)
            <div class="col-md-6 col-lg-4 m-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $material->title }}</h5>
                        <p class="card-text">{{ $material->description }}</p>
                        <a href="{{ route('student.material.show', $material->uuid) }}"
                            class="btn btn-primary waves-effect waves-light">Lihat
                            selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

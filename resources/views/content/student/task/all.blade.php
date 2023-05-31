@extends('content/general/layouts/horizontalLayout')

@section('title', 'Tugas')

@section('content')
    <div class="row">
        @foreach ($tasks as $task)
            <div class="col-md-6 col-lg-4 m-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">{{ $task->description }}</p>
                        <span class="card-text d-flex align-items-center mb-3">
                            <span class="badge rounded-pill bg-label-danger">
                                {{ $task->deadline }}</span>
                        </span>
                        <a href="{{ route('student.task.show', $task->uuid) }}"
                            class="btn btn-primary waves-effect waves-light">Lihat
                            selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

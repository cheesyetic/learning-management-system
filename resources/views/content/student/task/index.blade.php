@extends('content/general/layouts/horizontalLayout')

@section('title', 'Tugas')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor//libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor//libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor//libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor//libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor//libs/quill/quill.js') }}"></script>
@endsection

@section('content')
    <div class="app-kanban">
        <div class="kanban-wrapper ps" style="height: 100%">
            <div class="kanban-container flex-column flex-lg-row">
                <div class="kanban-board" style="width: 100% !important; margin-left: 15px; margin-right: 15px;">
                    <header class="kanban-board-header">
                        <div class="kanban-title-board">Belum Terkumpul</div>
                    </header>
                    <div class="kanban-drag">
                        @if ($unassigned_tasks->isEmpty())
                            <div class="kanban-item w-100">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges fw-bold">
                                        Selamat! Tugasmu sudah selesai semua!
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($unassigned_tasks as $task)
                                <a href="{{ route('student.task.show', $task->uuid) }}"
                                    class="text-decoration-none text-dark" style="--bs-text-opacity: none;">
                                    <div class="kanban-item w-100">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges fw-bold">
                                                {{ $task->title }}
                                            </div>
                                        </div>
                                        <span class="kanban-text">{{ $task->description }}</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="badge rounded-pill bg-label-danger">
                                                        {{ $task->deadline }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <a href="{{ route('student.task.all', 0) }}" class="btn btn-primary m-auto">Lihat Semua</a>
                        @endif
                    </div>
                    <footer></footer>
                </div>
                <div data-id="board-in-review" data-order="2" class="kanban-board"
                    style="width: 100% !important; margin-left: 15px; margin-right: 15px;">
                    <header class="kanban-board-header">
                        <div class="kanban-title-board">Dalam Pengecekan</div>
                    </header>
                    <main class="kanban-drag">
                        @if ($unchecked_tasks->isEmpty())
                            <div class="kanban-item w-100" style="cursor: auto">
                                <div class="d-flex justify-content-between flex-wrap align-items-center">
                                    <div class="item-badges m-0">
                                        Belum ada tugas yang kamu kumpulkan nih
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($unchecked_tasks as $task)
                                <a href="{{ route('student.task.edit', $task->uuid) }}"
                                    class="text-decoration-none text-dark" style="--bs-text-opacity: none;">
                                    <div class="kanban-item w-100">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges fw-bold">
                                                {{ $task->title }}
                                            </div>
                                        </div>
                                        <span class="kanban-text">{{ $task->description }}</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="badge rounded-pill bg-label-danger">
                                                        {{ $task->deadline }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <a href="{{ route('student.task.all', 1) }}" class="btn btn-primary m-auto">Lihat Semua</a>
                        @endif
                    </main>
                    <footer></footer>
                </div>
                <div data-id="board-done" data-order="3" class="kanban-board"
                    style="width: 100% !important; margin-left: 15px; margin-right: 15px;">
                    <header class="kanban-board-header">
                        <div class="kanban-title-board">Selesai</div>
                    </header>
                    <main class="kanban-drag">
                        @if ($checked_tasks->isEmpty())
                            <div class="kanban-item w-100" style="cursor: auto">
                                <div class="d-flex justify-content-between flex-wrap align-items-center">
                                    <div class="item-badges m-0">
                                        Belum ada tugas yang sudah dinilai, sabar ya!
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($checked_tasks as $task)
                                <a href="{{ route('student.task.show', $task->uuid) }}"
                                    class="text-decoration-none text-dark" style="--bs-text-opacity: none;">
                                    <div class="kanban-item w-100">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges fw-bold">
                                                {{ $task->title }}
                                            </div>
                                        </div>
                                        <span class="kanban-text">{{ $task->description }}</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="badge rounded-pill bg-label-danger">
                                                        {{ $task->deadline }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            {{-- show all button --}}
                            <a href="{{ route('student.task.all', 2) }}" class="btn btn-primary m-auto">Lihat Semua</a>
                        @endif
                    </main>
                    <footer></footer>
                </div>
            </div>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </div>
    </div>
@endsection

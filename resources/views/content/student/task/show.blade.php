@extends('content/general/layouts/horizontalLayout')

@section('title', 'Lihat Tugas')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
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
                    <form method="POST" id="form_field" action="{{ route('student.task.store') }}"
                        enctype="multipart/form-data" class="needsclick">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="dropzone needsclick" id="dropzone">
                            <a class="dropzone-remove-all bg-danger p-2 px-3 rounded rounded-sm btn-sm text-white btn-danger"
                                style="display: none">Hapus
                                file</a>

                            <div class="dz-message needsclick">
                                Tarik file kesini atau klik untuk mengunggah (Maksimal 5 MB)
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                        </div>
                        <button type="submit" id="btn-submit" class="btn btn-primary mt-2">Unggah Tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Form submit ID, so the file will be added and submitted when the element clicked
        const submitBtn = document.getElementById('btn-submit');
        const formField = document.getElementById('form_field');
        // Variable to save uploaded files
        var fileInputs = [];

        // Event: When the form is submitted
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Update the file input fields with the stored files
            fileInputs.forEach((inputData, index) => {
                const input = formField.querySelector(
                    `input[type="file"][name="${inputData.fieldName}"][data-uuid="${inputData.uuid}"]`
                );
                if (input && inputData.file.status === 'added') {
                    const file = inputData.file;
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                }
            });

            // Submit the form
            formField.submit();
        });

        // select element with class dropzone and loop for every element
        const dropzoneFields = document.querySelectorAll('.dropzone');
        dropzoneFields.forEach(dropzoneElement => {
            // <input name="">
            const inputFieldName = `file`;

            // set the preview element template
            const previewTemplate = `<div class="dz-preview dz-file-preview">
            <div class="dz-details">
              <div class="dz-thumbnail">
                <img data-dz-thumbnail>
                <span class="dz-nopreview">No preview</span>
                <div class="dz-success-mark"></div>
                <div class="dz-error-mark"></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
              </div>
              <div class="dz-filename" data-dz-name></div>
              <div class="dz-size" data-dz-size></div>
            </div>
            </div>`;

            const dropzoneConfig = {
                url: "#",
                autoDiscover: false,
                previewTemplate: previewTemplate,
                maxFilesize: 5,
                autoQueue: false,
                maxFiles: 1,
            }
            new Dropzone(`#${dropzoneElement.id}`, {
                ...dropzoneConfig,
                init: function() {
                    var _this = this

                    this.on("addedfile", function(file) {
                        dropzoneElement.querySelector('.dropzone-remove-all').style.display =
                            "inline-block";
                        const dropzoneItems = dropzoneElement.querySelectorAll(
                            '.dropzone-item');
                        dropzoneItems.forEach(dropzoneItem => {
                            dropzoneItem.style.display = '';
                        });

                        fileInputs.push({
                            name: file.name,
                            uuid: file.upload.uuid,
                            fieldName: inputFieldName,
                            file
                        });

                        // Create a new input element
                        const input = document.createElement('input');
                        input.type = 'file';
                        input.name = inputFieldName;
                        input.setAttribute('data-uuid', file.upload.uuid);
                        input.style.display = 'none'; // Hide the input element

                        // Append the input element to the form
                        dropzoneElement.appendChild(input);
                    });

                    // Setup the button for remove all files
                    dropzoneElement.querySelector(".dropzone-remove-all").addEventListener('click',
                        function() {
                            dropzoneElement.querySelector('.dropzone-remove-all').style.display =
                                "none";
                            _this.removeAllFiles(true);
                        });

                    this.on("removedfile", function(file) {
                        // Remove the file that matches the file uuid
                        fileInputs = fileInputs.filter(item => item.uuid !== file.upload.uuid);
                        dropzoneElement.removeChild(dropzoneElement.querySelector(
                            `input[type="file"][name="${inputFieldName}"][data-uuid="${file.upload.uuid}"]`
                        ));
                        // If all files removed then hide the .dropzone-remove-all button
                        if (this.files.length < 1) {
                            dropzoneElement.querySelector('.dropzone-remove-all').style
                                .display = "none";
                        }
                    });

                }
            });
        });
    </script>
@endpush

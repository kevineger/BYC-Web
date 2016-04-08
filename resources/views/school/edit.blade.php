@extends('app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <h2 class="ui teal image header">
        <div class="content">
            Edit an Existing School
        </div>
    </h2>
    {!! Form::model($school, ['method' => 'PATCH', 'action' => ['SchoolsController@update', $school], 'class' => 'ui large form']) !!}
    @include('school.form', ['submitButtonText' => 'Update School'])
    {!! Form::close() !!}

    <div class="ui section divider"></div>
    <h1 class="ui teal header ">Add a School Photos</h1>
    <form id="addPhotosForm" action="{{ route('addPhotoToSchool', [$school]) }}" method="POST" class="dropzone">
        {{ csrf_field() }}
    </form>
    <br>
    <a href="{{ URL::previous() }}" class="ui labeled icon button">
        <i class="left chevron icon"></i>
        Back
    </a>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script>
        $(".dz-image").on('click', function (event) {
            alert("Clicked");
            alert(event.target.id);
        });
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFileSize: 3,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png',
            addRemoveLinks: true,
            clickable: true,
            removedfile: function (file) {
                var name = file.name;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/schools/{!! $school->id !!}/removePhoto/',
                    data: {id: file.id},
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            init: function () {
                // On success, give the file the unique ID in DB (response data).
                this.on("success", function (file, response) {
                    file.id = response;
                });
                // Add pre-existing images to Dropzone
                @foreach($school->photos as $photo)
                // Create the mock file:
                var mockFile = {
                    id: '{!! $photo->id !!}',
                    name: '{!! $photo->path !!}',
                    size: '{!! $photo->size !!}'
                };

                // Call the default addedfile event handler
                this.emit("addedfile", mockFile);
                // And optionally show the thumbnail of the file:
                this.emit("thumbnail", mockFile, "/{!! $photo->thumbnail_path !!}");
                this.emit("complete", mockFile);
                @endforeach
            }
        };
    </script>
@endsection
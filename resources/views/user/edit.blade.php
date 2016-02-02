@extends('app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')


<div class="ui segment">
    <h1 class="ui teal header ">Edit Your Profile</h1>

        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user], 'class'=>"ui form"]) !!}
        <div class="field">
            {!! Form::label('name', 'User Name') !!}
            {!! Form::text('name', null) !!}
        </div>
        <div class="field">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'ui teal button']) !!}
        </div>
        {!! Form::close() !!}
</div>
<div class="ui section divider"></div>
<h1 class="ui teal header ">Add Photos to Profile</h1>
    <div class="col-lg-12">
        <form id="addPhotosForm" action="{{ route('addPhotoToUser', [$user]) }}" method="POST" class="dropzone">
            {{ csrf_field() }}
        </form>
    </div>

    @if ($errors->any())
        <ul class="ui error message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
<br>
<a href="{{ action('UsersController@show', [Auth::user()]) }}" class="ui labeled icon button">
    <i class="left chevron icon"></i>
    Back To Profile
</a>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFileSize: 3,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png',
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/users/{!! $user->id !!}/removePhoto/',
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
                @foreach($user->photos as $photo)
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
                // Or if the file on your server is not yet in the right
                // size, you can let Dropzone download and resize it
                // callback and crossOrigin are optional.
                //                var imageUrl = "/photos/schools/1452965443school.png";
                //                myDropzone.createThumbnailFromUrl(file, imageUrl, callback, crossOrigin);
                //                myDropzone.createThumbnailFromUrl(file, imageUrl);

                // Make sure that there is no progress bar, etc...
                this.emit("complete", mockFile);
                @endforeach

            }
        };
    </script>
@endsection
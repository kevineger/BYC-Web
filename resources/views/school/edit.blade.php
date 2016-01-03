@extends('app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
@endsection

@section('content')
    <h1>Edit an existing School</h1>
    {!! Form::model($school, ['method' => 'PATCH', 'action' => ['SchoolsController@update', $school]]) !!}
    @include('school.form', ['submitButtonText' => 'Update School'])
    {!! Form::close() !!}

    <form id="addPhotosForm" action="{{ route('addPhotoToSchool', [$school]) }}" method="POST" class="dropzone">
        {{ csrf_field() }}
    </form>

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
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFileSize: 3,
            acceptedFiles: '.jpeg, .jpg, .tiff, .gif, .bmp, .png'
        };
    </script>
@endsection
@extends('app')

@section('content')
    <h1>Edit an existing Course</h1>
    {!! Form::model($course, ['method' => 'PATCH', 'action' => ['CourseController@update', $course]]) !!}
    @include('course.form', ['submitButtonText' => 'Update Course'])
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
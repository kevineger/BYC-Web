@extends('app')

@section('content')
    <h1>Create a new Course</h1>
    {!! Form::model($course = new App\Course, ['url' => 'courses']) !!}
    @include('course.form', ['submitButtonText' => 'Create Course'])
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection


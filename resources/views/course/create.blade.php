@extends('app')

@section('content')
    <h2 class="ui teal image header">
        <div class="content">
            Create a new Course
        </div>
    </h2>
    {!! Form::model($course = new App\Course, ['url' => 'courses', 'class' => 'ui large form']) !!}
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


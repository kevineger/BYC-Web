@extends('app')

@section('content')
    <h2 class="ui center aligned teal header">
        <div class="content">
            Create a new Course
        </div>
    </h2>
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


@extends('app')

@section('content')
    <h1>Create a new School</h1>
    {!! Form::model($school = new App\School, ['action' => ['SchoolsController@show', $school]]) !!}
    @include('school.form', ['submitButtonText' => 'Create School'])
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
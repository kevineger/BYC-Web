@extends('app')

@section('content')
    <h2 class="ui teal image header">
        <div class="content">
            Create a new School
        </div>
    </h2>
    {!! Form::model($school = new App\School, ['action' => ['SchoolsController@show', $school], 'class' => 'ui large form']) !!}
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

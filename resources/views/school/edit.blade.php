@extends('app')

@section('content')
    <h1>Edit an existing School</h1>
    {!! Form::model($school, ['method' => 'PATCH', 'action' => ['SchoolController@update', $school]]) !!}
    @include('school.form', ['submitButtonText' => 'Update School'])
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
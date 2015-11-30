@extends('app')

@section('content')
    <h1>Edit Your Profile</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user]]) !!}
            {{--@include('school.form', ['submitButtonText' => 'Update School'])--}}
            <div class="form-group">
                {!! Form::label('name', 'User Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection
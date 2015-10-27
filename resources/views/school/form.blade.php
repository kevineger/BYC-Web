{!! Form::label('name', 'School Name') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}

{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', null, ['class' => 'form-control']) !!}

{!! Form::label('address', 'Address') !!}
{!! Form::text('address', null, ['class' => 'form-control']) !!}

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
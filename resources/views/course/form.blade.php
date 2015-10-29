{!! Form::label('name', 'Course Name') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}

{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', null, ['class' => 'form-control']) !!}

{!! Form::label('min_age', 'Min Age') !!}
{!! Form::input('number','min_age', null, ['class' => 'form-control']) !!}

{!! Form::label('max_age', 'Max Age') !!}
{!! Form::input('number','max_age', null, ['class' => 'form-control']) !!}

{!! Form::label('price', 'Price') !!}
{!! Form::input('number','price', null, ['class' => 'form-control']) !!}

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}

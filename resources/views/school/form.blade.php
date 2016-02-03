<div class="ui grid">
    <div class="column">
        <div class="field">
            {!! Form::label('name', 'School Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('address', 'Address') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::submit($submitButtonText, ['class' => 'ui fluid large teal submit button']) !!}
        </div>
    </div>
</div>







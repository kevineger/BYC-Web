<div class="ui grid">
    <div class="column">
        <div class="field">
            {!! Form::label('name', 'Course Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('active', 'Active') !!}
            {!! Form::checkbox('active', '1') !!}
        </div>
        <div class="field">
            {!! Form::label('all_ages', 'All Ages') !!}
            {!! Form::checkbox('all_ages') !!}
        </div>
        <div class="field">
            {!! Form::label('min_age', 'Min Age') !!}
            {!! Form::input('number','min_age', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('max_age', 'Max Age') !!}
            {!! Form::input('number','max_age', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::label('price', 'Price') !!}
            {!! Form::input('number','price', null, ['class' => 'form-control']) !!}
        </div>
        <div class="field">
            {!! Form::submit($submitButtonText, ['class' => 'ui fluid large teal submit button']) !!}
        </div>
    </div>
</div>

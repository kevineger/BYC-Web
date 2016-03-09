@section('header')
    {{--Clock Picker--}}
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/libs.css') }}" type='text/css'>
@endsection

<div class="ui centered grid">
    <div class="twelve wide column">
        <div class="ui form">
            <div class="field">
                {!! Form::label('name', 'Course Name') !!}
                {!! Form::text('name') !!}
            </div>
            <div class="field">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description') !!}
            </div>
            <div class="inline fields">
                <div class="ten wide field">
                    <div class="ui labeled input">
                        <div class="ui label">$</div>
                        {!! Form::input('number','price') !!}
                    </div>
                </div>
                <div class="three wide field">
                    <div class="inline field">
                        <div class="ui toggle checkbox">
                            <input name="active" type="checkbox" tabindex="0" class="hidden" checked="checked">
                            <label>Active</label>
                        </div>
                    </div>
                </div>
                <div class="three wide field">
                    <div class="inline field">
                        <div class="ui toggle checkbox">
                            <input name="all_ages" type="checkbox" tabindex="0" class="hidden">
                            <label>All Ages</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    {!! Form::label('min_age', 'Min Age') !!}
                    {!! Form::input('number','min_age') !!}
                </div>
                <div class="field">
                    {!! Form::label('max_age', 'Max Age') !!}
                    {!! Form::input('number','max_age') !!}
                </div>
            </div>

            <div id="app">
                @include('course.times')
                <time></time>
            </div>

        </div>

        <div class="inline fields">
            <div class="four wide field">
                <div class="ui right aligned grid">
                    <button type="button" onclick="addTime()" class="ui green basic button">Add Another Time</button>
                </div>
            </div>
            <div class="twelve wide field">
                {!! Form::submit($submitButtonText, ['class' => 'ui fluid large teal submit button']) !!}
            </div>
        </div>
    </div>
</div>

@section('footer')
    {{--Vue JS--}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.17/vue.min.js"></script>
    <script>
        num = 0;
        var timeComponent = Vue.component('time', {
            template: '#times-template',
            data: function() {
                return {count: num}
            },
            methods: {
                toggleRepeat: function (e) {
                    var repeat = $(e.target);
                    repeat.parent().children().removeClass('green').addClass('grey');
                    repeat.removeClass('grey').addClass('green');
                    // Set the repeat hidden field type
                    repeat.parent().children().first().val(repeat.attr('id'));
                },
                toggleDay: function (e) {
                    e.preventDefault();
                    var dayOfWeek = $(e.target);
                    // If adding day of week
                    if (dayOfWeek.hasClass('grey')) {
                        dayOfWeek.removeClass('grey').addClass('green');
                        dayOfWeek.parent().append('<input class=' + dayOfWeek.attr('id') + ' type="hidden" name="days['+ this.$data.count +'][]" value=' + dayOfWeek.attr('id') + '>');
                    } else {
                        // Removing day of week
                        dayOfWeek.removeClass('green').addClass('grey');
                        console.log(dayOfWeek.parent());
                        dayOfWeek.parent().find("." + dayOfWeek.attr('id')).remove();
                    }
                }
            }
        });
        new Vue({
            el: '#app'
        });
        {{--Add Time Function--}}
        function addTime() {
            num++;
            new timeComponent().$mount().$appendTo('#app');
            {{--ClockPicker--}}
            $('.clockpicker').clockpicker();
        }
        {{--ClockPicker--}}
        $('.clockpicker').clockpicker();
        {{--Initialize the Semantic UI checkbox--}}
        $('.ui.checkbox').checkbox();
    </script>
@endsection
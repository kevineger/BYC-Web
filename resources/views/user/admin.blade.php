@extends('app')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')
    <h2 class="ui center aligned icon header">
        <i class="dashboard icon"></i>

        <div class="content">
            Admin Dashboard
            <div class="sub header">Manage schools, courses, payment.</div>
        </div>
    </h2>
    <br>
    @include('user.banner-selection')
    <br>
    <div class="ui styled fluid accordion">
        @include('user.partials.users')
        @include('user.partials.schools')
        @include('user.partials.courses')
        @include('user.partials.payment')
    </div>

@endsection
@section('footer')
    <script>
        $(document).ready(function(){
            $('.ui.accordion').accordion();
        });

        // Set a course or school as featured
        function setFeatured(event, model) {
            var target = $(event.target);
            id = target.attr('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "admin/" + model + "/" + id + "/feature"
            }).success(function (data) {
                model = "'" + model + "'";
                var parent = target.parent();
                parent.empty();
                // If school is featured, set it to not featured
                if (target.attr('data-featured') == 'true') {
                    parent.append('<a id="' + id + '" data-featured="false" class="ui basic orange button" onclick="setFeatured(event, ' + model + ')">Set As Featured</a>');
                }
                // Else, set it as not featured
                else {
                    parent.append('<a id="' + id + '" data-featured="true" class="ui basic teal button" onclick="setFeatured(event, ' + model + ')">Set As Not Featured</a>');
                    parent.append("<a class='ui teal tag label'>Featured</a>");
                }
            }).error(function (msg) {
                alert("Error: " + msg);
            });
        }
    </script>
@endsection
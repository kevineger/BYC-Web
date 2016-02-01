<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BYC</title>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    {{--JQuery--}}
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    {{---Fonts-----------------------------------------------------------------}}
    <link href='http://fonts.googleapis.com/css?family=Crimson+Text:600,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    {{-------------------------------------------------------------------------}}

    {{---Compiled CSS----------------------------------------------------------}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/libs.css') }}" type='text/css'>
    {{-------------------------------------------------------------------------}}


    @yield('head')

</head>
<body>

@include('partials.nav')

<div class="ui container">
    @yield('content')
</div>

{{---Compiled JS----------------------------------------------------------}}
<script src="{{ asset('js/libs.js') }}"></script>
{{-------------------------------------------------------------------------}}

{{---Stripe----------------------------------------------------------------}}
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
{{-------------------------------------------------------------------------}}
@yield('footer')

</body>
</html>
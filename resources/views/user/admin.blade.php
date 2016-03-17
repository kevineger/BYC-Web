@extends('app')

@section('content')
    <h2 class="ui center aligned icon header">
        <i class="dashboard icon"></i>

        <div class="content">
            Admin Dashboard
            <div class="sub header">Manage schools, courses, payment.</div>
        </div>
    </h2>
    <h3 class="ui dividing header">
        Users
    </h3>
    <div class="ui floating info message">
        <p>{{$users->whereLoose('vendor',1)->count()}} Vendor(s)</p>
        <p>{{$users->whereLoose('vendor',0)->count()}} Consumer(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>Vendor</th>
        <th>Update/Delete</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{ action('UsersController@show', $user) }}">{{$user->name}}</a></td>

                <td>{{$user->vendor}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user], 'style'=>'display:inline-block;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue button" href="{{ action('UsersController@edit', $user) }}" role="button">Edit User</a>
                </td>
            </tr>
        @endforeach
    </table>
    <h3 class="ui dividing header">
        Schools
    </h3>
    <div class="ui floating info message">
        <p>{{$schools->count()}} School(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>Vendor</th>
        <th># Courses</th>
        <th>Update/Delete</th>
        <th>Featured</th>
        </thead>
        <tbody>
        @foreach($schools as $school)
            <tr>
                <td><a href="{{ action('SchoolsController@show', $school) }}">{{$school->name}}</a></td>
                <td>{{$school->user->name}}</td>
                <td>{{$school->courses->count()}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school], 'style'=>'display:inline-block;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue button" href="{{ action('SchoolsController@edit', $school) }}"
                       role="button">Edit
                        School</a>
                </td>
                <td>
                    @if($school->featured)
                        <a class="ui basic teal button" href=""
                           role="button">Set as not featured</a>
                        <a class="ui teal tag label">Featured</a>
                    @else
                        <a class="ui basic orange button" href=""
                           role="button">Set As Featured</a>
                    @endif
                </td>

            </tr>
        @endforeach
    </table>
    <h3 class="ui dividing header">
       Courses
    </h3>
    <div class="ui floating positive message">
        <p>{{$courses->whereLoose('active',1)->count()}} Active Course(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>School</th>
        <th>Update/Delete</th>
        <th>Featured</th>
        </thead>
        <tbody>
        @foreach($courses->whereLoose('active',1) as $course)
            <tr>
                <td><a href="{{ action('CoursesController@show', $course) }}">{{$course->name}}</a></td>
                <td>{{$course->school->name}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}

                    <a class="ui basic blue button" href="{{ action('CoursesController@edit', $course) }}" role="button">Edit Course</a></td>
                <td>
                    @if($course->featured)
                        <a class="ui basic teal button" href=""
                           role="button">Set as not featured</a>
                        <a class="ui teal tag label">Featured</a>
                    @else
                        <a class="ui basic orange button" href=""
                           role="button">Set As Featured</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div class="ui section divider"></div>
    <div class="ui floating negative message">
        <p>{{$courses->whereLoose('active',0)->count()}} Inactive Course(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>School</th>
        <th>Update/Delete</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($courses->whereLoose('active',0) as $course)
            <tr>
                <td><a href="{{ action('CoursesController@show', $course) }}">{{$course->name}}</a></td>
                <td>{{$course->school->name}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue button" href="{{ action('CoursesController@edit', $course) }}" role="button">Edit Course</a></td>
                <td>
                    @if($course->featured)
                        <a class="ui basic teal button" href=""
                           role="button">Set as not featured</a>
                        <a class="ui teal tag label">Featured</a>
                    @else
                        <a class="ui basic orange button" href=""
                           role="button">Set As Featured</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <h3 class="ui dividing header">
       Payment
    </h3>
    <div class="ui floating info message">
        <p>{{$purchases->count()}} Purchase(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Course</th>
        <th>Consumer</th>
        <th>Vendor</th>
        <th>Quantity</th>
        <th>Payment Amount</th>
        <th>Paypal Id</th>
        <th>Date of Purchase</th>
        </thead>
        <tbody>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{$purchase->course->name}}</td>
                <td>{{$purchase->payment->user->name}}</td>
                <td>{{$purchase->course->school->user->name}}</td>
                <td>{{$purchase->quantity}}</td>
                <td>{{$purchase->subtotal}}</td>
                <td>{{$purchase->payment->paypal_id}}</td>
                <td>{{$purchase->created_at}}</td>
            </tr>
        @endforeach
    </table>
@endsection
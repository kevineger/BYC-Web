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
                <a class="ui basic blue button" href="{{ action('UsersController@edit', $user) }}" role="button">Edit
                    User</a>
            </td>
        </tr>
    @endforeach
</table>
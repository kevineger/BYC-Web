{!! Form::open(['route' => 'global.search']) !!}
<div class="ui huge icon fluid input">
    <input name="query_string" type="text" placeholder="Search the entire site">
    <i class="search icon"></i>
</div>
{!! Form::close() !!}
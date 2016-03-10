@if(session()->has('message'))
    <div class="ui info message">
        <div class="header">
            {{ session('message') }}
        </div>
    </div>
@endif

@if(session()->has('status'))
    <div class="ui info message">
        <div class="header">
            {{ session('status') }}
        </div>
    </div>
@endif
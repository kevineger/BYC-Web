@if(session()->has('message'))
    <div class="ui info message">
        <div class="header">
            {{ session('message') }}
        </div>
    </div>
@endif
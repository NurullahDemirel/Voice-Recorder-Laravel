@if(Session::has('processStatus'))
    <div class="alert alert-{{Session::get('processStatus')['type']}}">
        {{Session::get('processStatus')['message']}}
    </div>
@endif

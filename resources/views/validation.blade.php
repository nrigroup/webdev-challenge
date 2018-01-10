<!-- if the session contains a message instance -->
@if(session()->has('message'))
<div class="alert alert-danger">
        {{session()->get('message') }}
    </div>
@endif




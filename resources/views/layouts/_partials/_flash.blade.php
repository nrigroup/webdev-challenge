@if(session('danger'))
    <div class="alert-danger">
        {{ session('danger') }}
    </div>
@endif
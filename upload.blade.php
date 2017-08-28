@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        The file is successfully uploaded to the server.
        </div>
        
        <div div class="col-md-8 col-md-offset-2">
            <a href="{{ URL::to('showcsvdata',$fileExt) }}"><button class="btn btn-primary">Show CSV data</button></a>
        </div>
    </div>
</div>
@endsection


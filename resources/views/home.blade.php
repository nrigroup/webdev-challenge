@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h2>Please visit the <a href="{{ url('upload') }}">upload</a> page to upload a csv file.</h2>

                    <br>
                    <a href="{{ url('upload') }}" class="btn btn-info" role="button">Upload page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

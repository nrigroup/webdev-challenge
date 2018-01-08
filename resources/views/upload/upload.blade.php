@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upload</div>

                <div class="panel-body">
                    <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
                        <h2>CSV Upload</h2>

                        <div class="well form-group">
                            <label for="csv">File upload:</label>
                            <input type="file" name="csv" id="csv">
                            <p class="help-block">Upload a CSV file for processing</p>

                            <br>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
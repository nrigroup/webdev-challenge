@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Upload CSV File</h1>
        <div class="panel-body">
                
            <!-- Display Validation Errors -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/items/process" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="csv_file" class="col-sm-3 control-label">Select CSV file</label>

                    <div class="col-sm-6">
                        <input type="file" name="csv_file" id="csv-name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
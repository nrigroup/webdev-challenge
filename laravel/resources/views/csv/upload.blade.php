@extends('layouts.main')

@section('content')
<div class="page-header">
  <h1>Upload CSV Page</h1>
</div>
<div class="form-wrapper">
    <form id="csv-form" name="csv" method="post" action="{{url()->current()}}/parseData" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="pwd">CSV Upload*:</label>
            <input type="file" name="upload-csv" accept=".csv" class="form-contrsol required" id="file-upload"/>
        </div>
      <button type="button" id="form-submit" class="btn btn-default">Submit</button>
    </form>
</div>
<script>
    $(function() {
        $("#form-submit").on("click",function(){
            validateForm("csv-form");
        });
    });
</script>
@endsection
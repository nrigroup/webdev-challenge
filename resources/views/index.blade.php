@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1 class="text-left">Upload your data file</h1>
    <form class="form-inline" action="{{route('data.process')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <div class="form-group">
        <label for="data_file">Upload Data File</label>
        <input name="data_file" id="data_file" type="file" class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Upload CSV</button>
    </form>
  </div>
</div>

@endsection

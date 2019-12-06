@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-6 card">
      <div class="card-header">
        Import CSV
      </div>
      <div class="card-body">
        <form action="{{ route('upload_file') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="csv_file">Choose file</label>
            <input type="file" class="form-control-file{{ $errors->has('csv_file') ? ' is-invalid' : '' }}" id="csv_file" name="csv_file">
            @if ($errors->has('csv_file'))
              <div class="invalid-feedback">
                {{ $errors->first('csv_file') }}
              </div>
            @endif
          </div>
          <button type="submit" name="submit" class="btn btn-primary ">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
@endsection
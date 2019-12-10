@extends('layout.master')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1 class="header">NRI Web Dev Challenge</h1>
    </div>
  </div>
  <div class="card main-card shadow mb-5">
    <div class="row">
      <div class="col-sm-6">
        <img class="left-img" src="{{asset('images/windows_xp.jpg')}}" alt="">
      </div>
      <div class="col-sm-6">
        <div class="container form-div">
          {{-- <p class="instruction">Please select or drag csv file for submission.</p> --}}
          {{ Form::open(array(
            'route' => 'auctionSubmit', 
            'method' => 'POST',
            'id' => 'auction_data_upload_form',
            'files' => true)) }}
          
            <p class="instruction">Please select or drag csv file for submission.</p>
            <div class="custom-file mb-3">
              <input type="file" class="custom-file-input" id="customFile" name="csvFile">
              <label class="custom-file-label" for="csvFile">Choose file</label>
              <span class="error">{{$errorMessage}}</span>
            </div>
          
            <div class="text-center">
              <input class="btn btn-primary" type="submit" value="Submit">
            </div>
          
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@section('scripts')
<script src="{{asset('js/pages/home.js')}}"></script>
@endsection

@endsection
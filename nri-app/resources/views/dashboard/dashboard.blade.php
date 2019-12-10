@extends('layout.master')

@section('stylesheets')
<link rel="stylesheet" href="{{asset('css/pages/dashboard.css')}}">
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1 class="header">Dashboard</h1>
    </div>
  </div>
  <div class="card main-card shadow mb-5">
    <div class="row">
      <div class="col-sm-5 form-div">

        {{ Form::open(array(
          'route' => 'dashboardSubmit', 
          'method' => 'POST',
          'id' => 'dashboard_filter_form'))
        }}
        <p class="instruction">Please enter month and year to display auction expenses by category.</p>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <select name="monthFilter" id="monthFilter" class="form-control"
              value="{{isset($month) ? $month : ''}}">
              <option value="01" @if($month == "01") {{'selected'}} @endif>January</option>
              <option value="02" @if($month == "02") {{'selected'}} @endif>February</option>
              <option value="03" @if($month == "03") {{'selected'}} @endif>March</option>
              <option value="04" @if($month == "04") {{'selected'}} @endif>April</option>
              <option value="05" @if($month == "05") {{'selected'}} @endif>May</option>
              <option value="06" @if($month == "06") {{'selected'}} @endif>June</option>
              <option value="07" @if($month == "07") {{'selected'}} @endif>July</option>
              <option value="08" @if($month == "08") {{'selected'}} @endif>August</option>
              <option value="09" @if($month == "09") {{'selected'}} @endif>September</option>
              <option value="10" @if($month == "10") {{'selected'}} @endif>October</option>
              <option value="11" @if($month == "11") {{'selected'}} @endif>November</option>
              <option value="12" @if($month == "12") {{'selected'}} @endif>December</option>
            </select>
          </div>
          <div class="col-sm-6">
            <div class="input-group mb-3">
              <label for="yearFilter"></label>
              <input name="yearFilter" type="text" class="form-control yearFilter" 
                placeholder="Year" aria-label="Year" value="{{isset($year) ? $year : ''}}">
            </div>
          </div>
        </div>


        <div class="text-right">
          <input class="btn btn-primary submitButton" type="submit" value="Submit">
        </div>

        {{ Form::close() }}
      </div>
      <div class="col-sm-7 table-div">
        <p class="table-caption">Total expenses for the month of {{date('F, Y', mktime(0, 0, 0, $month, 10, $year))}}.</p>
        <br>
        <div class="data-table">
          <div class="row table-row first-row">
            <div class="col-sm-6">Category</div>
            <div class="col-sm-3">Pre-tax</div>
            <div class="col-sm-3">Total Spend</div>
          </div>
          @foreach($categories as $category)
            <div class="row table-row">
              <div class="col-sm-6">{{$category}}</div>
              <div class="col-sm-3">{{$preTaxByCat[$category]}}</div>
              <div class="col-sm-3">{{$spendingByCat[$category]}}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <a class="homeLink" href="{{route('homePage')}}">Return to Home Page</a>
</div>

</div>

@section('scripts')
<script src="{{asset('js/pages/dashboard.js')}}"></script>
@endsection

@endsection
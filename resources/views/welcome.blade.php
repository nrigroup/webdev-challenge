@extends('layouts.header')
@section('body')
<section>
  <div class="container p-5">
      <div class="row mb-5 text-center text-white">
        <div class="col-lg-10 mx-auto">

        @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
    </div>
      @endif

        @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
    </div>
      @endif

        @if (session('result'))
        <div class="alert alert-success">
       
       <ul>
        @foreach ( session('result') as $result)
      <li> Total Spending: {{ $result->total_spending }} for Category: {{$result->category}}  for Month: {{ $result->month}} </li>
      @endforeach
      </ul>
       
    </div>
      @endif
   <h1 class="display-4">NRI Industrial Sales</h1>
          <p class="lead">CSV File Import Dashboard</p>
         
        </div>
      </div>
  


  <form method="post" action="/Records" enctype="multipart/form-data">
  @csrf
    <div class="row">
    <div class="col-lg-5 mx-auto">
      <div class="p-5 bg-white shadow rounded-lg"><img src="https://res.cloudinary.com/mhmd/image/upload/v1557366994/img_epm3iz.png" alt="" width="200" class="d-block mx-auto mb-4 rounded-pill">
        <h6 class="text-center mb-4 text-muted">
          You can upload only csv file
        </h6>
        <label for="file" class="file-upload btn btn-primary btn-block rounded-pill shadow"><i class="fa fa-upload mr-2"></i>Browse for file ...
        <input id="file" required type="file" name="file">
        </label>
        <input type="submit" class="file-upload btn btn-primary btn-block rounded-pill shadow"/>
      </div>
    </div>
    </form>

    </div>
  </div>
</section>
@endsection
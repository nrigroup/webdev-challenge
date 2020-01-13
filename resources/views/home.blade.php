@extends('layouts.app')

@section('content')
<div class="main">
  <p>This application is to keep track of current spending for items that NRI has won from an auction. The details received electronically from the auctioneer will be imported into our central inventory system.</p> 
  <p>A simple web interface that will accept a .csv file and then store them in a relation database.</p>
</div>
@endsection

@section('sidebar')
  @parent
  <h4>Year To Date Amount</h4>
  <hr>
  <p>
  @foreach ($currentSpending as $item)
   ${{number_format($item->total, 2)}}
  @endforeach
  </p>
@endsection
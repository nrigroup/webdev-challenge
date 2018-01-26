@extends('layout.master')



@section ('content')

<div>
      <a href="/items">BACK</a>
</div>

<div class="table-responsive">
      <table class="table table-striped">
      <tr><th>id</th> <td>{{ $item->id }}</td> </tr> 
      <tr><th>date</th><td> {{ $item->date }} </td></tr> 
      <tr><th>category</th><td> {{ $item->category }} </td></tr> 
      <tr><th>lot_title</th><td> {{ $item->lot_title }}</td></tr> 
      <tr><th>lot_location</th><td> {{ $item->lot_location }}</td></tr> 
      <tr><th>lot_condition</th><td> {{ $item->lot_condition }}</td></tr> 
      <tr><th>pre_tax_amount</th><td> {{ $item->pre_tax_amount }} </td></tr> 
      <tr><th>tax_name</th> <td>{{ $item->tax_name }}</td></tr> 
      <tr><th>tax_amount</th><td> {{ $item->tax_amount }}</td></tr> 
      </table>
</div>

@endsection
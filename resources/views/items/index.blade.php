@extends('layout.master')


@section('content_header')

<section class="row text-center placeholders">
      <div class="col-6 col-sm-3 placeholder">
              <h4>List Of Items</h4>
      </div>
</section>


@endsection



@section('content')

<div class="table-responsive">
	<table class="table table-striped">
	  <tr>
		    <th>ID</th>
		    <th>date</th>
		    <th>category</th>
		    <th>lot_title</th>
  		  <th>lot_location</th>
  		  <th>lot_condition</th>
		    <th>pre_tax_amount</th>
		    <th>tax_name</th>
		    <th>tax_amount</th>
	   </tr>
	

	@foreach($items as $item)
		<tr>
			      <td> <a href="/items/{{ $item->id }}"> {{ $item->id }}</a></td>
            <td> {{ $item->date }} </td>
            <td> {{ $item->category }} </td>
            <td> {{ $item->lot_title }}</td>
            <td> {{ $item->lot_location }}</td>
            <td> {{ $item->lot_condition }}</td>
            <td> {{ $item->pre_tax_amount }} </td>
            <td> {{ $item->tax_name }}</td>
            <td> {{ $item->tax_amount }}</td>
		</tr>
	@endforeach

	</table>
</div>

@endsection
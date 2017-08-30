@extends('layout.master')

@section('content')

<h1 class="text-center">Inventory Data</h1>

<div class="text-center">
	<form method="post" action="/inventory">
	<h4>Confirm:
		{{csrf_field()}}	
		<button class="btn btn-success">Save to DB</button>
	 </h4>
	</form>
</div>

@include('partials.inventorytable')

@endsection
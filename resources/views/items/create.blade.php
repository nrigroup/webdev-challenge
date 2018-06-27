@extends('layout.master')

@section('content')

<div>
      
	<form method="POST" action="/items" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	<h3> Select File </h3>
	<hr>

	<input type="file" name="csv_file"></input>
	<hr>
	<input type="checkbox" name="startFresh"> Remove Old Table</input>
	<hr>

	<button type="submit">Upload File</button>

	</form>
	
</div>

@endsection
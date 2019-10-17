@extends ('layout')
@section ('content')
<div id="wrapper">
	<div id="page" class="container">
		<a class="btn btn-primary" href="/conditions/create" role="button">Add a new condition</a>

		<h3>Conditions:</h3>
		<ul class="list-group">
		@foreach($conditions as $condition)
	 <li class="list-group-item">{{$condition->title}} 
	 	<a class="btn btn-primary" href="/conditions/{{$condition->id}}/edit" role="button">Edit</a>
	 </li>		
		@endforeach
	 </ul>
	</div>
</div>
@endsection
@extends ('layout')
@section ('content')
    <div id="wrapper">
    	<div id="page" class="container">
    		<a class="btn btn-primary" href="/lots/create" role="button">Add a new lot</a>

    		<h3>Lots:</h3>
    		<ul class="list-group">
    		@foreach($lots as $lot)
			 <li class="list-group-item">{{$lot->title}} 
			 	<a class="btn btn-primary" href="/lots/{{$lot->id}}/edit" role="button">Edit</a>
			 </li>		
    		@endforeach
    		</ul>
    	</div>

    </div>
@endsection
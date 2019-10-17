@extends ('layout')
@section ('content')
    <div id="wrapper">
    	<div id="page" class="container">
    		<a class="btn btn-primary" href="/categories/create" role="button">Add a new category</a>

    		<h3>Categories:</h3>
    		<ul class="list-group">
    		@foreach($categories as $categorie)
			 <li class="list-group-item">Name: {{$categorie->name}} 
        <br/>
        Total amount spent per category: {{$categorie->total_amount}} $
        <br/>
			 	<a class="btn btn-primary" href="/categories/{{$categorie->id}}/edit" role="button">Edit</a>
			 </li>		
    		@endforeach
    		</ul>
    	</div>

    </div>
</div>
@endsection
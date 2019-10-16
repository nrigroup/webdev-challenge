@extends ('layout')
@section ('content')
<div class="container">
    <h1>Categories:</h1>
</div>                

	<div class="text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/upload/">Upload a file</a>
              </li>
              <li class="nav-item actif">
                <a class="nav-link" href="/categories/">Manage categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/conditions/">Manage conditions</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://github.com/laravel/laravel">GitHub</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>

    <div id="wrapper">
    	<div id="page" class="container">
    		<a class="btn btn-primary" href="/categories/create" role="button">Add a new category</a>

    		<h3>Categories:</h3>
    		<ul class="list-group">
    		@foreach($categories as $categorie)
			 <li class="list-group-item">{{$categorie->name}} 
			 	<a class="btn btn-primary" href="/categories/{{$categorie->id}}/edit" role="button">Edit</a>
			 </li>		
    		@endforeach
    		</ul>
    	</div>

    </div>
</div>
@endsection
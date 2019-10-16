@extends ('layout')
@section ('content')
<div class="container">
    <h1>Edit category</h1>
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
                <a class="nav-link" href="/upload/">Upload a  file</a>
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
    		<h3>Edit a Category:</h3>

    		<form method="POST" action="/categories/{{$categorie->id}}">
    			@csrf
    			@method('PUT')
    			
    			<div class="form-group">
    				<label for="InputTitle">Category name: </label>
    				<input type="text" class="form-control is-danger" id="name" name="name" placeholder="Default name" value="{{$categorie->name}}">
              @error('name')
                <div class="alert alert-danger" role="alert">
                  {{$errors->first('name')}}
                </div>
              @enderror
    			</div>
    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
        <form method="POST" action="/categories/{{$categorie->id}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Delete category</button>
        </form>
    	</div>

    </div>
</div>
@endsection
@extends ('layout')
@section ('content')
<div class="container">
    <h1>Edit lot</h1>
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
              <li class="nav-item">
                <a class="nav-link" href="/categories/">Manage categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/conditions/">Manage conditions</a>
              </li>
              <li class="nav-item actif">
                <a class="nav-link" href="/lots/">Manage lots</a>
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
    		<h3>Edit a lot:</h3>

    		<form method="POST" action="/lots/{{$lot->id}}">
    			@csrf
    			@method('PUT')
    			
    			<div class="form-group">
    				<label for="title">Lot title: </label>
    				<input type="text" class="form-control is-danger" id="title" name="title" placeholder="Default title" value="{{$lot->title}}">
              @error('title')
                <div class="alert alert-danger" role="alert">
                  {{$errors->first('title')}}
                </div>
              @enderror
            <label for="location">Lot title: </label>
            <input type="text" class="form-control is-danger" id="location" name="location" placeholder="Default location" value="{{$lot->location}}">
              @error('location')
                <div class="alert alert-danger" role="alert">
                  {{$errors->first('location')}}
                </div>
              @enderror
            <label for="categories">Category: </label>
              <select name="categorie" id="categorie>
                @foreach($categories as $categorie)
                <option value="{{$categorie->id}}" {!! $categorie->id == $lot->categorie ? 'selected' : '' !!}>{{$categorie->name}}</option>
                @endforeach
              </select>
            <label for="conditions">Condition: </label>
              <select name="condition" id="condition>
                @foreach($conditions as $condition)
                <option value="{{$condition->id}}" {!! $condition->id == $lot->condition ? 'selected' : '' !!}>{{$condition->title}}</option>
                @endforeach
              </select>
    			</div>
    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
        <form method="POST" action="/lots/{{$lot->id}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Delete lot</button>
        </form>
    	</div>

    </div>
</div>
@endsection
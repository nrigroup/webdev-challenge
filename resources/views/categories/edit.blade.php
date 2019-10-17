@extends ('layout')
@section ('content')

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
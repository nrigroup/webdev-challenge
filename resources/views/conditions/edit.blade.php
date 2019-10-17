@extends ('layout')
@section ('content')
             
    <div id="wrapper">
    	<div id="page" class="container">
    		<h3>Edit a condition:</h3>

    		<form method="POST" action="/conditions/{{$condition->id}}">
    			@csrf
    			@method('PUT')
    			
    			<div class="form-group">
    				<label for="InputTitle">Category title: </label>
    				<input type="text" class="form-control is-danger" id="title" name="title" placeholder="Default title" value="{{$condition->title}}">
              @error('title')
                <div class="alert alert-danger" role="alert">
                  {{$errors->first('title')}}
                </div>
              @enderror
    			</div>
    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
        <form method="POST" action="/conditions/{{$condition->id}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary">Delete category</button>
        </form>
    	</div>

    </div>
@endsection
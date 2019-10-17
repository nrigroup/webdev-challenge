@extends ('layout')
@section ('content')
    <div id="wrapper">
    	<div id="page" class="container">
    		<h3>New Lot:</h3>

    		<form method="POST" action="/lots">
    			@csrf
    			<div class="form-group">
    				<label for="title">Title: </label>
    				<input type="text" class="form-control" id="title" name="title" placeholder="Default condition" values="{{ old('name') }}"> 
    				@error('title')
	    				<div class="alert alert-danger" role="alert">
							{{$errors->first('title')}}
						</div>
      				@enderror  
            <label for="location">Location: </label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Default condition" values="{{ old('name') }}"> 
            @error('location')
              <div class="alert alert-danger" role="alert">
              {{$errors->first('location')}}
            </div>
              @enderror  
            <label for="categories">Category: </label>
            <select name="categorie" id="categorie>
              @foreach($categories as $categorie)
              <option value="{{$categorie->id}}">{{$categorie->name}}</option>
              @endforeach
            </select>
            <label for="conditions">Condition: </label>
            <select name="condition" id="condition>
              @foreach($conditions as $condition)
              <option value="{{$condition->id}}">{{$condition->title}}</option>
              @endforeach
            </select>
    			</div>



    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
    	</div>

    </div>
@endsection
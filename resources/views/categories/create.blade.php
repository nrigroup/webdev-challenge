@extends ('layout')
@section ('content')
    <div id="wrapper">
    	<div id="page" class="container">
    		<h3>New Category:</h3>

    		<form method="POST" action="/categories">
    			@csrf
    			<div class="form-group">
    				<label for="InputTitle">Category name: </label>
    				<input type="text" class="form-control" id="name" name="name" placeholder="Default name" values="{{ old('name') }}"> 
    				@error('name')
	    				<div class="alert alert-danger" role="alert">
							{{$errors->first('name')}}
						</div>
      				@enderror  
    			</div>
    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
    	</div>

    </div>
</div>
@endsection
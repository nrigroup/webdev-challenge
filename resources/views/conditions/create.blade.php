@extends ('layout')
@section ('content')
    <div id="wrapper">
    	<div id="page" class="container">
    		<h3>New Condition:</h3>

    		<form method="POST" action="/conditions">
    			@csrf
    			<div class="form-group">
    				<label for="InputTitle">Condition name: </label>
    				<input type="text" class="form-control" id="title" name="title" placeholder="Default condition" values="{{ old('name') }}"> 
    				@error('title')
	    				<div class="alert alert-danger" role="alert">
							{{$errors->first('title')}}
						</div>
      				@enderror  
    			</div>
    			<button type="submit" class="btn btn-primary">Submit</button>
    		</form>
    	</div>

    </div>
@endsection
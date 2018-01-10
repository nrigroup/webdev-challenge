@extends('welcome')

@section('content')

<div class="container">
	
	<div class="space"></div>

	<p class="text-white">We have parsed your CSV file</p>

	<p>
		<a class="btn btn-primary" data-toggle="collapse" href="#categorytotal" role="button" aria-expanded="false" aria-controls="categorytotal">Total spending by category</a>
	</p>

	<div class="collapse" id="categorytotal">   

		<!-- Import the total spending category table -->  
		@include('tables.category')

	</div>

	<p>

		<a class="btn btn-primary" data-toggle="collapse" href="#monthstotal" role="button" aria-expanded="false" aria-controls="monthstotal">Total spending by month</a>
		<div class="collapse" id="monthstotal">

			<!-- Import the total spending months table -->
			@include('tables.month')

		</div>
	</p>

	<p>
		
		<a class="btn btn-primary" data-toggle="collapse" href="#wholetable" role="button" aria-expanded="false" aria-controls="wholetable">Show me the entire table</a>
		<div class="collapse" id="wholetable">

			<!-- Import the total whole table -->
			@include('tables.alltable')

		</div>
	</p>

	<p>
		<!-- Redirect home to parse another file -->
		<a class="btn btn-success" href="/">Great, let's parse another CSV file.</a>
	</p>

</div>

@endsection
</div>





@extends('layout.master')

@section('content')

<h1 class="text-center">{{$title}}</h1>

<div class="row">
	@if(request()->path() === 'category-report')
		<p class="text-center"><a href="/monthly-report" class="btn btn-primary">Go To Monthly Report</a></p>
	@elseif(request()->path() === 'monthly-report')
		<p class="text-center"><a href="/category-report" class="btn btn-primary text-center">Category Report</a></p>
	@endif
	<div class="col-md-4 col-md-offset-4">
		@include('partials.concise')
	</div>
</div>

@foreach($categories as $category)

	<h4>{{$category}} <strong class="lead">Total: ${{$groupTotal[$category]}}</strong></h4>

	@include('partials.reporttable')

@endforeach

@endsection
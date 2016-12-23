@extends('layout')

@section('content')
<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ url('/') }}">NRI</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('/auction') }}"><span class="glyphicon glyphicon-paperclip " aria-hidden="true"></span> Submit Auction File</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">HELP</a></li>
							</ul>
						</li>
						<li class="active"><a href="#">Result</a></li>
					</ul>
					
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
		<div class="container">
			<div class="row"><br><br><br>
			</div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<h3>Total spending amount per-month</h3>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-xs-6">Month</th>
								<th class="col-xs-6">Ammount</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($fn as $key => $value)
							<tr>
								<td>{{ $fnd[$key] }}</td>
								<td>$ {{ number_format($value, 2) }}</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<h3>Total spending amount per-category</h3>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-xs-6">Category</th>
								<th class="col-xs-6">Ammount</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($cate as $key => $value)
							<tr>
								<td>{{ $key }}</td>
								<td>$ {{ number_format($value, 2) }}</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	

	
@stop

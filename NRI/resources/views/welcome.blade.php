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
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>		
		<div class="container">
			<div class="row"><br><br><br>
			</div>
			<div class="jumbotron">
			<h1>Welcome to NRI!</h1>
			<p>The NRI Group of companies is Canadian owned with subsidiaries, offices, and projects in the USA and Canada. NRI acquires and holds real estate and personal property with private capital for short and long term investment purposes.</p>
			<p>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Options <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a href="{{ url('/auction') }}"><span class="glyphicon glyphicon-paperclip " aria-hidden="true"></span> Submit Auction File</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">HELP</a></li>
					</ul>
				</div>
			</p>
			</div>
		</div>
@stop

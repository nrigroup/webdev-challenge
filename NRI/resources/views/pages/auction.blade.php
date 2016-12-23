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
						<li class="dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li class="active"><a href="#"><span class="glyphicon glyphicon-paperclip " aria-hidden="true"></span> Submit Auction File</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">HELP</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
		</nav>
		<div class="container">
			<div class="row">
				<br><br><br>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Auction File Submit Form</h3>
						</div>
						<div class="panel-body">
							<div class="col-12">
								<p>Please use this form to submit your 'csv' file(s). You can browse for it or drop it in the marked section.
								</p>
								<form action="./auction/save" method="post" enctype="multipart/form-data">
									<div class="input-group">
										<label class="input-group-btn">
											<span class="btn btn-primary">
												Browse <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <input type="file" style="display: none;" name="fileName" id="fileID">
											</span>
										</label>
										<input id="fileNameText" type="text" class="form-control" readonly>
									</div>
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
									<br>
									<button id="sendMe" type="submit" class="btn btn-default" aria-label="Left Align" disabled>
										Submit
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
@stop
@section('footer')
<script>
			$(function() {

				$(document).on('change', '#fileID', function() {
					var input = $(this),
					numFiles = input.get(0).files ? input.get(0).files.length : 1,
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
					input.trigger('fileselect', [numFiles, label]);
				});

				// We can watch for our custom `fileselect` event like this
				$(document).ready( function() {
					$('#fileID').on('fileselect', function(event, numFiles, label) {
						var input = $('#fileNameText'),
						log = label;
						if( log.toLowerCase().lastIndexOf(".csv")==-1) 
						{
							alert("Please upload a file with .csv extension.");
							return false;
						}else
						{
							if( input.length > 0) {
								$('#sendMe').prop('disabled', false);
								input.val(log);
							} else {
								$('#sendMe').prop('disabled', true);
							}
						}
					});
				});

			});
		</script>
@stop

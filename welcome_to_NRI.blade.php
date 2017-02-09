<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
        
		<title>Welcome to NRI</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<link type="text/css" rel="stylesheet" href="../css/main/font-awesome.css">
        <!-- Styles -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/main.css" rel="stylesheet">
	</head>
    
	<body>
		<div class="top_navigation">
			<a class="logo"><img src="../images/logos/nri_logo.png"></a>
			<a class="btn btn-info btn-sm menu-hamburger">
				<span class="glyphicon glyphicon-menu-hamburger"></span>
			</a>
			<ul id="navigation_links">
				<li><a class="active" href="#home">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#news">News</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
		</div>
		
		<div>
			<div class="content">
				<h1>Upload File from Auctioneer</h1>
				<p>Please Upload the csv File</p>
				<form id="csv_submission_form" action="/upload" method="post" enctype="multipart/form-data">						
					{{csrf_field()}}
					<div class="fileUpload btn btn-primary">
						<span>Select File</span>
						<input type="file" name="fileToUpload" id="fileToUpload" class="upload"/>
					</div>
					<input type="submit" name="uploadFile" id="uploadFile" class="btn btn-success" value="Upload File" name="submit">
					<div id="file_name_wrapper"></div>
				</form>
				<div class="status_message">
					@if(isset($status_message))
						<p>{{$status_message}}</p>
					@endif
				</div>
				
				@if(isset($queried_total_by_month_category) && !empty($queried_total_by_month_category))
					<p>Below is Total Spending Amount per-month and per-category:</p>
					<table>
						<tr>
							<td class="inventory_display header">Year</td>
							<td class="inventory_display header">Month</td>
							<td class="inventory_display header">Category</td>
							<td class="inventory_display header">Total</td>
						</tr>
						@foreach($queried_total_by_month_category as $queried_total_by_month_category_object)
							<tr>
								<td class="inventory_display">{{$queried_total_by_month_category_object->year}}</td>
								<td class="inventory_display">{{$queried_total_by_month_category_object->month}}</td>
								<td class="inventory_display">{{$queried_total_by_month_category_object->category}}</td>
								<td class="inventory_display">{{$queried_total_by_month_category_object->total}}</td>
							</tr>
						@endforeach
					</table>
				@endif
				
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../js/main.js"></script>
		<script src="../js/file_upload.js"></script>
    </body>
</html>

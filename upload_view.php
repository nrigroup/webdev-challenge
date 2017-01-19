<!DOCTYPE html>
<html>
	<head>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<form action="/inventory/upload" method="post" enctype="multipart/form-data" class="form-horizontal">
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="filename">Select CSV file to Upload:</label>
				<div class="col-sm-10">
				  <input type="file" class="form-control" name="filename" id="filename">
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" name="submit" class="btn btn-default">Upload CSV</button>
				</div>
			</div>
			
			
		</form>

	</body>
</html>



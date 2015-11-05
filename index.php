<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    </head>
<body>
    
<div class="container-fluid" style='margin-top:20px;'>
  <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="fileToUpload">Select CSV to upload:</label>
    <input type="file" name="uploadfile" id="fileToUpload">
    </div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Upload CSV file" name="submit">
    </div>
</form>
</div>
     <div class="col-md-4"></div>
</div>
</div>

</body>
</html> 
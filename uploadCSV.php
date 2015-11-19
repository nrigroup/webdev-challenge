<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>Upload CSV</title> 
</head> 

<body> 
<div style="padding-left:50px;">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form"> 
 <div class="form-group" >
  <label for="csv">Choose your csv file: </label>
  <input name="csv" type="file" id="csv" class="btn btn-default" /> 
 </div>
  <button  type="submit"  class="btn btn-primary">Submit</button> 
</form> 
</div>

</body> 
</html> 

<?php
$FileID=date("Ymd-His") . '-' . rand(100,999);
$fileName = getcwd()."/".$FileID.$_FILES['csv']['name'];
	
if(move_uploaded_file($_FILES['csv']['tmp_name'], $fileName)){
	//load data into database
	$sql = <<<eof
    LOAD DATA INFILE '$fileName'
     INTO TABLE lot
     FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
     LINES TERMINATED BY '\n'
	 IGNORE 1 LINES
    (@date,category,title,location,lot_condition,pre_tax_amount,tax_name,tax_amount)
     SET date = STR_TO_DATE(@date,'%m/%d/%Y');
eof;
	
	//connect to database
	mysql_connect("localhost", "username","password") or
	  die("Could not connect: " . mysql_error());
	mysql_set_charset('utf8');
	//select a database
	mysql_select_db("mydatabase");

	$result = mysql_query($sql);
	if($result==1){
		//show summary table
		print "<div class='container'><h2>Summary</h2><table class='table'><thead><tr><th>Month</th><th>Category</th><th>Total Spending Amount</th></tr></thead>";
		$sql1 = "select CONCAT(YEAR(date),'-',MONTH(date)) as month,category,sum(pre_tax_amount+tax_amount) as sum from lot group by concat(category,month) order by month,category;";
		$result1 = mysql_query($sql1);
		while ($row1 = mysql_fetch_array($result1)){
			print "<tbody><tr><td>".$row1['month']."</td><td>".$row1['category']."</td><td>$".$row1['sum']."</td></tr>";
			
		}
		print "</tbody></table><div>";
		die;
	}
} 

?>

<!DOCTYPE html>
<?php

if(isset($_POST['submit'])){
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	
	try {
		$pdo = new PDO('mysql:host=localhost; dbname=nriglobal','nriglobal','1234');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$row = fgetcsv($handle, 1024, ","); //retrieve the header here
		while($row = fgetcsv($handle, 1024, ",") !== false){
			//insert into the database
			$sql = "INSERT INTO `tbl1` (dates, category, lot_title, lot_location, lot_condition, pre_tax_amount, tax_name, tax_amount) VALUES (':dates', ':category', ':lot_title', ':lot_location', ':lot_condition', ':pre_tax_amount', ':tax_name', ':tax_amount')";
			$query = $pdo->prepare($sql);
        	$query->bindParam(':dates', $row[1], PDO::PARAM_STR);
	        $query->bindParam(':category', $row[2], PDO::PARAM_STR);
    	    $query->bindParam(':lot_title', $row[3], PDO::PARAM_STR);
    	  	$query->bindParam(':lot_location', $row[4], PDO::PARAM_INT);
    	  	$query->bindParam(':lot_condition', $row[5], PDO::PARAM_INT);
    	  	$query->bindParam(':pre_tax_amount', $row[6], PDO::PARAM_INT); //For some reason this is not working. Error Message as follows: "Error: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'pre_tax_amount' in 'field list'""
    	  	$query->bindParam(':tax_name', $row[7], PDO::PARAM_INT);
    	  	$query->bindParam(':tax_amount', $row[8], PDO::PARAM_INT);
        	$query->execute();
		}
	}catch(PDOException $e) {
		echo "File not uploaded. Error: " .$e->getMessage();
	}
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>NRI Global Webdev Challenge Submission</title>
	<link href="StyleSheet.css" rel="stylesheet" type="text/css"/>
	<style type="text/css"></style>
	<script src="text/javascript"></script>
</head>

<body>
	<header id="header">
		<h1>NRI Global Webdev Challenge Submission</h1>
	</header>

	<div id="wrapper">
		<div id="menu">
			<ul>
				<li><a class="active" href="Home.php">Home</a></li>
			</ul>
		</div>
		<div id="content">
			<h3>Click the button to run data file</h3>
			<form method="post" enctype="multipart/form-data">
				<input type="file" name="file">
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
		<footer id="footer">
			<h6>This is the footer of the page</h6>
		</footer>
	</div>
</body>
</html>
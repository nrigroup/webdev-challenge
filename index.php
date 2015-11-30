<?php

require_once("database.php");
require_once("purchase_import.php");

// create object of class 'Purchase_Import'
$purchase = new Purchase_Import();

// insert csv file into database table 'purchase'
$purchase->csv_to_array($filename='data.csv', $delimiter=',');

// caculate total spending amount per month
$arr_month = $purchase->AmountByMonth();

// caculate total spending amount per category
$arr_category = $purchase->AmountByCategory();

?>

<!DOCTYPE html>
<html>

<head>
<title>Purchase Details</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="js/jquery-ui-1.11.4.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/PurchaseDetails.js"></script>

<script>
$(document).ready(function(){

});

</script>

</head>

<body>
	<div class="container">

		<h2>Purchase List By Month</h2>
		<table class='table table-bordered text-center'>
		<thead>
			<tr>
				<th style="text-align:center">Jan</th>
				<th style="text-align:center">Feb</th>
				<th style="text-align:center">Mar</th>
				<th style="text-align:center">Apr</th>
				<th style="text-align:center">May</th>
				<th style="text-align:center">Jun</th>
				<th style="text-align:center">Jul</th>
				<th style="text-align:center">Aug</th>
				<th style="text-align:center">Sep</th>
				<th style="text-align:center">Oct</th>
				<th style="text-align:center">Nov</th>
				<th style="text-align:center">Dec</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			foreach($arr_month as $month => $amount) { ?>
			<tr>
				<td><?php echo $month == "1"? $amount:""; ?></td>
				<td><?php echo $month == "2"? $amount:""; ?></td>
				<td><?php echo $month == "3"? $amount:""; ?></td>
				<td><?php echo $month == "4"? $amount:""; ?></td>
				<td><?php echo $month == "5"? $amount:""; ?></td>
				<td><?php echo $month == "6"? $amount:""; ?></td>
				<td><?php echo $month == "7"? $amount:""; ?></td>
				<td><?php echo $month == "8"? $amount:""; ?></td>
				<td><?php echo $month == "9"? $amount:""; ?></td>
				<td><?php echo $month == "10"? $amount:""; ?></td>
				<td><?php echo $month == "11"? $amount:""; ?></td>
				<td><?php echo $month == "12"? $amount:""; ?></td>
			</tr>
			<?php } ?>
		</tbody>
		</table>

		<br />

		<h2>Purchase List By Category</h3>

		<table class='table table-striped'>
		<thead>
			<tr>
				<th>Category</th>
				<th>Amount</th>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach($arr_category as $ctg => $amount) { ?>
			<tr>
				<td><?php echo $ctg ?></td>
				<td><?php echo $amount ?></td>
			</tr>
			<?php } ?>
		</tbody>
		</table>

	</div> <!-- end of container -->

</body>

</html>

<?php if(isset($database)) { $database->close_connection(); } ?>

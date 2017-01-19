<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<p> Total Spending by Category</p>
		<?php
		if(!(isset($result)){
			echo 'No Data found';
			exit;

		}?>

		<form name="form_listing" id="form_listing" method="post" action="">
			<table class='table'>
				
				<tr>
					<td >
						<b>Select Month/Year</b>
					</td>
					<td >
						<select name='month_year' id='month_year' onchange="jQuery('#form_listing').submit();">
							<?php
								
								foreach($result as $key=>$value){
								
									$month_year=$value['month'].'-'.$value['year'] //this will be something like '3-2015'
									
									echo "<option value='".$month_year."'";
									
									if($selected_month_year==$month_year)
									{
										$selected="selected='selected'";	
									}
									else
										$selected='';
									
									echo $selected.">".$month_year."</option>";	
									//we can also change month to look something like Mar-2015 in the dropdown
								}
								
							?>
						</select>
					</td>
					
				</tr>
			</table> 		
			
		</form>
		<div class="table-responsive">
			<?php
			if(!isset($spending)){
				echo 'No spending in this month-year';
				exit;
			}?>
			
			<table  class='table table-striped'>
				<thead>
					<tr class='tablehead'>
						
						<th>Date</th>
						<th>Category</th>
						<th>Pre-tax Amount</th>
						<th>Tax Amount</th>						
						<th>Total</th>
						
					</tr>
				</thead>
							
				<?php for($i=0;$i<sizeof($spending);$i++)
				{
					$total=$summary[$i]['pre_tax_amount']+$summary[$i]['tax_amount'];
					
					?>
					<tr>
						<td ><?php echo $summary[$i]['month'].'-'.$summary[$i]['year'];?></td>
						<td ><?php echo $summary[$i]['category'];?></td>
						<td><?php echo number_format($summary[$i]['pre_tax_amount'], 2, '.', '');?></td>	<!-- // Outputs -> 105.00-->					   
						<td><?php echo number_format($summary[$i]['tax_amount'], 2, '.', '');?></td>
						<td><?php echo number_format($total, 2, '.', '');?></td>
					
					</tr>
			   <?php  }
				  ?>
				
				
			</table>
		</div>
	</div>
</body>
</html>
@extends('layouts.NRIChallenge')
@extends('config')
<?php


 if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {


	           $sql = "INSERT into NRIChallenge (date1, category, lot_title,lot_location,lot_condition,pre_tax_amount,tax_name,tax_amount) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."',
                   '".$getData[5]."','".$getData[6]."','".$getData[7]."')";
                   $result = mysqli_query($con, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 

	function get_all_records(){
    $con = getdb();
    $Sql = "SELECT * FROM NRIChallenge";
    $result = mysqli_query($con, $Sql);  


    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>Auction ID</th>
                          <th>Date</th>
                          <th>category</th>
                          <th>Lot Title</th>
                          <th>Lot location</th>
                          <th>Lot condition</th>
                          <th>Pre-tax amount</th>
                          <th>Tax name</th>
                          <th>Tax amount</th>
                        </tr></thead><tbody>";


     while($row = mysqli_fetch_assoc($result)) {

         echo "<tr><td>" . $row['auction_id']."</td>
                   <td>" . $row['lot_title']."</td>
                   <td>" . $row['lot_location']."</td>
                   <td>" . $row['lot_condition']."</td>
                   <td>" . $row['pre_tax_amount']."</td>
                   <td>" . $row['tax_name']."</td>
                   <td>" . $row['tax_amount']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}
 ?>


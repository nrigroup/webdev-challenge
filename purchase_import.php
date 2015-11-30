<?php

require_once("database.php");

// define table 'purchase' class
class Purchase_Import
{
	var $id;
	var $date;
	var $category;
	var $lot_title;
	var $lot_location;
	var $lot_condition;
	var $pre_tax_amount;
	var $tax_name;
	var $tax_amount;

	function csv_to_array($filename='', $delimiter=',') {

	    if(!file_exists($filename) || !is_readable($filename))
		{
	        return FALSE;
		}
	
	    $header = NULL;
	    $data = array();
	    $cnt = 0;


	    if (($handle = fopen($filename, 'r')) !== FALSE)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	        {
	  
	            if(!$header) 
				{
	                $header = $row;
	            }
				else 
				{
	           		$data = array_combine($header, $row);
	                        
		            // Table 'purchase' Insert
					$database = new MySQLDatabase();

					$sql  = "INSERT INTO purchase " .
							"(id, date, category, lot_title, lot_location, lot_condition, pre_tax_amount, tax_name, tax_amount)" .
							" VALUES (''," .
							" '" .$database->escape_value($row[0]) ."', '" . $database->escape_value($row[1]) ."'," .
							" '" .$database->escape_value($row[2]) ."', '" . $database->escape_value($row[3]) ."'," .
							" '" .$database->escape_value($row[4]) ."', '" . $database->escape_value($row[5]) ."'," .
							" '" .$database->escape_value($row[6]) ."', '" . $database->escape_value($row[7]) ."')";

					$cnt += 1;

					$database->query($sql);
					//echo "purchase : " .$cnt. " records inserted". "<br />";
					
				} /* end of data process (not header) */
	            
	        } /* end of while */
	        
	        fclose($handle);
	    }

	    //return $data;
	}

	function AmountByMonth() {

		$database = new MySQLDatabase();

		// Reading the table 'purchase'
		$sql = "SELECT * FROM purchase;";
		$result = $database->query($sql);
		$count = 0;
		
		while($rec = $database->fetch_array($result)) {

			$purchase_month = array();
			
			// get the month out of date
			$pos = strpos($rec["date"], "/");
			$month = substr($rec["date"], 0, $pos);
			$purchase_month[$month] = $rec["pre_tax_amount"];
			$purchases_month[] = $purchase_month;
			$count++;
		}


		//print_r($purchases_month);

		foreach($purchases_month as $purchase_month) {
			foreach($purchase_month as $month => $amount) {

				if(isset($abc[$month])) { // prevent index warning
					$abc[$month] += $amount;
				}else{
					$abc[$month] = $amount;
				}
				//echo "<br />";
				//print_r($abc);
			}
		}

		return $abc;
	}

	function AmountByCategory() {

		$database = new MySQLDatabase();

		// Reading the table 'purchase' 

		$sql = "SELECT * FROM purchase;";
		$result = $database->query($sql);
		$count = 0;

		while($rec = $database->fetch_array($result)) {

			$category = array();

			$category[$rec["category"]] = $rec["pre_tax_amount"];
			$categories[] = $category;
			$count++;

		}

		//print_r($categories);

		foreach($categories as $category) {
			foreach($category as $ctg => $amount) {
				if(isset($abc[$ctg])) { // prevent index warning
					$abc[$ctg] += $amount;
				}else{
					$abc[$ctg] = $amount;
				}
				//echo "<br />";
				//print_r($abc);
			}
		}

		return $abc;
	}

}

?>

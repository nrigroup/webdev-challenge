<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class pageController extends Controller
{

	function welcome_to_NRI($status_message=null,$queried_total_by_month_category=null){
		if(isset($queried_total_by_month_category) && !empty($queried_total_by_month_category)){
			return view('welcome_to_NRI')->with(['status_message'=>$status_message,'queried_total_by_month_category'=>$queried_total_by_month_category]);
		}else{
			$queried_total_by_month_category=array();
			return view('welcome_to_NRI')->with(['status_message'=>$status_message,'queried_total_by_month_category'=>$queried_total_by_month_category]);
		}
	}
	
	function upload(){
		
		$file_name=basename($_FILES["fileToUpload"]["name"]);
		$target_dir = "../uploaded_data_files/";
		$target_file = $target_dir . $file_name;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$uploadOk = 1;
		
		if(isset($file_name)) {
			//Check File Size
			if($_FILES["fileToUpload"]["size"] > 52428800) { //50 MB (size is also in bytes)
				// File too big
				$uploadOk = 0;
				echo "Files larger than 50MB can not be uploaded"; //File is too big";
			}else{
				$uploadOk = 1;
			} 
			//Check File Type
			if($imageFileType != "csv" ) {
				return $this->welcome_to_NRI("Only csv files are allowed.. Please try again.");
				$uploadOk = 0;
			}
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return $this->welcome_to_NRI("Your file was not uploaded. Please try again.");
		}else {
			if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				return $this->read_items_from_csv_File($file_name);
			}else {
				return $this->welcome_to_NRI("There was an error uploading your file. Please try again.");
			}
		}
	}	

	function read_items_from_csv_File($file_name){
		
		//$items_from_auction=array();
		$row = 1;
		if (($handle = fopen("../uploaded_data_files/".$file_name, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				for ($counter=0; $counter < $num; $counter++) {
					if($row>1){
						$items_from_auction[$row][$counter]=$data[$counter];
					}
				}
				$row++;
			}
			fclose($handle);
		}
		return $this->insert_items_from_csv_File($items_from_auction);
	}
	
	function insert_items_from_csv_File($items_from_auction){
		$successfully_added=1;
		foreach ($items_from_auction as $i => $items_from_auction_array){
			$total_spent=$items_from_auction_array[7]+$items_from_auction_array[5];
			$date_array=explode("/",$items_from_auction_array[0]);
			$month=$date_array[0];
			$year=$date_array[2];
			$data=array('date'=>$items_from_auction_array[0],'category'=>$items_from_auction_array[1],'lot_title'=>$items_from_auction_array[2],'lot_location'=>$items_from_auction_array[3],
			'lot_condition'=>$items_from_auction_array[4],'pre_tax_amount'=>$items_from_auction_array[5],'tax_name'=>$items_from_auction_array[6],'tax_amount'=>$items_from_auction_array[7],'total'=>$total_spent,'month'=>$month, 'year'=>$year);
			//DB::table('auctioned_items')->insert($data);
			try {
				DB::table('auctioned_items')->insert($data);
			}catch(\Exception $e){
				//query failed
				$successfully_added=0;
			}
		}
		if($successfully_added){
			////SELECT category, sum(total), month, year FROM `auctioned_items` group by category, year, month order by year asc 
			$queried_total_by_month_category = DB::table('auctioned_items')
                     ->select(DB::raw('category, sum(total) as total, month, year'))
                     ->groupBy(DB::Raw('category, year, month'))
					 ->orderBy(DB::Raw('year'), 'ASC')
                     ->get();
			return $this->welcome_to_NRI("Your file was successfully uploaded and items were added to the inventory.",$queried_total_by_month_category);
		}else{
			return $this->welcome_to_NRI("There was an error adding items to inventory. Please try again or contact administrator.");
		}
	}
	
	function getupload(){
		return view('welcome_to_NRI')->with(['status_message'=>""]);
	}
}

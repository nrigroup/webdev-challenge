<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');


class Inventory extends CI_Controller {
	private $data=array();
	
	public function __construct() {
		parent::__construct();		
		
		$this->load->model("main_db");
			
	}

	
	//function to view inventory information
	public function index()
	{	
		
		//get distinct month and year from inventory table
		$db_result=$this->main_db->get_month_year();
		
		if($db_result!==FALSE){			¨
			
			$data['result']=$db_result;
			
			//by default most recent month and year is on the top of the result
			
			if( isset($_POST['month_year']) && trim($_POST['month_year'])!='')
			{
				$month_year_selected=trim(strip_tags($_POST['month_year']));
			}
			else
				$month_year_selected==$db_result[0]['month'].'-'.$db_result[0]['year'];/*select the first one*/
			
			//explode $month_year_selected on '-' to separate month and Year from post
			
			$info=explode('-',$month_year_selected);
			$month=$info[0];
			$year=$info[1];
			
			// function will get total spending by category for selected month and year
			//added year too because same month can exist in mutiple years
			
			$db_result_spending=$this->main_db->get_spending_month_year($month,$year);
			
			if($db_result_spending!==FALSE)
				$data['spending']=$db_result_spending;	
			
			
		
		}
		$this->load->view('spending_view', $data);
		
	}
	
	//Function to import csv file to database
	public function upload(){
		
		if(isset($_POST['submit'])) {
	
			if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
					
				$target_dir = "uploads/";
				
				$target_file = $target_dir . basename($_FILES["file"]["name"]);
				
				$file_ext = pathinfo($target_file,PATHINFO_EXTENSION);
				
				//Only csv file allowed
				if($file_ext=='csv'){
					
					//check if file already exist or add date time so that there is no 'file already exist error'
					
					$inventory_filename = "inventory_".date('m-d-Y_hia').".csv";
					
					// Move file to upload folder.
					
					move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $inventory_filename);
				
					//Import uploaded file to Database
					echo "Importing File.  \n\n";				
					
					$result=$this->main_db->import_inventry_file($inventory_filename);
					
					echo 'Total number of rows imported '.$result;
				
				}else	
					echo 'Invalid file format';
			}
			
		}else 
			// VIEW upload view
			$this->load->view('upload_view');

		
		
	}
	
}
	
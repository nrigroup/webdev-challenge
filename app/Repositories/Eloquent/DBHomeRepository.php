<?php namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\HomeRepositoryInterface;
use DB;

class DbHomeRepository implements HomeRepositoryInterface
{
	// Empty constructor method
	public function __construct()
	{
		
	}
    
	// Method to truncate table before insert
	public function trunateBeforeInsert()
	{
        // Before the insert statement all the data must be truncated
		DB::table('category_amount')
		 ->truncate();

		 return true;
	}

	public function storeCSVParsedData($data, $date)
	{
        // Insert the data into the category table
		$insert_data = DB::table('category_amount')
						->insert([
							'tax_date' => $date, 
							'category' => $data[1],
							'iot_title' => $data[2],
							'iot_location' => $data[3],
							'iot_condition' => $data[4],
							'pre_tax_amt' => $data[5],
							'tax_name' => $data[6],
							'tax_amt' => $data[7]
							]);
		return true;
	}
    
	// Fetch the full data
	public function fetchFullData()
	{
        // fetch the data from the category table
		$category_data = DB::table('category_amount')
			    		->get();

	     return $category_data;
	}
    
	// Fetch per month data
	public function fetchPerMonth()
	{
        $month_data =  DB::select("SELECT MONTHNAME(tax_date) as month, SUM(pre_tax_amt+tax_amt) AS total
								   FROM category_amount
								   GROUP BY month");

        return $month_data;
	}
    
	// Fetch per category data
	public function fetchPerCategory()
	{
       $category_data =  DB::select("SELECT category, SUM(pre_tax_amt+tax_amt) AS total
                                     FROM category_amount
                                     GROUP BY category");

       return $category_data;
	}
}

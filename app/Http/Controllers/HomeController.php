<?php 

namespace App\Http\Controllers;

use File;
use Input;
use DB;
use Response;
use Request;

class HomeController extends Controller
{
	/**
	*Loads the home page
	*/
	public function home()
	{
		$pageType = "home";

		return view('home', compact('pageType'));
	}

	//TODO: Create a DBHomeRepository.php in eloquent folder to handle the database calls

    /**
     * This is the function which is called when the file is uploaded
     * Purpose: 1. Fetch the file and check for the file type
     *          2. If the file type is CSV then, parse the file data to store it in the category table
     *          3. IF the file type is other than CSV, alert the user to upload the right one
     *
     * @param data (FILE): CSV File from the users
     */
    public function storeFileData()
    {
		// Fetch the csv file
    	//$csv_data = Input::file('csvfile');
    	$csv_data = Request::file('uploadfile');

		// Best practice to ignore the trailing newline
    	$lines = file($csv_data, FILE_IGNORE_NEW_LINES);

		// The total number of lines will be stored in the count variable
    	$count = count($lines);
        
		// Before the insert statement all the data must be truncated
		DB::table('category_amount')
		 ->truncate();

        // Loop through all the lines except the header
    	for($i = 1; $i < $count; $i++)
    	{
			// Standard function to extract the comma separated string to an array of data
    		$data = str_getcsv($lines[$i], ',');

            // Convert the date to database date format i.e Y-M-d
    		$date = date('Y-m-d', strtotime(str_replace('-', '/', $data[0])));

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
    	}

    	return Response::json(['success' => 1]);
    }
    
      /**
     * function used to displays the total spending amount per-month and per-category.
     * Purpose: 1. Make a call to the category table with proper conditions
     *          2. Fetch the spending amount per-month and per-category
     *
     * @param data (Array): spending amount per-month and per-category
     */
    public function fetchFullData()
    {
	    // fetch the data from the category table
		$category_data = DB::table('category_amount')
			    		->get();

	    return Response::json(['data' => $category_data]);
    }
    
	/**
     * Fetch the total spending amount per month
     *
     * Returns(JSON): month and total
     */
	public function fetchPerMonth()
	{
		$month_data =  DB::select("SELECT MONTHNAME(tax_date) as month, SUM(pre_tax_amt+tax_amt) AS total
								   FROM category_amount
								   GROUP BY month");

	    return Response::json(['data' => $month_data]);
	}
    
	/**
     * Fetch the total spending amount per category
     *
     * Returns(JSON): category and total
     */
	public function fetchPerCategory()
	{
		$category_data =  DB::select("SELECT category, SUM(pre_tax_amt+tax_amt) AS total
                                  FROM category_amount
                                  GROUP BY category");

	    return Response::json(['data' => $category_data]);
	}
}

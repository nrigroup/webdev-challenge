<?php 

namespace App\Http\Controllers;

use App\Repositories\Interfaces\HomeRepositoryInterface;
use File;
use Input;
use DB;
use Response;
use Request;

class HomeController extends Controller
{
	protected $home;
	
	public function __construct(HomeRepositoryInterface $home)
    {
	    $this->home = $home;
    }
	/**
	*Loads the home page
	*/
	public function home()
	{
		$pageType = "home";

		return view('home', compact('pageType'));
	}

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

    	$this->home->trunateBeforeInsert();

        // Loop through all the lines except the header
    	for($i = 1; $i < $count; $i++)
    	{
			// Standard function to extract the comma separated string to an array of data
    		$data = str_getcsv($lines[$i], ',');

            // Convert the date to database date format i.e Y-M-d
    		$date = date('Y-m-d', strtotime(str_replace('-', '/', $data[0])));
            
    		$res = $this->home->storeCSVParsedData($data, $date);
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
		$category_data = $this->home->fetchFullData();

	    return Response::json(['data' => $category_data]);
    }
    
	/**
     * Fetch the total spending amount per month
     *
     * Returns(JSON): month and total
     */
	public function fetchPerMonth()
	{
		$month_data =  $this->home->fetchPerMonth();

	    return Response::json(['data' => $month_data]);
	}
    
	/**
     * Fetch the total spending amount per category
     *
     * Returns(JSON): category and total
     */
	public function fetchPerCategory()
	{
		$category_data =  $this->home->fetchPerCategory();

	    return Response::json(['data' => $category_data]);
	}
}

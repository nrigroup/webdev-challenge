<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Carbon\Carbon;
use DB;

class ParseController extends MasterController
{
    /**
    * We handle the uploaded CSV file through parse function and deal with data accordingly
    * @param $request DI
    */
    public function parse(Request $request)
    {
    	/**
    	* First, we do a validation for a CSV file. A manual validation is needed for     	
        * checking if the input file is a valid CSV file
    	*/	
    	$csvfile = $request->csvfile;

    	// Do a validation check from the MasterController::validation()
    	$validator = $this->validation($csvfile);

    	// If the validator fails return back with an error
    	if ($validator->fails()) {
    		return back()
            //sending a custom message by flashing into the session
    		->withMessage('The supplied file is not a valid CSV file');
    	}

    	/**
    	* Once the validation passes, we can parse the CSV file.
    	* Master Controller provides a readcsv function which parses the csv file into an array
    	*/
    	$response = $this->readcsv($csvfile);

    	//The first element of the array will be the header
    	$csvheader = array_shift($response);

    	//The remaining array element will be the body
    	$csvbody = $response;

    	//We rename the array with maparray funciton in the MasterController
    	$renamedarray = $this->maparray($csvbody);

        /**
        * Truncating the new instance of CSV file, to allow a feature to allow subsequent CSV
        * uploading feature. Can be overriden as required
        */
        $truncate = new Items;
        $truncate->truncate();

    	foreach ($renamedarray as $items)
    	{
    		//new Item class is initialized for each new item
    		$lot = new Items;
    		//if the date is not set, the CSV file may have invalid entries, we only include the set date entries
    		if(isset($items['date']))
    		{
        		$lot->date = date("Y-m-d", strtotime($items['date']));
        		$lot->category = $items['category'];
        		$lot->lot_title = $items['lot_title'];
        		$lot->lot_location = $items['lot_location'];
        		$lot->lot_condition = $items['lot_condition'];
        		$lot->pre_tax_amount = $items['pre_tax_amount'];
        		$lot->tax_name = $items['tax_name'];
        		$lot->tax_amount = $items['tax_amount'];
        		$lot->save();
    		}
    	}

        //First query will group by category and calculate the tax amount and pre tax amount for each category
        $categoryspending = Items::groupBy('category')
        ->selectRaw('sum(tax_amount)+sum(pre_tax_amount) as total , category')
        ->get();
        

        /** 
        * Second query will calculate the sum first and group by months 
        * @package DB::raw
        */
        $monthspending = Items::select(
                DB::raw('sum(tax_amount)+sum(pre_tax_amount) as total'),
                DB::raw("DATE_FORMAT(date, '%M') as months"))
                ->groupBy('months')
                ->get();

        //return the view result with all the variables required to show results
    	return view('result', compact('categoryspending','monthspending','csvheader','csvbody'));
   }		
}

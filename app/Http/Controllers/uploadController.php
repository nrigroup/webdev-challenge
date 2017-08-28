<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\data;
use DateTime;

class uploadController extends Controller
{
    public function index(){
    	return view('upload');
    }

    /****
 	    Stores the data from the uploaded file to db and displays the report view 

    ******/
    public function storeData(request $request){
    	
    	if($request->hasFile('browse_file')){

			$upload = $request->file('browse_file');
    		$request->browse_file->storeAs('public','data.csv');

    		//open and read the data from the file 
    		$file_path = $upload->getRealPath();
    		$file = fopen($file_path, 'r');
            $data=[];
			
			if ($file) {
				while (($line = fgets($file)) !== false) {
					$data[] = explode(',',$line);
				}
			    fclose($file);
			} else {
			    return view('upload');
			}

            //Since the data[0][n] is just the header, will start at 1
			for($row = 1; $row < count($data); $row++){
				$_data = new data();

				//properly format the dates in order to use fetch for report
				$dateformat = new DateTime($data[$row][0]);
				$_data->date_ = $dateformat->format('y-m-d');
				
				$_data->category = $data[$row][1];
				$_data->lot_title = $data[$row][2];
				$_data->lot_location = $data[$row][3].','.$data[$row][4].$data[$row][5];
				$_data->lot_condition = $data[$row][6];
				$_data->pre_tax_amount = $data[$row][7];
				$_data->tax_name = $data[$row][8];
				$_data->tax_amount = $data[$row][9];
				$_data->save();	
			}

			//Report method can be found below. Generates the report and displays the report view
			$reportContent = \DB::select( \DB::raw("SELECT Category, Year(date_) as year, month(date_) as month,sum(tax_amount) as total_tax_amount, sum(pre_tax_amount + tax_amount) as total_amount FROM data GROUP BY YEAR(date_),MONTH(date_),Category") );

			return view('report')->with('reports', $reportContent);

     		
    	}else{
    		return view('upload');
    	}
    }
}

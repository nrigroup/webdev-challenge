<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;

class DataController extends Controller
{
    public function upload()
    {
        return view('upload/upload');
    }

    public function upload_processing(Request $request)
    {
    	$file = $request->file('csv');
    	$row = 0;

		if (($handle = fopen($file, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	// skip header row
		        if ($row > 0){			        
		        	$item = new Item;

    				$item->date = $data[0];
		            $item->category = $data[1];
		            $item->lot_title = $data[2];
		            $item->lot_location = $data[3];
		            $item->lot_condition = $data[4];
		            $item->pre_tax_amount = $data[5];
		            $item->tax_name = $data[6];
		            $item->tax_amount = $data[7];

		            $item->save();
			    }
			    $row++;
		    }
		    fclose($handle);
		}

		$totals = Item::totals();

        return view('upload/done')->with('totals', $totals);
    }
}

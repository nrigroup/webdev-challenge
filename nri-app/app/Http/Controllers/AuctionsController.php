<?php

namespace App\Http\Controllers;

use App\Auction;

use Mockery\Exception;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
Use App\Document;

class AuctionsController extends Controller
{
    public function store(Request $request) {

        try {

            // Return with errors if file not submitted
            if ($request->file('csvFile') == null) {
                return view('home.home', array('errorMessage' => 'Please submit a csv file.'));
            }

            // Get file
            $upload = $request->file('csvFile');
            $filePath = $upload->getRealPath();
    
            // Open and read
            $file = fopen($filePath, 'r');
            $header = fgetcsv($file);
    
            // Loop through columns
            while($columns = fgetcsv($file)) {

                $data = array();
    
                // Format data
                foreach($columns as $key => $value) {
                    if ($header[$key] == 'date') {
                        $value = date("Y-m-d", strtotime($value) );
                    }
                    $data[$header[$key]] = $value;
                }
    
                // Fields to insert
                $date=$data['date'];
                $category=$data['category'];
                $lot_title=$data['lot title'];
                $lot_location=$data['lot location'];
                $lot_condition=$data['lot condition'];
                $pre_tax_amount=$data['pre-tax amount'];
                $tax_name=$data['tax name'];
                $tax_amount=$data['tax amount'];
                
                // Create new auction item or update if it exists
                // *Existence is defined by combination of title and location
                $auction = Auction::firstOrNew([
                    'lot_title' => $lot_title, 
                    'lot_location' => $lot_location
                ]);

                $auction->date = $date;
                $auction->category = $category;
                $auction->lot_condition = $lot_condition;
                $auction->pre_tax_amount = $pre_tax_amount;
                $auction->tax_name = $tax_name;
                $auction->tax_amount = $tax_amount;
    
                // Save auction item into database
                $auction->save();
                
            }

            // Render dashboard page
            return redirect()->route('dashboardPage');

        } catch (Exception $ex) {
            abort(500); // Internal server error
        }
    }
}

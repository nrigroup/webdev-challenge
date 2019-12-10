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
            //get file
            $upload = $request->file('csvFile');
            $filePath = $upload->getRealPath();
    
            // open and read
            $file = fopen($filePath, 'r');
    
            $header = fgetcsv($file);
    
    
            while($columns = fgetcsv($file)) {
                // dd($columns);
                $data = array();
    
                foreach($columns as $key => $value) {
                    if ($header[$key] == 'date') {
                        $value = date("Y-m-d", strtotime($value) );
                    }
                    $data[$header[$key]] = $value;
                }
    
                $date=$data['date'];
                $category=$data['category'];
                $lot_title=$data['lot title'];
                $lot_location=$data['lot location'];
                $lot_condition=$data['lot condition'];
                $pre_tax_amount=$data['pre-tax amount'];
                $tax_name=$data['tax name'];
                $tax_amount=$data['tax amount'];
                
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
    
                $auction->save();
                
            }

            return redirect()->route('dashboardPage');

        } catch (Exception $ex) {
            abort(500); // Internal server error
        }


        // dd($total);
    }
}

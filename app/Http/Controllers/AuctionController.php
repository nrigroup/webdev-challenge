<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;




class AuctionController extends Controller
{
    
    public function showForm(){
        return view('welcome');
    }
    
    // store CEV file into database
    public function import(Request $request){

        // get file 
        $upload = $request -> file('upload_file');
        $filePath = $upload-> getRealPath();
        // open and read file 
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);
       
        // validate file 
 
        // loop throgh other colums
        $importData_arr = array();
        $i = 0;
        while( $filedata = fgetcsv($file))
        {
            $num = count($filedata );
            if($i == 0){
                $i++;
                continue; 
            }
            for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;

        }
       // Insert to MySQL database
       foreach($importData_arr as $importData){

        $insertData = array(
           "date"=>$importData[0],
           "category"=>$importData[1],
           "lot_title"=>$importData[2],
           "lot_location"=>$importData[3],
           "lot_condition"=>$importData[4],
           "pretax_amount"=>$importData[5],
           "tax_name"=>$importData[6],
           "tax_amount"=>$importData[7],

        );
           Auction::insertData($insertData);

      }
      return redirect()->action('AuctionController@showForm');

    }



}

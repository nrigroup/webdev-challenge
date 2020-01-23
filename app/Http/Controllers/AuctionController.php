<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use DB;




class AuctionController extends Controller
{
    // Display welcome view
    public function showForm(){
        return view('welcome');
    }
    
    // store CEV file into database
    public function import(Request $request){

        // get file 
        $upload = $request -> file('upload_file');
        if ( $upload == null){
            $error = "Please select CSV file";
            return view("welcome")->with('error',$error);
        }
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
    
     $data = DB::table('auctions')->get();
     return view("welcome")->with('allAuctionData',$data);

    }
    // get all the total spending per month from database 
    public function perMonth (){
        $data =  Auction::totalPreMonth();
        return view("welcome")->with('totalPerMonth',$data);   
    }
    // get all the total spending per category from database 
    public function perCategory (){
        $data =  Auction::totalPreCategory();
        return view("welcome")->with('totalPerCategory' ,$data);      
    } 




}

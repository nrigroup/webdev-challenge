<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Session;

class ItemsController extends Controller {
    public function index() {
        return view('index');
    }

    public function showTable() {
        $items = Item::getAllItems();
        return view('show_table', ['items' => $items]);
    }

    public function uploadFile(Request $request) {
        if ($request->input('submit') != null ){
            $file = $request->file('csv_file');
      
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
      
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)) {

                // Check file size
                if($fileSize <= $maxFileSize) {
      
                    // File upload location
                    $location = 'uploads';
        
                    // Upload file
                    $file->move($location,$filename);
        
                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);
        
                    // Reading file
                    $file = fopen($filepath,"r");
        
                    $importData_arr = array();
                    $i = 1;
        
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                    
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);
        
                    // Insert to MySQL database
                    foreach($importData_arr as $importData){
                        $insertData = array(
                            "date"          =>$importData[1],
                            "category"      =>$importData[2],
                            "lot_title"     =>$importData[3],
                            "lot_location"  =>$importData[4],
                            "lot_condition" =>$importData[5],
                            "pre_tax_amount"=>$importData[6],
                            "tax_name"      =>$importData[7],
                            "tax_amount"    =>$importData[8]);
                        Item::insertData($insertData);
                    }
                    Session::flash('message','Import Successful.');
                } else {
                Session::flash('message','File too large. File must be less than 2MB.');
                }
            } else {
                Session::flash('message','Invalid File Extension.');
            }
        }
        // Redirect to index
        return redirect()->route('show_table');
    }
}

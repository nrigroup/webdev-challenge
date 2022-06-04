<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Items;
class HomeController extends Controller
{   
    //Page for showing form for uploading csv
    public function index(){

        return view('index');
    }

    //post csv data and save in table
    public function postCSV(Request $request){

        if ($request->file('csvFile') != null ){
    
            $file = $request->file('csvFile');
        
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
            if(in_array(strtolower($extension),$valid_extension)){
        
                // Check file size
                if($fileSize <= $maxFileSize){
        
                // File upload location
                $location = 'uploads';
        
                // Upload file
                $file->move($location,$filename);
        
                // Import CSV to Database
                $filepath = public_path($location."/".$filename);
        
                // Reading file
                $file = fopen($filepath,"r");
        
                $importData_arr = array();
                $i = 0;
                
                //make array of required fields
                $requiredFields = array('date', 'category', 'lot title', 'lot location', 'lot condition', 'pre-tax amount');
                $headerFields = array();
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    
                    $num = count($filedata );
                    
                    // Skip first row 
                    if($i == 0){
                        $i++;

                        //check all required fields are there
                        $invalid_columns = 0;
                        foreach($requiredFields as $field){
                            if(!in_array($field, $filedata)){

                                $invalid_columns++;
                            }
                        }
                        if($invalid_columns > 0){

                            Session::flash('message','Required Fields Missing.');
                            return redirect()->action('HomeController@index');
                        }
                        $headerFields = $filedata;
                        continue; 
                    }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][$headerFields[$c]] = $filedata [$c];
                    } 
                    $i++;
                }
               
                fclose($file);

                

                
                // Insert to MySQL database
                foreach($importData_arr as $importData){
                   
                    //validate required fields
                    if(trim($importData['date']) == '' || trim($importData['category']) == '' || trim($importData['lot title']) == '' || trim($importData['lot location']) == '' || trim($importData['lot condition']) == '' || trim($importData['pre-tax amount']) == ''){

                        Session::flash('message','Required Fields Missing.');
                        return redirect()->action('HomeController@index');
                    }

                    $insertData[] = array(
                        "date"=>date('Y-m-d', strtotime($importData['date'])),
                        "category"=>$importData['category'],
                        "lot_title"=>$importData['lot title'],
                        "lot_location"=>$importData['lot location'],
                        "lot_condition"=>$importData['lot condition'],
                        "pre_tax_amount"=>$importData['pre-tax amount'],
                        "tax_name"=> isset($importData['tax name']) && $importData['tax name'] != '' ? $importData['tax name'] : 0,
                        "tax_amount"=>isset($importData['tax amount']) && $importData['tax amount'] != '' ? $importData['tax amount'] : 0);                  
        
                }               
                    Items::insert($insertData);
                   
                    // Redirect to dashboard
                    return redirect()->action('HomeController@dashboard');
                }else{
                    Session::flash('message','File too large. File must be less than 2MB.');
                }
        
            }else{
                Session::flash('message','Invalid File Extension.');
                return redirect()->action('HomeController@index');
            }    
        } else {
            
            Session::flash('message','Please upload file');
            return redirect()->action('HomeController@index');
        }
    
        
    }

    //show csv data in dashboard
    function dashboard(){

        //calculate total amount date wise
        $total_amount = Items::selectRaw('date, sum(pre_tax_amount) as total')->groupBy('date')->orderBy('date')->get()->toArray();

        //calculate total amount category wise
        $total_amount_per_category = Items::selectRaw('category, sum(pre_tax_amount) as total')->groupBy('category')->orderBy('id')->get()->toArray();

        //calculate total amount condition wise
        $total_amount_per_condition = Items::selectRaw('lot_condition, sum(pre_tax_amount) as total')->groupBy('lot_condition')->orderBy('id')->get()->toArray();        

        return view('dashboard', 
                [   
                    'total_amount'=> $total_amount, 
                    'total_amount_per_category'=> $total_amount_per_category, 
                    'total_amount_per_condition'=> $total_amount_per_condition
                ]);

    }
}

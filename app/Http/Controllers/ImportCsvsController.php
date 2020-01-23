<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Csv;

class ImportCsvsController extends Controller
{
    public function index(){
        $title = "Import CSV data into Database";
        return view('index')->with('title',$title);
    }

    public function showData(){
        $records = Csv::showData();
        return view('records',['records'=>$records]);
    }

    public function uploadFile(Request $request){
        if($request->file('uploadedFile') != ""){
            
            $file = $request->file('uploadedFile');
            //dd($file);

            // Get the file details and store it in variables
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Uploaded file should be in CSV format
            $valid_extension = array("csv");

            // Restrict file size to 2MB
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){
                    
                    $file = fopen($tempPath,"r");

                    //Get the Header Starts Here
                    $header = fgetcsv($file);
                    //dd($header);

                    $escapedHeader = [];

                    foreach($header as $key => $value){
                        //Replace - and space with _ and push each header element in an array
                        $escapedValue = preg_replace('/[\- ]/','_',$value);
                        array_push($escapedHeader,$escapedValue);
                    }
                    // dd($escapedHeader);
                    // Get the Header Ends Here
                    $allData=[];
                    while($columns = fgetcsv($file)){
                        if($columns[0] == ""){
                            continue;
                        }
                        foreach($columns as $key => &$value){
                            $value = preg_replace('/[,]/',' ',$value);
                        }
                        //dd($value);
                        $data = array_combine($escapedHeader,$columns);
                        //dd($data);
                        foreach($data as $key => &$value){
                            if($key == 'date'){
                                $value = strtotime($value);
                                $value = date('Y-m-d',$value);
                            }
                            else{
                                $value = $value;
                            }
                        }
                        array_push($allData,$data);
                        
                    }
                    //dd($allData);

                   
                     // Insert to MySQL database
                    foreach($allData as $importData){
                        $insertData = array(
                        "date"=>$importData['date'],
                        "category"=>$importData['category'],
                        "lot_title"=>$importData['lot_title'],
                        "lot_location"=>$importData['lot_location'],
                        "lot_condition"=>$importData['lot_condition'],
                        "pre_tax_amount"=>$importData["pre_tax_amount"],
                        "tax_name"=>$importData['tax_name'],
                        "tax_amount"=>$importData['tax_amount']);
                        Csv::insertData($insertData);
                    }
                    //Redirect to Records Page
                    return redirect()->action('ImportCsvsController@showData')->with('status','File imported successfully');

                }
                else{
                    Session::flash('message','File size should not more than 2MB');
                    return redirect()->action('ImportCsvsController@index');
                }
            }
            else{
                Session::flash('message','Invalid File Extension only CSV allowed');
                return redirect()->action('ImportCsvsController@index');
            }
        }
        else{
            Session::flash('message','Please select file to upload');
            return redirect()->action('ImportCsvsController@index');
        }
        
    }
}

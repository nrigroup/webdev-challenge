<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function index(){
        return view('lot.index');
    }

    public function success() {
        
        $spendingByCategory = DB::table('lots')
        ->select('category', DB::raw('SUM(total_spending) as total_spending'))
        ->groupby('category')
        ->get();

        $sql = "SELECT month(date) as month, year(date) as year, sum(total_spending) as total_spending FROM lots GROUP BY month(date), year(date)"; 
        $spendingPerMonth = DB::select($sql);
        
        return view('lot.success', [
            'spendingByCategory' => $spendingByCategory,
            'spendingPerMonth' => $spendingPerMonth
        ]);
        
    }

    public function errorResult(Request $request, $msg){
        
        return view('lot.result', compact('msg'));
    }

    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){
    
            $file = $request->file('file');

            if ($file != null) {
    
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

                // Array of the column names in the lots table in the database
                $lotsHeaderArray = array("date", "category", "lot title", "lot location", "lot condition", "pre-tax amount", "tax name", "tax amount");
            
                // Check file extension
                if(in_array(strtolower($extension),$valid_extension)){
            
                    // File upload location
                    $location = 'uploads';
            
                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $headerArray = array();
                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );
                        
                        // Check first row for correct headers in the right order
                        if($i == 0){
                            for ($b=0; $b < $num; $b++) {
                                $headerArray[$b] = $filedata [$b];
                            }
                            if($headerArray === $lotsHeaderArray) {
                                $i++;
                                continue;
                            }
                            else {
                                // Redirect to result
                                return redirect()->action('LotController@errorResult', ['msg' => 'The headers in the file do not match the headers in our database.']);
                            }
                        }
                        for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){
                        // Convert date from string to date format
                        $dateArray = explode("/", $importData[0], 3);
                        $d = mktime(null, null, null, $dateArray[0], $dateArray[1], $dateArray[2]);
                        $date = date("Y-m-d", $d);
                        $insertData = array(
                            "id"=>null,
                            "date"=>$date,
                            "category"=>$importData[1],
                            "lot_title"=>$importData[2],
                            "lot_location"=>$importData[3],
                            "lot_condition"=>$importData[4],
                            "pre_tax_amount"=>$importData[5],
                            "tax_name"=>$importData[6],
                            "tax_amount"=>$importData[7],
                            "total_spending"=>strval(floatval($importData[5]) + floatval($importData[7])),
                            "created_at"=>date("Y-m-d H:i:s"),
                            "updated_at"=>date("Y-m-d H:i:s"));
                    
                        \App\Lot::insertData($insertData);

                    }
                    // Redirect to result
                    return redirect()->action('LotController@success', ['msg' => 'Import Successful.']);

                }else{
                    // Redirect to result
                    return redirect()->action('LotController@errorResult', ['msg' => 'Invalid File Extension.']);
                }
            }else {
                // Redirect to result
                return redirect()->action('LotController@errorResult', ['msg' => 'Please select a .csv file to upload.']);
            }
        }
    }
}

<?php
namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\AuctionAwards;

class AuctionAwardsController extends Controller{

	public function addAuctionFile(){
		return view('index');
	}

	public function uploadFile(Request $request){

		if ($request->input('submit') != null ){
			if($request->hasFile('file')) {	

			 	$file = $request->file('file');

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

			      	while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
			        	$num = count($filedata);
			         
			         	// Skip first row (Remove below comment if you want to skip the first row)
			         	if($i == 0){
			            	$i++;
			            	continue; 
			         	}
			         	for ($c=0; $c < $num; $c++) {
			            	$importData_arr[$i][] = $filedata[$c];
			         	}
			        	$i++;
			    	}
			    fclose($file);

			    // Insert to MySQL database
			    foreach($importData_arr as $importData){
			        $insertData = array(
			        	"auctionDate"=>date("y-m-d H:i:s",strtotime($importData[0])),
			            "category"=>$importData[1],
			            "lotTitle"=>$importData[2],
			            "lotLocation"=>$importData[3],
			            "lotCondition"=>$importData[4],
			            "preTaxAmount"=>$importData[5],
			            "taxName"=>$importData[6],
			            "taxAmount"=>$importData[7],
			            "created_at"=>now(),
			            "updated_at"=>now(),

			        );

			        AuctionAwards::insertData($insertData);
			    }

			    Session::flash('message','Imported Successfully.');
			    	}else{
			      			Session::flash('message','File too large. File must be less than 2MB.');
			    	}

			}else{
			     Session::flash('message','Invalid File Extension, CSV Required.');
				 }

			}
			else{
			Session::flash('message','Please Add A File.');
			}
		//}
		// Redirect to index
		//return redirect()->action('AuctionAwardsController@addAuctionAwards');
		return redirect('/upload-auction-file');
	}
	}
}
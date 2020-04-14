<?php

namespace App\Http\Controllers\ImportCSV;

use App\Data_Items;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
use DB;

class ImportCsvController extends Controller
{
    //
    public function index()
    {
        $data = Data_items::orderBy('created_at','DESC')->get();
        
        return view('upload',compact('data'));
    }

    public function store(Request $request)
    {   
        //get file
        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');

        $header= fgetcsv($file);

        // dd($header);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '_', $lheader); //re-placing space or '-' with '_' from header
            array_push($escapedHeader, $escapedItem);
        }

        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
            {
                continue;
            }
                       
        //header and columns
        $data= array_combine($escapedHeader, $columns);

           // Table update
           $fname=$data['first_name'];
           $lname=$data['last_name'];
           $address=$data['address'];
           $province=$data['province'];
           $info= Data_Items::firstOrNew(['first_name'=>$fname,'last_name'=>lname,'address'=>$address,'province'=>$province]);
           $info->save();
        }
        
        
    }
}

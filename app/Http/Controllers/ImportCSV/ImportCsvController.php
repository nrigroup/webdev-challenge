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
        $Total_amount = DB::table('data__items')->select(DB::raw('SUM(pre_tax_amount) + SUM(tax_amount) as total, category'))->groupBy('category')->get();
        return view('upload',compact('data','Total_amount'));
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
           $date=$data['date'];
           $dateformated= Carbon::createFromFormat('m/d/Y',$date)->format('Y-m-d'); // Changing date format for mysql
           $category=$data['category'];
           $lot_title=$data['lot_title'];
           $lot_location=$data['lot_location'];
           $lot_condition=$data['lot_condition'];
           $pre_tax_amount=$data['pre_tax_amount'];
           $tax_name=$data['tax_name'];
           $tax_amount=$data['tax_amount'];
        
           $budget= Data_Items::firstOrNew(['date'=>$dateformated,'category'=>$category,'lot_title'=>$lot_title,'lot_location'=>$lot_location,'lot_condition'=>$lot_condition,'pre_tax_amount'=>$pre_tax_amount,'tax_name'=>$tax_name,'tax_amount'=>$tax_amount]);
           $budget->save();
        }
        
        
    }
}

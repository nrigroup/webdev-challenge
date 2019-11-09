<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;

class RecordController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    //Valiaation
    $request->validate([
        'file' => 'required|file'
    ]);

      $file = $request->file('file');

      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes - 2GB Limit for Security Reason
      $maxFileSize = 2097152; 

      // Check file extension
      if(in_array(strtolower($extension),$valid_extension))
      {

        // Check file size
        if($fileSize <= $maxFileSize)
        {

          // File upload location
          $location = 'uploads';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = $location."/".$filename;


          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
          {
             $num = count($filedata );
             
             //Skip first row (Remove below comment if you want to skip the first row)
             if($i == 0){
                $i++;
                continue; 
             }
             for ($c=0; $c < $num; $c++)
              {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }
          fclose($file);

          //Find if file is empty
          if(count($importData_arr)<1)
          {
              return response("OOps! Your CSV File is empty");
          }
          
          //if file not empty
          else
          {
              //Reach each row and save to database
               foreach ($importData_arr as $data)
               {
                $row = new Record;
                $row->date = $data[0];
                $row->category = $data[1];
                $row->lot_title = $data[2];
                $row->lot_location = $data[3];
                $row->lot_condition = $data[4];
                $row->pre_tax_amount = $data[5];
                $row->tax_name = $data[6];
                $row->tax_amount = $data[7];
                $row->save();
               }

               //Search the table in order to get tosal sum of tax_amount per month per category wise.
               $result = \DB::table('records')
               ->select(\DB::raw('SUM(pre_tax_amount) as total_spending, MONTH(date) month, category'))
               ->groupBy('month')
               ->groupBy('category')
               ->get();

               //Store the data to info array
                $info = [];
                foreach ($result as $res)
                {
                    $info [] = $res;
                }

               
               //Redirect to dashboard with success message 
               return redirect('/')->with('result', $info)->with('status','Data Imported Successfully');
          
          }

          //redirect to dashboard with error message
          return redirect('/')->with('error', 'Oops! Some Error Occured');
          
        }
    }
}





        
    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}

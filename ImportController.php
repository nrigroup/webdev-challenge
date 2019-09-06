<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Import;

class ImportController extends Controller
{
    private $data;
    
    public function import()
    {
       return view('imports') ;
    }
    
    public function display()
    {
       //Get the path of the file
       $path = request('csv_file')->getRealPath();       
       
       //Open the file
       $file = fopen($path, "r");
       
       //Get the header
       $header=fgetcsv($file);

       //Get the data array
       while($content=fgetcsv($file))
       {
            $date = date("Y-m-d",strtotime(str_replace('/','-',$content[0])));
            
            $data[]=[
                        $date, 
                        $content[1],
                        $content[2],
                        $content[3],
                        $content[4],
                        $content[5],
                        $content[6],
                        $content[7]
                    ];
          
       }
       
       
       //Serialize Data Array - pass the data to store method through hidden input
       $serializedData=serialize($data);
       
       //display uploaded data
       return view('displays', compact('header', 'data','serializedData')) ;
       
    }
    
    public function store()
    {
       //Get the data from hidden input
       $serializedData=request('serializedData');
        
       //unserialize the data to array
       $data = unserialize($serializedData);

       //Get the contents and save to database
       foreach($data as $record)
       {
  
            Import::create([
                'date'=>$record[0],
                'category'=>$record[1],
                'lot title'=>$record[2],
                'lot location'=>$record[3],
                'lot condition'=>$record[4],
                'pre-tax amount'=>$record[5],
                'tax name'=>$record[6],
                'tax amount'=>$record[7] 
            ]);           
          
       }

       //Redirect the page to /display
       return redirect('summary');

    }
    
    public function summary()
    {
        //Select tax amount, date with format m-Y, and category
        $data = \DB::table('imports')->selectRaw("sum(`tax amount` + `pre-tax amount`) as `sum`, DATE_FORMAT(`date`, '%b-%Y') as `month`, `category`");
        
        //Group the results by month and category, and order by month and category
        $data = $data->groupBy('month','category')->latest('date')->orderBy('category');
        
        //Get tax amount grouped by month and category
        $data = $data->get();
        
        //Get the sum of tax amount
        $total=$data->sum('sum');
        
        //Return the view /display
        return view('summary', compact('data','total')) ;

    }
}

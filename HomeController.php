<?php

namespace App\Http\Controllers;
use Input;
use App\Auction;
//use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the upload form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * Upload the csv file
     *
     * @return 
     */
    public function upload(Request $request)
    {
        
        $datafile = $request->file('csv');
        $fileExt = $datafile->getClientOriginalExtension();
        $input['filename'] = time().'.'.$datafile->getClientOriginalExtension();
        $destinationPath = public_path('/csv');
        $datafile->move($destinationPath,$input['filename']);
       
        
        return view("upload",["fileExt"=>$input['filename']]);
    }
    /**
     * Show the csv file data
     *
     * @return 
     */
    public function showcsvdata($filename)
    {
        $file_name = "csv\\".$filename;
        $file = public_path($file_name);
       
        $auctionArrays = $this->csvToArray($file);
        
        if(!empty($auctionArrays) && count($auctionArrays)){
            foreach ($auctionArrays as $auctionArray) {
                $time = strtotime($auctionArray['date']);
                $newformat = date('Y-m-d',$time);
                                 
                $insert[] = ['date'=>$newformat , 'category' =>$auctionArray['category'], 'lot_title'=>$auctionArray['lot title'],
                             'lot_location'=>$auctionArray['lot location'],'lot_condition'=>  $auctionArray['lot condition'],
                             'pre_tax_amount'=>$auctionArray['pre-tax amount'], 'tax_name'=>$auctionArray['tax name'],'tax_amount'=>$auctionArray['tax amount']];
            }
                                    					
	    if(!empty($insert)){
		DB::table('auctions')->insert($insert);
		//dd('Insert Records successfully.');
               
            }
	}
        //SELECT month(date) as month, category, SUM(tax_amount) as spending FROM gary.auctions group by month(date), (category);
        $sums = DB::table('auctions')->select(DB::raw("MONTH(date) as month"),"category",DB::raw("SUM(tax_amount) as spending"))
                                     ->groupBy(DB::raw("MONTH(date)"))
                                     ->groupBy('category')
                                     ->get();
          return view("showsummery",["sums"=>$sums]);                           
        
    } 
    
     /**
     * show suumaery data
     *
     * @return 
     */
    public function showsummery()
    {
        return view('showsummery');
    }
    
    /**
     * Convert csv data to an array
     *
     * @return array
     */
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use File;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Auction;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions=Auction::all();
        $results = DB::select('SELECT DATE_FORMAT(date, "%Y-%m") as date,category,SUM(pre_tax_amount + tax_amount) as total_amount FROM `auctions`
                               GROUP BY category,DATE_FORMAT(date, "%Y-%m")');
        return view('add-auction',compact('auctions','results'));
    }
    public function destroy($id)
    {
        Auction::find($id)->delete();
        return back();
    }
    public function import(Request $request)
    {
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
        if($request->hasFile('file'))
            {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv")
                {
                    $path = $request->file->getRealPath();
                    $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count())
                {
                    foreach ($data as $key => $value)
                    {
                        $newdate = date('Y-m-d', strtotime($value->date));
                        $insert[] = [
                            'date' => $newdate,
                            'category' => $value->category,
                            'lot_title' => $value->lot_title,
                            'lot_location' => $value->lot_location,
                            'lot_condition' => $value->lot_condition,
                            'pre_tax_amount' => $value->pre_tax_amount,
                            'tax_name' => $value->tax_name,
                            'tax_amount' => $value->tax_amount
                                    ];
                    }
                    if(!empty($insert))
                    {
                        $insertData = DB::table('auctions')->insert($insert);
                        if ($insertData)
                        {
                            Session::flash('success', 'Your data has successfully imported');
                        }else
                         {
                            Session::flash('error', 'Error inserting the data');
                            return back();
                        }
                    }
                }
                return back();

                }else
                {
                    Session::flash('error', 'File is a '.$extension.' file.Please upload a valid xls/csv file');
                    return back();
                }
            }
    }
}


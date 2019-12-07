<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\ItemImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
  
class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    * Import Function
    */
    public function importView()
    {
        // Query for fetching spending by month and category
        $items = DB::select("SELECT 
            Year(date) as 'year',
            Month(date) as Month,
            category, 
            SUM(pre_tax_amount) as base, 
            SUM(tax_amount) as tax, 
            (SUM(pre_tax_amount) + SUM(tax_amount)) as 'Total' 
            FROM items 
            GROUP BY 
            MONTH(date), category, year;");
            // Return View + Data
       return view("import", compact('items'));
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ItemImport,request()->file('file'));
           
        return back();
    }
}

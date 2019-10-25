<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class MyController extends Controller
{
   /**
       * @return \Illuminate\Support\Collection
       */
       public function importExportView()
       {
          return view('import');
       }

       /**
       * @return \Illuminate\Support\Collection
       */
       public function Productsexport()
       {
           return Excel::download(new UsersExport, 'products.xlsx');
       }


         /**
                * @return \Illuminate\Support\Collection
                */
                public function ProductsImport()
                {
                    Excel::import(new ProductsImport,request()->file('file'));
                     return back()->with('success','You added new items to database!');
                }
                  public function calculate()
                        {
                         $products = DB::table('products')
                                                         ->select('category',DB::raw('SUM(tax_amount) as total'),DB::raw('Year(date) as year'), DB::raw('MONTH(date) as month'))
                                                          ->groupBy('year')
                                                          ->groupBy('month')
                                                          ->groupBy('category')
                                                          ->orderBy('year','desc')
                                                          ->get();

                          return view('calculate', compact('products'));
                       }
}

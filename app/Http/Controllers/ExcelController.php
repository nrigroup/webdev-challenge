<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Product;

class ExcelController extends Controller
{
    /**
     * Import page view
     *
     * @return \Illuminate\Http\Response
     */

    public function importView(){

        return view('import');

    }

    public function tableView(){
        // $products = Product::all();
        // return view('table')->with('products', $products);
        $products = Product::groupBy('category')
                ->selectRaw('sum(tax_amount + pre_tax_amount) as total, category')
                ->get();


        return view('table')->with('products', $products);

    }



    /**
     * Import csv file
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */

    public function importFile(Request $request){
        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();
            \Excel::load($path)->each(function (Collection $csvLine) {

                Product::create([
                    'date' => $csvLine->get('date') ,
                    'category' => $csvLine->get('category'),
                    'lot_title' => $csvLine->get('lot_title'),
                    'lot_location' => $csvLine->get('lot_location'),
                    'lot_condition' => $csvLine->get('lot_condition'),
                    'pre_tax_amount' => $csvLine->get('pre_tax_amount'),
                    'tax_name' => $csvLine->get('tax_name'),
                    'tax_amount' => $csvLine->get('tax_amount')
                ]);
           
           });
           return redirect('/table')->with('success', 'Message created');

        }

        // dd('Request data does not have any files to import.');      
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Product;
use App\Auction;

class ExcelController extends Controller
{
    /**
     * Import page view
     *
     * @return \Illuminate\Http\Response
     */

    public function importView(){

        return view('pages.import');

    }

    public function tableView(){
        // $products = Product::all();
        // return view('table')->with('products', $products);
        $products = Product::groupBy('category')
                ->selectRaw('sum(tax_amount + pre_tax_amount) as total, category')
                ->get();


        return view('pages.table')->with('products', $products);

    }



    /**
     * Import csv file
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */

    public function importFile(Request $request){
        if($request->hasFile('sample_file')){
            $path = $request->file('sample_file')->getRealPath();

            // Get filename with the extension
            $filenameWithExt = $request->file('sample_file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            if(!Auction::find($filename)){
                Auction::create([
                    'filename'=>$filename
                ]);
            }else{
                return redirect('/import')->with('error', 'Duplicate file has been submitted');  
            }
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
           return redirect('/table')->with('success', 'table created');

        }
        return redirect('/import')->with('error', 'No file submitted, please choose a csv file to submit');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTable()
    {
        // $products = Product::query();
        // // Check for correct user
        Product::truncate();
        Auction::truncate();
        // $products->delete();
        return redirect('/import')->with('success', 'Table Removed');
    }
}

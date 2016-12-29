<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Input;
use DB;
use Excel;

class ExcelController extends Controller{
    
    public function getImport(){
        return view('excel.import');
    }
    
    /* Import to CSV */
    public function postImport(){
        Excel::load(Input::file('items'), function ($reader){
           $reader->each(function($sheet){
               Item::firstOrCreate($sheet->toArray()); 
                return $sheet;
           }); 
        });
        return back();
    }
    
    /* Export XLSX */
    public function getExport(){
        $customer=Item::all();
        Excel::create('Export Data', function($excel) use($customer){
            $excel->sheet('Sheet 1' , function($sheet) use($customer){
                $sheet->fromArray($customer);         
            });
        })->export('xlsx');
    }
}

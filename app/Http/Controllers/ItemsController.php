<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use DB;
class ItemsController extends Controller
{
    //
    public function index() {
      return view('index');
    }

    public function processCSV (Request $request) {
      $file = $request->file('data_file')->move(public_path('uploads'), $request->file('data_file')->getClientOriginalName());
      $handle = fopen($file, 'r');

      if(($handle = fopen($file, 'r')) !== FALSE) {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $items = new Items();
          $items->date = date("Y-m-d", strtotime($data[0]));
          $items->category = $data[1];
          $items->lot_title = $data[2];
          $items->lot_location = $data[3];
          $items->lot_condition = $data[4];
          $items->pre_tax_amount = $data[5];
          $items->tax_name = $data[6];
          $items->tax_amount = $data[7];
          $items->save();
        }
        fclose($handle);
      }
      return redirect()->route('items');
    }

    public function getTotals () {
      $data['sumPerCategory'] = array();
      $data['sumPerMonth'] = array();

      //Select sum per category
      $categoryQuery = DB::table('items')
        ->select(DB::raw('category, sum(`pre_tax_amount`) as preTaxAmountSum, sum(`tax_amount`) as taxAmountSum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total'))
        ->groupBy('category')
        ->get();
      if($categoryQuery->count()) {
        $data['sumPerCategory'] = $categoryQuery->toArray();
      }

      //Select sum per month
      $monthQuery = DB::table('items')
        ->select(DB::raw('MONTH(date) as month, YEAR(date) as year, sum(`pre_tax_amount`) as preTaxAmountSum, sum(`tax_amount`) as taxAmountSum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total'))
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
      if($monthQuery->count()) {
        $data['sumPerMonth'] = $monthQuery->toArray();
      }
      return view('items', $data);
    }
}

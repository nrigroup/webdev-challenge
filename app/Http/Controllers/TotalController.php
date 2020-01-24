<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DateTime;
use \DB;

class TotalController extends Controller
{
  public function show(){
    // Get data from database
    $data = DB::select("select date, category, pre_tax_amount, tax_amount from data");

    $summaryData = [];
    foreach ($data as $row) {
      $time = new DateTime($row->date);
      // Reformat the time so that monthly report can be obtained
      $month = $time->format('Y-m');
      $category = $row->category;
      // Create a key and group the same month/category together
      $name = $month . "-" . $category;
      // Add the pre-tax amount and tax amount together
      $amount = $row->pre_tax_amount + $row->tax_amount;
      if (array_key_exists($name, $summaryData)){
        // Update the monthly data
        $summaryData[$name]["sum"] = $summaryData[$name]["sum"] + $amount;
      }else{
        // Add monthly data if it doesn't exist
        $summaryData[$name] = [
          "month" => $month,
          "category" => $category,
          "sum" => $amount
        ];
      }
    }
    
    return view('summary', [
      "summary" => $summaryData
    ]);
  }
}

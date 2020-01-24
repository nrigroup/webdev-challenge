<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DateTime;
use \DB;

class HandleController extends Controller
{
  public function show(){
    $data = [];
    $dir = $_FILES["file"]["tmp_name"];

    if($dir){
      // Open the file
      if (file_exists($dir)) {
        $handle = fopen($dir, "r");
        $skipHeaderLine = true;
        // Read the CSV file line by line
        while($content = fgetcsv($handle)) {
          // Skip the dataset header line
          if ($skipHeaderLine) {
            $skipHeaderLine = false;
            continue;
          }
          $time = new DateTime($content[0]);
          // Reformat the time
          $content[0] = $time->format('Y-m-d H:i:s');
          // Save the read data into the array
          $data[] = $content;
        }
      }

      // Save the array data into database according to the schema
      foreach ($data as $row) {
        DB::insert("insert into data (date, category, lot_title, lot_location, lot_condition, pre_tax_amount, tax_name, tax_amount) values (?, ?, ?, ?, ?, ?, ?, ?)", [$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]]);
      }
    }

    $summaryData = [];
    foreach ($data as $row) {
      $time = new DateTime($row[0]);
      // Reformat the time so that monthly report can be obtained
      $month = $time->format('Y-m');
      $category = $row[1];
      // Create a key and group the same month/category together
      $name = $month . "-" . $category;
      // Add the pre-tax amount and tax amount together
      $amount = $row[5] + $row[7];
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

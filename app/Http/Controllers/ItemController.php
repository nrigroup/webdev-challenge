<?php

namespace App\Http\Controllers;

use DB;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // insert data
    public function insertData(Request $request)
    {
        try {
            // get file content
            $file = $request->file('file')->get();

            // create csv map
            $csv = str_getcsv($file, "\n");

            // declare file index
            $index = 0;

            // foreach the csv file
            foreach($csv as &$record) {
                // check for header
                if ($index > 0) {
                    // get the record as array
                    $record = str_getcsv($record, ",");

                    // create new item
                    $item = new Item([
                        'date' => date('Y-m-d', strtotime(str_replace('-', '/', $record[0]))),
                        'category' => $record[1],
                        'lot_title' => $record[2],
                        'lot_location' => "'" . $record[3] . "'",
                        'lot_condition' => "'" . $record[4] . "'",
                        'pre_tax_amount' => $record[5],
                        'tax_name' => $record[6],
                        'tax_amount' => $record[7]
                    ]);

                    // save item
                    $item->save();
                }

                // increment index
                $index ++;
            }

            // get total per month
            $total_per_month = DB::table('items')->select(DB::raw('sum(pre_tax_amount) as `amount`'), DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year', 'month')->get();

            // get total per category
            $total_per_category = DB::table('items')->select(DB::raw('sum(pre_tax_amount) as `amount`'), DB::raw('category'))->groupby('category')->get();

            // return the JSON
            return response()->json([
                'status' => true,
                'total_per_month' => $total_per_month, 
                'total_per_category' => $total_per_category
            ], 201);
        }
        // catch any exception
        catch (Exception $error) {
            // return status as false and error message
            return response()->json([
                'status' => false,
                'error' => $error->getMessage()
            ], 201);
        }
    }

}

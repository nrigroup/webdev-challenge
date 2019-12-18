<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // insert data
    public function insertData(Request $request)
    {
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
                    'category' => "'" . $record[1] . "'",
                    'lot_title' => "'" . $record[2] . "'",
                    'lot_location' => "'" . $record[3] . "'",
                    'lot_condition' => "'" . $record[4] . "'",
                    'pre_tax_amount' => $record[5],
                    'tax_name' => "'" . $record[6] . "'",
                    'tax_amount' => $record[7]
                ]);

                // save item
                $item->save();
            }

            // increment index
            $index ++;
        }

        //return response()->json(['status' => true], 201);
        return $csv;
    }

}

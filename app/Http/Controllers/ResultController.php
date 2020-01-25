<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;

class ResultController extends BaseController
{
    public function index(Request $request){
        $file = $request->file('fileToUpload');
        if ($file) {
            $fpath = $file->getPath() . '/' . $file->getBasename();
            $content = fopen($fpath, "r");
            $header = true;
            while (($row = fgetcsv($content)) !== false) {
                if ($header) {
                    $header = false;
                    continue;
                }
                $date = new DateTime($row[0]);

                DB::insert('insert into data (date, category, lot_title, lot_location, lot_condition, pre_tax_amount, tax_name, tax_amount) values (?, ?, ?, ?, ?, ?, ?, ?)', [$date->format('Y-m-d H:i:s'), $row[1], $row[2], $row[3],$row[4], $row[5], $row[6], $row[7]]);
            }
        }

        // Generate total value per category per month
        $info = DB::select('select date, category, pre_tax_amount, tax_amount from data');
        $result = array();
        foreach ($info as $row) {
            $date = new DateTime($row->date);
            $key = $date->format('Y-m') . $row->category;
            if (array_key_exists($key, $result)) {
                if (array_key_exists('total', $result[$key])) {
                    $result[$key]['total'] = $result[$key]['total'] + $row->pre_tax_amount + $row->tax_amount;
                }
            } else {
                $result[$key] = array(
                    'time' => $date->format('Y-m'),
                    'category' => $row->category,
                    'total' => $row->pre_tax_amount +  $row->tax_amount
                );
            }
        }

        return view('result', ['result' => $result]);
    }
}
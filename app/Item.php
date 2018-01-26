<?php

namespace App;

use Carbon\Carbon;


class Item extends Model
{

public static function getTotalSpendingPerCategory() {
        $categories = collect ();
        foreach (Item::select('category')->distinct()->get() as $item) {

            $pre_tax_amount = 
                Item::where('category', '=', $item->category)->get()->sum('pre_tax_amount');
            $tax_amount = 
                Item::where('category', '=', $item->category)->get()->sum('tax_amount');

            $categories->push([
                'category'           => $item->category,
                'pre_tax_amount'     => $pre_tax_amount,
                'tax_amount'         => $tax_amount,
                'amount'             => $pre_tax_amount + $tax_amount
            ]);
        } 
        return $categories->keyBy('category');
 }

public static function getTotalSpendingPerMonth() {
        $totals = collect([]);
        foreach (Item::orderBy('date')->get() as $item) {
            $date = Carbon::parse($item->date)->format('M Y');
            $totals = $totals->keyBy('date'); 
            $c = $totals->where('date', '=', $date);
            
            if ($c->isEmpty()) {
                $totals->push([
                    'date'               => $date,
                    'pre_tax_amount'     => $item->pre_tax_amount,
                    'tax_amount'         => $item->tax_amount,
                    'amount'             => $item->pre_tax_amount + $item->tax_amount
                ]);
            }
            else {
                    $d = $c->first();
                    $pre_tax_amount = $d['pre_tax_amount'];
                    $tax_amount     = $d['tax_amount'];
                    $amount         = $d['amount'];
                
                $totals->merge([
                    'date'               => $date,
                    'pre_tax_amount'     => $pre_tax_amount + $item->pre_tax_amount,
                    'tax_amount'         => $tax_amount + $item->tax_amount,
                    'amount'             => $amount + $item->pre_tax_amount + $tax_amount
                ]);

            }
        }

        return $totals;

}


/*
public static function getTotalSpendingPerMonth() {
        $totals = collect([]);
        foreach (Item::orderBy('date')->get() as $item) {
            $date = Carbon::parse($item->date)->format('M Y');
            $totals = $totals->keyBy('date'); 
            $c = $totals->where('date', '=', $date);
            
            if ($c->isEmpty()) {
                $totals->push([
                    'date'               => $date,
                    'pre_tax_amount'     => $item->pre_tax_amount,
                    'tax_amount'         => $item->tax_amount,
                    'amount'             => $item->pre_tax_amount + $item->tax_amount
                ]);
            }
            else {
                foreach($c as $d) {
                    $pre_tax_amount = $d['pre_tax_amount'];
                    $tax_amount     = $d['tax_amount'];
                    $amount         = $d['amount'];
                }
                $totals = $totals->merge([
                    'date'               => $date,
                    'pre_tax_amount'     => $pre_tax_amount + $item->pre_tax_amount,
                    'tax_amount'         => $tax_amount + $item->tax_amount,
                    'amount'             => $amount + $item->pre_tax_amount + $tax_amount
                ]);

            }
        }

        return $totals;

}
*/

    public static function storeCSV($csv_file, $options) 
    {

        if ($options['fresh'] == 'on') {
            Item::truncate();
        }


    	$file = fopen($csv_file,"r");

    	$row = fgetcsv($file); // get header
    	
        // add item

    	while (($row = fgetcsv($file)) !== FALSE) {


            $item = Item::firstOrCreate([
                'date'            => new Carbon($row[0]), // date format written by humans
                'category'        => $row[1],
                'lot_title'       => $row[2],
                'lot_location'    => $row[3],
                'lot_condition'   => $row[4],
                'pre_tax_amount'  => $row[5],
                'tax_name'        => $row[6],
                'tax_amount'      => $row[7]
            ]);

            $item->save();
        }
        
    	fclose($file);

    }
}

<?php

namespace App\Imports;

use App\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Log;

class ItemImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Log::info('This is some useful information.');
        return new Item([ 
            'date'  => Carbon::createFromFormat('m/d/Y', $row['date'])->format('Y-m-d'),
            'category' => $row['category'],
            'lot_title' => $row['lot_title'],
            'lot_location' => $row['lot_location'],
            'lot_condition' => $row['lot_condition'],
            'pre_tax_amount'  => $row['pre_tax_amount'],
            'tax_name' => $row['tax_name'],
            'tax_amount' => $row['tax_amount'],
        ]);
    }
}

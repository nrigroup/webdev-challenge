<?php

namespace App\Imports;

use App\Item;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ItemsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        //Item details as provided in the data.csv
        return new Item([
            //Item details
            //'date'     => Carbon::createFromFormat('m/d/y',$row['date']) ,
            'date'     => Carbon::parse($row['date']),
            'category'     => $row['category'],
            'lot_title'     => $row['lot title'],
            'lot_location'     => $row['lot location'],
            'lot_condition'     => $row['lot condition'],
            'pre_tax_amount'     => $row['pre-tax amount'],
            'tax_name'     => $row['tax name'],
            'tax_amount'     => $row['tax amount'],
        ]);
    }

    /**
     * @return int
     */
}

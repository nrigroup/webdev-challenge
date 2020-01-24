<?php

namespace App\Imports;

use App\Data_Items;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportData_Items implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Data_Items([
            //
            'date' => @row[0],
            'category' => @row[1],
            'lot_title' => @row[2],
            'lot_location' => @row[3],
            'lot_condition' => @row[4],
            'pre_tax_amount' => @row[5],
            'tax_name' => @row[6],
            'tax_amount' => @row[7]
        ]);
    }
}

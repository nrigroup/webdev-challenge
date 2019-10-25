<?php

namespace App\Imports;

use App\Products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $newDateFormat2 = date('Y-m-d', strtotime($row['date']));
       return new Products([
        'date' => $newDateFormat2,
        'category'=> $row['category'],
        'lot_title'=> $row['lot_title'],
         'lot_location' => $row['lot_location'],
         'lot_condition' => $row['lot_condition'],
         'pre_tax_amount' => $row['pre_tax_amount'],
         'tax_name' => $row['tax_name'],
         'tax_amount' => $row['tax_amount'],


        ]);
    }
}

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
            'First name' => @row[0],
            'Last name' => @row[1],
            'Address' => @row[2],
            'Province' => @row[3]
        ]);
    }
}

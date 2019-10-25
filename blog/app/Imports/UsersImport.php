<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'category'     => $row['category'],
            'email'    => $row['email'],
            'password' => \Hash::make($row['password']),
            'lot_title' => $row['lot_title'],
             'lot_location' => $row['lot_location'],
              'lot_condition' => $row['lot_condition'],
               'pre_tax_amount' => $row['pre_tax_amount'],
               'tax_name' => $row['tax_name'],
                'tax_amount' => $row['tax_amount'],
                 'date' => $row['date'],

        ]);
    }
}

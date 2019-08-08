<?php

namespace App\Imports;

use App\Category;
use App\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Class LotImport
 * @package App\Imports
 */
class LotImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * Add items to the item table
     *
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //find category id
        $cat_id = Category::where('category',$row['category'])->firstOrFail()->id;

        //insert new item into item table
        return new Item([
            'date' => $row['date'],
            'category_id' => $cat_id,
            'title' => $row['lot_title'],
            'location' => $row['lot_location'],
            'condition' => $row['lot_condition'],
            'amount_pre_tax' => $row['pre_tax_amount'],
            'tax_name' => $row['tax_name'],
            'tax_amount' => $row['tax_amount'],
        ]);
    }

    /**
     * Import the data in chunks if in case CSV contains alot if records
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}

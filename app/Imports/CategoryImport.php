<?php

namespace App\Imports;

use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * Add categories into category table
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Category::firstOrNew(['category' => $row['category']]);
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

<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    public static function insertData($data){

        // Check if the data already exists in the lots table
        $value=DB::table('lots')
        ->where([
            ['lot_title', $data['lot_title']],
            ['date', $data['date']],
            ['category', $data['category']],
            ['lot_location', $data['lot_location']],
            ['total_spending', $data['total_spending']],
            ['tax_name', $data['tax_name']]])
        ->get();
        if($value->count() == 0){
            // Add the lot to the lots table in the database
            DB::table('lots')->insert($data);
        }
     }
}

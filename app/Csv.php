<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Csv extends Model
{
    public static function insertData($data){
        DB::table('imported_data')->insert($data);
    }

    public static function showData(){
        
        $monthWiseRecords = DB::select('SELECT YEAR(date)as LotYear, date_format(date,"%M") as LotMonth, category as Category, SUM(`pre_tax_amount`) as TotalPreTaxAmount, sum(`tax_amount`) as TotalTaxAmount From imported_data group by LotYear DESC,LotMonth,Category');
        return $monthWiseRecords;
    }
}

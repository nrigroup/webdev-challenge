<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    //Disable the timestamp fields
    const UPDATED_AT = null;

    const CREATED_AT = null;

    //Name the table
    protected $table = 'csv_data';

    //Set fillable fields
    public $fillable = ["date","category","lot_title","lot_location","lot_condition","pre_tax_amount","tax_name","tax_amount"];

    /**
     * getCategoryPerMonth() - Fetches the calculated total category spending per month
     * @return {Array} results from DB
     */
    public static function getCategoryPerMonth(){
        $result = array();
        for ($i=1; $i < 13 ; $i++) { 
            # code...
            $row = DB::SELECT('SELECT category, SUM(pre_tax_amount) from csv_data WHERE month(date) = ? GROUP BY category', [$i]);
            if($row){
                $result[$i] = $row;

            }

        }
        return json_decode(json_encode($result), true);;
    }

    /**
     * getByMonthTotal() - Fetches calculated total spending per month
     * @return {Array} results from DB
     */
    public static function getByMonthTotal(){
        $result = array();
        for ($i=1; $i < 13 ; $i++) { 
            $row = (array) DB::SELECT('SELECT month(date), SUM(pre_tax_amount) from csv_data WHERE month(date) = ? GROUP BY month(date)', [$i]);
            if($row){
                $result[$i] = $row[0];
            }
        }
        return json_decode(json_encode($result), true);;
    }

    /** 
     * getByCategoryTotal() - Fetches calculated total spending per category
     * @return {Array} - fetched results from DB
     */
    public static function getByCategoryTotal(){
        $result = DB::SELECT('SELECT month(date), category, SUM(pre_tax_amount) from csv_data GROUP BY category');
        return json_decode(json_encode($result), true);
    }
}

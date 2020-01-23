<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'date', 'category', 'lot_title', 'lot_location', 'lot_condition' ,'pretax_amount', 'tax_name', 'tax_amount'
    ];

    /* Insert data to database */
    public static function insertData($data){
        DB::table('auctions')->insert($data);
    }

    /* Get the total spending per-month   */
    public static function totalPreMonth(){
        $data = DB::table('auctions')->select(DB::raw('substr(date,1,2) as month'), DB::raw('SUM(tax_amount) as total'))->groupBy("month")->get();
        return $data;
    }
    /* Get the total spending per-month  */
    public static function totalPreCategory(){

        $data = DB::table('auctions')->select('category', DB::raw('SUM(tax_amount) as total'))->groupBy("category")->get();
        return $data;
    }
}

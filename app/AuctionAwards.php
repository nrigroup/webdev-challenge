<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AuctionAwards extends Model
{
     public static function insertData($data){

        DB::table('auction_awards')->insert($data);



    /*  $value=DB::table('auction_awards')->where('auctionNumber', $data['auctionNumber'])->get();
      if($value->count() == 0){
         DB::table('auction_awards')->insert($data);
      }
	*/
   }

   
   protected $fillable = [
        'auctionDate',
        'category',
        'lotTitle',
        'lotLocation',
        'lotCondition',
        'preTaxAmount',
        'taxName',
        'taxAmount',
        'created_at',
        'created_at'
    ];
}

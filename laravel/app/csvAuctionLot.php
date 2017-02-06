<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class csvAuctionLot extends Model
{   
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'csv_auction_lots';
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;
}
